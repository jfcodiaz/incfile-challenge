<?php

namespace App\Repositories;

use App\Contracts\Repositories\IRequestRepository;
use App\Models\Request;

class RequestRepository implements IRequestRepository
{

    public function create(): Request
    {
        $request = new Request();
        $request->status = Request::PENDING;
        $request->save();

        return $request;
    }

    public function getById($id): Request
    {
        return Request::find($id);
    }
}
