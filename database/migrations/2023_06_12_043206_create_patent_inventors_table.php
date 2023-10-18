<?php

use App\Models\Country;
use App\Models\District;
use App\Models\Province;
use App\Models\Subdistrict;
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
        Schema::create('patent_inventors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(PatentDetail::class, 'detail_id');
            $table->foreign('detail_id')->references('id')->on('patent_details')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->foreignIdFor(Country::class, 'nationality_id');
            $table->foreign('nationality_id')->references('id')->on('countries')->onDelete('cascade')->onUpdate('cascade');
            $table->string('address');
            $table->foreignIdFor(Country::class, 'country_id');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(Province::class, 'province_id')->nullable();
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(District::class, 'district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(Subdistrict::class, 'subdistrict_id')->nullable();
            $table->foreign('subdistrict_id')->references('id')->on('subdistricts')->onDelete('cascade')->onUpdate('cascade');
            $table->string('email');
            $table->string('telephone');
            $table->boolean('is_manageable')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patent_inventors');
    }
};
