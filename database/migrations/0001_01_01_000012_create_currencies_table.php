<?php

declare(strict_types=1);

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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(State::class)->constrained();
            $table->string('currency_code', 3)->unique()->comment('ISO 4217 code: USD, ARS, EUR');
            $table->string('currency_name')->comment('Dólar Estadounidense, Peso Argentino');
            $table->string('currency_symbol', 10)->comment('$, USD, AR$');
            $table->integer('decimal_places')->default(2);
            $table->boolean('is_base')->default(false)->comment('¿Es la moneda base del sistema?');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
