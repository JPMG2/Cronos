<?php

declare(strict_types=1);

use App\Models\Credential;
use App\Models\Degree;
use App\Models\Person;
use App\Models\Specialty;
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
            $table->foreignIdFor(Person::class)->constrained();
            $table->foreignIdFor(Credential::class)->constrained();
            $table->foreignIdFor(Specialty::class)->nullable()->constrained();
            $table->foreignIdFor(Degree::class)->nullable()->constrained();
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
