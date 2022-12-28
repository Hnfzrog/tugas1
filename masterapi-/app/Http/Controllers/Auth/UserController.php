<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PersonalToken;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    public function register(Request $request) {
        $validasi = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validasi->fails()) {
            return $this->error($validasi->errors()->first());
        }

        $user = User::create(array_merge($request->all(), [
            'password' => bcrypt($request->password)
        ]));

        if ($user) {
            return $this->success($user, 'selamat datang ' . $user->name);
        } else {
            return $this->error("Terjadi kesalahan");
        }
    }

    public function update(Request $request, $id) {

        $user = User::where('id', $id)->first();
        if ($user) {
            $user->update($request->all());
            return $this->success($user);
        }

        return $this->error("tidak ada user");
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function success($data, $message = "success"): JsonResponse {
        return response()->json([
            'code' => 200,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function error($message): JsonResponse {
        return response()->json([
            'code' => 400,
            'message' => $message
        ], 400);
    }

    public function generateToken(): string {
        $alfabet = "abcdefghijklmnopqrstuvwxyz";
        $alfabetUpercase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $numeric = "1234567890";
        $allCart = $alfabet . $alfabetUpercase . $numeric;
        return substr(str_shuffle($allCart), 0, 60);
    }
}
