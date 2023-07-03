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
        Schema::create('patent_priorities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(PatentDetail::class, 'detail_id');
            $table->foreign('detail_id')->references('id')->on('patent_details')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patent_priorities');
    }
};
