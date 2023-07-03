<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatentCorrespondence extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'detail_id',
        'name',
        'address',
        'telephone',
        'email',
        'legal_entity_name',
    ];
}
