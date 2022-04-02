<?php

namespace App\Service\ValidateService\ValidateLocationService;

use App\Service\ValidateInputService\ValidateInputLocationService\ValidateInputDistrictService;

use App\Repositories\Location\CityRepository;
use Illuminate\Http\Request;

class ValidateDistrictService
{
    protected $validateInputDistrictService;
    protected $cityRepository;

    /**
     * validateCreateAccountManagerService constructor.
     */
    public function __construct( ValidateInputDistrictService  $validateInputDistrictService, CityRepository $cityRepository)
    {
        $this->validateInputDistrictService = $validateInputDistrictService;
        $this->cityRepository = $cityRepository;
    }

    public function validateDistrict(Request $request)
    {
        try {
            if ($this->validateInputDistrictService->validateInputDistrict($request) === true) {
                $id = $request->id;
                $city = $this->cityRepository->find($id);
                if(isset($city) && $city != null){
                    return true;
                }else{
                    return response()->json([
                        'status' => 'error',
                        'message' => "Không tồn tại thành phố",
                        'data' => []
                    ], 412);
                }

            } else {
                return $this->validateInputDistrictService->validateInputDistrict($request);
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
