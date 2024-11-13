@extends('backend.layouts.main')
@section('main-container')
<style> .line { width: 100%; height: 2px; background-color: black; margin: 10px 0; } </style>
<div class="page-content-wrapper ">

<div class="container-fluid">
    <!-- we can add below title if we need -->
<!-- Bank & Tax Information:
Bank Account Number
Bank Name and Branch
IFSC Code (India-specific, or equivalent international code)
Tax Identification Number (TIN) or PAN (for India)
Benefits/Insurance Information:
Health Insurance Provider (if applicable)
Policy Number (if applicable)
Nominee for Provident Fund/Gratuity (spouse, parents, etc.)
Compliance & Legal Information:
Background Check Consent (yes/no)
Non-disclosure Agreement (NDA) (signed copy)
Employment Agreement (signed copy)
Code of Conduct Acknowledgment (yes/no) -->

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
                <h4 class="page-title">Candidate Onboarding</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body bootstrap-select-1">
                <form method="post" action="{{url('save_candidate_details')}}" enctype="multipart/form-data">
                    @csrf
                    <h4 class="mt-0 header-title">Employment Information:</h4>
                    <!-- <p class="text-muted mb-4 font-13">Simple jQuery Based Color and Gradient Picker - asColorPicker. </p> -->                    
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-0">Job Title/Position</h6>                                            
                            <input type="text" name="job_title_position" class="form-control" value="" /> 
                        </div>                                    
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Date of Joining</h6>                                            
                            <input type="date" name="date_of_joining" class="form-control" value="" />
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Department/Team</h6>                                           
                            <select name="department_team" class="form-control">
                                <option value="">Select Department/Team</option>
                                <option value="Android">Android</option>
                                <option value="Digital Marketing">Digital Marketing</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Employee ID (assigned by the organization)</h6>                                           
                            <input type="text" name="employee_id" readonly class="form-control" value="{{ $newId }}" /> 
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Manager's Name</h6>                                           
                            <input type="text" name="managers_name" class="form-control" value="" /> 
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Office Location</h6>     
                            <select name="office_location" class="form-control">
                                <option value="">Select Office Location</option>
                                <option value="Remote">Remote</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Employee Type (full-time, part-time, contractor)</h6>                                           
                            <select name="employee_type" class="form-control">
                                <option value="">Select Employee Type</option>
                                <option value="full-time">full-time</option>
                                <option value="part-time">part-time</option>
                                <option value="contractor">contractor</option>
                            </select> 
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Candidate Resume</h6>                                           
                            <input type="file" name="candidate_resume" class="form-control" value="" /> 
                        </div>
                    </div>
                    <div class="line"></div>
                    <h4 class="mt-0 header-title">Previous Employment Details (if applicable):</h4>
                    <!-- <p class="text-muted mb-4 font-13">Simple jQuery Based Color and Gradient Picker - asColorPicker. </p> -->                    
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-0">Last Employer Name</h6>                                            
                            <input type="text" name="last_employer_name" class="form-control" value="" /> 
                        </div>                                    
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Last Job Title</h6>                                           
                            <input type="text" name="last_job_title" class="form-control" value="" /> 
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Total Experience (in years/months)</h6>                                           
                            <input type="text" name="total_experience" placeholder="2.5" class="form-control" /> 
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Last CTC (Cost to Company)</h6>                                           
                            <input type="text" name="last_ctc" class="form-control" value="" /> 
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Experience Letter (from previous employer, if applicable)</h6>                                           
                            <input type="file" name="experience_letter" class="form-control" value="" /> 
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Relieving Letter (from the previous employer, if applicable)</h6>                                           
                            <input type="file" name="relieving_letter" class="form-control" value="" /> 
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Pay Slips (last 3 months, if applicable)</h6>                                           
                            <input type="file" name="pay_slips" class="form-control" value="" /> 
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Offer Letter (from the previous employer for reference)</h6>                                           
                            <input type="file" name="offer_letter" class="form-control" value="" /> 
                        </div>
                    </div>
                    <div class="line"></div>
                    <h4 class="mt-0 header-title">Personal Information:</h4>
                    <!-- <p class="text-muted mb-4 font-13">Simple jQuery Based Color and Gradient Picker - asColorPicker. </p> -->                    
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-0">Full Name (as per official documents)</h6>                                            
                            <input type="text" name="full_name" class="form-control" value="" /> 
                        </div>                                    
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Date of Birth</h6>                                            
                            <input type="date" name="date_of_birth" class="form-control" value="" />
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Gender</h6>                                           
                            <select name="gender" class="form-control">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Contact Number</h6>                                           
                            <input type="text" name="contact_number" class="form-control" value="" /> 
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Email Address</h6>                                           
                            <input type="text" name="email_address" class="form-control" value="" /> 
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Permanent Address</h6>                                           
                            <input type="text" name="permanent_address" class="form-control" value="" /> 
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Current Address (if different from permanent)</h6>                                           
                            <input type="text" name="current_address" class="form-control" value="" /> 
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Aadhar Card</h6>                                           
                            <input type="file" name="aadhar_card" class="form-control" value="" /> 
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">PAN Card</h6>                                           
                            <input type="file" name="pan_card" class="form-control" value="" /> 
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Degree Certificates (Bachelor's, Master's, or any relevant qualifications)</h6>                                           
                            <input type="file" name="degree_certificates" class="form-control" value="" /> 
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Passport-sized Photographs (usually 1 copie)</h6>                                           
                            <input type="file" name="passport_sized_photographs" class="form-control" value="" /> 
                        </div>
                    </div>
                    <div class="line"></div>
                        <div class="col-md-4 form-group mb-0">    
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0"></h6>        
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                Submit
                            </button>  
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
