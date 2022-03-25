<?php

namespace App\Http\Controllers;
use App\Repositories\LoginRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Service\AuthService\loginService;
use Illuminate\Support\Facades\App;

class LoginController extends Controller 
{
    protected $loginService;

    /**
     * LoginController constructor.
     */
    public function __construct( loginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(Request $request)
    {
        return $this->loginService->login($request);
    }

    public function register(Request $request){
        return $this->loginService->register($request);
    }
}
