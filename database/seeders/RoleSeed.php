<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RoleSeed extends Seeder
{

    public function run(): void
    {
        DB::table('role')->insert([

            'name' => "super_admin",

        ]);
        DB::table('role')->insert([

            'name' => "wasity_manager",

        ]);
        DB::table('role')->insert([

            'name' => "sub_branch_owner",

        ]);
     
    }
}
