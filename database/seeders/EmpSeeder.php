<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EmpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('Employee')->insert([
            'firstname'=>Str::random(10),
            'lastname'=>Str::random(10),
            'username'=>Str::random(10),
            'email'=>Str::random(10).'gmail.com',
            'phone'=>Str::random(10),
            'image'=>Str::random(10),
            'company'=>Str::random(10)
        ]);
    }
}
