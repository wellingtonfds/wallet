<?php

namespace App\Http\Controllers;

use App\Services\CreateTransactionServices;
use App\Http\Requests\TransactionCreateRequest;


class TransactionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TransactionCreateRequest $request, CreateTransactionServices $createTransactionServices)
    {
        return $createTransactionServices->create(
            $request->get('payer'),
            $request->get('payee'),
            $request->get('value'),
        );
    }
}
