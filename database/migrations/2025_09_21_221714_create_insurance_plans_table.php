<?php

declare(strict_types=1);

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
        Schema::create('insurance_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Insurance::class)->constrained();
            $table->foreignIdFor(App\Models\State::class)->constrained();
            $table->string('insurance_plan_name');
            $table->string('insurance_plan_code');
            $table->date('insurance_start_date');
            $table->date('insurance_end_date')->nullable();
            $table->text('insurance_plan_description')->nullable();
            $table->text('insurance_plan_condition')->nullable();
            $table->boolean('authorisation')->default(true);
            $table->timestamps();

            $table->unique(['insurance_id', 'insurance_plan_name']);
            $table->unique(['insurance_id', 'insurance_plan_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance_plans');
    }
};
