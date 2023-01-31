<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Utils\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
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
            'email'        => ['nullable', 'unique:admins,email'],
            'phone_number' => ['required', 'unique:admins,phone_number'],
            'password'     => ['required', 'confirmed']
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return $this->response->error(null, $validator->errors());
        }

        $name        = $request->input('name', null);
        $email       = $request->input('email', null);
        $phoneNumber = $request->input('phone_number', null);
        $password    = $request->input('password', null);

        $adminObj = new Admin();

        $adminObj->name         = $name;
        $adminObj->email        = $email;
        $adminObj->phone_number = $phoneNumber;
        $adminObj->password     = Hash::make($password);

        $res = $adminObj->save();
        if ($res) {
            return $this->response->response($adminObj, __('auth.admin_create'));
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

        $admin = Admin::where('phone_number', $phoneNumber)->first();

        if ($admin && Hash::check($password, $admin->password)) {
            $token = $admin->createToken('admin-token', ['type:admin'])->plainTextToken;

            return $this->response->response($admin, __('auth.admin_info'), $token);
        } else {
            return $this->response->error(null, __('auth.failed'));
        }
    }

    public function logout()
    {
        $user = Auth::user();
        $user->tokens()->delete();

        return $this->response->response(null, __('auth.admin_logout'), null);
    }
}
