<?php

declare(strict_types=1);

use App\Models\Credential;
use App\Models\Medical;
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
        Schema::create('credential_medical', function (Blueprint $table) {
            $table->id();
            $table->primary(['credential_id', 'medical_id']);
            $table->foreignIdFor(Credential::class)->constrained();
            $table->foreignIdFor(Medical::class)->constrained();
            $table->string('credential_number', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credential_medical');
    }
};
