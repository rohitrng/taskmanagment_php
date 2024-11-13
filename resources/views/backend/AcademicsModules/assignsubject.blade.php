@extends('backend.layouts.main')
@section('main-container')

@php
                      $i = 0;
                    @endphp
<div class="main-content pt-4">
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
<div class="col-md-12 form-group mb-3">
    <div class="form_section1_div">
        <div class="breadcrumb">
            <h1 class="me-2">Subject Combination Assign to Student</h1>
        </div>

        <div class="separator-breadcrumb border-top"></div>
        @if(!empty($stream_master))
                <form id="progress-form" class="p-4 progress-form" action="{{url('store-AssignSubject')}}"  novalidate method="post">
                <input type="hidden" 
            @if(!empty($stream_master))
            @foreach($stream_master as $streammaster)
                value=" {{ $streammaster->id }}"
                @endforeach
            @else
                value=""
            @endif
            name="id"
        >
        @else
            <form id="progress-form" class="p-4 progress-form" action="{{url('save-AssignSubject')}}"  novalidate method="post">
        @endif

@csrf
            <div class="row">


                <div class="col-md-3 form-group mb-3">
                    <label for="firstName1">Class Name</label>
                    <select id="class_name" class="form-control" name="class_name" autocomplete="" required>
                        @if (!empty($stream_master))
                        <option value="" disabled hidden>Please select</option>
                        @foreach($classlist as $each)
                        <option value="{{$each->class_name}}" {{ ($stream_master->class_name == $each->class_name) ? 'selected' : ''}}>{{$each->class_name}}</option>
                        @endforeach
                        @else
                        <option value="" disabled selected>Please select</option>
                        @foreach($classlist as $each)
                        <option value="{{$each->class_name}}">{{$each->class_name}}</option>
                        @endforeach
                        @endif
                        {{-- @foreach(config('global.class_name') as $each)
                       <option value="{{$each}}">{{$each}}</option>
                        @endforeach --}}
                    </select>
                    <span class="classname_msg validation_err"></span>
                </div>


                <div class="col-md-3 form-group mb-3">
                    <label for="section_name">Section</label>
                    <select id="section_name" class="form-control" name="section_name" autocomplete="shipping address-level1" required>
                        <?php //print_r($sectionname);die(); ?>
                
                        @if (!empty($stream_master))
                        <option value="{{ $stream_master->section_name}}" selected>{{ $stream_master->section_name}}</option>
                        @else
                
                        @endif
                    </select>
                </div>

              
                    <div class="col-md-3 form-group mb-3">
                        <br>
                    <button type="button" id="show-students-button" class="btn btn-primary">Show Students</button>
                </div>


                
                <div class="col-md-4 form-group mb-3">
                    <label for="combination_name_dropdown">Assign this comb. to all:-</label>
                    <select name="combination_name_dropdown" class="form-control" id="combination_name_dropdown">
                        <option value="">-- Please select --</option>
                        @foreach ($comlist as $com)
                            <option {{ ($com->combination_name == $c_stream) ? 'selected' : '' }} value="{{ $com->combination_name }}">{{ $com->combination_name }}</option>
                        @endforeach
                    </select>
                </div>
               
            

                <div class="col-md-3 form-group mb-3">
                    <br>
                    <button type="submit" class="btn btn-primary">Assigns</button>
                    {{-- <button type="reset" class="btn btn-primary" name="btn" value="Reset Form">Reset</button> --}}
                    @if(request()->route()->getName() !== 'AssignSubject')
                    <a href="{{ url('AssignSubject') }}" class="btn btn-primary">Add New</a>
             @endif
             
                </div>
            
            </div>
    </div>
</div>
</div>



<div class="row">
    <div class="row">
        <div class="col-md-12 mb-4">
            <h3>Students Details</h3>
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="card text-start">
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="display table table-striped table-bordered" id="deafult_ordering_table_wrapper" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Roll No.</th>
                                    <th>Board Roll No.</th>
                                    <th>Name</th>
                                    <th>Assign Combination</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="student_combination_table">
                                    <tr>
                                        <td>1</td>
                                        <td>7394</td>
                                        <td>abc123</td>
                                        <td>student name</td>
                                        <td>
                                            <select name="combination_name" class="form-control" id="combination_name">
                                                <option value="">-- Please select --</option>
                                                @foreach ($comlist as $com)
                                                    <option {{ ($com->combination_name == $c_stream) ? 'selected' : '' }} value="{{ $com->combination_name }}">{{ $com->combination_name }}</option>
                                                @endforeach
                                            </select>
                                    </td>

                                        <td><a class="btn btn-danger m-1" href="#">Delete</a</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>7394</td>
                                        <td>abc123</td>
                                        <td>student name</td>
                                        <td>
                                            <select name="combination_name" class="form-control" id="combination_name">
                                                <option value="">-- Please select --</option>
                                                @foreach ($comlist as $com)
                                                    <option {{ ($com->combination_name == $c_stream) ? 'selected' : '' }} value="{{ $com->combination_name }}">{{ $com->combination_name }}</option>
                                                @endforeach
                                            </select>
                                    </td>

                                        <td><a class="btn btn-danger m-1" href="#">delete</a</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Roll No.</th>
                                    <th>Board Roll No.</th>
                                    <th>Name</th>
                                    <th>Assign Combination</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>
                </form>

            <div class="col-md-12 mb-4">
            <div class="breadcrumb">
                <h1 class="me-2">List of Saved Assignment :-</h1>
            </div>
            <div class="separator-breadcrumb border-top"></div>


                    <div class="card text-start">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-striped table-bordered" id="deafult_ordering_table_wrapper" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Class</th>
                                    <th>Section </th>
                                    <th>Assign Com. To All </th>
                                    <th>Action </th>
                                    
                                </tr>
                                </thead>
                                <tbody>

                                
                        @if(!empty($subjectsassign))
                        @foreach($subjectsassign as $streams)
                        <tr>
                        <td>{{++$i}}</td>
                          <td>{{$streams->class_name}}</td> 
                          <td>{{$streams->section_name}}</td>
                          <td>{{$streams->assign_this_combtoall}}</td> 

                          <td class='d-flex'>
                              {{-- <a class="btn btn-primary m-1" href="{{ url('view-AssignSubject') .'/'.$streams->id}}">Edit</a> --}}
                                <!-- <form id="deleteForm" method="post" action="{{url('delete-streammaster')}}">                                
                                    @csrf
                                    <input type="hidden" name="table_name" value="streams">
                                    <input type="hidden" name="delete_id" value="{{ $streams->id }}">
                                    <button type="button" class="btn btn-danger m-1" onclick="confirmDelete(event)">Delete</button>
                                </form> -->
                                <?php $a = "subject_assign_student"."-".$streams->id ; ?>
                                <a class="btn btn-raised ripple btn-danger m-1" href="{{url('delete-AssignSubject').'/'.$a}}" onclick="confirmDelete(event)">Delete</a>
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

    document.addEventListener("DOMContentLoaded", function() {

function showSections() {
    var iso2 = $("#class_name").val();
    let token = document.getElementsByName("_token")[0].value
    console.log(iso2);
    if (iso2) {
        $.ajax({
            data: {
                id: iso2
            }
            , url: "{{url('classsection-view')}}/" + iso2
            , headers: {
                'X-CSRF-TOKEN': token
            }
            , method: "POST"
            , dataType: 'json'
            , success: function(data) {
                // console.log(data);
                $('#section_name').html('<option value=""> -- Select All -- </option>');
                for (var i = 0; i < data.length; i++) {
                    var studentData = data[i].section_name;
                    // console.log(studentData, ' ', selected_section);                            
                    $('#section_name').append('<option value="' + studentData + '">' + studentData + '</option>');
                }
            }
            , error: function(xhr, status, error) {
                console.error(error);
            }
        });
    } else {
        $('#section_name').html('<option value="">Select class first</option>');
    }
}

// showSections();

$('#class_name').on('change', showSections)

})


     
// .............
document.addEventListener("DOMContentLoaded", function() {


$('#show-students-button').click(function() {
    var selectedClass = $('#class_name').val();
    var selectedSection = $('#section_name').val();
    console.log("hello");

    $.ajax({
        url: "{{url('find-student_combination')}}",
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            class_name: selectedClass,
            section_name: selectedSection
        },
        success: function(response) {
            console.log(response);
            let data = response;
            $('#student_combination_table').html('');
                for (var i = 0; i < data.length; i++) {
                    var student_name = data[i].student_name;

                    let dropdownStr = `
                    <select name="combination_name" class="form-control" id="combination_name">
                                                <option value="">-- Please select --</option>
                                                @foreach ($comlist as $com)
                                                    <option {{ ($com->combination_name == $c_stream) ? 'selected' : '' }} value="{{ $com->combination_name }}">{{ $com->combination_name }}</option>
                                                @endforeach
                                            </select>
                    `

                    let tRow = `
                    <tr>
                          <td>${i+1}</td>
                          <td>Test</td> 
                          <td>Testing</td>
                          <td>${student_name}</td> 
                          <td>${dropdownStr}</td> 
                       
                        <td><a class="btn btn-danger m-1" href="#">delete</a></td>
                        </tr>
                    `
                                            
                    $('#student_combination_table').append(tRow);
                }
        }
    });
});

})

</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var select = document.getElementById('combination_name_dropdown');
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









@endsection