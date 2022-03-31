<?php
namespace App\Service;

use Carbon\Carbon;
use Illuminate\Http\Request;

class checkTimeService
{
    public function checkTimeSearch(Request $request)
    {
        try
        {
//            check ngày hiện tại
            $date = Carbon::parse($request->time);
            $checkToday =  $date->isToday();
//            lấy ngày hiện tại
            $today = Carbon::now()->toDateTimeString();
//            lấy ngày hôm qua
            $yesterday = Carbon::now()->subDay();
//            lấy tháng này
            return $yesterday->toDateTimeString();

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
