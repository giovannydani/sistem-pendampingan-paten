<?php

use App\Models\Criteria;
use App\Models\PatentType;
use App\Models\User;
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
            $table->foreignIdFor(PatentType::class, 'type_id')->nullable();
            $table->foreign('type_id')->references('id')->on('patent_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(Criteria::class, 'criteria_id')->nullable();
            $table->foreign('criteria_id')->references('id')->on('criterias')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->string('title_en');
            $table->longText('abstract');
            $table->longText('abstract_en');
            $table->unsignedInteger('total_claim');
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
