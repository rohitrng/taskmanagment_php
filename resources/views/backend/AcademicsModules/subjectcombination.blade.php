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


<script defer>
    function handleInsertRowData() {
        let subjectname = document.getElementById("subject_name").value;
        let childLength = document.getElementById("selected_subjects").children.length;


        console.log(childLength);

        let rowStr = `
    <tr>
                <td></td>
                <td></td> 
                <td></td>
                <td>
                    <input type="checkbox" name="class_checkbox" class="class_checkbox" >
                </td>
            </tr>
    `

        // document.getElementById("subject_tbody").append(rowStr);
    }

    function changeAcademicType() {

        let type = document.querySelector('input[name="combination_type"]:checked').value;

        if (type === "Academic") {
            document.getElementById("subject_name").innerHTML = document.getElementById("academicdata").innerHTML;
        } else {
            document.getElementById("subject_name").innerHTML = document.getElementById("nonacademicdata").innerHTML;
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        changeAcademicType();


        document.getElementById("combination_type_academic").addEventListener("click", function() {
            changeAcademicType("Academic");
        }, false);

        document.getElementById("combination_type_nonacademic").addEventListener("click", function() {
            changeAcademicType("Non Academic");
        }, false);

        // document.getElementById("loadSubjectsButton").addEventListener("click", function () {
        //   handleInsertRowData();
        // }, false);

    });

</script>


{{-- <script defer>
    // ... Your existing JavaScript code ...

    document.getElementById("submitForm").addEventListener("click", function (e) {
        // Check if at least one class is selected
        let selectedClasses = document.querySelectorAll('input[name="class_checkbox"]:checked');

        if (selectedClasses.length === 0) {
            // Display an error message
            document.getElementById("error-message").innerText = "Please select at least one class.";

            // Prevent form submission by returning false
            e.preventDefault();
        } else {
            // Clear the error message if classes are selected
            document.getElementById("error-message").innerText = "";
        }
    });
</script> --}}

<style>
    .serial-number {
        min-width: 40px;
        /* Adjust the width as needed */
    }

    .app-admin-wrap {
        margin-top: -30px;
    }

</style>




<div class="main-content">

    <div class="main-content pt-4">
        <div class="form_section1_div">
            <div class="breadcrumb">
                <h1 class="me-2">Subject Combinations</h1>
            </div>

            <select id="academicdata" class="form-control  d-none " name="academicdata" required>
                <option value="">--Please Select--</option>
                @if (!empty($subjects))
                @foreach ($subjects as $subject)
                @if ($subject->subject_type=="Academic")
                <option value="{{ $subject->subject_name }}">
                    {{ $subject->subject_name }}</option>
                @endif
                @endforeach
                @endif
            </select>


            <select id="nonacademicdata" class="form-control d-none" name="nonacademicdata" required>
                <option value="">Select</option>
                @if (!empty($subjects))
                @foreach ($subjects as $subject)
                @if ($subject->subject_type!="Academic")
                <option value="{{ $subject->subject_name }}">
                    {{ $subject->subject_name }}</option>
                @endif
                @endforeach
                @endif
            </select>




            <div class="separator-breadcrumb border-top"></div>
            @if(!empty($stream_master))
            {{-- <form id="progress-form" class="p-4 progress-form" action="{{url('store-subjectcombinatiomaster')}}"
            novalidate method="post"> --}}
            <form id="subjectCombinationForm" class="p-4 progress-form">
                <input type="hidden" @if(!empty($stream_master)) @foreach($stream_master as $streammaster) value=" {{ $streammaster->id }}" @endforeach @else value="" @endif name="id">


                @else


                {{-- <form id="subjectCombinationForm" class="p-4 progress-form"
                    action="{{url('save-subjectcombinatiomaster')}}" novalidate method="post"> --}}

                <form id="subjectCombinationForm" class="p-4 progress-form">
                    @endif

                    @csrf
                    <div class="row">

                        <div class="col-md-4 form-group mb-3 uperletter">
                            <label class= "uperletter" for="combination_name">Combination Name</label>
                            <input @if (!empty($stream_master)) @foreach ($stream_master as $s_item) value="{{ $s_item->combination_name }}" @endforeach @endif class="form-control uperletter" id="combination_name" name="combination_name" type="text" placeholder="Combination Name" />
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label for="alise_name" class= "uperletter">Alise Name</label>
                            <input @if (!empty($stream_master)) @foreach ($stream_master as $s_item) value="{{ $s_item->alise_name }}" @endforeach @endif class="form-control uperletter" id="alise_name" name="alise_name" type="text" placeholder="Alise Name" />
                        </div>

                        <div class="col-md-3 form-group mb-3">
                            <label for="streams">Stream</label>
                            <select name="streams" class="form-control uperletter" id="streams">
                                <option value="">-- Please select --</option>
                                @if (!empty($stream_master))
                                @foreach ($stream_master as $s_item)
                                {{ $c_stream = $s_item->streams }}
                                @endforeach
                                @endif
                                @foreach ($streamlist as $streamlist)
                                <option {{( (!empty($c_stream)) && ($c_stream==$streamlist->streams)) ? 'selected' :
                                        '' }} value="{{ $streamlist->streams }}">{{ $streamlist->streams }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-3 form-group mb-3">
                            <br>
                            <label for="lastName1">Combination Type:</label><br>
                            {{-- <label class="radio-inline">
                            <input type="radio" name="combination_type" id="combination_type_academic" value="Academic" checked>Academic
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="combination_type" id="combination_type_nonacademic" value="Non Academic">Non Academic
                        </label> --}}

                            @if (!empty($subject_combination_type))
                            <label class="radio-inline">
                                <input type="radio" name="combination_type" id="combination_type_academic" value="Academic" {{ ($subject_combination_type=='Academic') ? 'checked' : '' }}>Academic
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="combination_type" id="combination_type_nonacademic" value="Non Academic" {{ ($subject_combination_type=='Non Academic') ? 'checked' : '' }}>Non Academic
                            </label>
                            @else
                            <label class="radio-inline">
                                <input type="radio" name="combination_type" id="combination_type_academic" value="Academic" checked>Academic
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="combination_type" id="combination_type_nonacademic" value="Non Academic">Non Academic
                            </label>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-md-6">

                                <div class="col-md-12 form-group mb-3">
                                    <h4>Subject in this Combination :-</h4>
                                    <div class="col-md-7 form-group mb-3">
                                        <label for="lastName1">Subjects</label>
                                        <div class="d-flex align-items-center">
                                            <select id="subject_name" class="form-control uperletter" name="subject_name" autocomplete="shipping address-level1" required>
                                                <!-- <option value="">-Select-</option>
                                            <option value="For-Student">PCM</option>
                                            <option value="For-Staff">PCB</option>
                                            <option value="For-Worker">Commerce</option> -->
                                            </select>
                                            <!-- <div class="col-md-2"> -->
                                            {{-- <div class="col-md-3 text-end"> --}}
                                            {{-- <div class="input-group-append"> --}}
                                            <div class="ms-2">
                                                {{-- <button type="button" id="loadSubjectsButton" class="btn btn-primary">V</button> --}}
                                                <button type="button" id="loadSubjectsButton" class="btn btn-primary">
                                                    {{-- ⌄ --}}
                                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                                                      </svg>                                                       --}}
                                                      <svg style="filter: invert(100%);" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z"/></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive col-md-12">
                                    <table class="display table table-striped table-bordered" id="selectedSubjectsTable" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Sr.</th>
                                                <th>Subject</th>
                                                <th class="serial-number"> Subject Order</th>
                                                {{-- <th>IsAdditional</th> --}}
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="selected_subjects">

                                            @if (!empty($selected_subjects_json))
                                            @foreach ($selected_subjects_json as $subject_item)

                                            <tr>
                                                <td>1</td>
                                                <td>{{$subject_item['subject'] }}</td>
                                                <td><input value="{{$subject_item['order'] }}" name="order" class="form-control" type="number" /></td>
                                                {{-- <td><input {{ ($subject_item['IsAdditional']) ? 'checked' : '' }} type="checkbox" id="StudentRelated" name="Visibility" /></td> --}}
                                                <td class='d-flex'>
                                                    <a class="btn btn-raised ripple btn-danger m-1" href="#" onclick="deleteSelectedSubject(event)">Delete</a>
                                                </td>
                                            </tr>

                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>

                                    <div id="subject-error-message" class="text-danger"></div>

                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="col-md-12 form-group mb-3">
                                    <h4>Applicable to these classes :-</h4>
                                    <div class="table-responsive col-md-12">
                                        <table class="display table table-striped table-bordered" id="deafult_ordering_table_wrapper" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>Sr.</th>
                                                    <th>Class Name</th>
                                                    <th>Section</th>

                                                    <th>Action </th>
                                                    <!-- <th>Section</th>
                                    <th>Class Strength</th> -->
                                                </tr>
                                            </thead>
                                            <tbody id="selected_classes">

                                                @if (!empty($selected_classes_json))
                                                @foreach ($selected_classes_json as $class_item)

                                                @endforeach
                                                @endif


                                                @if(!empty($studentclasses))
                                                @foreach($studentclasses as $studentclass)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $studentclass->class_name }}</td>
                                                    <td>
                                                        @if(!empty($studentclass->section_name))
                                                        {{ $studentclass->section_name }}
                                                        @else

                                                        N/A
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" @if (!empty($selected_classes_json)) @foreach ($selected_classes_json as $class_item) @if (($class_item['class']==$studentclass->class_name) && ($class_item['section'] == $studentclass->section_name) )
                                                        checked
                                                        @break
                                                        @endif
                                                        @endforeach
                                                        @endif
                                                        id="id_{{ $studentclass->class_name }}"
                                                        name="class_checkbox" class="class_checkbox" value="{{ $studentclass->class_name }}">
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="4" class="text-center">No Data Found</td>
                                                </tr>
                                                @endif
                                            </tbody>

                                            <!-- <tfoot>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Class Name</th>
                                    <th>Action </th>
                                </tr>
                                </tfoot> -->
                                        </table>

                                        <div id="classes-error-message" class="text-danger"></div>




                                        <div class="col-md-6"><br>
                                            <button type="button" id="submitForm" class="btn btn-primary">Submit</button>
                                            <button type="button" id="reset" class="btn btn-primary" name="btn" value="Reset Form">Reset</button>
                                            @if(request()->route()->getName() !== 'subjectcombinatiomaster')
                                            <a href="{{ url('subjectcombinatiomaster') }}" class="btn btn-primary">Add New</a>
                                        @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </form>
                <br>
        </div>
    </div>
</div>

<!-- <div class="col-md-4"><br>
                    <button type ="submit" class="btn btn-primary">Submit</button>
                </div> -->
<!-- </form><br> -->

</div>
<div class="breadcrumb">
    <h1 class="me-2">list of saved Subject Combination :-</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card text-start">
            <div class="card-body">

                {{-- <div class="col-md-3 form-group mb-3">
                    <label for="lastName1">Class Name</label>
                    <select id="Classname" class="form-control" name="Classname" autocomplete="shipping address-level1"
                        required>
                        <option value="">---Select---</option>
                        <option value="For-Student">PCM</option>
                        <option value="For-Staff">PCB</option>
                        <option value="For-Worker">Commerce</option>
                    </select>
                </div> --}}

                <div class="table-responsive">

                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Sr.</th>
                                <th>Combination Name</th>
                                {{-- <th>Is Academic Comb</th> --}}
                                <th>Alise Name</th>
                                <th>Stream</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($stream))
                            @foreach($stream as $streams)
                            <tr>
                                <td>{{++$i}}</td>
                                <td class= "uperletter">{{$streams->combination_name}}</td>
                                {{-- <td>{{$streams->is_academic_comb}}</td> --}}

                                {{-- <td> --}}
                                {{-- <input type="checkbox" name="is_academic_comb" value="Yes" disabled {{$streams->is_academic_comb == 'Yes' ? 'checked' : ''}}> --}}
                                {{-- </td> --}}
                                <td class= "uperletter">{{$streams->alise_name}}</td>

                                <td class= "uperletter">{{$streams->streams}}</td>

                                <td class='d-flex'>
                                    <a class="btn btn-primary m-1" href="{{ url('view-subjectcombinatiomaster') .'/'.$streams->id}}">Edit</a>
                                    <!-- <form id="deleteForm" method="post" action="{{url('delete-streammaster')}}">                                
                                    @csrf
                                    <input type="hidden" name="table_name" value="streams">
                                    <input type="hidden" name="delete_id" value="{{ $streams->id }}">
                                    <button type="button" class="btn btn-danger m-1" onclick="confirmDelete(event)">Delete</button>
                                </form> -->
                                    <?php $a = "subject_combinations"."-".$streams->id ; ?>
                                    <a class="btn btn-raised ripple btn-danger m-1" href="{{url('delete-subjectcombinatiomaster').'/'.$a}}" onclick="confirmDelete(event)">Delete</a>
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
                        <tfoot>
                            <tr>
                                <th>Sr.</th>
                                <th>Combination Name</th>
                                {{-- <th>Is Academic Comb</th> --}}
                                <th>Alise Name</th>
                                <th>Stream</th>
                                <th>Action</th>
                            </tr>
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
        console.log('confirmDelete function called');
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


    function confirmDeletesub(event) {
        event.preventDefault(); // Prevents the default link navigation
        console.log('confirmDelete function called');
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
    function hasDuplicates(array) {
        return (new Set(array)).size !== array.length;
    }

    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("submitForm").addEventListener("click", function(e) {
            e.preventDefault();

            $("#classes-error-message").html("");
            $("#subject-error-message").html("");

            let selectedSubjectsHtml = document.getElementById("selected_subjects").children;
            let selectedClassesHtml = document.getElementById("selected_classes").children;

            let selectedSubjectData = [];
            let selectedClassesData = [];
            let selectedSubjectDataOrder = [];

            for (var i = 0; i < selectedSubjectsHtml.length; i++) {
                let tr_elm = selectedSubjectsHtml[i];

                let subjObj = {};

                subjObj['subject'] = tr_elm.children[1].innerHTML;
                subjObj['order'] = tr_elm.children[2].children[0].value;
                subjObj['IsAdditional'] = tr_elm.children[3].children[0].checked;

                selectedSubjectData.push(subjObj);
                selectedSubjectDataOrder.push(subjObj['order']);
            }





            for (var i = 0; i < selectedClassesHtml.length; i++) {
                let tr_elm = selectedClassesHtml[i];

                let classObj = {};
                let checked = tr_elm.children[3].children[0].checked;

                classObj['class'] = tr_elm.children[1].innerHTML;
                classObj['section'] = (tr_elm.children[2].innerHTML).trim();

                if (checked) {
                    selectedClassesData.push(classObj);
                }
            }

            // console.log(selectedClassesData);
            // console.log(selectedClassesHtml);

            // console.log(selectedSubjectsHtml);
            // console.log(selectedSubjectData);

            // return ; 

            if (selectedSubjectDataOrder.length < 1) {
                $("#subject-error-message").html("Please select at least one  subject")
                return;
            }
           
            const filterOrder = selectedSubjectDataOrder.filter((item) => (item != ""));

            if (filterOrder.length != selectedSubjectDataOrder.length) {
                $("#subject-error-message").html("Subject's order required.")
                return;
            }

            if (hasDuplicates(selectedSubjectDataOrder)) {
                $("#subject-error-message").html("Subject's have duplicate order.")
                return;
            }



            if (selectedClassesData.length < 1) {
                $("#classes-error-message").html("Please select at least one  class.")
                return;
            }



            
            var formData = new FormData(document.getElementById("subjectCombinationForm"));
            let combination_type_value = document.querySelector('input[name="combination_type"]:checked').value;

            let combination_name = $("#combination_name").val();
            let alise_name = $("#alise_name").val();
            let streams = $("#streams").val();
            let combination_type = combination_type_value;
            let selected_subjects_data = selectedSubjectData;
            let selected_classes_data = selectedClassesData;

            formData.append("selected_subjects_data", JSON.stringify(selected_subjects_data));
            formData.append("selected_classes_data", JSON.stringify(selected_classes_data));

            $.ajax({
                crossDomain: true
                , type: "POST"
                , url: "{{route('store-subjectcombinatiomaster')}}"
                , data: formData
                , processData: false
                , contentType: false
                , success: function(response) {
                    console.log(response)
                    toastr.success("Subject combination  has been updated successfully.", "Success");
                    setTimeout(() => {
                        // location.reload()
                        window.location.href = "{{ route('subjectcombinatiomaster') }}";
                    }, 1500);
                    //   Toast.fire({
                    //     title: response.toString(),
                    //     type: "success"
                    // });    
                }
                , error: function(error) {
                    console.log(error);
                    //   Toast.fire({
                    //     title: error.toString(),
                    //     type: "error"
                    // });     
                }
            });

            // axios.post('{{ route("store-subjectcombinatiomaster") }}', formData)
            //     .then(function (response) {
            //         // Handle success response here
            //         console.log(response.data);
            //         // You can redirect the user or perform other actions as needed
            //     })
            //     .catch(function (error) {
            //         // Handle error response here
            //         if (error.response && error.response.data) {
            //             console.log(error.response.data);
            //             // You can display validation errors to the user here
            //         } else {
            //             console.error(error);
            //         }
            //     });
        });
    });


    //     document.addEventListener("DOMContentLoaded", function () {
    //     // Add an event listener to the button
    //     document.getElementById("loadSubjectsButton").addEventListener("click", function () {
    //         // Perform your action here, such as loading subjects
    //         alert("Button clicked!");
    //     });
    // });

</script>




<script defer>
    // Event listener for the "V" button
    document.getElementById("loadSubjectsButton").addEventListener("click", function() {
        var subjectSelect = document.getElementById("subject_name");
        var selectedSubject = subjectSelect.value;

        if (selectedSubject) {
            // Create a new table row for the selected subject
            var newRow = document.createElement("tr");

            let indexNo = document.getElementById("selected_subjects").children.length + 1;
            // Add columns for the selected subject
            newRow.innerHTML = `
            <td>${indexNo}</td>
            <td>${selectedSubject}</td>
            <td><input name="order" class="form-control" type="number"/></td>

            <td class='d-flex'>
                <a class="btn btn-raised ripple btn-danger m-1" href="#" onclick="deleteSelectedSubject(event)">Delete</a>
            </td>
        `;

            // Append the new row to the table
            document.getElementById("selected_subjects").appendChild(newRow);

            // Clear the selected subject from the dropdown
            subjectSelect.value = "";
        }
    });

    // Function to delete a selected subject row
    function deleteSelectedSubject(event) {
        event.preventDefault();
        event.target.parentElement.parentElement.remove();
    }

    // document.getElementById("loadSubjectsButton").addEventListener("click", function () {
    //     fetch('/fetch-subjects')
    //         .then(response => response.json())
    //         .then(data => {
    //             updateTableWithData(data.subjects);
    //         })
    //         .catch(error => {
    //             console.error('Error fetching subjects:', error);
    //         });
    // });



    function updateTableWithData(subjects) {
        const tableBody = document.getElementById('selected_subjects');
        tableBody.innerHTML = '';

        subjects.forEach((subject, index) => {
            const row = tableBody.insertRow(index);
            const cell1 = row.insertCell(0);
            const cell2 = row.insertCell(1);
            const cell3 = row.insertCell(2);
            const cell4 = row.insertCell(3);
            const cell5 = row.insertCell(4);

            cell1.textContent = index + 1;
            cell2.textContent = subject.subject_name;
            // Add more cells and data if needed
            // For example, you can add input fields for order and checkbox for IsAdditional
            cell3.innerHTML = '<input name="order" class="form-control" type="number"/>';
            cell4.innerHTML = '<input type="checkbox" id="StudentRelated" name="Visibility" />';
            cell5.innerHTML = '<a class="btn btn-raised ripple btn-danger m-1" href="#" onclick="confirmDeletesub(event)">Delete</a>';
        });
    }



    // cell1.innerHTML = index;
    // cell1.classList.add("serial-number"); // Add the CSS class to the cell


    document.addEventListener('DOMContentLoaded', function() {
        $("#reset").on("click", function () {
            $("#combination_name").val("");     
            $("#alise_name").val("");
            $("#streams").val("");
            // $("#combination_type_nonacademic").val("");
            // $("#combination_type_academic").val("");
            $("#streams").val("");     
            $("#selected_subjects").html("");     
            $(".class_checkbox").prop('checked', false);       
                        
        });
    })

</script>




@endsection
