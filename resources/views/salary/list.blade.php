@extends('layouts.app')

@section('title'){{'Salary List'}}@endsection
@section('active-salary'){{'active'}}@endsection
@section('menu-open'){{'menu-open'}}@endsection

@section('content')
<!-- Main content -->
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Salary List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Salary List</li>
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
                <h3 class="card-title">Salary List</h3>
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
@endsection
