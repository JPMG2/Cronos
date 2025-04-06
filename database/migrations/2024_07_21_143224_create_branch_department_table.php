<?php

declare(strict_types=1);

use App\Models\Branch;
use App\Models\Department;
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
        Schema::create('branch_department', function (Blueprint $table) {
            $table->id();
            $table->unique(['branch_id', 'department_id']);
            $table->foreignIdFor(Branch::class)->constrained();
            $table->foreignIdFor(Department::class)->constrained();
            $table->foreignIdFor(State::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_department');
    }
};
