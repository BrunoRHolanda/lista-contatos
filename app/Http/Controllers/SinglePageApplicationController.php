<?php

namespace App\Http\Controllers;


use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;

/**
 * Controller que renderiza a SPA.
 *
 * Class SinglePageApplicationController
 *
 * @package App\Http\Controllers
 */
class SinglePageApplicationController extends Controller
{
    /**
     * Renderiza a SPA na tela do usuário.
     *
     * @return Factory|View
     */
    public function vue()
    {
        return view('app');
    }
}
