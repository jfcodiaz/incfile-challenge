<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    const PENDING = 0;
    const DELIVERED = 200;
    use HasFactory;
}
