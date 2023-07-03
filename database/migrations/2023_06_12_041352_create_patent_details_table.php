<?php

use App\Models\User;
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
            $table->foreignIdFor(PatentType::class, 'patent_type_id');
            $table->foreign('patent_type_id')->references('id')->on('patent_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(ApplicantCriteria::class, 'applicant_criterias_id');
            $table->foreign('applicant_criterias_id')->references('id')->on('applicant_criterias')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('fractions');
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
