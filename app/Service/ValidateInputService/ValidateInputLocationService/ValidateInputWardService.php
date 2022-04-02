<?php

namespace App\Service\ValidateInputService\ValidateInputLocationService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class validateInputWardService
{
    public function validateInputWard(Request $request)
    {
        try {
            $rules = [
                'city_id' => 'required|integer',
                'district_id' => 'required|integer',
            ];
            $message = [
                'city_id.required' => 'Vui lòng check id',
                'city_id.integer' => 'Id phải là số',
                'district_id.required' => 'Vui lòng check id',
                'district_id.integer' => 'Id phải là số',
            ];
            $validator = Validator::make($request->all(), $rules, $message);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->all()[0],
                    'data' => []
                ], 412);
            }
            return true;

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Đã xảy ra lỗi, vui lòng quay trở lại sau',
                'data' => []
            ], 500);
        }
    }
}
