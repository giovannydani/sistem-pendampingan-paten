<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatentApplicant extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'detail_id',
        'nationality_id',
        'name',
        'address',
        'country_id',
        'province_id',
        'district_id',
        'subdistrict_id',
        'telephone',
        'email',
    ];

    public function Nationality(): BelongsTo 
    {
        return $this->belongsTo(Country::class, 'nationality_id');   
    }

    public function Country(): BelongsTo
    {
        return $this->belongTo(Country::class, 'country_id');
    }

    public function Province(): BelongsTo
    {
        return $this->belongTo(Province::class, 'province_id');
    }

    public function District(): BelongsTo
    {
        return $this->belongTo(District::class, 'district_id');
    }

    public function Subdistrict(): BelongsTo
    {
        return $this->belongTo(Subdistrict::class, 'subdistrict_id');
    }
}
