<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lender extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'gender',
        'profile',
        'phone',
        'notes',
        'userId'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }

    /**
     * @return HasMany
     */
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class, 'lenderId');
    }

    /**
     * @param HasMany
     */
    public function loanPayments(): HasMany
    {
        return $this->hasMany(LoanPayment::class, 'lenderId');
    }

    /**
     * @return float
     */
    public function getTotalRemainingAttribute(): float
    {
        return $this->total_loan - $this->total_paid;
    }

    /**
     * @return float
     */
    public function getTotalLoanAttribute(): float
    {
        return (float) $this->loans()->sum('amount');
    }

    /**
     * @return float
     */
    public function getTotalPaidAttribute(): float
    {
        return (float) $this->loanPayments()->sum('amount');
    }
}
