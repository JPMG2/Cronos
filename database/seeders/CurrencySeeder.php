<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

final class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            [
                'state_id' => 1,
                'currency_code' => 'ARS',
                'currency_name' => 'Peso Argentino',
                'currency_symbol' => 'AR$',
                'decimal_places' => 2,
                'is_base' => true,
            ],
            [
                'state_id' => 1,
                'currency_code' => 'USD',
                'currency_name' => 'Dólar Estadounidense',
                'currency_symbol' => '$',
                'decimal_places' => 2,
                'is_base' => false,
            ],
            [
                'state_id' => 2,
                'currency_code' => 'EUR',
                'currency_name' => 'Euro',
                'currency_symbol' => '€',
                'decimal_places' => 2,
                'is_base' => false,
            ],
        ];
        foreach ($currencies as $currency) {
            Currency::query()->create($currency);
        }

    }
}
