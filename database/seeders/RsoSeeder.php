<?php

namespace Database\Seeders;

use App\Models\Rso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RsoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rso::insert([
            ['house_id' => 1, 'user_id' => 7, 'rso_code' => 'RS040001', 'itop_number' => '01915270101', 'status' => 'active'],
            ['house_id' => 1, 'user_id' => 8, 'rso_code' => 'RS040002', 'itop_number' => '01915270102', 'status' => 'active'],
            ['house_id' => 1, 'user_id' => 9, 'rso_code' => 'RS040003', 'itop_number' => '01915270103', 'status' => 'active'],
            ['house_id' => 2, 'user_id' => 10, 'rso_code' => 'RS040004', 'itop_number' => '01915270104', 'status' => 'active'],
            ['house_id' => 2, 'user_id' => 11, 'rso_code' => 'RS040005', 'itop_number' => '01915270105', 'status' => 'active'],
            ['house_id' => 2, 'user_id' => 12, 'rso_code' => 'RS040006', 'itop_number' => '01915270106', 'status' => 'active'],
            ['house_id' => 3, 'user_id' => 13, 'rso_code' => 'RS040007', 'itop_number' => '01915270107', 'status' => 'active'],
            ['house_id' => 3, 'user_id' => 14, 'rso_code' => 'RS040008', 'itop_number' => '01915270108', 'status' => 'active'],
            ['house_id' => 3, 'user_id' => 15, 'rso_code' => 'RS040009', 'itop_number' => '01915270109', 'status' => 'active'],
        ]);
    }
}
