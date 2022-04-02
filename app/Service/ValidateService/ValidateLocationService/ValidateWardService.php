<?php


namespace App\Service\ValidateService\ValidateLocationService;


use App\Service\ValidateInputService\ValidateInputLocationService\validateInputWardService;
use Illuminate\Http\Request;
use App\Repositories\Location\DistrictRepository;
use App\Repositories\Location\CityRepository;

class ValidateWardService
{
    protected $validateInputWardService;
    protected $districtRepository;
    protected $cityRepository;

    /**
     * validateCreateAccountManagerService constructor.
     */
    public function __construct(validateInputWardService $validateInputWardService, DistrictRepository $districtRepository, CityRepository $cityRepository)
    {
        $this->validateInputWardService = $validateInputWardService;
        $this->districtRepository = $districtRepository;
        $this->cityRepository = $cityRepository;

    }

    public function validateWard(Request $request)
    {
        try {
            if ($this->validateInputWardService->validateInputWard($request) === true) {
                $city_id = $request->city_id;
                $district_id = $request->district_id;
                $city = $this->cityRepository->find($city_id);
                $district = $this->districtRepository->find($district_id);
                if(isset($city) && $city != null && isset($district) && $district != null){
                    return true;
                }else{
                    return response()->json([
                        'status' => 'error',
                        'message' => "Không tồn tại thành phố / Quận, huyện",
                        'data' => []
                    ], 412);
                }

            } else {
                return $this->validateInputWardService->validateInputWard($request);
            }
            if ($this->validateInputWardService->validateInputWard($request) === true) {
                return true;
            } else {
                return $this->validateInputWardService->validateInputWard($request);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Đã xảy ra lỗi, vui lòng quay trở lại sau',
                'data' => []
            ], 500);
        }
    }
}
