<?php

namespace App\Http\Controllers;

use App\Models\CashAccountModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->roleId = $request->roleId;
        $res = $user->save();
        $acc = new CashAccountModel;
        $acc->number = "";
        $acc->balance = 0;
        $acc->userId = $user->id;
        $acc->save();


        if ($res) {
            return response()->json([
                'user'  => $user,
                'token' => $user->createToken('token')->plainTextToken
            ], 200);
        } else {
            return response()->json([], 500);
        }
    }
    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',

            ]
        );
        if ($validator->fails()) {
            return json_encode([
                'message' => $validator->errors()
            ]);
        }

        $user =  User::where('email', $request->email)->first();

        if ($user) {
            if (!Hash::check($request->password, $user->password)) {
                return json_encode([
                    'message' => [
                        'name' =>
                        'Password is wrong'
                    ]
                ]);
            }

            return json_encode([
                'user' =>  $user,
                'token' =>  $user->createToken('token')->plainTextToken
            ]);
        }
        return json_encode([
            'status' => 'failed',
            'message' => [
                'email' =>
                'Email is not found'
            ]
        ]);
    }
}
