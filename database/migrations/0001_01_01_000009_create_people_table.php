<?php

declare(strict_types=1);

use App\Models\Document;
use App\Models\Gender;
use App\Models\MaritalStatus;
use App\Models\Nationality;
use App\Models\Occupation;
use App\Models\Province;
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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Document::class)->nullable()->constrained();
            $table->foreignIdFor(Province::class)->nullable()->constrained();
            $table->foreignIdFor(Gender::class)->nullable()->constrained();
            $table->foreignIdFor(MaritalStatus::class)->nullable()->constrained();
            $table->foreignIdFor(Occupation::class)->nullable()->constrained();
            $table->foreignIdFor(Nationality::class)->nullable()->constrained();
            $table->string('num_document')->nullable();
            $table->string('person_name');
            $table->string('person_lastname');
            $table->date('person_datebirth')->nullable();
            $table->string('person_address')->nullable();
            $table->string('person_phone')->nullable();
            $table->string('person_email')->nullable();
            $table->string('person_cpcode')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
