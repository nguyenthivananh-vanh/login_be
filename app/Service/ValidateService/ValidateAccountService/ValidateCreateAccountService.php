<?php
namespace App\Service\ValidateService\ValidateAccountService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class validateCreateAccountService
{
    public function validateInputCreateAccount(Request $request)
    {
        try
        {
            $rules = [
                'username' => 'required',
                'email' => 'required|email',
            ];
            $message = [
                'username.required' => 'Vui lòng nhập tên tài khoản',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không đúng định dạng',
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
