<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatentCorrespondence extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'detail_id',
        'name',
        'address', 
        'telephone',
        'country_id',
        'province_id',
        'district_id',
        'subdistrict_id',
        'email',
        'legal_entity_name',
    ];

    protected function completeAddress(): Attribute
    {
        if ($this->country_id == "8d1458c5-dde2-3ac3-901b-29d55074c4ec") {
            $subdistrict = Subdistrict::where('id', $this->subdistrict_id)->first();
            $district = District::where('id', $this->district_id)->first();
            $province = Province::where('id', $this->province_id)->first();
            $country = Country::where('id', $this->country_id)->first();
            $address = $this->address .', '.$subdistrict->name.', '.$district->name.', '.$province->name.', '.$country->name;
        }

        // return Attribute::make(
        //     get: fn($val) => 'awkwwk',
        // );
        // return new Attribute(
        //     get: fn () => 'yes',
        // );

        return Attribute::make(
            get: fn () => $address,
        );
    }

    protected $appends = [
        'complete_address',
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
