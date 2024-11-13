@extends('backend.layouts.main')
@section('main-container')
@php
$i = 0;
@endphp
<div class="main-content">
    <div class="form_section1_div">
        <div
        
        class="breadcrumb">
            <h1 class="me-2">Teacher Class Subject </h1>
        </div>

        <div class="separator-breadcrumb border-top"></div>
        @if (!empty($teacher_subject['id']))

        <form id="progress-form" class="p-4 progress-form" action="{{ url('store-teachersubject') }}" method="post">
            <input type="hidden" value="{{$teacher_subject['id']}}" name="id">
            @else
            <form id="progress-form" class="p-4 progress-form" action="{{ url('save-teachersubject') }}" method="post">
                @endif
                @csrf


                <div class="row">

                    {{-- <div class="col-md-3 form-group mb-3">
                    <!-- <input type="text" id="schedule_nameb" name="schedule_nameb" value=""> -->
                    <label for="lastName1">Session Name</label>
                    <select name="session_name" class="form-control" id="session_name">
                        @if (!empty($sessions))
                            <option value=""> -- Please select -- </option>
                            <option value="" selected> -- Please select -- </option>
                            @foreach ($studentsession as $studentsession)
                                <option value="{{ $studentsession->session_name }}"
                    {{ $sessions[sizeof($sessions) - 1]->session_name == $studentsession->session_name ? 'selected' : '' }}>
                    {{ $studentsession->session_name }}</option>
                    @endforeach
                    @else
                    <option value="" selected> -- Please select -- </option>
                    @foreach ($studentsession as $studentsession)
                    <option value="{{ $studentsession->session_name }}">{{ $studentsession->session_name }}
                    </option>
                    @endforeach
                    </select>
                    @endif
                </div> --}}

                <div class="col-md-3 form-group mb-3">
                    <label for="firstName1">Class Name</label>
                    <select required id="class_name" class="form-control" name="class_name" autocomplete="" required>
                        @if (!empty($teacher_subject))
                        <option value="" disabled hidden>Please select</option>
                        @foreach($classlist as $each)
                        <option value="{{$each->class_name}}" {{ ($teacher_subject->class_name == $each->class_name) ? 'selected' : ''}}>{{$each->class_name}}</option>
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














                {{-- <div class="col-md-3 form-group mb-3">
                    <label for="class_name">Class Name</label>
                    <select id="class_name" class="form-control" name="class_name" autocomplete="" required>
                       <option value="" disabled selected>Please select</option>
                       @foreach($classlist as $each)
                       <option value="{{$each->class_name}}">{{$each->class_name}}</option>
                @endforeach
                {{-- @foreach(config('global.class_name') as $each)
                       <option value="{{$each}}">{{$each}}</option>
                @endforeach --}}
                {{-- </select>
                    <span class="classname_msg validation_err"></span>
                  </div>    --}}

                {{-- <div class="col-md-3 form-group mb-3">
                    <label for="studentname">Class</label>
                    <select id="classname" class="form-control" name="classname" autocomplete="shipping address-level1" required>
                    @if(!empty($classname))
                    <option value=""> -- Please select -- </option>
                    @foreach($datas as $country)
                      @if($classname == $country->class_name)
                        <option selected value="{{$country->class_name}}">{{$country->class_name}}</option>
                @else
                <option value="{{$country->class_name}}">{{$country->class_name}}</option>
                @endif
                @endforeach
                @else
                <option value="" selected> -- Please select -- </option>
                @foreach($datas as $country)
                <option value="{{$country->class_name}}">{{$country->class_name}}</option>
                @endforeach
                @endif
                </select>
    </div> --}}


    {{-- <div class="col-md-3 form-group mb-3"> --}}
    {{-- <!-- <input type="text" id="schedule_nameb" name="schedule_nameb" value=""> -->
                    <label for="lastName1">Class Name</label>
                    <select name="class_name" class="form-control" id="class_name">
                        @if (!empty($teacher_subjects))
                            <option value=""> -- Please select -- </option>
                            <option value="" selected> -- Please select -- </option>
                            @foreach ($studentclasses as $studentclasses)
                                <option value="{{ $studentclasses->class_name }}"
    {{ $teacher_subjects[sizeof($teacher_subjects) - 1]->class_name == $studentclasses->class_name ? 'selected' : '' }}>
    {{ $studentclasses->class_name }}</option>
    @endforeach
    @else
    <option value="" selected> -- Please select -- </option>
    @foreach ($studentclasses as $studentclasses)
    <option value="{{ $studentclasses->class_name }}">{{ $studentclasses->class_name }}
    </option>
    @endforeach
    </select>
    @endif
</div> --}}



{{--
                <div class="col-md-3 form-group mb-3">
                    <!-- <input type="text" id="schedule_nameb" name="schedule_nameb" value=""> -->
                    <label for="lastName1">Section Name</label>
                    <select name="section_name" class="form-control" id="section_name">
                        @if (!empty($teacher_subjects))
                            <option value="" selected> -- Please select -- </option>
                            <!-- <option value="All">All</option> -->
                            <option value="All"
                                {{ $teacher_subjects[sizeof($teacher_subjects) - 1]->section_name == 'All' ? 'selected' : '' }}>
All</option>
<option value="A" {{ $teacher_subjects[sizeof($teacher_subjects) - 1]->section_name == 'A' ? 'selected' : '' }}>
    A</option>

<option value="B" {{ $teacher_subjects[sizeof($teacher_subjects) - 1]->section_name == 'B' ? 'selected' : '' }}>
    B</option> --}}
<!-- <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option> -->
{{-- @else
                            <option value="" selected> -- Please select -- </option>
                            <option value="All">All</option>
                            <option value="A">A</option>
                            <option value="B">B</option>


                    </select>
                    @endif --}}

<div class="col-md-3 form-group mb-3">
    <label for="section_name">Section</label>
    <select required id="section_name" class="form-control" name="section_name" autocomplete="shipping address-level1" required>
        <?php //print_r($sectionname);die(); 
        ?>

        @if (!empty($teacher_subject))
        <option value="{{ $teacher_subject->section_name}}" selected>{{ $teacher_subject->section_name}}</option>
        @else

        @endif
    </select>
</div>




{{-- </div> --}}

{{-- <div class="col-md-3 form-group mb-3">
    <!-- <input type="text" id="schedule_nameb" name="schedule_nameb" value=""> -->
    <label for="lastName1">Subject Name</label>
    <select name="subject_name" class="form-control" id="subject_name">
        @if(!empty($teacher_subject))
        <option value=""> -- Please select -- </option>
        @foreach($subjects as $subject)
        @if($teacher_subject['subject_name'] == $subject->subject_name)
        <option selected value="{{$subject->subject_name}}">{{$subject->subject_name}}</option>
        @else
        <option value="{{$subject->subject_name}}">{{$subject->subject_name}}</option>
        @endif
        @endforeach
        @else
        <option value="" selected> -- Please select -- </option>
        @foreach ($subjects as $subject)
        <option value="{{ $subject->subject_name }}">{{ $subject->subject_name }}</option>

        {{-- <option {{( (!empty($c_stream)) && ($c_stream==$subject->subject_name)) ? 'selected' :
            '' }} value="{{ $subject->subject_name }}">{{ $subject->subject_name }}</option> --}}

        {{-- @endforeach --}}
        {{-- @endif --}}


    {{-- </select> --}}
{{-- </div> --}} 

<div class="col-md-3 form-group mb-3">
    <label for="lastName1">Subject Name</label>
    <select required name="subject_name" class="form-control" id="subject_name">
        <option value="">-- Please select --</option>
        @if(!empty($teacher_subject))
            @foreach($subjects as $subject)
                <option {{ $teacher_subject['subject_name'] == $subject->subject_name ? 'selected' : '' }} value="{{ $subject->subject_name }}">{{ $subject->subject_name }}</option>
            @endforeach
        @else
            <option value="" selected> -- Please select -- </option>
            @foreach ($subjects as $subject)
                <option value="{{ $subject->subject_name }}">{{ $subject->subject_name }}</option>
            @endforeach
        @endif
    </select>
</div>

<div class="col-md-3 form-group mb-3">
    <!-- <input type="text" id="schedule_nameb" name="schedule_nameb" value=""> -->
    <label for="lastName1">Teacher Name</label>
    <!-- <option value="11th SC(BPSY)">Teacher name 1</option> -->
    <!-- <option value="11th SC(MPSY)">Teacher name 2</option> -->
    <select required name="teacher_name" class="form-control" id="teacher_name">
        <option value="">-- Please select --</option>
        @if (!empty($stream_master))
        @foreach ($stream_master as $s_item)
        {{ $c_stream = $s_item->teacher_name }}
        @endforeach
        @endif
        @foreach ($teacherlist as $teacherlist)
        <option {{( (!empty($teacher_subject)) && ($teacher_subject->teacher_name==$teacherlist->teacher_name)) ? 'selected' :
                    '' }} value="{{ $teacherlist->teacher_name }}">{{ $teacherlist->teacher_name }}</option>
        @endforeach
     </select>
</div>


<div class="col-md-3 form-group mb-3">
<td>
    <label for="role">Role:</label>
</td>
<td>
    <select required name="role" class="form-control" id="role">
        <option value="">-- Please select --</option>
        <option value="Class Teacher">Class Teacher</option>
        <option value="Regular Teacher">Regular Teacher</option>
    </select>
</td>
</div>

{{-- <div class="row"> --}}



<!--
                                <div class="col-md-3 form-group mb-3">
                                        <label for="remarks"> </label>
                                        <input
                                          class="form-control"
                                          id="remarks"
                                          name="remarks"
                                          type="text"
                                          {{-- @if (!empty($exam_master)) @foreach ($exam_master as $exammaster) --}}
                                          {{-- value=" {{ $exammaster->remarks }}" --}}
                                        {{-- @endforeach --}}
                                      {{-- @else --}}
                                        {{-- value="" @endif --}}
                                          placeholder="Remark"
                                        />
                                      </div> -->


<div class="col-md-12">
    <button class="btn btn-primary" name="btn" value="submit text">Submit</button>
    <button type="button" id="reset" class="btn btn-primary" name="btn" value="Reset Form">Reset</button>

    @if(request()->route()->getName() !== 'teachersubject')
    <a href="{{ url('teachersubject') }}" class="btn btn-primary">Add New</a>
@endif



    
</div>
</div>
</form><br>


<form id="" class="" action="{{ url('copy-teachersubject') }}" novalidate method="post">
    @csrf

    {{-- <div class="col-md-3 form-group mb-3">
                    <!-- <input type="text" id="schedule_nameb" name="schedule_nameb" value=""> -->
                    <label for="pre_session">Session Name</label>
                    <select name="pre_session" class="form-control" id="pre_session">
                        @if (!empty($sessions))
                            <option value=""> -- Please select -- </option>
                            <option value="" selected> -- Please select -- </option>
                            @foreach ($pre_studentsessions as $pre_studentsession)
                                <option value="{{ $pre_studentsession->session_name }}"
    {{ $sessions[sizeof($sessions) - 1]->session_name == $pre_studentsession->session_name ? 'selected' : '' }}>
    {{ $pre_studentsession->session_name }}</option>
    @endforeach
    @else
    <option value="" selected> -- Please select -- </option>
    @foreach ($pre_studentsessions as $pre_studentsession)
    <option value="{{ $pre_studentsession->session_name }}">
        {{ $pre_studentsession->session_name }}
    </option>
    @endforeach
    </select>
    @endif
    </div> --}}

    {{--
                <button type="button" onclick="copy_data(event)" class="btn btn-primary">Copy from previous
                    year</button> --}}
</form>

</div>
<div class="breadcrumb">
    <h1 class="me-2">List of saved Teacher Subject :-</h1>
</div>
<div class="separator-breadcrumb border-top"></div>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card text-start">
            <div class="card-body">
                <!-- <h4 class="card-title mb-3 text-end"><a href="{{ url('add-student-registrations') }}"><button class="btn btn-outline-primary" type="button">Create Registration</button></a></h4> -->
                <div class="table-responsive">
                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Sr.</th>
                                <th>Class Name</th>
                                <th>Section Name</th>
                                <th>Subject Name</th>
                                <th>Teacher Name</th>
                                {{-- <th>Date</th> --}}
                                <th>Action</th>
                                {{-- <th>Session Name </th> --}}
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>


                            @if (!empty($teachersubjects))
                            @foreach ($teachersubjects as $teachersubject)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $teachersubject->class_name }}</td>
                                <td>{{ $teachersubject->section_name }}</td>
                                <td>{{ $teachersubject->subject_name }}</td>
                                <td>{{ $teachersubject->teacher_name }}</td>
                                {{-- <td>{{ date('d-m-Y', strtotime($teachersubject->updated_at)) }}</td> --}}
                                {{-- <td>{{ $teachersubject->session_name }}</td> --}}
                                <td class='d-flex'>
                                    <a class="btn btn-primary m-1" href="{{ url('view-teachersubject') .'/'.$teachersubject->id}}">Edit</a>
                                    <!-- <form id="deleteForm" method="post" action="{{url('delete-streammaster')}}">                                
                                                    @csrf
                                                    <input type="hidden" name="table_name" value="streams">
                                                    <input type="hidden" name="delete_id" value="{{ $teachersubject->id }}">
                                                    <button type="button" class="btn btn-danger m-1" onclick="confirmDelete(event)">Delete</button>
                                                </form> -->
                                    <?php $a = "subject_combinations"."-".$teachersubject->id ; ?>
                                    <a class="btn btn-raised ripple btn-danger m-1" href="{{url('delete-teachersubject').'/'.$teachersubject->id}}" onclick="confirmDelete(event)">Delete</a>
                                </td>

                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="9" class="text-center">No Data Found</td>
                            </tr>
                            @endif


                            <!-- <tr>
                                                <td>2</td>
                                                <td>12th</td>
                                                <td>A</td>
                                                <td>Maths</td>
                                                <td>Teacher Name 2</td>
                                                <td>Digtwise</td>
                                                <td><a class="btn btn-primary m-1" href="#">Edit</a><br>
                                                    <a class="btn btn-danger m-1" href="#">delete</a></td>
                                            </tr>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                              <th>Sr.</th>
                                              <th>Class Name</th>
                                              <th>Section Name</th>
                                              <th>Subject Name</th>
                                              <th>Teacher Name</th>
                                              <th>Action</th>
                                            </tr>  -->


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
        event.preventDefault(); // Prevents the default form submission

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
                // If the user clicks on "Yes, delete it!", manually submit the form
                document.getElementById('deleteForm').submit();
            }
        });
    }

    function copy_data(e) {
        e.preventDefault();


        if ((!$('#pre_session').val()) || ($('#pre_session').val() == '')) {
            return
        }
        if ((!$('#session_name').val()) || ($('#session_name').val() == '')) {
            return
        }

        let url = "{{ url('copy-teachersubject') }}"
        const _token = document.getElementsByName("_token")[0].value;

        var formData = new FormData()
        formData.append('_token', _token);
        formData.append('class_name', $('#class_name').val());
        formData.append('section_name', $('#section_name').val());
        formData.append('subject_name', $('#subject_name').val());
        formData.append('teacher_name', $('#teacher_name').val());
        formData.append('session_name', $('#session_name').val());
        formData.append('pre_session', $('#pre_session').val());

        // formData.append('file', $('#file_path').prop('files')[0])
        $.ajax({
            url: url,
            type: "POST",
            // dataType: "json",
            data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                console.log("success", response);
                Swal.fire({
                    icon: 'success',
                    title: 'success',
                    text: 'techer subject has been copied successfully.',
                })
                setTimeout(() => {
                    location.reload()
                }, 1500);

            },
            error: function(err) {
                console.log("error", err);
                if (err.status == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'success',
                        text: 'techer subject has been copied successfully.',
                    })
                    setTimeout(() => {
                        location.reload()
                    }, 1500);
                }
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
                    },
                    url: "{{url('classsection-view')}}/" + iso2,
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    method: "POST",
                    dataType: 'json',
                    success: function(data) {
                        // console.log(data);
                        $('#section_name').html('<option value=""> -- Select All -- </option>');
                        for (var i = 0; i < data.length; i++) {
                            var studentData = data[i].section_name;
                            // console.log(studentData, ' ', selected_section);                            
                            $('#section_name').append('<option value="' + studentData + '">' + studentData + '</option>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                $('#secationname').html('<option value="">Select class first</option>');
            }
        }

        // showSections();

        $('#class_name').on('change', showSections)

    })

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var select = document.getElementById('teacher_name');
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
        var select = document.getElementById('subject_name');
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
        $("#class_name").val("");     
        $("#section_name").val("");     
        $("#subject_name").val("");     
        $("#teacher_name").val("");     
    });

})

  </script>



@endsection
