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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->nullable()->constrained();
            $table->string('name_menu')->nullable();
            $table->string('grup_menu')->nullable();
            $table->boolean('title_menu')->nullable();
            $table->string('header_menu')->nullable();
            $table->text('icon_menu')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('linkto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
