<?php

namespace Database\Seeders;

use App\Models\PermissionGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionGroups = [
 [
    'name' => 'Country'
 ],
  [
    'name' => 'State'
 ]
                     ];
                     echo '-------------------------------------------' . "\n";
                     echo '----------Permission Group Seeding---------' . "\n";
                     foreach ($permissionGroups as $key =>$value)
                     {
                         $permissionGroup = new permissionGroup;
                         $permissionGroup->name = $value['name'];
                         $permissionGroup->save();
                         echo "---------Permission Group Name=> $permissionGroup->name------------"."\n";
                     }
                         echo "-----------------Permission Group Seeding Completed-----------------"."\n";

    }
}
