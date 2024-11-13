@extends('backend.layouts.main')
@section('main-container')
<div class="main-content">
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="breadcrumb">
            <h1 class="me-2">Daily Attandence Entry :-</h1>
          </div>
        <div class="separator-breadcrumb border-top"></div>
    <div class="row">
            <div class="col-md-6 mb-4">
               <div class = "row">
               <form id="attendanceForm" class="p-4 progress-form" action="{{url('dailyattandence')}}"  method="post">
               @csrf
               <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                
                                                <td><label for="firstName1">Attandence Date:</label></td>
                                                <td><input name="Attandence_Name" class="form-control" id="callno" type="date" 
                                                placeholder="Attandence_Name" required /></td>
                                            </tr>
                                            <tr>
                                                
                                                <td><label for="firstName1">Teacher:</label></td>
                                                <td>
                                                    <select name="teacher_name" class="form-control" id="teacher_name" required>
                                                        <option value="">-- Please select --</option>
                                                        @if (!empty($stream_master))
                                                        @foreach ($stream_master as $s_item)
                                                        {{ $c_stream = $s_item->teacher_name }}
                                                        @endforeach
                                                        @endif
                                                        @foreach ($teacherlist as $teacherlist)
                                                        <option {{( (!empty($c_stream)) && ($c_stream = $teacherlist->teacher_name)) ? 'selected' :
                                                                    '' }} value="{{ $teacherlist->teacher_name }}">{{ $teacherlist->teacher_name }}</option>
                                                        @endforeach
                                                     </select>
                                            </td>
                                            </tr>

                                            <tr>
                                                 
                                                <td><label for="firstName1">Class:</label></td>
                                                <td>
                                                    <select id="classname" class="form-control" name="class_name" autocomplete="" required onchange="fetch_select(this.value)">
                                                        <option value="" disabled selected>--Please select--</option>
                                                        @foreach($classlist as $each)
                                                        <option value="{{$each->class_name}}">{{$each->class_name}}</option>
                                                        @endforeach
                                                         {{-- @foreach(config('global.class_name') as $each)
                                                        <option value="{{$each}}">{{$each}}</option>
                                                        @endforeach  --}}
                                                     </select>

                                                </td>


                                            </tr>

                                            <tr>
                                                
                                                <td><label for="firstName1">Section:</label></td>
                                                <td><select name="section_name" class="form-control" id="section_name">                                                    
                                                </select></td>
                                            </tr>
                                            <tr>
                                                
                                                <td><label for="firstName1">period/meeting:</label></td>
                                                <td><select name="period_meeting" class="form-control" id="Exam_Name">
                                                    <option value="" selected> -- Please select -- </option>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="C">C</option>
                                                </select></td>
                                            </tr>
                                            <tr>
                                                <td><button class="btn btn-primary">Submit</button></td>
                                               <td> <button type="reset" class="btn btn-primary" name="btn" value="Reset Form">Reset</button></td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                              <div class="row">
                                        <div class="col-md-2 form-group mb-3">
                                        <!-- <input type="text" id="schedule_nameb" name="schedule_nameb" value=""> -->
                                            <label for="lastName1">from date:</label>
                                            <input type="date" class="form-control" id="picker2-"  />
                                        </div>
                                        <div class="col-md-2 form-group mb-3">
                                        <!-- <input type="text" id="schedule_nameb" name="schedule_nameb" value=""> -->
                                            <label for="lastName1">to date:</label>
                                            <input type="date" class="form-control" id="picker2-"  />
                                        </div>
                                        <div class="col-md-2 form-group mb-3">
                                            <br>
                                            <button class="btn btn-primary">show</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="table-responsive" style="height: 250px; overflow: auto;">
                                    <table class="display table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">S.no.</th>
                                                <th scope="col">Teacher Name</th>
                                                <th scope="col">Class</th>
                                                <th scope="col">Sec.</th>
                                                <th scope="col">Period no.</th>
                                                <th scope="col">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
                        <tr><td colspan="9" class="text-center">No Data Found</td></tr>
                        @endif
                                        </tbody>
                                    </table>
                                    </div>
                                    </div>
               </div>
               <div class="row">
                  
               </div>
            </div>
            <div class="col-md-6 mb-4">
            <div class="row">
                    <h4>Marks Attandence below :-</h4>
                                    <div class="table-responsive" style="height: 600px; overflow: auto;">
                                    <table class="display table table-striped table-bordered" id="another_div">
                                    <thead id="another_div"></thead>
                                    <tbody id="bus_Attend_data"></tbody>
                                      <!-- Add this inside the form where you want to submit the radio button data -->
                                        <input type="hidden" name="attendance_data" id="attendance_data" value="">
                                    </table>
                                    </div>
                                    </div>
                                    </form> 
              </div>
          </div>

          
    <!-- end of main-content -->
</div>
<script>
    var responseData;
    var stu; 
    var checkedValues = []; // Initialize the array globally
   // Function to fetch data and populate the table
   function fetch_select(val) {
        // Reset the checkedValues array
        checkedValues = [];
        var value = val;

        $.ajax({
            data: { value: val },
            url: "{{ url('classwisestudent') }}",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            method: "POST",
            datatype: 'json',
            success: function(response) {
                responseData = response;
                var stuData = JSON.parse(responseData);
                stu = stuData; // Assign 'stuData' to the global 'stu' variable

                // Clear the existing rows from the table body and header
                $('#bus_Attend_data tbody').empty();
                $('#another_div thead').empty();

                // Construct the table header with a single select dropdown
                var tableHeader = '<tr>' +
                    '<th scope="col">S.no.</th>' +
                    '<th scope="col">Roll no.</th>' +
                    '<th scope="col">Board roll no.</th>' +
                    '<th scope="col">Student Name</th>' +
                    '<th scope="col">Attandence: ' +
                        '<select class="form-control" onchange="updateRadioButtons(this)">' +
                            '<option value="Please Select">Please Select</option>' +
                            '<option value="P">P</option>' +
                            '<option value="A">A</option>' +
                            '<option value="N">N</option>' +
                            '<option value="E">E</option>' +
                            '<option value="O">O</option>' +
                            '<option value="OFF">OFF</option>' +
                            '<option value="PL">PL</option>' +
                        '</select>' +
                    '</th>' +
                '</tr>';
                $('#another_div thead').html(tableHeader);

                // Iterate over the arrays and construct the table rows
                for (var i = 0; i < stu.length; i++) {
                    // Construct the table rows for attendance
                    var newRow =  '<tr>' +
                        '<td style="font-size: 16px; font-weight: bold;">' + (i + 1) + '</td>' +
                        '<td style="font-size: 16px;">' + stu[i].form_number + '</td>' +
                        '<td style="font-size: 16px;">' + stu[i].id + '</td>' +
                        '<td style="font-size: 16px;">' + stu[i].student_name + '</td>' +
                        '<td class="updateselectvalue">' +
                            '<label><input type="radio" name="attendance_' + i + '" value="P" checked> P</label>' +
                            '<label><input type="radio" name="attendance_' + i + '" value="A"> A</label>' +
                            '<label><input type="radio" name="attendance_' + i + '" value="N"> N</label>' +
                            '<label><input type="radio" name="attendance_' + i + '" value="E"> E</label>' +
                            '<label><input type="radio" name="attendance_' + i + '" value="O"> O</label>' +
                            '<label><input type="radio" name="attendance_' + i + '" value="OFF"> OFF</label>' +
                            '<label><input type="radio" name="attendance_' + i + '" value="PL"> PL</label>' +
                        '</td>' +
                    '</tr>';
                    $('#bus_Attend_data').append(newRow);
                }
                // Attach the change event handler to the radio buttons
                $(document).on('change', 'input[type="radio"]', function() {
                    console.log(1);
                    updateCheckedValues(this);
                });

            }
        });
    }

    // Function to update the checked values array
    function updateCheckedValues(radioButton) {
        console.log('updateCheckedValues function called');
    
    var selectedValue = $('input[name="' + $(radioButton).attr('name') + '"]:checked').val();
    console.log('Selected Value:', selectedValue);

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
                row: rowIndex,
                value: selectedValue,
                student_name: studentName,
                form_Number: formNumber,
                student_id: studentId,
            });
        });
        console.log('Checked Values:', checkedValues);

        // Set the value of the hidden input field with the collected checked values as JSON
        $('#attendance_data').val(JSON.stringify(checkedValues));
    }

    // Function to update the radio buttons based on the selected value in the header dropdown
    function updateRadioButtons(selectElement) {
        var selectedValue = selectElement.value;
        console.log(selectedValue);

        // Loop through each radio button and set the checked property based on the selected value
        $('input[name^="attendance_"]').each(function(index, radio) {
                // Set the checked property based on the selected value
                $(radio).prop('checked', $(radio).val() === selectedValue);
            });
            $('input[type="radio"]:checked').each(function() {
            var rowIndex = $(this).closest('tr').index();
            var selectedValue = $(this).val();
            var studentName = stu[rowIndex].student_name;
            var formNumber = stu[rowIndex].form_number;
            var studentId = stu[rowIndex].id;

            checkedValues.push({
                row: rowIndex,
                value: selectedValue,
                student_name: studentName,
                form_Number: formNumber,
                student_id: studentId,
            });
        });
        console.log('Checked Values:', checkedValues);
        $('#attendance_data').val(JSON.stringify(checkedValues));
        // Reset the dropdown selection to trigger the onchange event even if the same value is selected again
        selectElement.selectedIndex = 0;
    }
    document.addEventListener("DOMContentLoaded", function() {

function showSections() {
    var iso2 = $("#classname").val();
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


$('#classname').on('change', showSections)

})
 
</script>
@endsection
