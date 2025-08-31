<?php

declare(strict_types=1);

use App\Models\BloodType;
use App\Models\Person;
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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Person::class)->constrained();
            $table->foreignIdFor(BloodType::class)->nullable()->constrained();
            $table->string('patient_photo')->nullable();
            $table->string('patient_weight')->nullable();
            $table->string('patient_height')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
