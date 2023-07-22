<?php

namespace App\Models;

use App\Enums\AjuanStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PatentDetail extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'owner_id',
        'patent_type_id',
        'applicant_criterias_id',
        'is_fractions',
        'fractions_number',
        'fractions_date',
        'status',
        'is_submited',
    ];

    protected $appends = [
        'status_text',
        'is_admin_process',
        'is_revision',
        'is_finish',
    ];

    protected $casts = [
        'status' => AjuanStatus::class,
    ];

    public function Owner(): BelongsTo {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function PatentType(): BelongsTo {
        return $this->belongsTo(PatentType::class, 'patent_type_id');
    }

    public function ApplicantCriteria(): BelongsTo {
        return $this->belongsTo(ApplicantCriteria::class, 'applicant_criterias_id');
    }

    public function PatentApplicant(): HasOne {
        return $this->hasOne(PatentApplicant::class, 'detail_id');
    }

    public function PatentApplicants(): HasMany {
        return $this->hasMany(PatentApplicant::class, 'detail_id');
    }

    public function PatentCorrespondent(): HasOne {
        return $this->hasOne(PatentCorrespondence::class, 'detail_id');
    }

    public function PatentDocument(): HasOne 
    {
        return $this->hasOne(PatentDocument::class, 'detail_id');
    }

    public function PatentClaim(): HasOne 
    {
        return $this->hasOne(PatentClaim::class, 'detail_id');
    }

    public function PatentAttachment(): HasOne 
    {
        return $this->hasOne(PatentAttachment::class, 'detail_id');
    }

    protected function statusText(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status->text(),
        );
    }

    protected function isAdminProcess(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status->isAdminProcess(),
        );
    }

    protected function isRevision(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status->isRevision(),
        );
    }

    protected function isFinish(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status->isFinish(),
        );
    }

    public function scopeAdminProcess(Builder $query): void
    {
        $query->where('status', AjuanStatus::AdminProcess->value);
    }

    public function scopeRevision(Builder $query): void
    {
        $query->where('status', AjuanStatus::Revision->value);
    }

    public function scopeFinish(Builder $query): void
    {
        $query->where('status', AjuanStatus::Finish->value);
    }

    public function scopeIsSubmited(Builder $query): void
    {
        $query->where('is_submited', 1);
    }
}
