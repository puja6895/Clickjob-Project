<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'dob', 'daily_salary', 'address'];

    public function salaries()
    {
        return $this->hasMany(\App\Models\EmployeeSalary::class);
    }
}
