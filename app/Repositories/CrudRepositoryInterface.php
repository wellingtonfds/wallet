<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;


interface CrudRepositoryInterface
{
    public function create(array $data): Model;
    public function update($model, array $data): Model;
    public function delete(int $id): Model;
    public function show(int $id): Model;
    public function index(int $page_number): Paginator;
}
