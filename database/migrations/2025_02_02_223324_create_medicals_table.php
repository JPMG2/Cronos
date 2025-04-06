<?php

declare(strict_types=1);

use App\Models\Credential;
use App\Models\Degree;
use App\Models\Specialty;
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
        Schema::create('medicals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(State::class)->constrained();
            $table->foreignIdFor(Credential::class)->constrained();
            $table->foreignIdFor(Specialty::class)->nullable()->constrained();
            $table->foreignIdFor(Degree::class)->nullable()->constrained();
            $table->string('medical_name');
            $table->string('medical_lastname');
            $table->string('medical_address')->nullable();
            $table->string('medical_phone')->nullable();
            $table->string('medical_email')->nullable();
            $table->string('medical_dni')->nullable()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicals');
    }
};
