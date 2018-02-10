<?php

use Illuminate\Database\Seeder;
use Misfits\Repositories\PermissionRepository;
use Misfits\Repositories\RoleRepository;
use Misfits\Repositories\UserRepository;

/**
 * User ACL Database seeder
 *
 * @author      Tim Joosten <tim@activime.be>
 * @copyright   2018 Tim Joosten and his contributors
 */
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds against the user, roles, permissions table.
     *
     * @param  UserRepository        $userRepository        Functions for the user stuff in the seeder
     * @param  PermissionRepository  $permissionRepository  Functions for the permission stuff in the seeder.
     * @param  RoleRepository        $roleRepository        Functions  for the role stuff in the seeder. .
     * @return void
     */
    public function run(UserRepository $userRepository, PermissionRepository $permissionRepository, RoleRepository $roleRepository): void
    {
        $command = $this->command; // Laravel command bus

        if ($command->confirm('Create roles for user, default is admin and user? [y|N]', true)) {
            $inputRoles = $command->ask('Enter roles in comma seperated format.', 'admin,user'); // Ask role(s) from input.
            $arrayRoles = explode(',', $inputRoles); // Explode roles form the array. BOOM!
            
            foreach ($arrayRoles as $role) { // Add roles in the system. And attach them to the user.
                $entityRole = $roleRepository->entity();
                $role       = $roleRepository->firstOrCreate(['name' => trim($role)]);
                
                if ($role->name == 'admin') {
                    $entityRole->syncPermissions($permissionRepository->all());
                    $command->info('Admin granted all permissions');
                } else { // Other default has by default only read access
                    $entityRole->syncPermissions($permissionRepository->getUserPermissions());
                }

                $userRepository->seedCreateUser($role, $command);
            } // END foreach

            $command->info('Roles' . $inputRoles . ' added successfully to the system.');
        } else { // Just add new users without the acl permission and role stuff.
            $roleRepository->firstOrCreate(['name' => 'user']);
            $command->info('Add only default user role.');
        }
    }
}
