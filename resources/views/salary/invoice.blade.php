<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Invoice</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
    
    <style>
        .container {
            font-size: 10px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .container table {
            width: 100%;
            text-align: center;
        }


        .container table td {

        }
        .container table, th, td {
            
        }
        thead {
            border-bottom: 1px solid grey;
            margin-bottom: 4px;
        }
    </style>
    
</head>
<body>
 <div class="container">

    <div class="row pad-top-botm ">
        <div class="col-lg-12 col-md-12 col-sm-12" style="text-align:center;">
            <strong>Click Jobs Invoice.</strong>
            <br/>
            <i>Payout From :</i> {{\Carbon\Carbon::parse($employee_salary->start_date)->format('d-m-Y')}}   TO: {{\Carbon\Carbon::parse($employee_salary->end_date)->format('d-m-Y')}}
        </div>
    </div>

     <div  class="row text-center contact-info">
         <div class="col-lg-12 col-md-12 col-sm-12" >
             <hr />
             <span class="align-left" style="padding:20px;">
                 <strong>Name : </strong>  {{$employee_salary->employee->name}}
             </span>
             <span style="padding:20px;">
                 <strong>Email : </strong>  {{$employee_salary->employee->email}}
             </span>
              <span class="align-right" style="padding:20px;">
                 <strong>Date Of Birth : </strong>  {{\Carbon\Carbon::parse($employee_salary->employee->dob)->format('d-m-Y')}}
             </span>
             <hr />
         </div>
     </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="table-responsive" style="margin-top:10px;">
                <table>
                    <thead>
                        <tr>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Rate</th>
                            <th>Days</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$employee_salary->start_date}}</td>
                            <td>{{$employee_salary->end_date}}</td>
                            <td>$ {{$employee_salary->employee->daily_salary}}</td>
                            <td>{{$employee_salary->days}}</td>
                            <td>$ {{$employee_salary->total_salary}}</td>
                        </tr>
                        <tr>
                            <td  style="padding-top:6px;"></td>
                            <td  style="padding-top:6px;"></td>
                            <td  style="padding-top:6px;"></td>
                            <td  style="padding-top:6px;"><strong>Total:</strong></td>
                            <td  style="padding-top:6px;">$  {{$employee_salary->total_salary}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <hr>
    @php
        $net_salary = 0;
    @endphp
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="table-responsive" style="margin-top:10px;">
                <table>
                    <thead>
                        <tr>
                            <th>Konto</th>
                            <th>Description</th>
                            <th>Basis</th>
                            <th>Factor</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    @foreach ($taxes as $tax)
                    <tr>
                        <td>{{$tax->konto}}</td>
                        <td>{{$tax->description}}</td>
                        <td>$ {{$employee_salary->total_salary}}</td>
                        <td>{{$tax->factor}}%</td>
                        <td>$ {{round((($employee_salary->total_salary * $tax->factor) / 100), 3)}}</td>
                        @php
                            $net_salary += round((($employee_salary->total_salary * $tax->factor) / 100), 3);
                        @endphp
                    </tr>
                    @endforeach
                    <tr>
                        <td style="padding-top:6px;"></td>
                        <td style="padding-top:6px;"></td>
                        <td style="padding-top:6px;"></td>
                        <td style="padding-top:6px;"><strong>Total Deduction :</strong></td>
                        <td style="padding-top:6px;">$  {{$net_salary}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <hr />
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
        <table class="table-responsive" style="font-size:12px;">
            <tr>
                <td style="padding-right:100px;" class="text-center"> <strong> Net Salary</strong></td>
                <td style="padding-right:20px;" class="text-center"><p> Period: </p>{{\Carbon\Carbon::parse($employee_salary->start_date)->format('d-m-Y')}} / {{\Carbon\Carbon::parse($employee_salary->end_date)->format('d-m-Y')}}</td>
                <td style="padding-right:100px;" class="text-center"> <strong> $ {{$employee_salary->total_salary - $net_salary}}</strong></td>
            </tr>
        </table>
        </div>
    </div>
 </div>

</body>
</html>
