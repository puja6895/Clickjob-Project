@extends('layouts.app')

@section('title'){{'Add Employee'}}@endsection

@section('content')
<!-- Main content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Employee</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item "><a href="{{route('employee.list')}}">Employee List</a> </li>
            <li class="breadcrumb-item active">Add New</li>
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
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Employee</h3>
                <a href="{{route('employee.list')}}" class="d-none d-sm-inline-block card-title float-right">Back</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{route('employee.store')}}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1"><span style="color:red;">*</span>Name</label>
                    <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"><span style="color:red;">*</span>Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name ="email" placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>
                  <!-- Date range -->
                  <div class="form-group">
                  <label>Date of Birth:</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                      <div class="input-group-prepend" data-target="#reservationdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                      <input type="text" name="dob" id="dob" class="form-control datetimepicker-input @error('dob') is-invalid @enderror" data-target="#reservationdate" value="{{ old('dob') }}"/>
                      @error('dob')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!-- /.form group --> 
                  <div class="form-group">
                    <label for="exampleInputEmail1"><span style="color:red;">*</span>Daily Salary</label>
                    <input type="number" name="daily_salary" id="daily_salary" class="form-control @error('daily_salary') is-invalid @enderror" placeholder="Daily Salary" value="{{ old('daily_salary') }}">
                        @error('daily_salary')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"><span style="color:red;">*</span>Address</label>
                    <input type="text" name="address" id="address"  class="form-control @error('address') is-invalid @enderror" placeholder="Address" value="{{ old('address') }}">
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>
@endsection
@section('scripts')

<script>
    //Date picker
    // $('#datepicker').datepicker();
    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
</script>
@endsection
