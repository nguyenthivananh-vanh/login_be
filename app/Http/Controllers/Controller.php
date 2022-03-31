<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Service\checkTimeService;

class Controller extends BaseController
{
    protected $checkTimeService;
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct( checkTimeService $checkTimeService)
    {
        $this->checkTimeService = $checkTimeService;
    }
    public function testTime(Request  $request)
    {
        return $this->checkTimeService->checkTimeSearch($request);
    }
}
