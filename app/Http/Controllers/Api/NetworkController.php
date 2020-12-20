<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Network;

class NetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \Gate::authorize('isAdmin');
        return Network::get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        \Gate::authorize('isLogin');
        $id = (\Gate::allows('isUser')) ? \Auth::id() : $id ;
        return Network::forCustomShow($id);
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
        \Gate::authorize('isLogin');
        if (\Gate::allows('isUser')) {
            if ($id != \Auth::id()) {
                abort(403, 'ログインユーザーとリクエストのIDが異なります。');
            }
        }

        $network = new Network;

        // 受け取った親子関係が正しいかのチェック
        $myUser = $network->where('user_id', $id)->first();
        $children = $network->where('position_structure', 'like', $parent->position_structure.'%')->where('user_id', $position_parent_id)->first();
        if($children == null) { return '追加できません。'; }

        // 親の情報を取得
        $parent = $network->where('user_id', $request->position_parent_id)->first();

        // パラメータに構造情報をセット
        $request->offsetSet('position_structure', $parent->position_structure.'/'.$request->position_child_id);
        $request->offsetSet('position_stage', substr_count('/', $request->position_structure, 0));

        // 余分なパラメータを削除
        $req = $request->all();
        unset($req['position_parent_id']);
        unset($req['position_child_id']);

        $network->where('user_id', $id)->update($req);

        return $this->show($id);
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

    public function networkJson(Request $request, int $id)
    {
        \Gate::authorize('isLogin');

        $model = new Network;
        $structure = $request->type.'_structure';
        $stage = $request->type.'_stage';

        // ユーザーからのリクエストの場合、検索してもいいIDなのか調査
        if (\Gate::allows('isUser')) {
            $myuser = $model->where('user_id', \Auth::id())->first();
            $children = $model->where($request->type.'_structure', 'like', $myuser->$structure.'%')->where('user_id', $id)->first();
            if ($children == null) { return '検索できないユーザーです'; }
        }

        // 受けとtたIDのネットワーク情報を取得
        $myuser = $model->where('user_id', $id)->first();
        $query_stage = $request->stage + $myuser->$stage - 1;

        // パラメータで受け取った階層分のネットワークユーザーを取得
        $intro = $model->userJoin()
                    ->where($request->type.'_structure', 'like', $myuser->$structure.'%')
                    ->where($request->type.'_stage', '<=', $query_stage)
                    ->get();

        // Jsonにする項目の整理
        $data = [];
        foreach ($intro as $key => $val) {
            $type_id = $request->type.'_id';
            $data[$key]['head'] = $val->name_first;
            $data[$key][$request->type.'_id'] = $val->$type_id;
            $data[$key]['id'] = $val->user_id;
            $data[$key]['contents'] = $val->email;
        }

        // json準備
        $new = array();
        foreach ($data as $a){
            $new[$a[$request->type.'_id']][] = $a;
        }

        // jsonにして返却
        // return json_encode($this->createTree($new, array($data[0])));
        return $this->createTree($new, array($data[0]));

    }

    public function createTree(&$list, $parent){
        $tree = array();
        foreach ($parent as $k=>$l){
            if(isset($list[$l['id']])){
                $l['children'] = $this->createTree($list, $list[$l['id']]);
            }
            $tree[] = $l;
        }
        return $tree;
    }
}
