<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatentAttachment extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'detail_id',

        'description_id',
        'description_en',
        'sequence',
        'claim',
        'abstract',
        'technical_pict',
        'pict_to_show_on_announcement',
        'attachment',
    ];

    protected $casts = [
        'attachment' => 'array',
        // 'attachment' => AsCollection::class,
        // 'attachment' => AsArrayObject::class,
    ];
}
