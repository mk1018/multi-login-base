<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssetHistory;

class AssetHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \Gate::authorize('isAdmin');
        return AssetHistory::get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function indexForUser()
    {
        \Gate::authorize('isLogin');
        if (\Gate::allows('isUser')) {
            $request->offsetSet('user_id', \Auth::id());
        }
        return AssetHistory::where('user_id', $request->user_id)->get();
    }
}
