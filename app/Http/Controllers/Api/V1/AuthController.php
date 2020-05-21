<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserLoginRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    /**
     * @SWG\Post(
     *     path = "/auth/register",
     *     summary="Register user",
     *     tags={"Auth"},
     *     @SWG\Parameter(
     *         name="email",
     *         in="formData",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="password",
     *         in="formData",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="recaptcha_token",
     *         in="formData",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *     )
     * )
     */

    public function register(UserCreateRequest $request)
    {
        $user = new User;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['status' => 'success'], 200);
    }

    /**
     * @SWG\Post(
     *     path = "/auth/login",
     *     summary="Login user",
     *     tags={"Auth"},
     *     @SWG\Parameter(
     *         name="email",
     *         in="formData",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="password",
     *         in="formData",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Header(
     *             header="Authorization",
     *             description="Token",
     *             type="string"
     *         )
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Login error"
     *     )
     * )
     */

    public function login(UserLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
        }

        return response()->json(['error' => 'login_error'], 401);
    }

    /**
     * @SWG\Post(
     *     path = "/auth/logout",
     *     summary="Logout user",
     *     tags={"Auth"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation"
     *     )
     * )
     */

    public function logout()
    {
        $this->guard()->logout();

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    /**
     * @SWG\Get(
     *     path="/auth/user",
     *     summary="Get auth user data",
     *     tags={"Auth"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/User")
     *         ),
     *     ),
     * )
     */

    public function user()
    {
        $user = User::find(Auth::user()->id);

        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    /**
     * @SWG\Get(
     *     path = "/auth/refresh",
     *     summary="Refresh user token",
     *     tags={"Auth"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Header(
     *             header="Authorization",
     *             description="Token",
     *             type="string"
     *         )
     *     )
     * )
     */

    public function refresh()
    {
        if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
        }

        return response()->json(['error' => 'refresh_token_error'], 401);
    }

    private function guard()
    {
        return Auth::guard();
    }
}
