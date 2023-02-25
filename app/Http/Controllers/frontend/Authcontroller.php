<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Utils\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Authcontroller extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->All(), [
            'name'         => ['required'],
            'email'        => ['nullable', 'unique:users,email'],
            'phone_number' => ['required', 'unique:users,phone_number'],
            'password'     => ['required', 'confirmed']
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return Helper::error(null, $validator->errors());
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
            return Helper::response($userObj, __('auth.user_create'));
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->All(), [
            'phone_number' => ['required'],
            'password'     => ['required']
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return Helper::error(null, $validator->errors());
        }

        $phoneNumber = $request->input('phone_number', null);
        $password    = $request->input('password', null);

        $user = User::where('phone_number', $phoneNumber)->first();

        if ($user && Hash::check($password, $user->password)) {
            $token = $user->createToken('user-token', ['type:user'])->plainTextToken;

            return Helper::response($user, __('auth.user_info'), $token);
        } else {
            return Helper::error(null, __('auth.failed'));
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return Helper::response(null, __('auth.user_logout'), null);
    }
}
