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
        Schema::create('insurance_plans', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(App\Models\Insurance::class)->constrained();
            $table->foreignIdFor(App\Models\State::class)->constrained();
            $table->string('insurance_plan_name')->unique();
            $table->string('insurance_plan_code')->unique();
            $table->date('insurance_start_date');
            $table->date('insurance_end_date');
            $table->text('insurance_plan_description');
            $table->text('insurance_plan_condition');
            $table->boolean('authorisation')->default(true);
            $table->timestamps();
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
