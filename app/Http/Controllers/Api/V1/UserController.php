<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\UserRequest;
use App\Http\Resources\Api\V1\UserCollection;
use App\Repository\UserRepository;
use App\User;
use Exception;
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
     * @return UserCollection
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->only('name', 'email', 'password'));

        $user = $this->userRepository->save($user);

        return new UserCollection($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return UserCollection
     */
    public function show(int $id)
    {
        $user = $this->userRepository->find($id);

        return new UserCollection($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     *
     * @param  int  $id
     *
     * @return UserCollection
     */
    public function update(UserRequest $request, int $id)
    {
        $user = $this->userRepository->find($id);

        $user->update($request->only('name', 'email', 'password'));

        return new UserCollection($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return UserCollection
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        try {
            $this->userRepository->remove($user);

            return new UserCollection($user);
        } catch (Exception $e) {
            return response()->json(['error' => 'não foi possível processar operação!', 500]);
        }
    }
}
