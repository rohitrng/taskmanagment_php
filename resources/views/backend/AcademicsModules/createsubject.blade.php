@extends('backend.layouts.main')
@section('main-container')
<style>
.uperletter{
  text-transform: capitalize;
} 
</style>

<div class="main-content">
    <div class="form_section1_div">
        <div class="breadcrumb">
            <h1 class="me-2">Subject Master :-</h1>
        </div>
        <div class="separator-breadcrumb border-top"></div>
          @if(!empty($subject_s))
                  <form id="progress-form" class="p-4 progress-form" action="{{url('store-subject')}}"  method="post">
                  <input type="hidden" 
              @if(!empty($subject_s))
                  @foreach($subject_s as $subject_)
                  value=" {{ $subject_->id }}"
                  @endforeach
              @else 
                  value=""
              @endif
              name="id"
          >
          @else
              <form id="progress-form" class="p-4 progress-form" action="{{url('save-subject')}}"  method="post">
          @endif
          @csrf
            <div class="row">
                <div class="col-md-3 form-group mb-3">
                    <label for="firstName1">Subject Name:</label>
                    <input required name="subject_name" class="form-control uperletter" id="subject_name" type="text" 
                    value="<?php if(!empty($subject_s)){foreach($subject_s as $subject_){ echo $subject_->subject_name; }}else{}?>"
                    placeholder="Subject_Name" />
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label for="lastName1">Subject Type</label><br>
                    <?php if(!empty($subject_s)){
                            foreach($subject_s as $subject_){
                              // echo"<pre>";print_r($subject_);exit;
                              if($subject_->subject_type != 'Non Academic'){
                                $check_1 = 'checked';
                              } else {
                                $check_2 = 'checked';
                              }
                            }
                          }

                          $check_11 = '<label class="radio-inline">
                          <input type="radio" name="subject_type" value="Academic"';
                          $check_11 .= (!empty($check_1)) ? $check_1 : '' ;
                          $check_11 .=  '> Academic </label>';
                          
                          $check_12 = '<label class="radio-inline">
                          <input type="radio" name="subject_type" value="Non Academic"';
                          $check_12 .= (!empty($check_2)) ? $check_2 : '' ;
                          $check_12 .=  '>  Non Academic </label>';

                          echo $check_11;
                          echo $check_12;

                    ?>
                    
                    <!-- <label class="radio-inline">
                    <input type="radio" name="subject_type" value="Non Academic">Non Academic
                    </label> -->
                </div>                
                <div class="col-md-3 form-group mb-3">
                    <label for="lastName1">Evaluation</label><br>
                    
                    <?php if(!empty($subject_s)){
                            foreach($subject_s as $subject_){
                              if($subject_->evaluation != 'Gradewise'){
                                $echeck_1 = 'checked';
                              } else {
                                $echeck_2 = 'checked';
                              }
                            }
                          }

                          $check_e1 = '<label class="radio-inline">
                          <input type="radio" name="evaluation" value="Digtwise"';
                          $check_e1 .= (!empty($echeck_1)) ? $echeck_1 : '' ;
                          $check_e1 .=  '>Digtwise </label>';
                          
                          $check_e2 = '<label class="radio-inline">
                          <input type="radio" name="evaluation" value="Gradewise"';
                          $check_e2 .= (!empty($echeck_2)) ? $echeck_2 : '' ;
                          $check_e2 .=  '>Gradewise </label>';
                          
                          echo $check_e1;
                          echo $check_e2;

                    ?>
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label for="lastName1">Practical Type</label><br>
                    <input type="checkbox" id="vehicle1"  name="practical" 
                    <?php if(!empty($subject_s[0]['practical'])){
                      echo 'checked';
                    } ?>
                    value="Yes"
                    >
                    <label for="vehicle1"> Yes</label><br>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-primary">Submit</button>
                    <button type="button" id="reset" class="btn btn-primary" name="btn" value="Reset Form">Reset</button>


                    @if(request()->route()->getName() !== 'subjectmaster')
                    <a href="{{ url('subjectmaster') }}" class="btn btn-primary">Add New</a>
                @endif





                </div>
            </div>
        </form><br>
    </div>
    <div class="breadcrumb">
            <h1 class="me-2">List of saved subjects :-</h1>
          </div>
        <div class="separator-breadcrumb border-top"></div>

    <div class="row">
            <div class="col-md-12 mb-4">
              <div class="card text-start">
                <div class="card-body">
                  <!-- <h4 class="card-title mb-3 text-end"><a href="{{url('add-student-registrations')}}"><button class="btn btn-outline-primary" type="button">Create Registration</button></a></h4> -->
                  <div class="table-responsive">
                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width: 100%">
                      <thead>
                        <tr>
                          <th>Sr.</th>
                          <th>Subject Name</th>
                          <th>Subject Type</th>
                          <th>Is Practical Type</th>
                          <th>Evaluation</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody><?php $i=1; ?>
                        @if(!empty($datas))
                        @foreach($datas as $data)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $data->subject_name }}</td>
                            <td>{{ $data->subject_type }}</td>
                            <td>{{ $data->practical }}</td>
                            <td>{{ $data->evaluation }}</td>
                            <td>
                              <a class="btn btn-primary m-1" href="{{ url('view-subject') .'/'.$data->id}}">Edit</a>
                              <!-- <form id="deleteForm" method="post" action="{{url('delete-subject')}}">
                                  @csrf
                                  <input type="hidden" name="table_name" value="natureofwork">
                                  <input type="hidden" name="delete_id" value="{{ $data->id }}">
                                  <button type="submit" class="btn btn-danger " onclick="confirmDelete(event)">Delete</button>
                              </form> -->
                              <?php $a = "subjectmaster"."-".$data->id ; ?>
                                <a class="btn btn-raised ripple btn-danger m-1" href="{{url('delete-subject').'/'.$a}}" onclick="confirmDelete(event)">Delete</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                        @endforeach
                        @endif
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Sr.</th>
                          <th>Subject Name</th>
                          <th>Subject Type</th>
                          <th>Is Practical Type</th>
                          <th>Evaluation</th>
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
        $("#subject_name").val("");     
        $("input[type='checkbox']").prop('checked', false);
        $("input[type='radio']").prop('checked', false);
     
    });

})
</script>
@endsection