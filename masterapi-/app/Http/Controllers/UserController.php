<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helper;
use App\Models\User;
use App\Models\PersonalToken;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request) {
        $validasi = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:6',
        ]);

        if ($validasi->fails()) {
            return $this->error($validasi->errors()->first());
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (password_verify($request->password, $user->password)) {
                $token = PersonalToken::create([
                    'token' => $this->generateToken(),
                    'userId' => $user->id
                ]);

                $user->token = $token->token;
                return $this->success($user);
            } else {
                return $this->error("Wrong password");
            }
        }
        return $this->error("User tidak di temukan");
    }
}
