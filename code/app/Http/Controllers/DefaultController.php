<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\IRequestRepository;
use Illuminate\Http\Response;
use Illuminate\View\View;


class DefaultController extends Controller
{
    public function random(): Response
    {
        $status = rand(0, 2000) % 2 ? 200 : 404;

        return response($status, $status);
    }

    public function welcome(IRequestRepository $requestRepostitory): View
    {
        return view('welcome', [
            'total' => $requestRepostitory->getCount(),
            'delivereds' => $requestRepostitory->getCountDelivereds(),
            'pendings' => $requestRepostitory->getCountPendings()
        ]);
    }
}
