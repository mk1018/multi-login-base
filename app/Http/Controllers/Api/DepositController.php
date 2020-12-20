<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\AssetHistory;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \Gate::authorize('isAdmin');
        return Deposit::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Gate::authorize('isLogin');
        if (\Gate::allows('isUser')) {
            $request->offsetSet('user_id', \Auth::id());
            $request->offsetSet('status', 0);
        }
        $model = new Deposit;

        // depositデータの作成
        $result = $model->create($request->all());

        // asset_historiesへ登録
        $model->assetHistoryInsert($result);

        return $result;
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
        return Deposit::where('id', $id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        \Gate::authorize('isAdmin');
        $model = new Deposit;

        // 実績テーブルのアップデート
        $model->where('id', $id)->update($request->all());

        // アップデートした情報を取得
        $result = $model->where('id', $id)->first();

        // asset_historiesの情報を変更
        $model->assetHistoryUpdate($result, $id);

        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function indexForUser(Request $request)
    {
        \Gate::authorize('isLogin');
        if (\Gate::allows('isUser')) {
            $request->offsetSet('user_id', \Auth::id());
        }
        return Deposit::where('user_id', $request->user_id)->get();
    }

}
