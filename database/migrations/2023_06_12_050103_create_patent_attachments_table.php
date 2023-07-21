<?php

use App\Models\PatentDetail;
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
        Schema::create('patent_attachments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(PatentDetail::class, 'detail_id');
            $table->foreign('detail_id')->references('id')->on('patent_details')->onDelete('cascade')->onUpdate('cascade');
            $table->string('description_id')->nullable();
            $table->string('description_en')->nullable();
            $table->string('sequence')->nullable();
            $table->string('claim')->nullable();
            $table->string('abstract')->nullable();
            $table->string('technical_pict')->nullable();
            $table->string('pict_to_show_on_announcement')->nullable();
            $table->json('attachment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patent_attachments');
    }
};
