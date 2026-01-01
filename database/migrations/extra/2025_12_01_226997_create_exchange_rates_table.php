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
        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->id();

            // Moneda origen (FROM)
            $table->foreignId('from_currency_id')
                ->constrained('currencies')
                ->cascadeOnDelete();

            // Moneda destino (TO)
            $table->foreignId('to_currency_id')
                ->constrained('currencies')
                ->cascadeOnDelete();

            // Tasa de cambio
            $table->decimal('rate', 20, 8)
                ->comment('Tasa: 1 FROM = X TO. Ej: 1 USD = 1000 ARS → rate = 1000');

            // Vigencia
            $table->date('effective_date')
                ->comment('Fecha de vigencia de este tipo de cambio');

            // Tipo de cambio (compra/venta/oficial)
            $table->enum('rate_type', ['official', 'compra', 'venta', 'promedio'])
                ->default('official')
                ->comment('Tipo: oficial, compra, venta, promedio');

            // Fuente del tipo de cambio
            $table->string('source')->nullable()
                ->comment('Fuente: BCRA, Banco Nación, API, Manual');

            $table->timestamps();

            // Índices
            $table->index(['from_currency_id', 'to_currency_id', 'effective_date']);
            $table->index('effective_date');

            // No puede haber dos tasas iguales para la misma fecha y tipo
            $table->unique([
                'from_currency_id',
                'to_currency_id',
                'effective_date',
                'rate_type',
            ], 'unique_exchange_rate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange_rates');
    }
};
