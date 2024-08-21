<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('roles')->insert(
            [
                ['name' => 'Super Admin','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Dasso','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'ICT','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Utente','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
            ]
        );
    }
}
