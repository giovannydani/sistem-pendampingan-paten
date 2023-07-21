<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatentDocument extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'detail_id',
        'title_id',
        'title_en',
        'abstract_id',
        'abstract_en',
    ];

    
}
