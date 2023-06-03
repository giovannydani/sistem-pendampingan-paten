<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatentType extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'have_origin_patent',
    ];
}