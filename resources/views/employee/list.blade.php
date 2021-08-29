@extends('layouts.app')

@section('title'){{'Employee List'}}@endsection
@section('active-employee'){{'active'}}@endsection
@section('menu-open'){{'menu-open'}}@endsection

@section('content')
<!-- Main content -->
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Employees</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Employee</li>
              <li class="breadcrumb-item active"><a href="{{route('employee.list')}}"></a> Employee List</li>
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
                <h3 class="card-title">Employee List</h3>
                <a href="{{route('employee.add')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm   float-right"><i
                class="fas fa-plus fa-sm text-white-50"></i> Add New</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Daily Salary</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @forelse ($employees as $key => $employee)
                      <?php 
                            $employeeId = \Crypt::encrypt($employee->id);
                      ?>
                          <tr>
                              <td>{{$key + 1}}</td>
                              <td>{{$employee->name}}</td>
                              <td>{{$employee->email}}</td>
                              <td><i class="fas fa-dollar-sign"></i> {{$employee->daily_salary}}</td>
                              <td>
                                  <a href="{{route('salary.create',['employee_id' => $employeeId])}}" class="btn btn-success"> Create Salary</a>
                              </td>
                          </tr>
                      @empty
                          <tr>
                              <td colspan="5">No Employees Found</td>
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
