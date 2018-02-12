<?php 

namespace Tests\Traits;

use Misfits\User;
use Spatie\Permission\Models\Role;

/**
 * Helper traits for creating logins
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 * @package     Tests\Traits
 */
trait CreatesUsers
{
    /**
     * Function for creating a newly role in the testing db.
     *
     * @param  string $name   The name for the role that has to be created.
     * @return string
     */
    protected function createRole(string $name): string
    {
        return factory(Role::class)->create(['name' => $name])->name;
    }

    /**
     * Create an normal user in the system
     *
     * @return \Misfits\User
     */
    public function createNormalUser(): User
    {
        return factory(User::class)->create()
            ->assignRole($this->createRole('user'));
    }

    /**
     * Create an admin user in the system
     *
     * @return \Misfits\User
     */
    public function createAdminUser(): User
    {
        return factory(User::class)->create()
            ->assignRole($this->createRole('admin'));
    }
}
