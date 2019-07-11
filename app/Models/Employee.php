<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    /*
     * Male
     */
    const MALE = 1;

    /*
     * Female
     */
    const FEMALE = 2;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employees';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'birthday',
        'phone',
        'bank_account',
        'address',
        'gender',
        'company_id',
        'start_time',
    ];

    /**
     * Get gender
     *
     * @return array
     */
    public static function getGender()
    {
        return [
            self::MALE => 'Nam',
            self::FEMALE => 'Nữ'
        ];
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGenderAttribute($value)
    {
        return self::getGender()[$value];
    }

    /**
     * Get birthday
     *
     * @return string
     */
    public function getBirthdayAttribute($value)
    {
        return date("d-m-Y", strtotime($value));
    }

    /**
     * Get start time
     *
     * @return string
     */
    public function getStartTimeAttribute($value)
    {
        return date("d-m-Y", strtotime($value));
    }

    /**
     * Get created at
     *
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return date("d-m-Y H:i:s", strtotime($value));
    }

    /**
     * Get the log work for employee.
     */
    public function logWork()
    {
        return $this->hasMany('App\Models\LogWork', 'employee_id');
    }

    /**
     * Get the log work for employee.
     */
    public function salaries()
    {
        return $this->hasOne('App\Models\Salary', 'employee_id');
    }
}
