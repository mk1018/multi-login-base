<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BonusType;

class BonusTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \Gate::authorize('isAdmin');
        return BonusType::get();
    }

    public function indexForEnable()
    {
        \Gate::authorize('isLogin');
        return BonusType::where('enabled', 1)->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        \Gate::authorize('isAdmin');
        return BonusType::where('id', $id)->first();
    }
}
