<?php

namespace App\Repositories\Eloquent;

use App\Models\Lender;
use App\Repositories\Contracts\LenderRepositoryInterface;

class LenderRepository extends BaseRepository implements LenderRepositoryInterface
{
    public function __construct(Lender $model)
    {
        parent::__construct($model);
    }
}
