<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lender extends Model
{
    use HasFactory;

    protected $fillable = [
        'lender_detail_id',
        'name',
        'phone',
        'notes',
    ];

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    public function detail(): BelongsTo
    {
        return $this->belongsTo(LenderDetail::class, 'lender_detail_id');
    }

    /**
     * Is lender ko ab tak kitna total loan diya gaya hai.
     */
    public function getTotalLoanAttribute(): float
    {
        return (float) $this->loans()->sum('amount');
    }

    /**
     * Is lender ka total paid amount (sab loans mila kar).
     */
    public function getTotalPaidAttribute(): float
    {
        return (float) $this->loans()
            ->join('loan_payments', 'loans.id', '=', 'loan_payments.loan_id')
            ->sum('loan_payments.amount');
    }

    /**
     * Is lender ka total remaining amount.
     */
    public function getTotalRemainingAttribute(): float
    {
        return $this->total_loan - $this->total_paid;
    }
}
