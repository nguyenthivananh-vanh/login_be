<?php

namespace App\Repositories\Location;

// use App\Repositories\BaseRepository;
use App\Models\Wards;

use App\Repositories\Location\LocationRepositoryInterface;
use App\Repositories\BaseRepository;

class WardRepository extends BaseRepository implements LocationRepositoryInterface
{
    protected $model;

    /**
     * UserAccountRepository constructor.
     * @param $model
     */
    public function __construct(Wards $model)
    {
        parent::__construct($model);
    }



}
