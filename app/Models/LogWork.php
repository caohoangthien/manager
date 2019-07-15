<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogWork extends Model
{

    /**
     * Status working
     */
    const WORKING = 1;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'log_work';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'employee_id',
        'manager_id',
        'status',
        'date',
        'note',
    ];

    /**
     * Get the post that owns the comment.
     */
    public function employees()
    {
        return $this->belongsTo('App\Models\Employee');
    }
}
