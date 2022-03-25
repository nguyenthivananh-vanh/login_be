<?php
namespace App\Service\AuthService;

use App\Repository\Setting\SettingRepositoryInterface;
use App\Service\validateService\validateLoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Repositories\LoginRepository;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;

class loginService
{
    // protected $validateLoginService;
    protected $login;
    /**
     * loginService constructor.
     */
    public function __construct(LoginRepository $login)
    {
        $this->login = $login;
    }

    public function login(Request $request)
    {
        // try
        // {
            $rules = [
                'name' => 'required',
                'password' => 'required',
                // |regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>])[A-Za-z\d!@#$%^&*()\-_=+{};:,<.>]{8,}$/',
            ];
            $message = [
                'name.required' => 'Username không được để trống',
                'password.required' => 'Password không được để trống',
                // 'password.regex' => 'Mật khẩu bắt buộc ít nhất 8 kí tự bao gồm chữ hoa, chữ thường, số và kí tự đặc biệt',
            ];
            $validator = Validator::make($request->all(), $rules, $message);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->all()[0],
                    'data' => []
                ]);
            }else{
                if(Auth::attempt(['name' => $request->name, 'password' => $request->password])){ 
                    $user = Auth::user(); 
                    return response()->json([
                        "status" => 'success',
                        "message" => "Đăng nhập thành công",
                        "data" => $user,
                    ]);
                } 
                else{ 
                    return response()->json([
                        "status" => 'error',
                        "message" => "Đăng nhập thất bại",
                    ]);
                }     
            }
            
        // }
        // catch (\Exception $e)
        // {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Đã xảy ra lỗi, vui lòng quay trở lại sau',
        //         'data' => []
        //     ], 500);
        // }

          
    
    }
    public function register(Request $request)
    {
       
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        return response()->json([
            "status" => true,
            "message" => "Đăng kí thành công",
            "data" => $user,
        ]);
    } 
}
