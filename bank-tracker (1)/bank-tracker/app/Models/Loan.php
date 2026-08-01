<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'lender_id',
        'amount',
        'loan_date',
        'description',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'loan_date' => 'date',
    ];

    public function lender(): BelongsTo
    {
        return $this->belongsTo(Lender::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(LoanPayment::class);
    }

    /**
     * Ab tak is loan par kitna paisa wapis kiya gaya hai.
     */
    public function getPaidAmountAttribute(): float
    {
        return (float) $this->payments()->sum('amount');
    }

    /**
     * Is loan ka remaining (baaqi) amount.
     */
    public function getRemainingAmountAttribute(): float
    {
        return (float) $this->amount - $this->paid_amount;
    }

    /**
     * Loan pura paid ho chuka hai ya nahi.
     */
    public function getIsClearedAttribute(): bool
    {
        return $this->remaining_amount <= 0;
    }
}
