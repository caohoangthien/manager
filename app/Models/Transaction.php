<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    /*
     * Thu
     */
    const MONEY_IN = 1;

    /*
     * Chi
     */
    const MONEY_OUT = 2;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'money',
        'reason',
        'date',
        'causer',
        'note',
        'status'
    ];

    /**
     * Get status
     *
     * @return array
     */
    public static function getStatus()
    {
        return [
            self::MONEY_IN => 'Thu',
            self::MONEY_OUT => 'Chi'
        ];
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getStatusAttribute($value)
    {
        return self::getStatus()[$value];
    }
}
