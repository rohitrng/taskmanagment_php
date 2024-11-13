@extends('backend.layouts.main')
@section('main-container')
<style>
    .uperletter {
        text-transform: capitalize;
    }

</style>

<div class="main-content">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="breadcrumb">
        <h1 class="me-2">Marks Entry :-</h1>
    </div>


    <div class="separator-breadcrumb border-top"></div>
    @if(!empty($stream_master))
    <form id="progress-form" class="p-4 progress-form" action="{{url('store-marks')}}" method="post">
        <input type="hidden" @if(!empty($stream_master)) @foreach($stream_master as $streammaster) value=" {{ $streammaster->id }}" @endforeach @else value="" @endif name="id">
        {{-- <div class="separator-breadcrumb border-top"></div> --}}


        @else
        <form onsubmit="handleSubmitData(event)" id="progress-form" class="p-4 progress-form">
            @endif

            @csrf
            <div class="row">


                <div class="col-md-6 mb-4">
                    <div class="row">
                        {{-- <form id="attendanceForm" class="p-4 progress-form" action="{{url('marks')}}" method="post"> --}}
                        {{-- @csrf --}}



                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>

                                    <tr>
                                    <?php ?>
                                        <td><label for="firstName1">Teacher:</label></td>
                                        <td>
                                            <select required name="teacher_name" class="form-control" id="teacher_name">
                                                <option value="">-- Please select --</option>
                                                @if (!empty($stream_master))
                                                    @foreach ($stream_master as $s_item)
                                                        {{ $c_stream = $s_item->teacher_name }}
                                                        {{ $c_class_name = $s_item->class_name }}
                                                        {{ $c_section_name = $s_item->section_name }}
                                                        {{ $c_subject_name = $s_item->subject_name }}
                                                        {{ $c_max_marks_p = $s_item->max_marks_p }}
                                                        {{ $c_max_marks_t = $s_item->max_marks_t }}
                                                        {{ $c_max_marks = $s_item->max_marks }}
                                                        {{ $c_also_enter_practical_marks = $s_item->also_enter_practical_marks }}
                                                        <!-- also_enter_practical_marks -->
                                                    @endforeach
                                                @endif
                                                @foreach ($teacherlist as $teacherlist)
                                                <option {{( (!empty($c_stream)) && ($c_stream==$teacherlist->teacher_name)) ? 'selected' :
                                                                    '' }} value="{{ $teacherlist->teacher_name }}">{{ $teacherlist->teacher_name }}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" id="class_name_hide" name="class_name_hide" value="<?php echo (!empty($c_class_name) ? $c_class_name : ''); ?>">
                                            <input type="hidden" id="section_name_hide" name="section_name_hide" value="<?php echo (!empty($c_section_name) ? $c_section_name : ''); ?>">
                                            <input type="hidden" id="subject_name_hide" name="subject_name_hide" value="<?php echo (!empty($c_subject_name) ? $c_subject_name : ''); ?>">
                                        </td>
                                    </tr>

                                    <tr>

                                        <td><label for="class_name">Class:</label></td>
                                        <td>
                                            <select required id="class_name" class="form-control" name="class_name" autocomplete="" required>
                                                <option value="">-- Please select --</option>
                                                

                                            </select>
                                        </td>


                                    </tr>

                                    <tr>
                                        <td><label for="section_name">Section:</label></td>
                                        <td><select required name="section_name" class="form-control" id="section_name" required>
                                                <option value=""> -- Please select -- </option>
                                                @if (!empty($stream_master))
                                                <option selected value="{{$stream_master[0]->section_name}}">{{$stream_master[0]->section_name}}</option>
                                                @endif
                                            </select></td>
                                    </tr>

                                    {{-- <tr>                                                
                                                <td><label for="firstName1">Section:</label></td>
                                                <td><select name="section_name" class="form-control" id="section_name">                                                    
                                                </select></td>
                                            </tr> --}}



                                    <tr>
                                        <td><label for="exam_name">Term/Exam:</label></td>

                                        <td>
                                            <select required name="exam_name" class="form-control" id="exam_name">
                                                <option value="">-- Please select --</option>
                                                @if (!empty($stream_master))
                                                @foreach ($stream_master as $s_item)
                                                {{ $c_stream = $s_item->exam_name }}
                                                @endforeach
                                                @endif
                                                @foreach ($examslist as $examslist)
                                                <option {{( (!empty($c_stream)) && ($c_stream==$examslist->exam_name)) ? 'selected' :
                                                                    '' }} value="{{ $examslist->exam_name }}">{{ $examslist->exam_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>


                                    <tr>

                                        <td><label for="subject_name">Subject:</label></td>
                                        <td>
                                            <select required name="subject_name" class="form-control" id="subject_name">
                                                <option value="">-- Please select --</option>
                                                @if (!empty($stream_master))
                                                @foreach ($stream_master as $s_item)
                                                {{ $c_stream = $s_item->subject_name }}
                                                @endforeach
                                                @endif
                                                @foreach ($subjectlist as $subjectlist)
                                                <option {{( (!empty($c_stream)) && ($c_stream==$subjectlist->subject_name)) ? 'selected' :
                                                                    '' }} value="{{ $subjectlist->subject_name }}">{{ $subjectlist->subject_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td> <label for="max_marks_t">Max Marks(Theory): </label></td>
                                        <td> 
                                            <?php if(!empty($c_max_marks_t)) { ?>
                                                <input required class="form-control uperletter" id="max_marks_t" name="max_marks_t" value="<?php echo $c_max_marks_t; ?>" type="text" placeholder="max_marks_t" />
                                            <?php } else {?>
                                                <input required class="form-control uperletter" id="max_marks_t" name="max_marks_t" type="text" placeholder="max_marks_t" />
                                            <?php } ?>
                                            
                                        </td>

                                    </tr>



                                    <tr>
                                        <td>
                                            <label for="also_enter_practical_marks">Also enter practical mark: </label>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <!-- c_also_enter_practical_marks -->
                                                <?php if(!empty($c_also_enter_practical_marks)) { ?>
                                                    <input class="form-check-input" type="checkbox" id="also_enter_practical_marks" name="also_enter_practical_marks" checked/>
                                                <?php } else {?>
                                                    <input class="form-check-input" type="checkbox" id="also_enter_practical_marks" name="also_enter_practical_marks" />
                                                <?php } ?>
                                                <!-- <input class="form-check-input" type="checkbox" id="also_enter_practical_marks" name="also_enter_practical_marks" /> -->
                                                <label class="form-check-label" for="also_enter_practical_marks"></label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="max_marks_practical" style="display: <?php echo (!empty($c_also_enter_practical_marks)) ? 'table-row' : 'none'; ?>;">
                                        <td> <label for="max_marks_p">Max Marks(Practical): </label></td>
                                        <td> 
                                            <?php if(!empty($c_max_marks_p)) { ?>
                                                <input class="form-control uperletter" id="max_marks_p" name="max_marks_p" value="<?php echo $c_max_marks_p; ?>" type="text" placeholder="max_marks_t" />
                                            <?php } else {?>
                                                <input class="form-control uperletter" id="max_marks_p" name="max_marks_p" type="text" placeholder="max_marks_p" />
                                            <?php } ?>
                                            <!-- <input required class="form-control uperletter" id="max_marks_p" name="max_marks_p" type="text" placeholder="max_marks_p" /> -->
                                        </td>
                                    </tr>

                                    <tr>
                                        <td> <label for="max_marks">Max Marks: </label></td>
                                        <td>
                                        <?php if(!empty($c_max_marks)) { ?>
                                            <input required class="form-control uperletter" id="max_marks" name="max_marks" value="<?php echo $c_max_marks; ?>" type="text" placeholder="max_marks" />
                                            <?php } else {?>
                                                <input required class="form-control uperletter" id="max_marks" name="max_marks" type="text" placeholder="max_marks" />
                                            <?php } ?> 
                                            
                                        </td>

                                    </tr>

                                    <tr>
                                        <td>
                                            <label for="grade_calculation">Grade calculation on: </label>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="grade_calculation" name="grade_calculation" />
                                                <label class="form-check-label" for="grade_calculation">Both theory + practical</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="grade_calculation">Add Max NB and SE</label>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="max_nb_and_se" name="grade_calculation" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="max_marks_nb_c" style="display: none;">
                                        <td> <label for="max_marks_nb">Max Marks(NB): </label></td>
                                        <td> <input class="form-control uperletter" id="max_marks_nb" name="max_marks_nb" type="text" placeholder="max_marks_nb" />
                                        </td>
                                    </tr>
                                    <tr class="max_marks_se_c" style="display: none;">
                                        <td> <label for="max_marks_se">Max Marks(SE): </label></td>
                                        <td> <input class="form-control uperletter" id="max_marks_se" name="max_marks_se" type="text" placeholder="max_marks_se" />
                                        </td>
                                    </tr>

                                    <tr>
                                        {{-- <td><button class="btn btn-primary">Submit</button></td> --}}
                                        <td> <button id="reset" type="reset" class="btn btn-primary" name="btn" value="Reset Form">Reset</button></td>
                                        <td> @if(request()->route()->getName() !== 'marks')
                                            <a href="{{ url('marks') }}" class="btn btn-primary">Add New</a> </td>
                                        @endif

                                    </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>

                </div>

                <div class="col-md-6 mb-4">
                    <div class="row">
                        <h4>Previously saved marks entry :-</h4>
                        <div class="table-responsive" style="height: 600px; overflow: auto;">
                            <table class="display table table-striped table-bordered" id="another_div">
                                <thead>
                                    <tr>
                                        <th scope="col">S.no.</th>
                                        <th scope="col">Exam Name</th>
                                        <th scope="col">Class</th>
                                        <th scope="col">Section</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                @php
                                $i = 0;
                                @endphp
                                <tbody id="">

                                    @if(!empty($stream))
                                    @foreach($stream as $streams)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td class="uperletter">{{$streams->exam_name}}</td>
                                        <td>{{$streams->class_name}}</td>
                                        <td>{{$streams->section_name}}</td>
                                        <td class="uperletter">{{$streams->subject_name}}</td>


                                        <td class='d-flex'>
                                            <a class="btn btn-primary m-1" href="{{ url('view-marks') .'/'.$streams->id}}">Edit</a>
                                            <!-- <form id="deleteForm" method="post" action="{{url('delete-streammaster')}}">                                
                                                        @csrf
                                                        <input type="hidden" name="table_name" value="streams">
                                                        <input type="hidden" name="delete_id" value="{{ $streams->id }}">
                                                        <button type="button" class="btn btn-danger m-1" onclick="confirmDelete(event)">Delete</button>
                                                    </form> -->
                                            <?php $a = "previosly_saved_marks_entry"."-".$streams->id ; ?>
                                            <a class="btn btn-raised ripple btn-danger m-1" href="{{url('delete-marks').'/'.$a}}" onclick="confirmDelete(event)">Delete</a>
                                        </td>
                                    </tr>
                                    <!-- </?php $i++; ?> -->
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="9" class="text-center">No Data Found</td>
                                    </tr>
                                    @endif




                                </tbody>
                                <!-- Add this inside the form where you want to submit the radio button data -->
                                <input type="hidden" name="attendance_data" id="attendance_data" value="">
                            </table>

                        </div>
                    </div>
                </div>



                <div class="container-fluid">
                    <div class="row">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="card" style="width: 100%;">
                                    <div class="card-body">
                                        <div class="table-responsive" style="width: 100%;">
                                            <table class="display table table-striped table-bordered table-full-width" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">S.no.</th>
                                                        {{-- <th scope="col">S.no.</th> --}}
                                                        <th scope="col">
                                                            <label>
                                                                <input type="checkbox" id="isAbsentToggle" class="toggle-checkbox" data-column-index="1"> Is Absent Th
                                                            </label>
                                                        </th>
                                                        <th scope="col">
                                                            <label>
                                                                <input type="checkbox" id="isAbsentPrToggle" class="toggle-checkbox" data-column-index="2"> Is Absent Pr
                                                            </label>
                                                        </th>
                                                        <th scope="col">Student Name</th>
                                                        <th scope="col">Enrollment no.</th>
                                                        <th scope="col">Scholar no.</th>
                                                        <th scope="col">Mark(theory)</th>
                                                        <th scope="col">Mark(practical)</th>
                                                        {{-- <th scope="col">Total Marks</th> --}}
                                                        <th scope="col">Total Marks 
                                                        <?php if(!empty($c_max_marks)) { ?>
                                                            <input type="text" id="totalMarksInput" value="<?php echo $c_max_marks; ?>" readonly placeholder="Enter Total Marks"></th>
                                                        <?php } else {?>
                                                            <input type="text" id="totalMarksInput" readonly placeholder="Enter Total Marks"></th>
                                                        <?php } ?>     
                                                        <th scope="col">Grade acade.</th>
                                                        <th scope="col" style="display:none" id="max_nb">Max (NB)</th>
                                                        <th scope="col" style="display:none" id="max_se">Max (SE)</th>
                                                        <!-- <th scope="col">Result</th> -->
                                                        <!-- <th scope="col">Over all grade</th> -->
                                                        <th scope="col">Action</th>
                                                    </tr>





                                                </thead>
                                                <tbody id="studentdatatable">
                                                    @php
                                                    $i = 0;
                                                    @endphp
                                                    @if(!empty($dailyreport))
                                                    @foreach($dailyreport as $listR)
                                                    <tr>
                                                        <th scope="row">{{++$i}}</th>
                                                        <td>{{$listR->Teacher_Name}}</td>
                                                        <td>{{$listR->class_name}}</td>
                                                        <td>{{$listR->section_name}}</td>
                                                        <td>{{$listR->period_meeting}}</td>
                                                        <td>{{date('d-m-Y', strtotime($listR->create_date))}}</td>
                                                    </tr>
                                                    @endforeach
                                                    @else
                                                    <tr>
                                                        <td colspan="12" class="text-center">No Data Found</td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary col-2 mt-2" style="width:100px;">Submit</button>

                    </div>
                </div>


        </form>
</div>
</div>


<!-- end of main-content -->














<script>
    document.addEventListener('DOMContentLoaded', function() {
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

    $("#reset").on("click", function() {
        console.log("click")
        $('#progress-form select').each(function(idx, sel) {
            for (let i = 0; i < sel.children.length; i++) {
                sel.children[i].removeAttribute("selected");
            }
        });
        $('#progress-form input').each(function(idx, sel) {
            for (let i = 0; i < sel.children.length; i++) {
                sel.children[i].value = "";
            }
        });
    });

</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var select = document.getElementById('exam_name');
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
    document.addEventListener('DOMContentLoaded', function() {
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

</script>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function confirmDelete(event) {
        event.preventDefault(); // Prevents the default link navigation

        Swal.fire({
            title: 'Are you sure?'
            , text: "You won't be able to revert this!"
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#d33'
            , cancelButtonColor: '#3085d6'
            , confirmButtonText: 'Yes, delete it!'
            , cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user clicks on "Yes, delete it!", navigate to the delete URL
                window.location.href = event.target.href;
            }
        });
    }

</script>

<script>
    var responseData;
    var stu;
    var checkedValues = []; // Initialize the array globally
    function fetch_select(val) {
        // Reset the checkedValues array
        checkedValues = [];
        var value = val;
        // console.log(val);
        $.ajax({
            data: {
                value: val
            }
            , url: "{{ url('classwisestudent') }}"
            , headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            , method: "POST"
            , datatype: 'json'
            , success: function(response) {
                responseData = response;
                var stuData = JSON.parse(responseData);
                stu = stuData; // Assign 'stuData' to the global 'stu' variable
                // console.log(stu);
                // Clear the existing rows from the table body
                $('#bus_Attend_data tbody').empty();
                // Iterate over the arrays and construct the table rows
                for (var i = 0; i < stu.length; i++) {
                    // Construct the table rows for attendance
                    var newRow = '<tr>' +
                        '<td style="font-size: 16px; font-weight: bold;">' + (i + 1) + '</td>' +
                        '<td style="font-size: 16px;">' + stu[i].form_number + '</td>' +
                        '<td style="font-size: 16px;">' + stu[i].id + '</td>' +
                        '<td style="font-size: 16px;">' + stu[i].student_name + '</td>' +
                        '<td><input type="radio" name="attendance_' + i + '" value="p" checked > P</input><input type="radio" name="attendance_' + i + '" value="A"> A</input><input type="radio" name="attendance_' + i + '" value="N">N</input><input type="radio" name="attendance_' + i + '" value="E">E</input><input type="radio" name="attendance_' + i + '" value="O">O</input><input type="radio" name="attendance_' + i + '"  value="OFF">OFF</input><input type="radio" name="attendance_' + i + '" value="PL">PL</input></td>' +
                        '</tr>';
                    $('#bus_Attend_data').append(newRow);
                }
                // Attach the change event handler to the radio buttons
                $('input[type="radio"]').on('change', function() {
                    updateCheckedValues();
                });
                // console.log(updateCheckedValues());
            }
        });
    }

    function updateCheckedValues() {
        // Reset the checkedValues array
        checkedValues = [];

        // Iterate over the radio buttons and collect the checked values
        $('input[type="radio"]:checked').each(function() {
            var rowIndex = $(this).closest('tr').index();
            var selectedValue = $(this).val();
            var studentName = stu[rowIndex].student_name;
            var formNumber = stu[rowIndex].form_number;
            var studentId = stu[rowIndex].id;

            checkedValues.push({
                row: rowIndex
                , value: selectedValue
                , student_name: studentName
                , form_Number: formNumber
                , student_id: studentId
            , });
            console.log(checkedValues);
        });

        // Set the value of the hidden input field with the collected checked values as JSON
        $('#attendance_data').val(JSON.stringify(checkedValues));
    }


    function deleteRowData(e) {
        const elm = e.target.parentElement.parentElement;
        console.log(elm)
        elm.remove()
    }


    document.addEventListener("DOMContentLoaded", function() {
        var select = $("#teacher_name").val();
        if (select !== "") {
            let teacher = select;
            let token = document.getElementsByName("_token")[0].value
            $.ajax({
                data: {
                    teacher: teacher
                },
                url: "{{ url('getteachersdata') }}",
                headers: {
                    'X-CSRF-TOKEN': token
                },
                method: "POST",
                dataType: 'json',
                success: function(data) {
                    // console.log(data);

                    $('#class_name').html('<option value=""> -- Select All -- </option>');
                    for (var i = 0; i < data.classes.length; i++) {
                        var className = data.classes[i];
                        <?php if(!empty($c_class_name)){ ?>
                            if ('<?php echo $c_class_name; ?>' === className) {
                                $('#class_name').append('<option value="' + className + '" selected>' + className + '</option>').change();
                            } else {
                                $('#class_name').append('<option value="' + className + '">' + className + '</option>');
                            }
                        <?php } else { ?>
                            $('#class_name').append('<option value="' + className + '">' + className + '</option>');
                        <?php } ?>
                    }

                    $('#subject_name').html('<option value=""> -- Select All -- </option>');
                    for (var i = 0; i < data.subjects.length; i++) {
                        var subjectName = data.subjects[i];                                            
                        $('#subject_name').append('<option value="' + subjectName + '">' + subjectName + '</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
        
        document.getElementById("teacher_name").addEventListener("change", (e) => {
            let teacher = e.target.value;
            let token = document.getElementsByName("_token")[0].value
            
            // $.ajax({
            //     data: {
            //         teacher: teacher
            //     }
            //     , url: "{{url('getteachersclasses')}}"
            //     , headers: {
            //         'X-CSRF-TOKEN': token
            //     }
            //     , method: "POST"
            //     , dataType: 'json'
            //     , success: function(data) {
            //         console.log(data);
            //         $('#class_name').html('<option value=""> -- Select All -- </option>');
            //         for (var i = 0; i < data.length; i++) {
            //             var class_name = data[i].class_name;                                            
            //             $('#class_name').append('<option value="' + class_name + '">' + class_name + '</option>');
            //         }
            //     }
            //     , error: function(xhr, status, error) {
            //         console.error(error);
            //     }
            // });

            // $.ajax({
            //     data: {
            //         teacher: teacher
            //     }
            //     , url: "{{url('getteacherssubject')}}"
            //     , headers: {
            //         'X-CSRF-TOKEN': token
            //     }
            //     , method: "POST"
            //     , dataType: 'json'
            //     , success: function(data) {
            //         console.log(data);
            //         $('#subject_name').html('<option value=""> -- Select All -- </option>');
            //         for (var i = 0; i < data.length; i++) {
            //             var subject_name = data[i].subject_name;                                            
            //             $('#subject_name').append('<option value="' + subject_name + '">' + subject_name + '</option>');
            //         }
            //     }
            //     , error: function(xhr, status, error) {
            //         console.error(error);
            //     }
            // });


            $.ajax({
                data: {
                    teacher: teacher
                },
                url: "{{ url('getteachersdata') }}",
                headers: {
                    'X-CSRF-TOKEN': token
                },
                method: "POST",
                dataType: 'json',
                success: function(data) {
                console.log(data);

                // Handle classes dropdown
                $('#class_name').html('<option value=""> -- Select All -- </option>');
                for (var i = 0; i < data.classes.length; i++) {
                    var className = data.classes[i];                                            
                    $('#class_name').append('<option value="' + className + '">' + className + '</option>');
                }

                // Handle subjects dropdown
                $('#subject_name').html('<option value=""> -- Select All -- </option>');
                for (var i = 0; i < data.subjects.length; i++) {
                    var subjectName = data.subjects[i];                                            
                    $('#subject_name').append('<option value="' + subjectName + '">' + subjectName + '</option>');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });




        })

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
                        console.log(data);
                        $('#section_name').html('<option value=""> -- Select All -- </option>');
                        for (var i = 0; i < data.length; i++) {
                            var studentData = data[i].section_name;
                            // alert(studentData);
                            <?php if(!empty($c_section_name)){ ?>
                                if ('<?php echo $c_section_name; ?>' === studentData) {
                                    $('#section_name').append('<option value="' + studentData + '" selected >' + studentData + '</option>');
                                } else {
                                    $('#section_name').append('<option value="' + studentData + '">' + studentData + '</option>');
                                }
                            <?php } else { ?>
                                $('#section_name').append('<option value="' + studentData + '">' + studentData + '</option>');
                            <?php } ?>  
                            // console.log(studentData, ' ', selected_section);                            
                            
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

        $('#max_nb_and_se').on('change', (e) => {
            // showStudentData();
        })

        function showStudentData() {
            var iso2 = $("#class_name").val();
            var section_name = $("#section_name").val();
            var max_nb_and_se = $("#max_nb_and_se").prop("checked");
            let token = document.getElementsByName("_token")[0].value
            // console.log(iso2);
            if (iso2) {
                $.ajax({
                    data: {
                        class: iso2,
                        section_name:section_name
                    },
                    url: "{{url('class-studentdata')}}", 
                    headers: {
                        'X-CSRF-TOKEN': token
                    }, 
                    method: "POST", 
                    dataType: 'json', 
                    success: function(data) {
                        if (max_nb_and_se) {
                            $("#max_nb").show();
                            $("#max_se").show();
                        } else {
                            $("#max_nb").hide();
                            $("#max_se").hide();
                        }

                        console.log(data.grade)
                        let rows = '';
                        data.students.map((item, index) => {
                            rows += `
                            <tr>
                                <td colspan="1">${index + 1}</td>
                                <td colspan="1"><input type="checkbox" /></td>
                                <td colspan="1"><input type="checkbox" /></td>
                                <td colspan="1">${item.student_name}</td>
                                <td colspan="1"></td>
                                <td colspan="1">${item.scholar_no}</td>
                                <td colspan="1"><input type="number" id="mark_th_${index + 1}" oninput="calculateTotal(${index + 1})" /></td>
                                <td colspan="1"><input type="number" id="mark_pt_${index + 1}" oninput="calculateTotal(${index + 1})" /></td>
                                <td colspan="1"><input type="number" id="total_${index + 1}" oninput="calculateTotal(${index + 1})" /></td>
                                <td colspan="1"><input type="text" id="grade_${index + 1}" /></td>
                                ${max_nb_and_se ? `<td colspan="1"><input type="number" id="mark_nb_${index + 1}" oninput="calculateTotal(${index + 1})" /></td>` : ''}
                                ${max_nb_and_se ? `<td colspan="1"><input type="number" id="mark_se_${index + 1}" oninput="calculateTotal(${index + 1})" /></td>` : ''}
                                <td colspan="1"><button type="button" class="btn btn-danger btn-sm" onclick="deleteRowData(event)">Delete</button></td>
                              </tr>`
                        })

                        $("#studentdatatable").html(rows)

                    }
                    , error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                $('#section_name').html('<option value="">Select class first</option>');
            }
        }

        $('#class_name').on('change', function() {
            showSections();
            // showStudentData();
            var teacher_name = $("#teacher_name").val();
            var class_name = $(this).val();
            let token = document.getElementsByName("_token")[0].value;
            $.ajax({
                data: {
                    teacher: teacher_name,
                    class_name: class_name
                },
                url: "{{ url('getteachersandsubject') }}",
                headers: {
                    'X-CSRF-TOKEN': token
                },
                method: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#subject_name').html('<option value=""> -- Select All -- </option>');
                    for (var i = 0; i < data.subjects.length; i++) {
                        var subjectName = data.subjects[i]; 
                        <?php if(!empty($c_subject_name)){ ?>
                            if ('<?php echo $c_subject_name; ?>' === subjectName) {
                                $('#subject_name').append('<option value="' + subjectName + '" selected>' + subjectName + '</option>');
                            } else {
                                $('#subject_name').append('<option value="' + subjectName + '">' + subjectName + '</option>');
                            }
                        <?php } else { ?>
                            $('#subject_name').append('<option value="' + subjectName + '">' + subjectName + '</option>');
                        <?php } ?>                                             
                        // $('#subject_name').append('<option value="' + subjectName + '">' + subjectName + '</option>');
                    }
                }
            });
        });
        $('#section_name').on('change', function() {
            showStudentData();
        });

        $('#subject_name').on('change', () => {
            // showSections();
            // showStudentData();
        })

        $('#isAbsentToggle').on('change', (e) => {
            let bodydata = document.getElementById("studentdatatable").children
            for (var i = 0; i < bodydata.length; i++) {
                var row = bodydata[i];
                row.children[1].children[0].checked = e.target.checked
            }
        })

        $('#isAbsentPrToggle').on('change', (e) => {
            let bodydata = document.getElementById("studentdatatable").children
            for (var i = 0; i < bodydata.length; i++) {
                var row = bodydata[i];
                row.children[2].children[0].checked = e.target.checked
            }
        })

        $('#totalMarksInput').on('input', (e) => {
            let bodydata = document.getElementById("studentdatatable").children
            for (var i = 0; i < bodydata.length; i++) {
                var row = bodydata[i];
                row.children[8].children[0].value = e.target.value
            }
        })

    })


    function handleSubmitData(event) {
        event.preventDefault();
        let token = document.getElementsByName("_token")[0].value
        let data = []
        let bodydata = document.getElementById("studentdatatable").children
        // console.log(bodydata)


        for (var i = 0; i < bodydata.length; i++) {
            var row = bodydata[i];
            let obj = {};
            // console.log(row)
            obj['is_absent'] = row.children[1].children[0].checked;
            obj['is_absent_pr'] = row.children[2].children[0].checked;
            obj['student_name'] = row.children[3].innerText;
            obj['enrollment'] = row.children[4].innerText;
            obj['scholar_no'] = row.children[5].innerText;
            obj['mark_theory'] = row.children[6].children[0].value;
            obj['mark_practical'] = row.children[7].children[0].value;
            obj['total_marks'] = row.children[8].children[0].value;
            obj['grade'] = row.children[9].children[0].value;
            if (row.children.length > 10) {
                obj['max_nb'] = row.children[10].children[0].value;
                obj['max_se'] = row.children[11].children[0].value;
            }
            data.push(obj);
        }

        var max_marks_nb_ = parseFloat($('#max_marks_nb').val()) || 0;
        var max_marks_se_ = parseFloat($('#max_marks_se').val()) || 0;
        let postData = {
            teacher_name: $("#teacher_name").val()
            , class_name: $("#class_name").val()
            , section_name: $("#section_name").val()
            , exam_name: $("#exam_name").val()
            , subject_name: $("#subject_name").val()
            , max_marks_t: $("#max_marks_t").val()
            , also_enter_practical_marks: $("#also_enter_practical_marks").val()
            , max_marks_p: $("#max_marks_p").val()
            , max_marks: $("#max_marks").val()
            , grade_calculation: $("#grade_calculation").val()
            , max_marks_nb: max_marks_nb_
            , max_marks_se: max_marks_se_
            , marksdata: data
        }








        // console.log(postData);
        // return

        $.ajax({
            data: postData
            , url: "{{url('save-marks')}}"
            , headers: {
                'X-CSRF-TOKEN': token
            }
            , method: "POST"
            , dataType: 'json'
            , success: function(response) {
                console.log(response);
                if (response.status === "success") {
                    toastr.success("Updated successfully.", "Success");
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    console.error("Unexpected response format.");
                }
            },

            // error: function(xhr, status, error) {
            //     console.error(error);
            // }
        });


    }

</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get all toggle checkboxes
        var toggleCheckboxes = document.querySelectorAll(".toggle-checkbox");

        // Add event listener to each toggle checkbox
        toggleCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener("change", function() {
                // Get the index of the column
                var columnIndex = this.getAttribute("data-column-index");

                // Get all checkboxes in the corresponding column
                var columnCheckboxes = document.querySelectorAll(".checkbox-column-" + columnIndex);

                // Set the state of all checkboxes in the column based on the state of the toggle checkbox
                columnCheckboxes.forEach(function(columnCheckbox) {
                    columnCheckbox.checked = checkbox.checked;
                });
            });
        });
    });

</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Add event listener to class checkboxes
        $('.toggle-checkbox').change(function() {
            // Get the index of the column
            var columnIndex = $(this).data('column-index');

            // Check or uncheck all checkboxes in the corresponding column based on the state of the class checkbox
            $('.checkbox-column-' + columnIndex).prop('checked', $(this).prop('checked'));
        });

        $('#also_enter_practical_marks').change(function() {
            var isChecked = $(this).prop('checked');
            if (isChecked) {
                $('.max_marks_practical').show();
            } else {
                $('.max_marks_practical').hide();
            }
        });

        $('#max_nb_and_se').change(function() {
            var isChecked = $(this).prop('checked');
            if (isChecked) {
                $('.max_marks_nb_c').show();
                $('.max_marks_se_c').show();
            } else {
                $('.max_marks_nb_c').hide();
                $('.max_marks_se_c').hide();
            }
        });

        $('#max_marks_p').on('input', function() {
            var max_marks_t = parseInt($('#max_marks_t').val());
            var max_marks_p = parseInt($(this).val());
            var total = max_marks_t + max_marks_p;
            $('#max_marks').val(total);
            $('#totalMarksInput').val(total);
        });

        $('#max_marks_t').on('input', function() {
            var max_marks_t = parseInt($('#max_marks_t').val());
            var total = max_marks_t;
            $('#max_marks').val(total);
            $('#totalMarksInput').val(total);
        });

    });

    function calculateTotal(rowNumber) {
        var mark_th = parseFloat($('#mark_th_' + rowNumber).val()) || 0;
        var mark_pt = parseFloat($('#mark_pt_' + rowNumber).val()) || 0;
        var mark_nb = parseFloat($('#mark_nb_' + rowNumber).val()) || 0;
        var mark_se = parseFloat($('#mark_se_' + rowNumber).val()) || 0;

        $('#total_' + rowNumber).val(mark_th + mark_pt);

        var marks = parseFloat($('#totalMarksInput').val()) || 0;
        var totalMarks = mark_th + mark_pt;
        var total = (totalMarks / marks) * 100;
        console.log("mark_th "+mark_th);
        console.log("mark_pt "+mark_pt);
        console.log("marks "+marks);
        console.log("total "+total);
        let grade = findGrade(total, rowNumber);
        // $('#grade_' + rowNumber).val(total);
    }

    function findGrade(percentage, rowNumber) {
        // Iterate through data.grade to find the applicable grading range
        let token = document.getElementsByName("_token")[0].value
        $.ajax({
            data: {
                percentage: percentage
            }
            , url: "{{url('grade_percentage')}}"
            , headers: {
                'X-CSRF-TOKEN': token
            }
            , method: "POST"
            , dataType: 'json'
            , success: function(data) {
                // console.log(data);
                // return data;
                var check = $('#subject_name').val();
                if (check !== 'Sanskrit' && check !== 'sanskrit' && check !== 'Computer Science' && check !== 'computer science	'){
                    $('#grade_' + rowNumber).val(data);
                } else {
                    $('#grade_' + rowNumber).val();
                }
                
            }
            , error: function(xhr, status, error) {
                console.error(error);
            }
        });
        // for (const grading of data.grade) {
        //     let minPercentage = parseFloat(grading.min_per) || 0;
        //     let maxPercentage = parseFloat(grading.max_per) || 100;

        //     if (percentage >= minPercentage && percentage <= maxPercentage) {
        //         return grading.grading_name;
        //     }
        // }

        // return ''; // Return an empty string if no matching grade is found
    }

</script>


@endsection
