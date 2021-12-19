<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Faker\Factory as DataPalsu;
use Illuminate\Support\Facades\Hash;

class CostumerSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataPalsu = DataPalsu::create('id_ID');
        $data = [];

        for ($i = 0; $i < 100; $i++) {
            $gender = $dataPalsu->randomElement(['mele', 'famele']);
            $data[] = [
                'email' => $dataPalsu->email(),
                'first_name' => $dataPalsu->firstName($gender),
                'last_name' => $dataPalsu->lastName(),
                'city' => $dataPalsu->city(),
                'address' => $dataPalsu->address(),
                'password' => Hash::make('12345678')
            ];
        }
        (new Customer())->insert($data);
    }
}
