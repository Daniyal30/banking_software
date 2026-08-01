<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanPayment extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'lenderId',
        'amount',
        'paymentDate',
        'notes'
    ];

    protected $casts = [
        'paymentDate' => 'datetime',
    ];


    /**
     * @return BelongsTo
     */
    public function loan(): BelongsTo
    {
        return $this->belongsTo(Lender::class, 'lenderId');
    }

    /**
     * @param BelongsTo
     */
    public function lender(): BelongsTo
    {
        return $this->belongsTo(Lender::class, 'lenderId');
    }
}
