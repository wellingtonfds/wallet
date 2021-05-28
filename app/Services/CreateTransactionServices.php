<?php


namespace App\Services;


use App\Exceptions\NotifyAccountException;
use App\Exceptions\ValidationAccountException;
use App\Repositories\Transactions\TransactionRepository;
use Illuminate\Support\Facades\DB;

class CreateTransactionServices
{
    private $repository;
    private $notifyTransactionServices;
    private $accountServices;

    public function __construct()
    {
        $this->repository = new TransactionRepository();
        $this->notifyTransactionServices = new NotifyTransactionServices();
        $this->accountServices = new ValidationAccountServices();
    }

    public function create($payer, $payee, $value)
    {
        DB::beginTransaction();
        try {
            $this->accountServices->validateAccount();
        } catch (ValidationAccountException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        $transaction = $this->repository->create([
            'payer' => $payer,
            'payee' => $payee,
            'value' => $value
        ]);
        try {
            $this->notifyTransactionServices->notify($transaction->userPayee);
        } catch (NotifyAccountException $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 201);
        }
        DB::commit();
        return response()->json(['transaction' => $transaction], 201);
    }
}
