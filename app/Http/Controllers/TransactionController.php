<?php

namespace App\Http\Controllers;

use App\Services\CreateTransactionServices;
use App\Http\Requests\TransactionCreateRequest;
use Illuminate\Http\JsonResponse;


class TransactionController extends Controller
{
    /** @OA\Post(
     *     path="/api/transaction",
     *       @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="payer",
     *                     type="int"
     *                 ),
     *                 @OA\Property(
     *                     property="payee",
     *                     type="int"
     *                 ),
     *                 @OA\Property(
     *                     property="value",
     *                     type="numeric"
     *                 ),
     *
     *                  example={"payer": 12, "payee": 15, "value":25.12}
     *             )
     *         )
     *     ),
     *     @OA\Response(response="201", description="The user resource",
     *          @OA\JsonContent(type="object",ref="#/components/schemas/transaction")
     *     ),
     *     @OA\Response(response="422", description="Validation error")
     * )
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param TransactionCreateRequest $request
     * @param CreateTransactionServices $createTransactionServices
     * @return JsonResponse
     */
    public function store(TransactionCreateRequest $request, CreateTransactionServices $createTransactionServices): JsonResponse
    {
        return $createTransactionServices->create(
            $request->get('payer'),
            $request->get('payee'),
            $request->get('value'),
        );
    }
}
