<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \Gate::authorize('isAdmin');
        return User::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Gate::authorize('isAdmin');
        $request->offsetSet('password', bcrypt($request->password));
        $param = $request->all();
        return User::create($param);
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
        if (\Gate::allows('isUser')) {
            $id = \Auth::id();
        }
        return User::where('id', $id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        if (isset($request->password)) {
            $request->offsetSet('password', bcrypt($request->password));
        }

        User::where('id', $id)->update($request->all());

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
        \Gate::authorize('isAdmin');
        return User::where('id', $id)->delete();
    }

    public function qrCode($id)
    {
        \Gate::authorize('isLogin');
        if (\Gate::allows('isUser')) {
            $id = \Auth::id();
        }

        $url = Config('app.front_verify_mail_send_url');
        $user = $this->show($id);

        return $url.'?qr_token='.$user->qr_token;

    }
}
