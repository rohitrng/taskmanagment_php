@extends('backend.layouts.main')
@section('main-container')

<style>
.uperletter{
  text-transform: capitalize;
} 
</style>
<style>
  
    th.action-checkbox-header {
        position: relative;
    }

    th.action-checkbox-header input {
        position: absolute;
        left: 60px; /* Adjust the amount of space as needed */
    }
</style>
@php
                      $i = 0;
                    @endphp
<div class="main-content pt-4">
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
<div class="col-md-12 form-group mb-3">
    <div class="form_section1_div">
        <div class="breadcrumb">
            <h1 class="me-2">Exam Master</h1>
        </div>

      
                  @if(!empty($exam_master))
                  <!-- </?php echo  "testing"; ?> -->
                  <!-- <form id="progress-form" class="p-4 progress-form" action="{{url('store-exammaster')}}"  novalidate method="post"> -->
                  <form id="progress-form" class="p-4 progress-form" onsubmit="update_exammaster(event)" >
                  <input type="hidden" id="id"
                    @if(!empty($exam_master))
                      @foreach($exam_master as $exam_masters)
                        value=" {{ $exam_masters->id }}"
                      @endforeach
                    @else
                      value=""
                    @endif
                    name="id"
                  >

                  @else
                  <!-- <form id="progress-form" class="p-4 progress-form" action="{{url('save-exammaster')}}"  novalidate method="post"> -->
                  <form id="progress-form" class="p-4 progress-form" onsubmit="create_exammaster(event)" >
                  @endif
    
        @csrf
            <div class="row">
                {{-- <div class="col-md-3 form-group mb-3">
                        <label for="exam_name">Exam Name </label>
                        <input
                          class="form-control uperletter"
                          id="exam_name"
                          name="exam_name"
                          type="text"
                          @if(!empty($exam_master))
                            @foreach($exam_master as $exammaster)
                              value=" {{ $exammaster->exam_name }}"
                            @endforeach
                          @else
                            value=""
                          @endif
                          placeholder="ExamName"
                        />
                      </div> --}}
                               

                      <div class="col-md-3 form-group mb-3">
                        <label for="exam_name">Exam Name </label>
                        <input
                          class="form-control uperletter"
                          id="exam_name"
                          name="exam_name"
                          type="text"
                          @if(!empty($exam_master))
                            @foreach($exam_master as $exammaster)
                              value=" {{ $exammaster->exam_name }}"
                            @endforeach
                          @else
                            value=""
                          @endif
                          placeholder="Exam Name "
                        />
                      </div>



                      <div class="col-md-3 form-group mb-3">
                        <label for="max_marks_theory">Max Marks(Theory) </label>
                        <input
                          class="form-control"
                          id="max_marks_theory"
                          name="max_marks_theory"
                          type="text"
                          @if(!empty($exam_master))
                            @foreach($exam_master as $exammaster)
                              value=" {{ $exammaster->max_marks_theory }}"
                            @endforeach
                          @else
                            value=""
                          @endif
                          placeholder="Max Marks(Theory)"
                        />
                      </div>

                      <div class="col-md-3 form-group mb-3">
                        <label for="max_marks_practical">Max Marks(Practical) </label>
                        <input
                          class="form-control"
                          id="max_marks_practical"
                          name="max_marks_practical"
                          type="text"
                          @if(!empty($exam_master))
                            @foreach($exam_master as $exammaster)
                              value=" {{ $exammaster->max_marks_practical }}"
                            @endforeach
                          @else
                            value=""
                          @endif
                          placeholder="Max Marks(Practical)"
                        />
                      </div>
           
                      <div class="col-md-3 form-group mb-3">
                        <label for="fail_if">Fail if % <=  </label>
                        <input
                          class="form-control"
                          id="fail_if"
                          name="fail_if"
                          type="text"
                          @if(!empty($exam_master))
                            @foreach($exam_master as $exammaster)
                              value=" {{ $exammaster->fail_if }}"
                            @endforeach
                          @else
                            value=""
                          @endif
                          placeholder="fail %"
                        />
                      </div>
                               
  
                {{-- <div class="col-md-3 form-group mb-3">
                <label for="lastName1">Exam type</label>
                    <select name="exam_type" class="form-control" id="exam_type">
                          @if(!empty($exam_master))
                          <option value="Weakly Test" {{($exam_master[sizeof($exam_master)-1]->exam_type == 'Weakly Test' ? 'selected' : '')}}>Weakly Test</option>
                          <option value="Term 1" {{($exam_master[sizeof($exam_master)-1]->exam_type == 'Term 1' ? 'selected' : '')}}>Term 1</option>
                          <option value="Term 2" {{($exam_master[sizeof($exam_master)-1]->exam_type == 'Term 2' ? 'selected' : '')}}>Term 2</option>
                          <option value="Half Yearly" {{($exam_master[sizeof($exam_master)-1]->exam_type == 'Half Yearly' ? 'selected' : '')}}>Half Yearly</option>
                          <option value="Pre-Board" {{($exam_master[sizeof($exam_master)-1]->exam_type == 'Pre-Board' ? 'selected' : '')}}>Pre-Board</option>
                          <option value="fromative Test 1" {{($exam_master[sizeof($exam_master)-1]->exam_type == 'fromative Test 1' ? 'selected' : '')}}>fromative Test 1</option>
                          <option value="fromative Test 2" {{($exam_master[sizeof($exam_master)-1]->exam_type == 'fromative Test 2' ? 'selected' : '')}}>fromative Test 2</option>
                          <option value="Annual" {{($exam_master[sizeof($exam_master)-1]->exam_type == 'Annual' ? 'selected' : '')}}>Annual</option>                            
                          @else                                                      
                          <option value="" selected> -- Please select -- </option>
                          <option value="Weakly Test" >Weakly Test</option>
                          <option value="Term 1" >Term 1</option>
                          <option value="Term 2" >Term 2</option>
                          <option value="Half Yearly" >Half Yearly</option>
                          <option value="Pre-Board" >Pre-Board</option>
                          <option value="fromative Test 1" >fromative Test 1</option>
                          <option value="fromative Test 2">fromative Test 2</option>
                          <option value="Annual" >Annual</option>                            
                          @endif                          
                    </select> 
                </div> --}}

                <div class="col-md-3 form-group mb-3">
                  <label for="exam_type">Exam Type</label>
                  <select name="exam_type" class="form-control" id="exam_type">
                      <option value="">-- Please select --</option>
                      
                      @foreach ($examtypelist as $examtypelist)
                      <option {{( (!empty($exam_master)) && ($exam_master[0]->exam_type==$examtypelist->examtype)) ? 'selected' :
                              '' }} value="{{ $examtypelist->examtype }}">{{ $examtypelist->examtype }}</option>
                      @endforeach
                  </select>
              </div>

                <div class="col-md-3 form-group mb-3">
                        <label for="remarks">Remarks  </label>
                        <input
                          class="form-control uperletter"
                          id="remarks"
                          name="remarks"
                          type="text"
                          @if(!empty($exam_master))
                            @foreach($exam_master as $exammaster)
                              {{-- value=" {{ $exammaster->remarks }}" --}}
                              value="{{ !empty($exam_master) ? $exam_master[0]->remarks : '' }}"

                            @endforeach
                          @else
                            value=""
                          @endif
                          placeholder="Remark"
                        />
                      </div>

                {{-- <div class="col-md-3 form-group mb-3">
                <br>
                        <label for="is_ser">IsSER </label>
                        <input                          
                          id="is_ser"
                          name="is_ser"
                          type="checkbox"                     
                          @if(!empty($exam_master))
                            @foreach($exam_master as $exammaster)
                            {{($exammaster->is_ser=='true') ? 'checked' : ''}}                            
                            @endforeach
                          @else                          
                          @endif
                          placeholder="fail %"
                        />
                      </div>
            --}}

                      
                <div class="col-md-42">
                    <button class="btn btn-primary"type="submit">Submit</button>
                    {{-- <button type="reset" class="btn btn-primary" name="btn" value="Reset Form">Reset</button> --}}
                    {{-- <button type="button" id="reset" class="btn btn-primary" onclick="resetForm()">Reset</button> --}}
                    <button type="button" id="reset" class="btn btn-primary" name="btn" value="Reset Form">Reset</button>

                    @if(request()->route()->getName() !== 'exammaster')
                    <a href="{{ url('exammaster') }}" class="btn btn-primary">Add New</a>
                @endif
                </div>
            </div>
    </div>
</div>
</div>


<div class="row">
<br>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="breadcrumb">
                <h1 class="me-2">List of Saved Exam Name :-</h1>
            </div>
            <div class="separator-breadcrumb border-top"></div>

            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="card text-start">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-striped table-bordered" id="deafult_ordering_table_wrapper" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Exam Name</th>
                                    <th>Action </th>
                                    <!-- <th>Section</th>
                                    <th>Class Strength</th> -->
                                </tr>
                                </thead>
                                <tbody>

                                
                        @if(!empty($exammasters))
                        @foreach($exammasters as $exammaster)
                        {{-- </?php   print_r($exammaster); die(); ?> --}}
                        <tr>
                        <td>{{++$i}}</td>
                          <td class= "uperletter">{{$exammaster->exam_name}}</td>                                            
                          <td class='d-flex'>
                          
                              <a class="btn btn-primary m-1" href="{{ url('view-exammaster') .'/'.$exammaster->id}}">Edit</a>
                                <!-- <form id="deleteForm" method="post" action="{{url('delete-exammaster')}}">                                
                                    @csrf
                                    <input type="hidden" name="table_name" value="exammasters">
                                    <input type="hidden" name="delete_id" value="{{ $exammaster->id }}">
                                    <button type="submit" class="btn btn-danger m-1" onclick="confirmDelete(event)">Delete</button>
                                </form> -->
                                <?php $a = "exammasters"."-".$exammaster->id ; ?>
                                <a class="btn btn-raised ripple btn-danger m-1" href="{{url('delete-exammaster').'/'.$a}}" onclick="confirmDelete(event)">Delete</a>
                            
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







        <div class="col-md-6 mb-4">
            <div class="breadcrumb">
                <h1 class="me-2">Applicable to these Classes :-</h1>
            </div>
            <div class="separator-breadcrumb border-top"></div>
          
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="card text-start">
                    <div class="card-body">                      
                        <div class="table-responsive">
                          <div id="classes_error" class="text-danger"></div>
                        <table class="display table table-striped table-bordered" id="deafult_ordering_table_wrapper" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Class Name</th>
                                    <th class="action-checkbox-header">Action <input type="checkbox" class="class_checkbox_header"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($studentclasses))
                        @foreach($studentclasses as $studentclasses)
                        <tr>
                          <td>{{++$i}}</td>
                          <td>{{$studentclasses->class_name}}</td>  
                          {{-- <td>{{$studentclasses->exam_name}}</td>                                             --}}
                          <!-- <td><input type="checkbox" id="id_{{$studentclasses->class_name}}" name="class_checkbox" value="{{$studentclasses->class_name}}"></td> -->                          
                          <td><input type="checkbox" class="class_checkbox"
                            @if(!empty($exam_master))                                                                               
                              @if(in_array($studentclasses->class_name, $exam_master[count($exam_master)-1]->class_name))
                              checked
                              @endif 
                            @endif
                            id="id_{{$studentclasses->class_name}}" name="class_checkbox" value="{{$studentclasses->class_name}}">
                          </td>
                            
                          </tr>
                        <!-- </?php $i++; ?> -->
                        @endforeach
                        @else
                        <tr><td colspan="9" class="text-center">No Data Found</td></tr>
                        @endif           
                                    <!-- <tr>
                                        <td>1</td>
                                        <td>9th</td>
                                        <td><input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"><br></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>10th</td>
                                        <td><input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"></td>
                                    </tr> -->
                                </tbody>
                                <!-- <tfoot>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Class Name</th>
                                    <th>Action </th>
                                </tr>
                                </tfoot> -->
                            </table>

                            <div id="error-message" class="text-danger"></div>

                        </div>
                    </div>
                    </div>
                </div>
                
                </form>
            </div>
        </div>
    </div>
</div>
    <!-- end of main-content -->
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $(document).ready(function () {
        // Handle the "Action" checkbox change event
        $('.class_checkbox_header').change(function () {
            // Get the state of the "Action" checkbox
            var isChecked = $(this).prop('checked');

            // Set the state of all checkboxes in the column based on the "Action" checkbox
            $('.class_checkbox').prop('checked', isChecked);
        });
    });
</script>

<script>
  function resetForm() {
      // Get the input field by its ID
      var inputField = document.getElementById('remarks');
      // Set the value of the input field to an empty string
      if (inputField) {
          inputField.value = '';
      }
  }
</script>



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

    function create_exammaster(e){
                e.preventDefault();      
                $("#classes_error").html("");
                const _token = document.getElementsByName("_token")[0].value;

                let classes = [];
                $("input:checkbox[name=class_checkbox]:checked").each(function(){
                  classes.push($(this).val());
                });

                if(classes.length<1){
                  $("#classes_error").html("Please select at least one class.")
                  return
                }

                let classes_names = classes.join(",");                               

                var formData = new FormData()
                formData.append('_token', _token);                
                formData.append('exam_name', $('#exam_name').val());
                formData.append('max_marks_theory', $('#max_marks_theory').val());
                formData.append('max_marks_practical', $('#max_marks_practical').val());
                formData.append('fail_if', $('#fail_if').val());                
                formData.append('exam_type', $('#exam_type').val());
                
                formData.append('remarks', $('#remarks').val());                
                formData.append('is_ser', $('#is_ser').is(":checked"));
                formData.append('class_name', classes_names);
                // alert(formData);
                // formData.append('file', $('#file_path').prop('files')[0])
                $.ajax({
                   // url: "/lvn-school/public/save-exammaster",
                  //  {{url('save-exammaster')}},
                  url: "{{url('save-exammaster')}}",
                    type: "POST",
                    // dataType: "json",
                    data: formData,                    
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                      console.log(response);
                      toastr.success("exammaster has been created successfully.", "Success");                     
                      // toastr.error("exammaster has been created successfully.", "Success");                     
                      setTimeout(() => {
                        // location.reload()
                        window.location.href = "{{ route('exammaster') }}";

                      }, 1500);
                    }
                });
            }
    



    function update_exammaster(e){

                e.preventDefault();      
                $("#classes_error").html("")
                const _token = document.getElementsByName("_token")[0].value;

                let classes = [];
                $("input:checkbox[name=class_checkbox]:checked").each(function(){
                  classes.push($(this).val());
                });

                if(classes.length<1){
                  $("#classes_error").html("Please select at least one class.")
                  return
                }

                let classes_names = classes.join(",");                               

                var formData = new FormData()
                formData.append('id', $('#id').val());
                formData.append('_token', _token);                
                formData.append('exam_name', $('#exam_name').val());
                console.log($('#exam_name :selected').val());
                formData.append('max_marks_theory', $('#max_marks_theory').val());
                formData.append('max_marks_practical', $('#max_marks_practical').val());
                formData.append('fail_if', $('#fail_if').val());                
                formData.append('exam_type', $('#exam_type').val());
                formData.append('remarks', $('#remarks').val());                
                formData.append('is_ser', $('#is_ser').is(":checked"));
                formData.append('class_name', classes_names);
                // formData.append('file', $('#file_path').prop('files')[0])
                $.ajax({
                    // url: "/lvn-school/public/store-exammaster",
                    url: "{{url('store-exammaster')}}",
                    type: "POST",
                    // dataType: "json",
                    data: formData,                    
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                      console.log(response);
                      toastr.success("exammaster has been updated successfully.", "Success");
                      setTimeout(() => {
                        location.reload()
                      }, 1500);                      
                    }
                });
            }
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
      var select = document.getElementById('exam_type');
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
            $("#exam_name").val("");     
            $("#max_marks_theory").val("");     
            $("#max_marks_practical").val(""); 
            $("#fail_if").val(""); 
            $("#exam_type").val(""); 
            $("#remarks").val("");    
            $(".class_checkbox").prop('checked', false);                  
        });
    })


</script>

{{-- <script>
  document.addEventListener('DOMContentLoaded', function () {
      var select = document.getElementById('examtype');
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
</script> --}}


@endsection