<?php

declare(strict_types=1);

use App\Models\City;
use App\Models\InsuranceType;
use App\Models\State;
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
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(InsuranceType::class)->nullable()->constrained();
            $table->foreignIdFor(State::class)->constrained();
            $table->foreignIdFor(City::class)->nullable()->constrained();
            $table->string('insurance_name')->unique();
            $table->string('insurance_acronym')->nullable();
            $table->string('insurance_code')->nullable();
            $table->string('insurance_cuit')->nullable();
            $table->string('insurance_address');
            $table->string('insurance_phone');
            $table->string('insurance_zipcode')->nullable();
            $table->string('insurance_email')->nullable();
            $table->string('insurance_web')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurances');
    }
};
