<?php

use App\Models\City;
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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(State::class);
            $table->foreignIdFor(City::class);
            $table->string('company_name')->unique();
            $table->string('company_cuit')->unique();
            $table->string('company_address');
            $table->string('company_phone');
            $table->string('company_zipcode')->nullable();
            $table->string('company_email')->unique();
            $table->string('company_web')->nullable();
            $table->string('company_person_contact');
            $table->string('company_person_phone');
            $table->string('company_person_email');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
