<?php

namespace App\Http\Controllers\Api\V1;


use Exception;
use Illuminate\Http\JsonResponse;

use App\Repository\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\UserRequest;

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
        $user = $this->userRepository->create($request->only('name', 'email', 'password'));

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $user = $this->userRepository->find($id);

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(UserRequest $request, int $id)
    {
        $user = $this->userRepository->update($id, $request->only('name', 'email', 'password'));

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['error' => 'Usuário não encontrado'], 400);
        }
    }

    /**
     * Exclui a própria conta.
     *
     * @return JsonResponse
     */
    public function destroy()
    {
        try {
            $user = $this->userRepository->remove(auth()->user()->id);

            auth()->logout();

            return response()->json($user);
        } catch (Exception $e) {
            return response()->json(['error' => 'não foi possível processar operação!'], 500);
        }
    }
}
