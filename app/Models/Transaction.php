<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    /**
     * @OA\Schema(
     *     schema="transaction",
     *     description="The default resource for an Transaction",
     *     type="object",
     *     title="Transaction",
     *     @OA\Property(property="id", type="int64", description="ID", example="1"),
     *     @OA\Property(property="payer", type="object",ref="#/components/schemas/user_resource"),
     *     @OA\Property(property="payee", type="object",ref="#/components/schemas/user_resource"),
     *     @OA\Property(property="value", type="numeric"),
     * )
     */
    use HasFactory;

    protected $fillable = ['payer', 'payee', 'value'];


    public function userPayer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'payer');
    }

    public function userPayee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'payee');
    }
}
