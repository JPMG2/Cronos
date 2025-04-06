<?php

declare(strict_types=1);

use App\Models\City;
use App\Models\Company;
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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Company::class)->constrained();
            $table->foreignIdFor(State::class)->constrained();
            $table->foreignIdFor(City::class)->constrained();
            $table->string('branch_name')->unique();
            $table->string('branch_code')->unique();
            $table->string('branch_address');
            $table->string('branch_phone');
            $table->string('branch_zipcode')->nullable();
            $table->string('branch_email')->unique();
            $table->string('branch_web')->nullable();
            $table->string('branch_person_contact');
            $table->string('branch_person_phone');
            $table->string('branch_person_email');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
