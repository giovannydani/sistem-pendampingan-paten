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
        Schema::create('patent_documents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(PatentDetail::class, 'detail_id');
            $table->foreign('detail_id')->references('id')->on('patent_details')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title_id');
            $table->string('title_en')->nullable();
            $table->longText('abstract_id');
            $table->longText('abstract_en')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patent_documents');
    }
};
