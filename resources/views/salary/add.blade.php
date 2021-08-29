@extends('layouts.app')

@section('title'){{'Add New Salary'}}@endsection

@section('content')
<!-- Main content -->
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Create Salary</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item"> <a href="{{route('employee.list')}}">Employee List </a> </li>
              <li class="breadcrumb-item active">Create Salary </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<section class="content">
      <div class="container-fluid">
        <div class="row">
              <div class="col-md-12">
                    @include('includes.alert')
              </div>
          </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Create Salary</h3>
                <a href="{{route('employee.list')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm   float-right"> Back</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <div class="row">
                      <div class="col-6">
                        <form method="POST" action="{{route('salary.store')}}">
                            @csrf
                            <!-- /.form group -->
                            <!-- Date range -->
                            <div class="form-group">
                            <label><span style="color:red;">*</span> Date range</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                    </div>
                                    <input type="hidden" name="employee_id" value="{{$employee->id}}" />
                                    <input type="text" class="form-control float-right" name="date_range" id="daterangepicker">
                                 </div>
                            <!-- /.input group -->
                            </div>
                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                            <!-- /.form group -->
                        </form>
                      </div>
                      <div class="col-6">
                        <p> <strong>Worker: </strong>{{$employee->name}}</p>
                        <p> <strong>Email: </strong>{{$employee->email}}</p>
                        <p> <strong>Date of Birth: </strong>{{\Carbon\Carbon::parse($employee->dob)->format('d M, Y')}}</p>
                        <p> <strong>Daily Salary: </strong><i class="fas fa-dollar-sign"></i>{{$employee->daily_salary}}</p>
                       
                      </div>
                  </div>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>

        <!-- salry list -->
        @if(count($employee_salaries) > 0)
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Created Salaries</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Daily Salary</th>
                    <th>Total Salary</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @forelse ($employee_salaries as $employee_salary)
                  <tr>
                      <td>{{$employee_salary->employee->name}}</td>
                      <td>{{\Carbon\Carbon::parse($employee_salary->start_date)->format('d-m-Y')}}</td>
                      <td>{{\Carbon\Carbon::parse($employee_salary->end_date)->format('d-m-Y')}}</td>
                      <td>$ {{$employee_salary->employee->daily_salary}}</td>
                      <td>$ {{$employee_salary->total_salary}}</td>
                      <td>
                          <a target="_blank" href="{{route('salary.pdf',['employee_salary_id' => $employee_salary->id])}}" class="btn btn-success"> View PDF</a>
                      </td>
                  </tr>
                  @empty
                      <tr>
                          <td colspan="6">No Employee Salaries Found</td>
                      </tr>
                  @endforelse
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        @endif
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
@section('scripts')
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script type = "text/javascript">
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,"order":[],
    });
  });
</script>
<script>
    //Date picker
    $('#daterangepicker').daterangepicker();
</script>
@endsection
