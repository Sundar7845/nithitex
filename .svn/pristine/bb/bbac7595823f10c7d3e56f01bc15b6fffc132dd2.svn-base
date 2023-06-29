<?php

namespace Database\Seeders;

use App\Models\PermissionGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
               'name' => 'Country Create',
               'permission_group_id' => permissionGroup::where('name','Country')->first()->id
            ],
            [
                'name' => 'Country List',
                'permission_group_id' => permissionGroup::where('name','Country')->first()->id
             ],
             [
                'name' => 'Country Edit',
                'permission_group_id' => permissionGroup::where('name','Country')->first()->id
             ],
             [
                'name' => 'Country Delete',
                'permission_group_id' => permissionGroup::where('name','Country')->first()->id
             ],
             [
                'name' => 'State Create',
                'permission_group_id' => permissionGroup::where('name','State')->first()->id
             ],
             [
                 'name' => 'State List',
                 'permission_group_id' => permissionGroup::where('name','State')->first()->id
              ],
              [
                 'name' => 'State Edit',
                 'permission_group_id' => permissionGroup::where('name','State')->first()->id
              ],
              [
                 'name' => 'State Delete',
                 'permission_group_id' => permissionGroup::where('name','State')->first()->id
              ],
                                ];
                                echo '-------------------------------------------' . "\n";
                                echo '----------Permission Seeding---------' . "\n";
                                foreach ($permissions as $key => $value)
                                {
                                    $permission = new Permission;
                                    $permission->name = $value['name'];
                                    $permission->permission_group_id = $value['permission_group_id'];
                                    $permission->save();
                                    echo "---------Permission Name=> $permission->name------------"."\n";
                                }
                                    echo "-----------------Permission Seeding Completed-----------------"."\n";
    }
}
