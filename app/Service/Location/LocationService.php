<?php
namespace App\Service\Location;

use App\Repositories\Location\LocationRepositoryInterface;
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

    public function __construct(CityRepository $cities, DistrictRepository $districts, WardRepository $wards)
    {
        $this->cities = $cities;
        $this->districts = $districts;
        $this->wards = $wards;
    }

    public function getCity(){
        try
        {
            $cities = $this->cities->getAll();
            return response()->json([
                'status' => 'success',
                'message' => "Danh sách các Tỉnh/ Thành phố",
                'data' => $cities
            ]);

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
            $city = $this->cities->find($request->id);
            if(isset($city) && $city != null){
                $districts = $this->districts->get([['local_city_id', $request->id]]);
                return response()->json([
                    'status' => 'success',
                    'message' => "Danh sách các Quận/huyện",
                    'data' => $districts
                ]);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => "Không tồn tại thành phố",
                    'data' => []
                ]);
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
            $city = $this->cities->find($request->city_id);
            $district = $this->districts->find($request->district_id);
            if(isset($city) && $city != null && isset($district) && $district != null){
                $ward = $this->wards->get([['local_city_id', $request->city_id],['local_district_id', $request->district_id]]);
                return response()->json([
                    'status' => 'success',
                    'message' => "Danh sách các xã",
                    'data' => $ward
                ]);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => "Không tồn tại thành phố / Quận, huyện",
                    'data' => []
                ]);
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
