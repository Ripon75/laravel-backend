<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Utils\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Authcontroller extends Controller
{
    protected $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->All(), [
            'name'         => ['required'],
            'email'        => ['nullable', 'unique:users,email'],
            'phone_number' => ['required', 'unique:users,phone_number'],
            'password'     => ['required', 'confirmed']
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return $this->response->error(null, $validator->errors());
        }

        $name        = $request->input('name', null);
        $email       = $request->input('email', null);
        $phoneNumber = $request->input('phone_number', null);
        $password    = $request->input('password', null);

        $userObj = new User();

        $userObj->name         = $name;
        $userObj->email        = $email;
        $userObj->phone_number = $phoneNumber;
        $userObj->password     = Hash::make($password);

        $res = $userObj->save();
        if ($res) {
            return $this->response->response($userObj, __('auth.admin_create'));
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->All(), [
            'phone_number' => ['required'],
            'password'     => ['required']
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return $this->response->error(null, $validator->errors());
        }

        $phoneNumber = $request->input('phone_number', null);
        $password    = $request->input('password', null);

        $user = User::where('phone_number', $phoneNumber)->first();

        if ($user && Hash::check($password, $user->password)) {
            $token = $user->createToken('user-token', ['type:user'])->plainTextToken;

            return $this->response->response($user, __('auth.user_info'), $token);
        } else {
            return $this->response->error(null, __('auth.failed'));
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return $this->response->response(null, __('auth.user_logout'), null);
    }
}
