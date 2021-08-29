<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'start_date', 'end_date','days','total_salary'];

    public function employee()
    {
        return $this->belongsTo(\App\Models\Employee\Employee::class);
    }
}
