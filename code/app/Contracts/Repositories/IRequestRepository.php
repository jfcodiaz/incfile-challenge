<?php

namespace App\Contracts\Repositories;

use App\Models\Request;

interface IRequestRepository
{
    public function create(): Request;
    public function getById(int $id): Request;
    public function getCount(): int;
    public function getCountDelivereds(): int;
    public function getCountPendings(): int;
}
