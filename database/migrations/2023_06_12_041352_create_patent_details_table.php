<?php

use App\Models\User;
use App\Enums\AjuanStatus;
use App\Models\PatentType;
use App\Models\ApplicantCriteria;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patent_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(User::class, 'owner_id')->nullable();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(PatentType::class, 'patent_type_id')->nullable();
            $table->foreign('patent_type_id')->references('id')->on('patent_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(ApplicantCriteria::class, 'applicant_criterias_id')->nullable();
            $table->foreign('applicant_criterias_id')->references('id')->on('applicant_criterias')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('is_fractions')->default(0);
            $table->string('fractions_number')->nullable();
            $table->date('fractions_date')->nullable();
            $table->string('status')->default(AjuanStatus::AdminCheck->value);
            $table->boolean('is_submited')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patent_details');
    }
};
