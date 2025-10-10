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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service_name');
            $table->text('service_description');
            $table->string('service_code')->unique();
            $table->foreignId('parent_service_id')
                ->nullable()
                ->constrained('services')
                ->nullOnDelete()
                ->comment('ID del servicio padre. NULL = servicio raíz');
            $table->integer('level')
                ->default(0)
                ->index()
                ->comment('Nivel jerárquico: 0=raíz, 1=hijo, 2=nieto, etc.');
            $table->string('path', 500)
                ->nullable()
                ->index()
                ->comment('Ruta materializada para búsquedas rápidas (ej: 1/5/23)');
            $table->foreignIdFor(App\Models\Category::class)
                ->constrained();
            $table->string('type', 50)
                ->nullable()
                ->comment('Tipo: Principal, Sub-servicio, Componente');
            $table->integer('estimated_duration')
                ->nullable()
                ->comment('Duración estimada en minutos');
            $table->boolean('requires_preparation')
                ->default(false)
                ->comment('Indica si requiere preparación previa del paciente');
            $table->text('preparation_instructions')
                ->nullable()
                ->comment('Instrucciones de preparación para el paciente');
            $table->boolean('is_group')
                ->default(false)
                ->comment('TRUE si es un agrupador (solo organiza sub-servicios)');
            $table->boolean('allows_subservices')
                ->default(true)
                ->comment('TRUE si este servicio puede tener sub-servicios');
            $table->foreignIdFor(App\Models\State::class)
                ->constrained();
            $table->integer('display_order')
                ->default(0)
                ->comment('Orden de visualización en listados');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('services', function (Blueprint $table) {
            $table->index(
                ['parent_service_id', 'state_id', 'display_order'],
                'idx_services_hierarchy'
            );

            $table->index(
                ['category_id', 'state_id'],
                'idx_services_category_state'
            );

            $table->index(
                ['level', 'state_id'],
                'idx_services_level_state'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
