@extends('backend.layouts.main')
@section('main-container')
  
<div class="page-content-wrapper ">

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group float-right">
                    <!-- <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Zoogler</a></li>
                        <li class="breadcrumb-item"><a href="#">Forms</a></li>
                        <li class="breadcrumb-item active">Form Advanced</li>
                    </ol> -->
                </div>
                <h4 class="page-title">Add Candidate</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body bootstrap-select-1">
                    <h4 class="mt-0 header-title">Add Selected Resume</h4>
                    <!-- <p class="text-muted mb-4 font-13">Simple jQuery Based Color and Gradient Picker - asColorPicker. </p> -->
                    <form method="post" action="{{url('save_resume_inq')}}" enctype="multipart/form-data">
                    <div class="row">
                      @csrf
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-0">Candidate Name</h6>                                            
                            <input type="text" name="candidate_name" class="form-control" value="" /> 
                        </div>                                    
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Candidate Mobile</h6>                                            
                            <input type="text" name="candidate_mobile" class="form-control" value="" />
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Candidate Profile</h6>                                           
                            <select name="c_profile" class="form-control">
                                <option value="">Select Profile</option>
                                <option value="Android Developer">Android Developer</option>
                                <option value="Digital Marketing">Digital Marketing</option>
                                <option value="Sales Marketing">Sales Marketing</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Candidate Email</h6>                                           
                            <input type="text" name="candidate_email" class="form-control" value="" /> 
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Candidate Resume</h6>                                           
                            <input type="file" name="candidate_resume" class="form-control" value="" /> 
                        </div>

                        <div class="col-md-4 form-group mb-0">    
                        <h6 class=" input-title mb-2 mt-2 mt-lg-0"></h6>        
                          <button type="submit" class="btn btn-primary waves-effect waves-light">
                            Submit
                          </button>  
                        </div>
                    </div>
                    </form>
                </div>
            </div>                                
        </div> <!-- end col -->
    </div> <!-- end row --> 

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
            </div>                                        
        </div> <!-- end col -->
    </div> <!-- end row --> 
   

</div><!-- container -->

</div> <!-- Page content Wrapper -->


@endsection 
