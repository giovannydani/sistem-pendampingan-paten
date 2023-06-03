<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatentPriority extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'detail_id',
        'country_id',
        'application_id',
        'date',
        'notes',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
