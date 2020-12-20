<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Network;
use App\Models\Wallet;
use App\Models\Bonus;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        \Gate::authorize('isLogin');
        if (\Gate::allows('isUser')) {
            $id = \Auth::id();
        }
        if (\Gate::allows('isAdmin')) {
            $id = $request->user_id;
        }

        $network = new Network;
        $user = $network::where('user_id', $id)->first();

        $data = [
            'USER'      => $network::where('introducer_structure', 'like', $user->introducer_structure.'%')->count(),
            'REFERRALS' => $network::where('position_structure', 'like', $user->position_structure.'%')->count(),
            'WALLET'    => Wallet::where('id', $id)->first()->tradable,
            'BONUS'     => Bonus::where('id', $id)->sum('amount'),
        ];

        return $data;

    }
}
