@extends('backend.layouts.main')
@section('main-container')
@php
                      $i = 0;
                    @endphp
<div class="main-content">
    <div class="form_section1_div">
        <div class="breadcrumb">
            <h1 class="me-2">Salaries</h1>
        </div>

        {{-- <div class="separator-breadcrumb border-top"></div>
                  <form id="progress-form" class="p-4 progress-form" action="#"  novalidate method=""> --}}

                    <div class="separator-breadcrumb border-top"></div>
                    @if(!empty($stream_master))
                            <form id="progress-form" class="p-4 progress-form" action="{{url('store-salaries')}}"  method="post">
                            <input type="hidden" 
                        @if(!empty($stream_master))
                        @foreach($stream_master as $streammaster)
                            value=" {{ $streammaster->SalaryID }}"
                            @endforeach
                        @else
                            value=""
                        @endif
                        name="id"
                    >
                    @else
                        <form id="progress-form" class="p-4 progress-form" action="{{url('save-salaries')}}"  method="post">
                    @endif

            @csrf
            <div class="row">


              <div class="col-md-3 form-group mb-3">
                <label for="SalaryAmount">Salary Amount</label>
                <input required
                  class="form-control"
                  id="SalaryAmount"
                  name="SalaryAmount"
                  type="text"
                  @if(!empty($stream_master))
                    @foreach($stream_master as $streammaster)
                      value=" {{ $streammaster->SalaryAmount }}"
                    @endforeach
                  @else
                    value=""
                  @endif
                  placeholder="SalaryAmount"
                />
              </div>

              <div class="col-md-3 form-group mb-3">
                <label for="EffectiveDate">Effective Date</label>
                <input required
                  class="form-control"
                  id="EffectiveDate"
                  name="EffectiveDate"
                  type="date"
                  @if(!empty($stream_master))
                    @foreach($stream_master as $streammaster)
                      value="{{ $streammaster->EffectiveDate }}"
                    @endforeach
                  @else
                    value=""
                  @endif
                  placeholder="EffectiveDate"
                />
              </div>

              <div class="col-md-3 form-group mb-3">
                <label for="AttendanceMonth">Attendance Month</label>               
                <select  type="text" name="AttendanceMonth" class="form-control" id="EmployeeID">
                 <option value="" hidden>--select--</option>
                 <option @if(!empty($stream_master)) {{ ($stream_master[0]->AttendanceMonth == "1") ? 'selected' : ''}}  @endif value="1">january</option>
                 <option @if(!empty($stream_master)) {{ ($stream_master[0]->AttendanceMonth == "2") ? 'selected' : ''}}  @endif value="2">february</option>
                 <option @if(!empty($stream_master)) {{ ($stream_master[0]->AttendanceMonth == "3") ? 'selected' : ''}}  @endif value="3">march</option>
                 <option @if(!empty($stream_master)) {{ ($stream_master[0]->AttendanceMonth == "4") ? 'selected' : ''}}  @endif value="4">april</option>
                 <option @if(!empty($stream_master)) {{ ($stream_master[0]->AttendanceMonth == "5") ? 'selected' : ''}}  @endif value="5">may</option>
                 <option @if(!empty($stream_master)) {{ ($stream_master[0]->AttendanceMonth == "6") ? 'selected' : ''}}  @endif value="6">june</option>
                 <option @if(!empty($stream_master)) {{ ($stream_master[0]->AttendanceMonth == "7") ? 'selected' : ''}}  @endif value="7">july</option>
                 <option @if(!empty($stream_master)) {{ ($stream_master[0]->AttendanceMonth == "8") ? 'selected' : ''}}  @endif value="8">august</option>
                 <option @if(!empty($stream_master)) {{ ($stream_master[0]->AttendanceMonth == "9") ? 'selected' : ''}}  @endif value="9">september</option>
                 <option @if(!empty($stream_master)) {{ ($stream_master[0]->AttendanceMonth == "10") ? 'selected' : ''}}  @endif value="10">october</option>
                 <option @if(!empty($stream_master)) {{ ($stream_master[0]->AttendanceMonth == "11") ? 'selected' : ''}}  @endif value="11">november</option>
                 <option @if(!empty($stream_master)) {{ ($stream_master[0]->AttendanceMonth == "12") ? 'selected' : ''}}  @endif value="12">december</option>
                  </select>
               
              </div>



              <div class="col-md-3 form-group mb-3">
                <label for="DepartmentID">Employees </label>
               
                <select  type="text" name="EmployeeID" class="form-control" id="EmployeeID1">
                  @if(!empty($stream_master[0]) )                      
                      @foreach($employeeName as $employee)
                          <option {{($stream_master[0]['EmployeeID'] == $employee->EmployeeID) ? 'selected' : '' }} value="{{ $employee->EmployeeID }}">{{ $employee->FirstName }} {{$employee->LastName}}</option>
                      @endforeach
                  @else   
                      <option value="" selected> -- Please select -- </option>
                      @foreach($employeeName as $employee)
                          <option value="{{ $employee->EmployeeID }}">{{ $employee->FirstName }} {{$employee->LastName}}</option>
                      @endforeach
                  @endif
                  
                  </select>
              </div>




                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" id="reset" class="btn btn-primary" name="btn" value="Reset Form">Reset</button>
                    
                    @if(request()->route()->getName() !== 'salaries')
                           <a href="{{ url('salaries') }}" class="btn btn-primary">Add New</a>
                    @endif

                </div>
            </div>
        </form>
        <br>
    </div>

        <div class="separator-breadcrumb border-top"></div>
    <div class="row">


            <div class="col-md-12 mb-4">
            <div class="breadcrumb">
                <h1 class="me-2">List of Saved Holidays :-</h1>
            </div>
            <div class="separator-breadcrumb border-top"></div>

                    <div class="card text-start">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-striped table-bordered" id="deafult_ordering_table_wrapper" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Salary Amount</th>
                                    <th>Effective Date</th>
                                    <th>Attendance Month</th>
                                    <th>Action </th>
                                    <!-- <th>Section</th>
                                    <th>Class Strength</th> -->
                                </tr>
                                </thead>
                                <tbody>

                                
                        @if(!empty($stream))
                        @foreach($stream as $streams)
                        <tr>
                        <td>{{++$i}}</td>
                          <td>{{$streams->SalaryAmount}}</td> 
                          {{-- <td>{{$streams->EffectiveDate}}</td> --}}
                          <td>{{ date('d-m-Y', strtotime($streams->EffectiveDate)) }}</td> 
                          <td class= "uperletter">{{$streams->AttendanceMonth}}</td>                                

                          <td class='d-flex'>
                              <a class="btn btn-primary m-1" href="{{ url('view-salaries') .'/'.$streams->SalaryID}}">Edit</a>
                                <!-- <form id="deleteForm" method="post" action="{{url('delete-holidays')}}">                                
                                    @csrf
                                    <input type="hidden" name="table_name" value="streams">
                                    <input type="hidden" name="delete_id" value="{{ $streams->id }}">
                                    <button type="button" class="btn btn-danger m-1" onclick="confirmDelete(event)">Delete</button>
                                </form> -->
                                <?php $a = "salaries"."-".$streams->SalaryID ; ?>
                                <a class="btn btn-raised ripple btn-danger m-1" href="{{url('delete-salaries').'/'.$a}}" onclick="confirmDelete(event)">Delete</a>
                            </td>
                        </tr>
                        <!-- </?php $i++; ?> -->
                        @endforeach
                        @else
                        <tr><td colspan="9" class="text-center">No Data Found</td></tr>
                        @endif                                    
                                </tbody>
                                <tfoot>
                                
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

    <!-- end of main-content -->
</div>





<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
     function confirmDelete(event) {
        event.preventDefault(); // Prevents the default link navigation

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user clicks on "Yes, delete it!", navigate to the delete URL
                window.location.href = event.target.href;
            }
        });
    }
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      var select = document.getElementById('EmployeeID');
      for (var i = 0; i < select.options.length; i++) {
          select.options[i].innerText = capitalizeFirstLetter(select.options[i].innerText);
      }
  });

  function capitalizeFirstLetter(str) {
      var words = str.toLowerCase().split(' ');
      for (var i = 0; i < words.length; i++) {
          words[i] = words[i].charAt(0).toUpperCase() + words[i].substring(1);
      }
      return words.join(' ');
  }
</script>



<script>
  document.addEventListener('DOMContentLoaded', function () {
      var select = document.getElementById('EmployeeID1');
      for (var i = 0; i < select.options.length; i++) {
          select.options[i].innerText = capitalizeFirstLetter(select.options[i].innerText);
      }
  });

  function capitalizeFirstLetter(str) {
      var words = str.toLowerCase().split(' ');
      for (var i = 0; i < words.length; i++) {
          words[i] = words[i].charAt(0).toUpperCase() + words[i].substring(1);
      }
      return words.join(' ');
  }

  document.addEventListener('DOMContentLoaded', function() {
    $("#reset").on("click", function () {                
        $("#SalaryAmount").val("");
        $("#EffectiveDate").val("");
        $("#EmployeeID").val("");
        $("#EmployeeID1").val("");      
    });

})

</script>



@endsection