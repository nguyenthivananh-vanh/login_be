<?php
namespace App\Service\Account;

use App\Repositories\Account\AccountRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use App\Repositories\Account\AccountRepository;

class AccountService
{
    // protected $validateAccountManagerService;
    // protected $validateUpdateAccountManagerService;
    // protected $validateDeleteAccountManagerService;
    // protected $userAccountRepository;
    // protected $employeeRepository;
    protected $account;

    public function __construct(AccountRepository $account)
    {
        $this->account = $account;
    }
    /**
     * accountManagerService constructor.
     */
    
    public function getAll(Request $request, $keyConfigApi)
    {
        try
        {
            $data = $this->account->getAll();
            return response()->json([
                    'status' => 'success',
                    'message' => "Danh sách các tài khoản",
                    'data' => $data
                ]);
            // $linkApi = Config::get('link_api_icarm.base_url').Config::get("link_api_icarm.$keyConfigApi");
            // $token = $request->header('Authorization');
            
            // $response = Http::withHeaders([
            //     'Authorization' => $token
            // ])->get($linkApi, []); 
            // return $response;
            // $data = json_decode($response->body(), true)['data'];
            // $message = json_decode($response->body(), true)['message'];
            // $status = json_decode($response->body(), true)['status'];
            // $statusCode = $response->status();
            // return response()->json([
            //     'status' => $status,
            //     'message' => $message,
            //     'data' => $data
            // ], $statusCode);
            // return $this->responseToClient($response);
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
