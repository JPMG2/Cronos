<?php

use App\Models\Action;
use App\Models\Role;
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
        Schema::create('action_role', function (Blueprint $table) {
            $table->id();
            $table->primary(['action_id', 'role_id']);
            $table->foreignIdFor(Action::class)->constrained();
            $table->foreignIdFor(Role::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('action_role');
    }
};
