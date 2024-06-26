<?php

namespace App\Models;

use App\Enums\AjuanStatus;
use Carbon\Carbon;
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
        'bool_fraction',
        'submited_at',
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

    public function PatentInventor(): HasMany {
        return $this->hasMany(PatentInventor::class, 'detail_id');
    }

    public function PatentCorrespondent(): HasOne {
        return $this->hasOne(PatentCorrespondence::class, 'detail_id');
    }

    public function PatentDocument(): HasOne 
    {
        return $this->hasOne(PatentDocument::class, 'detail_id');
    }

    public function PatentClaims(): HasMany 
    {
        return $this->hasMany(PatentClaim::class, 'detail_id');
    }
    
    public function PatentAttachment(): HasOne 
    {
        return $this->hasOne(PatentAttachment::class, 'detail_id');
    }

    public function PatentComments(): HasMany
    {
        return $this->hasMany(PatentComment::class, 'detail_id');
    }

    public function PatentNewComment(): HasOne
    {
        return $this->hasOne(PatentComment::class, 'detail_id')->orderBy('created_at', 'desc');
    }

    protected function statusText(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status->text(),
        );
    }

    protected function boolFraction(): Attribute
    {
        $text = "no";
        if ($this->is_fractions) {
            $text = "yes";
        }
        return Attribute::make(
            get: fn () => $text,
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

    protected function submitedAt(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->updated_at)->format('d-m-Y'),
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

    public function isInventorExist(int $number)
    {
        if (self::PatentInventor()->count() < $number){
            $result = [
                'status' => false,
                'message' => "Inventor harus lebih dari ". $number,
            ];
        }else {
            $result = [
                'status' => true,
                'message' => true,
            ];
        }
        // return $number;

        return (object) $result;
    }

    public function isApplicantExist(int $number)
    {
        if (self::PatentApplicants()->count() < $number){
            $result = [
                'status' => false,
                'message' => "Pemohon harus lebih dari ". $number,
            ];
        }else {
            $result = [
                'status' => true,
                'message' => true,
            ];
        }
        // return $number;

        return (object) $result;
    }
}
