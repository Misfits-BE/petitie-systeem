<?php 

namespace Misfits\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use Illuminate\Pagination\Paginator;
use Misfits\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class UserRepository
 *
 * @package Misfits\Repositories
 */
class UserRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }

    /**
     * Creer een nieuwe gebruiker per toegangs rol. (seeder)
     *
     * @param  Role     $role       De naam van de gebruikers rol.
     * @param  mixed    $commandBus Mapping voor $this->command in de seeder
     * @return void
     */
    public function seedCreateUser(Role $role, $commandBus): void
    {
        $user = factory(User::class)->create();
        $user->assignRole($role->name);

        if ($role->name == 'admin') {
            $commandBus->info('Here is your admin details to login:');
            $commandBus->warn($user->email);
            $commandBus->warn('Password is "secret"');
        }
    }

    /**
     * Paginate all the users in the system.
     *
     * @param  int $perPage     The amount of results u want to display per page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getUsers(int $perPage): Paginator
    {
        return $this->model->simplePaginate($perPage);
    }

    /**
     * Get all the users by a give role. 
     * 
     * @param  string $roleName The permission role in the application.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByRole(string $roleName): Collection
    {
        return $this->entity()->role($roleName)->get();
    }
}
