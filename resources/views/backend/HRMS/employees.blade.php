@extends('backend.layouts.main')
@section('main-container')


<style>

  .uperletter{
    text-transform: capitalize;
  } 
  
  </style>

@php
                      $i = 0;
                    @endphp
<div class="main-content">
    <div class="form_section1_div">
        <div class="breadcrumb">
            <h1 class="me-2">Employees</h1>
        </div>
        

        {{-- <div class="separator-breadcrumb border-top"></div>
                  <form id="progress-form" class="p-4 progress-form" action="#"  novalidate method=""> --}}

                    <div class="separator-breadcrumb border-top"></div>
                    @if(!empty($stream_master))
                            <form id="progress-form" class="p-4 progress-form" action="{{url('store-employee')}}" method="post">
                            <input type="hidden" 
                        @if(!empty($stream_master))
                        @foreach($stream_master as $streammaster)
                            value=" {{ $streammaster->EmployeeID }}"
                            @endforeach
                        @else
                            value=""
                        @endif
                        name="id"
                    >
                    @else
                        <form id="progress-form" class="p-4 progress-form" action="{{url('save-employee')}}" method="post">
                    @endif

            @csrf
            <div class="row">


              <div class="col-md-3 form-group mb-3">
                <label for="FirstName">First Name </label>
                <input
                required
                  class="form-control uperletter"
                  id="FirstName"
                  name="FirstName"
                  type="text"
                  @if(!empty($stream_master))
                    @foreach($stream_master as $streammaster)
                      value=" {{ $streammaster->FirstName }}"
                    @endforeach
                  @else
                    value=""
                  @endif
                  placeholder="FirstName"
                />
              </div>

              <div class="col-md-3 form-group mb-3">
                <label for="LastName">Last Name </label>
                <input
                required
                  class="form-control uperletter"
                  id="LastName"
                  name="LastName"
                  type="text"
                  @if(!empty($stream_master))
                    @foreach($stream_master as $streammaster)
                      value=" {{ $streammaster->LastName }}"
                    @endforeach
                  @else
                    value=""
                  @endif
                  placeholder="LastName"
                />
              </div>

              <div class="col-md-3 form-group mb-3">
                <label for="Email">Email </label>
                <input
                required
                  class="form-control"
                  id="Email"
                  name="Email"
                  type="text"
                  @if(!empty($stream_master))
                    @foreach($stream_master as $streammaster)
                      value=" {{ $streammaster->Email }}"
                    @endforeach
                  @else
                    value=""
                  @endif
                  placeholder="Email"
                />
              </div>

              <div class="col-md-3 form-group mb-3">
                <label for="Phone">Phone </label>
                <input
                  class="form-control"
                  id="Phone"
                  name="Phone"
                  type="text"
                  @if(!empty($stream_master))
                    @foreach($stream_master as $streammaster)
                      value=" {{ $streammaster->Phone }}"
                    @endforeach
                  @else
                    value=""
                  @endif
                  placeholder="Phone"
                />
              </div>

              <div class="col-md-3 form-group mb-3">
                <label for="Address">Address </label>
                <input
                  class="form-control uperletter"
                  id="Address"
                  name="Address"
                  type="text"
                  @if(!empty($stream_master))
                    @foreach($stream_master as $streammaster)
                      value=" {{ $streammaster->Address }}"
                    @endforeach
                  @else
                    value=""
                  @endif
                  placeholder="Address"
                />
              </div>

              <div class="col-md-3 form-group mb-3">
                <label for="DateOfBirth">Date Of Birth </label>
                <input
                  class="form-control"
                  id="DateOfBirth"
                  name="DateOfBirth"
                  type="date"
                  @if(!empty($stream_master))
                    @foreach($stream_master as $streammaster)
                      value="{{ $streammaster->DateOfBirth }}"
                    @endforeach
                  @else
                    value=""
                  @endif
                  placeholder="DateOfBirth"
                />
              </div>

              <div class="col-md-3 form-group mb-3">
                <label for="JoiningDate">Joining Date </label>
                <input
                  class="form-control"
                  id="JoiningDate"
                  name="JoiningDate"
                  type="date"
                  @if(!empty($stream_master))
                    @foreach($stream_master as $streammaster)
                      value="{{ $streammaster->JoiningDate }}"
                    @endforeach
                  @else
                    value=""
                  @endif
                  placeholder="JoiningDate"
                />
              </div>

              <div class="col-md-3 form-group mb-3">
                <label for="DepartureDate">Departure Date </label>
                <input
                  class="newdatepicker form-control"
                  id="DepartureDate"
                  name="DepartureDate"
                  type="date"
                  @if(!empty($stream_master))
                    @foreach($stream_master as $streammaster)
                      value="{{ $streammaster->DepartureDate }}"
                    @endforeach
                  @else
                    value=""
                  @endif
                  placeholder="DepartureDate"
                />
              </div>

              {{-- <div class="col-md-2 form-group mb-3">   
                <lable>Date 1</lable>
                  <input type="date"  id="picker2" name="fromdate" class="form-control" placeholder="dd-mm-yyyy" required>
                  <span class="fromdate_msg validation_err"></span>
              <!-- </div> -->
              </div> --}}


              <div class="col-md-3 form-group mb-3">
                <label for="DepartmentID">Department </label>
               
                <select  type="text" name="DepartmentID" class="form-control uperletter" id="DepartmentID">
                  @if(!empty($stream_master[0]) )
                      <option value="{{$stream_master[0]['DepartmentName']}}">{{$stream_master[0]['DepartmentName'] }}</option>
                      @foreach($deparments as $deparment)
                          <option value="{{ $deparment->DepartmentID }}">{{ $deparment->DepartmentName }}</option>
                      @endforeach
                  @else   
                      <option value="" selected> -- Please select -- </option>
                      @foreach($deparments as $deparment)
                          <option value="{{ $deparment->DepartmentID }}">{{ $deparment->DepartmentName }}</option>
                      @endforeach
                  @endif
                    
                  </select>
              </div>



              <div class="col-md-3 form-group mb-3">
                <label for="PositionID">Position </label>
                {{-- <input
                  class="form-control"
                  id="PositionID"
                  name="PositionID"
                  type="text"
                  @if(!empty($stream_master))
                    @foreach($stream_master as $streammaster)
                      value="{{ $streammaster->PositionID }}"
                    @endforeach
                  @else
                    value=""
                  @endif
                  placeholder="Position"
                /> --}}
{{--             
              <select  type="text" name="PositionID" class="form-control" id="PositionID">
                <option value="">-- Please select --</option>
                @if (!empty($stream_master[0]))
                @foreach ($stream_master as $s_item)
                {{ $c_stream = $s_item->PositionID }}
                @endforeach
                @endif
                @foreach ($position as $position)
                <option {{( (!empty($c_stream)) && ($c_stream==$position->PositionID)) ? 'selected' :
                        '' }} value="{{ $position->PositionID }}">{{ $position->PositionID }}</option>
                @endforeach
            </select> --}}


            <select  type="text" name="PositionID" class="form-control uperletter" id="PositionID">
              @if(!empty($stream_master[0]) )
                  <option value="{{$stream_master[0]['PositionName']}}">{{$stream_master[0]['PositionName'] }}</option>
                  @foreach($positions as $position)
                      <option value="{{ $position->PositionID }}">{{ $position->PositionName }}</option>
                  @endforeach
              @else   
                  <option value="" selected> -- Please select -- </option>
                  @foreach($positions as $position)
                      <option value="{{ $position->PositionID }}">{{ $position->PositionName }}</option>
                  @endforeach
              @endif
                    
              </select>

          </div>


                <div class="col-md-12">
                    <button class="btn btn-primary">Submit</button>
                    <button type="button" id="reset" class="btn btn-primary" name="btn" value="Reset Form">Reset</button>

                    @if(request()->route()->getName() !== 'employee')
                    <a href="{{ url('employee') }}" class="btn btn-primary">Add New</a>
                @endif
                </div>

            </div>
        </form><br>
    </div>



        <div class="separator-breadcrumb border-top"></div>
    <div class="row">


            <div class="col-md-12 mb-4">
            <div class="breadcrumb">
                <h1 class="me-2">List of Saved Employees :-</h1>
            </div>
            <div class="separator-breadcrumb border-top"></div>

                    <div class="card text-start">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-striped table-bordered" id="deafult_ordering_table_wrapper" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Date Of Birth</th>
                                    <th>Joining Date</th>
                                    <th>Departure Date</th>
                                    <th>Action </th>
                                    
                            
                                </tr>
                                </thead>
                                <tbody>

                                
                        @if(!empty($stream))
                        @foreach($stream as $streams)
                        <tr>
                        <td>{{++$i}}</td>
                          <td class= "uperletter">{{$streams->FirstName}}</td> 
                          <td class= "uperletter">{{$streams->LastName}}</td> 
                          <td>{{$streams->Email}}</td> 
                          <td>{{$streams->Phone}}</td>
                          <td class= "uperletter">{{$streams->Address}}</td> 
                          <td>{{ date('d-m-Y', strtotime($streams->DateOfBirth)) }}</td> 
                        
                          <td>{{ date('d-m-Y', strtotime($streams->JoiningDate)) }}</td>
                          
                          <td>{{ date('d-m-Y', strtotime($streams->DepartureDate)) }}</td>
                                                                     
 {{-- <td>{{ date('d-m-Y', strtotime($streams->DateOfBirth)) }}</td> --}}

                          <td class='d-flex'>
                              {{-- <a class="btn btn-primary m-1" href="{{ url('view-employee') .'/'.$streams->id}}">Edit</a> --}}
                              <a class="btn btn-primary m-1" href="{{ url('view-employee') .'/'.$streams->EmployeeID}}">Edit</a>
                                <!-- <form id="deleteForm" method="post" action="{{url('delete-streammaster')}}">                                
                                    @csrf
                                    <input type="hidden" name="table_name" value="streams">
                                    <input type="hidden" name="delete_id" value="{{ $streams->id }}">
                                    <button type="button" class="btn btn-danger m-1" onclick="confirmDelete(event)">Delete</button>
                                </form> -->
                                {{-- </?php $a = $streams->id ; ?> --}}
                                <?php $a = "employees"."-".$streams->EmployeeID ; ?>
                                <a class="btn btn-raised ripple btn-danger m-1" href="{{url('delete-employee').'/'.$streams->EmployeeID}}" onclick="confirmDelete(event)">Delete</a>
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

    document.addEventListener('DOMContentLoaded', function() {
    $("#reset").on("click", function () {                
        $("#FirstName").val("");
        $("#LastName").val("");
        $("#Email").val("");
        $("#Phone").val("");
        $("#Address").val("");
        $("#DateOfBirth").val("");
        $("#JoiningDate").val("");
        $("#DepartureDate").val("");
        $("#DepartmentID").val("");
        $("#PositionID").val("");      
    });

})






</script>



@endsection