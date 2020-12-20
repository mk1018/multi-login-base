<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AssetHistory;

class Payment extends Model
{
    const ASSET_HISTORY_CATEGORY = 'payment';

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'payment_type',
        'amount',
        'status',
    ];

    public function assetHistoryInsert($result)
    {
        switch($result->status) {
            case 0 : $amount = 0; break;
            case 1 : $amount = 0; break;
            case 2 : $amount = 0; break;
            case 3 : $amount = $result->amount; break;
            case 9 : $amount = 0; break;
        }

        $data = [
            'user_id' => $result->user_id,
            'category_code' => self::ASSET_HISTORY_CATEGORY,
            'data_id' => $result->id,
            'amount' => $amount
        ];

        return AssetHistory::create($data);
    }

    public function assetHistoryUpdate($result, $id)
    {
        if ($result->status == 3) {
            AssetHistory::where('category_code', self::ASSET_HISTORY_CATEGORY)
                ->where('data_id', $id)
                ->update(['amount' => $result->amount]);
        }
    }
}
