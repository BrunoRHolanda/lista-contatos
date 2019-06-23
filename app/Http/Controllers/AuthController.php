<?php

namespace App\Http\Controllers;


use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Routing\ResponseFactory;

use App\Repository\UserRepository;

class AuthController extends Controller
{
    private $userRepository;

    /**
     * Create a new AuthController instance.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->userRepository = $repository;

        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Verifica autenticidade do usuário logado.
     *
     * @param Request $request
     *
     * @return ResponseFactory|Response
     */
    public function impersonate(Request $request)
    {
        $user = $this->userRepository->find($request->get('id'));

        if (!$token = JWTAuth::fromUser($user)) {
            return response([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], 404);
        }
        return response([
            'status' => 'success'
        ])->header('Authorization', $token);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response([
            'status' => 'success'
        ])->header('Authorization', $token);
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me()
    {
        $user = $this->userRepository->find(auth()->user()->id);

        return response([
            'status' => 'success',
            'data' => $user
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        auth()->refresh();

        return response([
            'status' => 'success'
        ]);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken($token)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
