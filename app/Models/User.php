<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    /**
     * @OA\Schema(
     *     schema="user_resource",
     *     description="The default resource for an User",
     *     type="object",
     *     title="User",
     *     @OA\Property(property="id", type="int64", description="ID", example="1"),
     *     @OA\Property(property="name", type="string", description="Name"),
     *     @OA\Property(property="email", type="string", description="Email", example="anakin@jediorder.org"),
     *     @OA\Property(property="cpf_cnpj", type="string"),
     * )
     */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf_cnpj'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'deleted_at',
        'created_at',
        'updated_at',
        'cpf_cnpj'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function balances()
    {
        return $this->hasMany(Balance::class);
    }

    public function transctionsPayer()
    {
        return $this->hasMany(Transaction::class, 'payer', 'id');
    }

    public function transctionsPayee()
    {
        return $this->hasMany(Transaction::class, 'payee', 'id');
    }

    public function getBalanceAttribute(): float
    {
        $balance = $this->balances->reduce(function ($carry, $value) {
            $signal = $value->type === 'payment' ? -1 : 1;
            return $carry + ($signal * $value->value);
        });
        $balanceTransctionsPayer = $this->transctionsPayer->reduce(function ($carry, $value) {
                return $carry + ($value->value);
            }) ?? 0;
        $balancetransctionsPayee = $this->transctionsPayee->reduce(function ($carry, $value) {
                return $carry + ($value->value);
            }) ?? 0;
        $finalBalance = $balance + $balancetransctionsPayee + (-1 * $balanceTransctionsPayer);
        return $finalBalance;
    }

    public function getTypeAttribute(): string
    {
        return strlen($this->cpf_cnpj) == 14 ? 'personal' : 'business';
    }

}
