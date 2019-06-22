<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\UserRequest;
use App\Http\Resources\Api\V1\UserCollection;
use App\Repository\UserRepository;
use App\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

        $this->middleware('auth:api', ['except' => ['store']]);
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        // todo implementar listagem de todos os usuário aqui.
        return response()->json(['error' => 'Método não implementado'], 501);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     *
     * @return JsonResponse
     */
    public function store(UserRequest $request)
    {
        $userRequest = $request->only('name', 'email', 'password');

        $user = new User($userRequest);

        $user->password = bcrypt($user->password);

        $this->userRepository->save($user);

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $user = $this->userRepository->find($id);

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     *
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function update(UserRequest $request, int $id)
    {
        $user = $this->userRepository->find($id);

        if ($user) {
            $user->name = $request->filled('name')? $request->input('name') : $user->name;
            $user->email = $request->filled('email')? $request->input('email') : $user->email;
            $user->password = $request->filled('password')? bcrypt($request->input('password')) : $user->password;

            $this->userRepository->save($user);

            return response()->json([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);
        } else {
            return response()->json(['error' => 'Usuário não encontrado'], 400);
        }
    }

    /**
     * Exclui a própria conta.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find(auth()->user()->id);

        try {
            $this->userRepository->remove($user);

            auth()->logout();

            return response()->json([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'não foi possível processar operação!', 500]);
        }
    }
}
