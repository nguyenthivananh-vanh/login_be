<?php

namespace App\Repositories\Location;

// use App\Repositories\BaseRepository;
use App\Models\Districts;

use App\Repositories\Location\LocationRepositoryInterface;
use App\Repositories\BaseRepository;

class DistrictRepository extends BaseRepository implements LocationRepositoryInterface
{
    protected $model;

    /**
     * UserAccountRepository constructor.
     * @param $model
     */
    public function __construct(Districts $model)
    {
        parent::__construct($model);
    }



}
