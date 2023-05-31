<?php

namespace App\Models;

use App\Models\Scopes\SortByNameScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'number',
        'name',
    ];

    public function districts()
    {
        return $this->hasMany(District::class, 'province_id');
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new SortByNameScope);
    }}
