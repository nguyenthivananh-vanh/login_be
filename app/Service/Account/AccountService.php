<?php
namespace App\Service\Account;

use App\Repositories\Account\AccountRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use App\Repositories\Account\AccountRepository;
use App\Service\ValidateService\ValidateAccountService\ValidateCreateAccountService;
use Illuminate\Support\Facades\Validator;
class AccountService
{

    protected $account;
    protected $validateCreateAccount;
    public function __construct(AccountRepository $account, ValidateCreateAccountService $validateCreateAccount)
    {
        $this->account = $account;
        $this->validateCreateAccount = $validateCreateAccount;
    }
    /**
     * accountManagerService constructor.
     */

    public function getAll(Request $request, $keyConfigApi)
    {
        try
        {
            $current_page = $request->current_page;
            if(isset($limit) && $limit > 0){
                $limit = $request->limit;
            }else{
                $limit = 3;
            }
            if(isset($current_page) && $current_page > 0){
                $current_page = $request->current_page;
            }else{
                $current_page = 1;
            }

            $total_records = $this->account->getTotal();
            $total_page = ceil($total_records / $limit);

            if ($current_page > $total_page){
                $current_page = $total_page;
            }
            else if ($current_page < 1){
                $current_page = 1;
            }
            $start = ($current_page - 1) * $limit;
            if(isset($start) && $start >= 0){
                $data = $this->account->paginate($start, $limit);
                return response()->json([
                    'status' => 'success',
                    'message' => "Danh sách các tài khoản",
                    'data' => $data, 'current_page'=> $current_page, 'total_page' => $total_page, 'limit' => $limit
                ], 200);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => "Hiện chưa có tài khoản nào trong danh sách",
                    'data' => []
                ], 419);
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

    public function create(Request $request){

        try {
            if ($this->validateCreateAccount->validateInputCreateAccount($request) === true) {
                $data = [
                    'username' => $request->username,
                    'email' => $request->email
                ];
                $this->account->create($data);
                return response()->json([
                    'status' => 'success',
                    'message' => "Thêm thành công",
                    'data' => $data
                ], 200);
            } else {
                return $this->validateCreateAccount->validateInputCreateAccount($request);
            }
        }catch (\Exception $e)
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Đã xảy ra lỗi, vui lòng quay trở lại sau',
                    'data' => []
                ], 500);
            }

    }

    public function find(Request $request){

        try {
            $data = $this->account->find($request->id);
            if(isset($data) && $data != null){
                return response()->json([
                    'status' => 'success',
                    'message' => "Lấy dữ liệu thành công",
                    'data' => $data
                ], 200);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tài khoản không tồn tại',
                    'data' => []
                ], 419);
            }
        }catch (\Exception $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Đã xảy ra lỗi, vui lòng quay trở lại sau',
                'data' => []
            ], 500);
        }

    }

}
