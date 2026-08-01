<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Loan extends Model
{
    protected $fillable = [
        'lenderId',
        'amount',
        'loanDate',
        'description'
    ];

    /**
     * @return BelongsTo
     */
    public function lender(): BelongsTo
    {
        return $this->belongsTo(Lender::class, 'lenderId');
    }

    /**
     * @return HasMany
     */
    public function loanPayments(): HasMany
    {
        return $this->hasMany(LoanPayment::class, 'loanId');
    }
}
