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
            <h1 class="me-2">Department</h1>
        </div>

        {{-- <div class="separator-breadcrumb border-top"></div>
                  <form id="progress-form" class="p-4 progress-form" action="#"  novalidate method=""> --}}

                    <div class="separator-breadcrumb border-top"></div>
                    @if(!empty($stream_master))
                            <form id="progress-form" class="p-4 progress-form" action="{{url('store-department')}}"  method="post">
                            <input type="hidden" 
                        @if(!empty($stream_master))
                        @foreach($stream_master as $streammaster)
                            value=" {{ $streammaster->DepartmentID }}"
                            @endforeach
                        @else
                            value=""
                        @endif
                        name="id"
                    >
                    @else
                        <form id="progress-form" class="p-4 progress-form" action="{{url('save-department')}}"  method="post">
                    @endif

            @csrf
            <div class="row">


              <div class="col-md-3 form-group mb-3">
                <label for="DepartmentName">Department Name </label>
                <input required
                  class="form-control uperletter"
                  id="DepartmentName"
                  name="DepartmentName"
                  type="text"
                  @if(!empty($stream_master))
                    @foreach($stream_master as $streammaster)
                      value=" {{ $streammaster->DepartmentName }}"
                    @endforeach
                  @else
                    value=""
                  @endif
                  placeholder="DepartmentName"
                />
              </div>

             
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" id="reset" class="btn btn-primary" name="btn" value="Reset Form">Reset</button>
                    
                    @if(request()->route()->getName() !== 'department')
                           <a href="{{ url('department') }}" class="btn btn-primary">Add New</a>
                    @endif

                </div>
            </div>
        </form><br>
    </div>


    

        <div class="separator-breadcrumb border-top"></div>
    <div class="row">


            <div class="col-md-12 mb-4">
            <div class="breadcrumb">
                <h1 class="me-2">List of Saved Departments :-</h1>
            </div>
            <div class="separator-breadcrumb border-top"></div>

                    <div class="card text-start">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-striped table-bordered" id="deafult_ordering_table_wrapper" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Department Name</th>
                                
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
                          <td class= "uperletter">{{$streams->DepartmentName}}</td> 
                                                                   

                          <td class='d-flex'>
                              <a class="btn btn-primary m-1" href="{{ url('view-department') .'/'.$streams->DepartmentID}}">Edit</a>
                                <!-- <form id="deleteForm" method="post" action="{{url('delete-streammaster')}}">                                
                                    @csrf
                                    <input type="hidden" name="table_name" value="streams">
                                    <input type="hidden" name="delete_id" value="{{ $streams->id }}">
                                    <button type="button" class="btn btn-danger m-1" onclick="confirmDelete(event)">Delete</button>
                                </form> -->
                                <?php $a = "departments"."-".$streams->DepartmentID ; ?>
                                <a class="btn btn-raised ripple btn-danger m-1" href="{{url('delete-department').'/'.$a}}" onclick="confirmDelete(event)">Delete</a>
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
        $("#DepartmentName").val("");      
    });

})

</script>



@endsection