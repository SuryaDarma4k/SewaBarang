<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'name',
        'trx_id',
        'phone_number',
        'proof',
        'address',
        'started_at',
        'duration',
        'ended_at',
        'is_paid',
        'delivery_type',
        'total_amount',
        'product_id',
        'store_id',
    ];

    protected $casts = [
        'total_amount' => MoneyCast::class,
        'started_at' => 'date',
        'ended_at' => 'date',
    ];

    public static function generateUniqueTrxId()
    {
        $prefix = 'SEWA';
        do{
            $randomString = $prefix . mt_rand(1000, 9999);
        }while (self::where('trx_id', $randomString)->exists());

        return $randomString;
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
