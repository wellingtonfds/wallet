<?php


namespace App\Repositories\Transactions;

use App\Models\Transaction;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;

class TransactionRepository implements TransactionRepositoryInterface
{

    public function create(array $data): Transaction
    {
        return Transaction::create($data);
    }

    public function update($transaction, array $data): Transaction
    {
        $transaction->fill($data);
        $transaction->save();
        return $transaction;
    }

    public function delete(int $id): Model
    {
        $transaction = $this->show($id);
        $transaction->delete();
        return $transaction;
    }

    public function show(int $id): Model
    {
        return Transaction::findOrFail($id);
    }

    public function index(int $page_number): Paginator
    {
        return Transaction::paginate($page_number);
    }
}
