<?php

namespace App\Repositories\Eloquent;

use App\Models\LenderDetail;
use App\Repositories\Contracts\LenderDetailRepositoryInterface;

class LenderDetailRepository extends BaseRepository implements LenderDetailRepositoryInterface
{
    public function __construct(LenderDetail $model)
    {
        parent::__construct($model);
    }
}
