<?php

namespace App\Models;

use App\Models\Scopes\SortByNameScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subdistrict extends Model
{
    use HasFactory, HasUuids;

    
    protected $fillable = [
        'district_id',
        'name',
    ];

    public function District()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new SortByNameScope);
    }
}
