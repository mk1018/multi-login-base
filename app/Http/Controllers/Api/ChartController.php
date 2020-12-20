<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Network;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {
        \Gate::authorize('isLogin');
        if (\Gate::allows('isUser')) {
            $id = \Auth::id();
        }

        $now = date('Y-m-d H:i:s');

        if ($request->period_type == 'year') {
            $period = date('Y') - $request->period;
            $str = 4;
        } elseif ($request->period_type == 'month') {
            $period = date('Y-m', strtotime($now.'-'.$request->period.' month'));
            $str = 7;
        } elseif ($request->period_type == 'day') {
            $period = date('Y-m-d', strtotime($now.'-'.$request->period.' day'));
            $str = 10;
        }

        $network = new Network;

        $myUser = $network->where('user_id', $id)->first();

        $sql = "
            select left(created_at, ".$str.") as date, count(*) as count
             from networks
            where introducer_structure like '".$myUser->introducer_structure."%'
              and left(created_at, ".$str.") >= ".$period.".
            group by left(created_at, ".$str.") ;
        ";

        return \DB::select($sql);


    }
}
