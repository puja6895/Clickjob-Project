<?php

namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee\Employee;
use App\Http\Requests\EmployeeAddRequest;
use Carbon\Carbon;
use View, DB;

class EmployeeController extends Controller
{
    public function getList(){
        try {
            $employees = Employee::orderBy('created_at','desc')->get();

            return View::make('employee.list')->with('employees', $employees);

        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th->getMessage());
        }
    }
  /**
     * Add Employee
     * @param Nill
     * @return View Add Employee
     * @author Puja Singh
     */
    public function addEmployee()
    {
        try {
            
            return View::make('employee.add');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th->getMessage());
        }
    }

     /**
     * Store Employee
     * @param EmployeeStoreRequest $request
     * @return View With $employees & Success Message
     * @author Puja Singh
     */
    public function storeEmployee(EmployeeAddRequest $request)
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $input['dob'] = Carbon::parse($request->dob)->format('Y-m-d');
            
            $create_employee = Employee::create($input);
            if($create_employee){

                DB::commit();
                return redirect()->route('employee.list')->with('success', 'Employee Added Successfully.');
            }else{
                DB::rollBack();
                return redirect()->back()->with('error', 'Unable To Create Employee, Please try again');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error',$th->getMessage());
        }
    }
}
