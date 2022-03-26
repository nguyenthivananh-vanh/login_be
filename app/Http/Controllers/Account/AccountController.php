<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Service\Account\AccountService;
use App\Service\BranchService\getBranchService;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    protected $AccountService;
    protected $getBranchService;

    /**
     * AccountManagerController constructor.
     */
    public function __construct(AccountService $AccountService)
    {
        $this->AccountService = $AccountService;
    }
    
    public function getAll(Request $request)
    {
        return $this->AccountService->getAll($request, 'admin_get_all');
    }
}
