<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;


class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::table('permissions')->insert(
            [
                ['name' => 'permissions','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'reports','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'request','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'users','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'roles','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'system','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'configuration','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'admin','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'user','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'dasso','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'portAccess','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'car','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'departments','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],

                ['name' => 'credential','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'approveCredential','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'approvedCredential','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'rejectedCredential','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],

                ['name' => 'addCar','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'listCar','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'customer','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'addCustomer','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'importCustomer','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'listCustomer','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'transactions','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],

                ['name' => 'internalCardCustomer','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'externalCardCustomer','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'induction','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'request-rejected','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'approved','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'vehicle','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'activities','guard_name'=>'web', 'created_at' => now(), 'updated_at' => now()],
            ],
    );
    }
}
