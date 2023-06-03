<?php

use App\Models\Country;
use App\Models\District;
use App\Models\PatentDetail;
use App\Models\Province;
use App\Models\Subdistrict;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patent_owners', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(PatentDetail::class, 'detail_id')->nullable();
            $table->foreign('detail_id')->references('id')->on('patent_details')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(Country::class, 'country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(Province::class, 'province_id')->nullable();
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(District::class, 'district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(Subdistrict::class, 'subdistrict_id')->nullable();
            $table->foreign('subdistrict_id')->references('id')->on('subdistricts')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->text('address');
            $table->string('postal_code',6);
            $table->string('email');
            $table->string('telephone');
            $table->boolean('is_company');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patent_owners');
    }
};
