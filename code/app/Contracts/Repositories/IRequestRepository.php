<?php

namespace App\Contracts\Repositories;

use App\Models\Request;

interface IRequestRepository
{
    public function create(): Request;
    public function getById(int $id): Request;
}
