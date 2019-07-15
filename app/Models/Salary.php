<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'salaries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'employee_id',
        'total',
        'month',
        'day_off_available',
        'day_off_available_total'
    ];

    /**
     * Get created at
     *
     * @return string
     */
    public function getMonthAttribute($value)
    {
        return date("m-Y", strtotime($value));
    }

    /**
     * Get the post that owns the comment.
     */
    public function employees()
    {
        return $this->belongsTo('App\Models\Employee');
    }
}
