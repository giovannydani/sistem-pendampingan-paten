<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatentDetail extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'owner_id',
        'type_id',
        'criteria_id',
        'title',
        'title_en',
        'abstract',
        'abstract_en',
        'total_claim',
    ];

    public function type()
    {
        return $this->belongsTo(PatentType::class, 'type_id');
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class, 'criteria_id');
    }

    public function owners()
    {
        return $this->hasMany(PatentOwner::class, 'detail_id');
    }

    public function inventors()
    {
        return $this->hasMany(PatentInventor::class, 'detail_id');
    }

    public function priorities()
    {
        return $this->hasMany(PatentPriority::class, 'detail_id');
    }
}
