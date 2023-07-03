<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatentApplicant extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'detail_id',
        'name',
        'address',
        'telephone',
        'email',
        'nationality',
    ];
}
