<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nationality;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nationality_name' => 'INDONESIA',
                'nationality_code' => 'ID'
            ],
            [
                'nationality_name' => 'JAPAN',
                'nationality_code' => 'JP'
            ],
            [
                'nationality_name' => 'RUSSIA',
                'nationality_code' => 'RU'
            ],
            [
                'nationality_name' => 'MALAYSIA',
                'nationality_code' => 'MY'
            ],
            [
                'nationality_name' => 'NEW ZEALAND',
                'nationality_code' => 'NZ'
            ]
        ];


        foreach($data as $item) {
            Nationality::create($item);
        }
    }
}
