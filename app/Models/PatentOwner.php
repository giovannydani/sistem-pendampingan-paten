<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatentOwner extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'detail_id',
        'country_id',
        'province_id',
        'district_id',
        'subdistrict_id',
        'name',
        'address',
        'postal_code',
        'email',
        'telephone',
        'is_company',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function subdistrict()
    {
        return $this->belongsTo(Subdistrict::class, 'subdistrict_id');
    }
}
