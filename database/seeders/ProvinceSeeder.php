<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;


class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $province = [
            ['province_name' => 'Buenos Aires','nickname'=>'ba'],
            ['province_name' => 'Ciudad Autónoma de Buenos Aires','nickname'=>'caba'],
            ['province_name' => 'Catamarca','nickname'=>'cta'],
            ['province_name' => 'Chaco','nickname'=>'cho'],
            ['province_name' => 'Chubut','nickname'=>'cut'],
            ['province_name' => 'Córdoba','nickname'=>'coa'],
            ['province_name' => 'Corrientes','nickname'=>'cos'],
            ['province_name' => 'Entre Ríos','nickname'=>'ers'],
            ['province_name' => 'Formosa','nickname'=>'fms'],
            ['province_name' => 'Jujuy','nickname'=>'jjy'],
            ['province_name' => 'La Pampa','nickname'=>'lpa'],
            ['province_name' => 'La Rioja','nickname'=>'lra'],
            ['province_name' => 'Mendoza','nickname'=>'mda'],
            ['province_name' => 'Misiones','nickname'=>'mss'],
            ['province_name' => 'Neuquén','nickname'=>'nqn'],
            ['province_name' => 'Río Negro','nickname'=>'rno'],
            ['province_name' => 'Salta','nickname'=>'sla'],
            ['province_name' => 'San Juan','nickname'=>'sjn'],
            ['province_name' => 'San Luis','nickname'=>'sls'],
            ['province_name' => 'Santa Cruz','nickname'=>'scz'],
            ['province_name' => 'Santa Fe','nickname'=>'sfe'],
            ['province_name' => 'Santiago del Estero','nickname'=>'sdo'],
            ['province_name' => 'Tierra del Fuego','nickname'=>'tdo'],
            ['province_name' => 'Tucumán','nickname'=>'tun'],
        ];

        foreach ($province as  $value) {
            $province = Province::create(Arr::only($value, ['province_name']));
            $city = new CitySeeder();
            $createCity = $city->run($value['nickname'],$province->id);
        }
    }
}
