<?php

namespace App\Models;

use App\Models\Scopes\SortByNameScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory, HasUuids;
    
    protected static function booted(): void
    {
        static::addGlobalScope(new SortByNameScope);
    }
}

