<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationCertificate extends Model
{
    use HasFactory, HasUuids;

    protected $appends = [
        'file_url'
    ];

    protected $fillable = [
        'detail_id',
        'file',
        'file_name',
    ];

    protected function fileUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => asset('storage/'.$this->file),
        );
    }
}
