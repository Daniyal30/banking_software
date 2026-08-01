<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LenderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'cnic',
        'address',
        'email',
        'city',
        'relationship',
    ];

    public function lender(): HasOne
    {
        return $this->hasOne(Lender::class);
    }
}
