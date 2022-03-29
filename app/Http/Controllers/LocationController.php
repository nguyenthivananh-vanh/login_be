<?php

namespace App\Http\Controllers;

use App\Service\Location\LocationService;
use Illuminate\Http\Request;
class LocationController extends Controller
{
    protected $locationService;
    protected $getBranchService;

    /**
     * AccountManagerController constructor.
     */
    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function getCity(Request $request){
        return $this->locationService->getCity($request);
    }

    public function getDistrict(Request $request){
        return $this->locationService->getDistrict($request);
    }

    public function getWard(Request $request){
        return $this->locationService->getWard($request);
    }
}
