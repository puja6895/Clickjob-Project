<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee\Employee;
use App\Http\Requests\StoreSalaryRequest;
use App\Models\EmployeeSalary;
use App\Models\Taxes;
use Carbon\Carbon;
use View, DB;
use PDF;

class EmployeeSalaryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     /**
     * Get Salary List
     * @param Nill
     * @return View $employee_salaries
     * @author Puja Singh
     */
    public function getSalaryList()
    {
        try {
            $employee_salaries = EmployeeSalary::orderBy('created_at','desc')->get();

            return View::make('salary.list')->with('employee_salaries', $employee_salaries);

        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th->getMessage());
        }
    }

       /**
     * Create Salary
     * @param Integer $employee_id
     * @return View with Employee List
     * @author Puja Singh
     */
    public function createSalary($employee_id)
    {
        $employee_id = \Crypt::decrypt($employee_id);
        try {
            $employee = Employee::find($employee_id);
            $employee_salaries = EmployeeSalary::where('employee_id',$employee_id)
                                                ->with('employee')
                                                ->orderBy('created_at', 'desc')->get();

            if(empty($employee)){
                return redirect()->back()->with('error','Invalid Employee');
            }

            return View::make('salary.add')->with(['employee'=> $employee, 'employee_salaries'=>$employee_salaries]);
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('error',$th->getMessage());
        }
    }

    /**
     * Store Salary
     * @param StoreSalaryRequest $request
     * @return View with Employee Salary List
     * @author Puja Singh
     */
    public function storeSalary(StoreSalaryRequest $request)
    {
        DB::beginTransaction();
        try {
            $date_range = explode('-', $request->date_range);
            $start_date = Carbon::parse($date_range[0]);
            $end_date = Carbon::parse($date_range[1]);
            $days = $end_date->diffInDays($start_date);

            $employee = Employee::whereId($request->employee_id)->first();

            $save_salary = EmployeeSalary::create([
                'employee_id' => $employee->id,
                'start_date'   => $start_date->format('Y-m-d'),
                'end_date'    => $end_date->format('Y-m-d'),
                'days'    => $days,
                'total_salary'    => $days * $employee->daily_salary,
            ]);
            
            DB::commit();
            return redirect()->route('salary.list')->with('success', 'Salary Added successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error',$th->getMessage());
        }
    }

    public function getSalaryPdf($employee_salary_id)
    {
        try {
            $employee_salary = EmployeeSalary::whereId($employee_salary_id)->with('employee')->first();

            if(empty($employee_salary)){
                return redirect()->back()->with('error','Invalid Salary Id');
            }

            $taxes = Taxes::all();

            $pdf = PDF::loadView('salary.invoice', [
                'employee_salary' => $employee_salary,
                'taxes'         => $taxes
            ]);

            return $pdf->stream('invoice.pdf');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th->getMessage());
        }
    }
}
