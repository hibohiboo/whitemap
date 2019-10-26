<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    // https://qiita.com/Kra8/items/bc2b99ab7ab9880cecf8
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * モデルの主キーを自動増分させるか否か
     *
     * @var boolean
     */
    public $incrementing = false; 
}
