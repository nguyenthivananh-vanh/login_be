<?php

namespace App\Repositories\Account;

// use App\Repositories\BaseRepository;
use App\Models\User;

use App\Repositories\Account\AccountRepositoryInterface;
use App\Repositories\BaseRepository;

class AccountRepository extends BaseRepository implements AccountRepositoryInterface
{
    protected $model;

    /**
     * UserAccountRepository constructor.
     * @param $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    

}
