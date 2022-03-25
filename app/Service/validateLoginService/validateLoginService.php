<?php
namespace App\Service\validateLoginService;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
 
class validateLoginService
{
    public function validateLogin(Request $request)
    {
        try
        {
            $rules = [
                'username' => 'required',
                'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>])[A-Za-z\d!@#$%^&*()\-_=+{};:,<.>]{8,}$/',
            ];
            $message = [
                'username.required' => 'Username không được để trống',
                'password.required' => 'Password không được để trống',
                'password.regex' => 'Mật khẩu bắt buộc ít nhất 8 kí tự bao gồm chữ hoa, chữ thường, số và kí tự đặc biệt',
            ];
            $validator = Validator::make($request->all(), $rules, $message);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->all()[0],
                    'data' => []
                ], 401);
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
 
