<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'introducer_id',
        'position_id',
        'introducer_stage',
        'position_stage',
        'introducer_structure',
        'position_structure',
    ];

    // protected $casts = [
    //     'introducer_structure' => 'json',
    //     'position_structure' => 'json'
    // ];

    // protected $hidden = [
    //     'introducer_structure',
    //     'position_structure'
    // ];

    public static function forCustomShow($id)
    {
        if (get_class(\Auth::user()) == 'App\Models\User') {
            $res = Network::where('user_id', $id)->first();
            unset($res->introducer_structure);
            unset($res->position_structure);
            unset($res->introducer_stage);
            unset($res->position_stage);
            return $res;
        } elseif (get_class(\Auth::user()) == 'App\Models\Admin') {
            return Network::where('user_id', $id)->first();
        }
    }

    public function userJoin()
    {
        return \DB::table('networks')->join('users', 'networks.user_id', '=', 'users.id');
    }
}
