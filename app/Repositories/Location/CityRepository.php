<?php

namespace App\Repositories\Location;

// use App\Repositories\BaseRepository;
use App\Models\Cities;

use App\Repositories\Location\LocationRepositoryInterface;
use App\Repositories\BaseRepository;

class CityRepository extends BaseRepository implements LocationRepositoryInterface
{
    protected $model;

    /**
     * UserAccountRepository constructor.
     * @param $model
     */
    public function __construct(Cities $model)
    {
        parent::__construct($model);
    }



}
