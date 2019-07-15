<?php

namespace App\Services\Frontend;

use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class EmployeeService
{

    /**
     * Get employees
     *
     * @return Collection
     */
    public function getEmployees()
    {
        return Employee::where('company_id', Auth::user()->company_id)->paginate(15);
    }
}
