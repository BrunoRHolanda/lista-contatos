<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\ContactRequest;
use App\Repository\ContactRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ContactController extends Controller
{
    /**
     * @var ContactRepository
     */
    private $contactRepository;

    /**
     * ContactController constructor.
     *
     * @param ContactRepository $contactRepository
     *
     */
    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;

        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $user = auth()->user();

        $contacts = $this->contactRepository->findAllByUser($user->id);

        return response()->json($contacts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContactRequest $request
     *
     * @return JsonResponse
     */
    public function store(ContactRequest $request)
    {
        $contact = $this->contactRepository->createByUser(
            auth()->user(),
            $request->only('name', 'email', 'telephone')
        );

        return response()->json($contact, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return JsonResponse
     *
     */
    public function show(int $id)
    {
        $user = auth()->user();

        $contact = $this->contactRepository->findByUser($user->id, $id);

        return response()->json($contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ContactRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(ContactRequest $request, int $id)
    {
        $contact = $this->contactRepository->update($id, $request->only('name', 'email', 'telephone'));

        if ($contact) {
            return response()->json($contact);
        } else {
            return response()->json(['error' => 'Contato não encontrado'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id)
    {
        $user = auth()->user();

        try {
            $contact = $this->contactRepository->removeByUser($user->id, $id);

            return response()->json($contact);
        } catch (Exception $e) {
            return response()->json(['error' => 'não foi possível processar operação!'], 500);
        }
    }

    /**
     * busca textual ou por inicial do nome do contato.
     *
     * @param string $text
     *
     * @return JsonResponse
     */
    public function search(string $text)
    {
        $user = auth()->user();

        $contacts = $this->contactRepository->findBySearchText($user->id, $text);

        return response()->json($contacts);
    }
}
