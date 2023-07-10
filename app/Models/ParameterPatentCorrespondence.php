<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ParameterPatentCorrespondence extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'address',
        'country_id',
        'province_id',
        'district_id',
        'subdistrict_id',
        'telephone',
        'email',
        'legal_entity_name',
    ];

    public function Country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function Province() : BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function District() : BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function Subdistrict() : BelongsTo
    {
        return $this->belongsTo(Subdistrict::class, 'district_id');
    }
}
