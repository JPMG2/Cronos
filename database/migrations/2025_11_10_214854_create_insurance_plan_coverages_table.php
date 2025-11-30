<?php

declare(strict_types=1);

use App\Models\InsurancePlan;
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
        Schema::create('insurance_plan_coverages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(InsurancePlan::class)->constrained()->cascadeOnDelete();
            $table->morphs('coverable');
            $table->decimal('plan_price', 10, 2)->nullable();
            $table->decimal('plan_coverage_percentage', 5, 2)->nullable();
            $table->decimal('deductible_amount', 10, 2)->nullable();
            $table->decimal('coinsurance_percentage', 5, 2)->nullable();
            $table->decimal('max_amount_per_event', 10, 2)->nullable();
            $table->integer('annual_max_uses')->nullable();
            $table->boolean('requires_referral')->nullable()->default(false);
            $table->text('coverage_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('insurance_plan_id');
            $table->unique(
                ['insurance_plan_id', 'coverable_type', 'coverable_id', 'deleted_at'],
                'unique_plan_coverage',
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance_plan_coverages');
    }
};
