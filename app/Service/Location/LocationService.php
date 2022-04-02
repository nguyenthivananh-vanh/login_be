<?php
namespace App\Service\Location;

use App\Repositories\Location\LocationRepositoryInterface;
use App\Service\ValidateService\ValidateLocationService\validateDistrictService;
use App\Service\ValidateService\ValidateLocationService\validateWardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use App\Repositories\Location\CityRepository;
use App\Repositories\Location\DistrictRepository;
use App\Repositories\Location\WardRepository;
use Illuminate\Support\Facades\Validator;

class LocationService
{

    protected $cities;
    protected $districts;
    protected $wards;
    protected $validateDistrictService;
    protected $validateWardService;

    public function __construct(CityRepository $cities, DistrictRepository $districts, WardRepository $wards, validateDistrictService $validateDistrictService, validateWardService $validateWardService)
    {
        $this->cities = $cities;
        $this->districts = $districts;
        $this->wards = $wards;
        $this->validateDistrictService = $validateDistrictService;
        $this->validateWardService = $validateWardService;
    }

    public function getCity(){
        try
        {
            $cities = $this->cities->getAll(['id','local_city_name']);
            return response()->json([
                'status' => 'success',
                'message' => "Danh sách các Tỉnh/ Thành phố",
                'data' => $cities
            ], 200);

        }
        catch (\Exception $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Đã xảy ra lỗi, vui lòng quay trở lại sau',
                'data' => []
            ], 500);
        }
    }

    public function getDistrict(Request $request){
        try
        {
            if ($this->validateDistrictService->validateDistrict($request) === true) {
                $districts = $this->districts->get([['local_city_id', $request->id]], ['id','local_district_name']);
                return response()->json([
                    'status' => 'success',
                    'message' => "Danh sách các Quận/huyện",
                    'data' => $districts
                ], 200);

            } else {
                return $this->validateDistrictService->validateDistrict($request);
            }

        }
        catch (\Exception $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Đã xảy ra lỗi, vui lòng quay trở lại sau',
                'data' => []
            ], 500);
        }
    }

    public function getWard(Request $request){
        try
        {
            if ($this->validateWardService->validateWard($request) === true) {
                $ward = $this->wards->get([['local_city_id', $request->city_id],['local_district_id', $request->district_id]], ['id','local_ward_name']);
                return response()->json([
                    'status' => 'success',
                    'message' => "Danh sách các xã",
                    'data' => $ward
                ], 200);

            } else {
                return $this->validateWardService->validateWard($request);
            }
        }
        catch (\Exception $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Đã xảy ra lỗi, vui lòng quay trở lại sau',
                'data' => []
            ], 500);
        }
    }

}
