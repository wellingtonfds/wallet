<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;

class UserRepository implements UserRepositoryInterface
{

    public function create(array $data): User
    {
        return User::create($data);
    }
    public function update($user, array $data): User
    {
        $user->fill($data);
        $user->save();
        return $user;
    }
    public function delete(int $id): User
    {
        $user = $this->show($id);
        $user->delete();
        return $user;
    }
    public function show(int $id): User
    {
        return User::findOrFail($id);
    }
    public function index(int $page_number = 20): Paginator
    {
        return User::paginate($page_number);
    }
}
