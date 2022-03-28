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
            $data = $this->account->getAll();
            return response()->json([
                'status' => 'success',
                'message' => "Danh sách các tài khoản",
                'data' => $data
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
                ]);
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


}
