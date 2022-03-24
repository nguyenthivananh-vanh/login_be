<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Repositories\LoginRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
       protected $login;
    public function __construct(LoginRepository $login)
    {
        $this->login = $login;
    }

    public function register(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'password' => 'required',
        //     'c_password' => 'required|same:password',
        // ]);
        // if($validator->fails()){
        //     return $this->sendError('Validation Error.', $validator->errors());       
        // }
        $input = $request->all();
        return $input;
        // $input['password'] = bcrypt($input['password']);
        
        // $user = $this->login->store($input);
        // // // $success['token'] =  $user->createToken('MyApp')->accessToken;
        // $success['name'] =  $user->name;
        // return response()->json([
        //     "status" => true,
        //     "message" => "Đăng kí thành công",
        //     "data" => $success,
        // ]);
        // return $this->sendResponse($success, 'User register successfully.');

    }
    public function login(Request $request){
        return $users = $this->login->all();
        // $users = $this->login->all();
        // if(Auth::attempt(['name' => $request->name, 'password' => $request->password])){ 
        //     $user = Auth::user(); 
        //     // $success['name'] =  $user->name;
        //     return response()->json([
        //         "status" => true,
        //         "message" => "Đăng nhập thành công",
        //         "data" => $user,
        //     ]);
        // } 
        // else{ 
        //     return response()->json([
        //         "status" => false,
        //         "message" => "Đăng nhập thất bại",
        //     ]);
        // }       
    }
}
