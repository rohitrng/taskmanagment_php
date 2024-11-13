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
                            <h6>{{ $datas->job_title_position }}</h6>
                        </div>                                    
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Date of Joining</h6>                                            
                            <h6>{{ $datas->date_of_joining }}</h6>
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Department/Team</h6>                                           
                            <h6>{{ $datas->department_team }}</h6>
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Employee ID (assigned by the organization)</h6>                                           
                            <h6>RNG{{ $datas->employee_id }}</h6>
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Manager's Name</h6>                                           
                            <h6>{{ $datas->managers_name }}</h6>
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Office Location</h6>     
                            <h6>{{ $datas->office_location }}</h6>
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Employee Type (full-time, part-time, contractor)</h6>                                           
                            <h6>{{ $datas->employee_type }}</h6>
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Candidate Resume</h6>                                           
                            <h6>
                                @if (!empty($datas->candidate_resume))
                                    <a href="{{ asset($datas->candidate_resume) }}" target="_blank">View</a>
                                @else
                                    #
                                @endif
                            </h6>
                        </div>
                    </div>
                    <div class="line"></div>
                    <h4 class="mt-0 header-title">Previous Employment Details (if applicable):</h4>
                    <!-- <p class="text-muted mb-4 font-13">Simple jQuery Based Color and Gradient Picker - asColorPicker. </p> -->                    
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-0">Last Employer Name</h6>                                            
                            <h6>{{ $datas->last_employer_name }}</h6>
                        </div>                                    
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Last Job Title</h6>                                           
                            <h6>{{ $datas->last_job_title }}</h6>
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Total Experience (in years/months)</h6>                                           
                            <h6>{{ $datas->total_experience }}</h6>
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Last CTC (Cost to Company)</h6>                                           
                            <h6>{{ $datas->last_ctc }}</h6>
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Experience Letter (from previous employer, if applicable)</h6>                                           
                            <h6>
                                @if (!empty($datas->experience_letter))
                                    <a href="{{ asset($datas->experience_letter) }}" target="_blank">View</a>
                                @else
                                    #
                                @endif
                            </h6>
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Relieving Letter (from the previous employer, if applicable)</h6>                                           
                            <h6>
                                @if (!empty($datas->relieving_letter))
                                    <a href="{{ asset($datas->relieving_letter) }}" target="_blank">View</a>
                                @else
                                    #
                                @endif
                            </h6>
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Pay Slips (last 3 months, if applicable)</h6>                                           
                            <h6>
                                @if (!empty($datas->pay_slips))
                                    <a href="{{ asset($datas->pay_slips) }}" target="_blank">View</a>
                                @else
                                    #
                                @endif
                            </h6>
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Offer Letter (from the previous employer for reference)</h6>                                           
                            <h6>
                                @if (!empty($datas->offer_letter))
                                    <a href="{{ asset($datas->offer_letter) }}" target="_blank">View</a>
                                @else
                                    #
                                @endif
                            </h6>
                        </div>
                    </div>
                    <div class="line"></div>
                    <h4 class="mt-0 header-title">Personal Information:</h4>
                    <!-- <p class="text-muted mb-4 font-13">Simple jQuery Based Color and Gradient Picker - asColorPicker. </p> -->                    
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-0">Full Name (as per official documents)</h6>                                            
                            <h6>{{ $datas->full_name }}</h6> 
                        </div>                                    
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Date of Birth</h6>                                            
                            <h6>{{ $datas->date_of_birth }}</h6>
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Gender</h6>                                           
                            <h6>{{ $datas->gender }}</h6>
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Contact Number</h6>                                           
                            <h6>{{ $datas->contact_number }}</h6> 
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Email Address</h6>                                           
                            <h6>{{ $datas->email_address }}</h6> 
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Permanent Address</h6>                                           
                            <h6>{{ $datas->permanent_address }}</h6> 
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Current Address (if different from permanent)</h6>                                           
                            <h6>{{ $datas->current_address }}</h6> 
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Aadhar Card</h6> 
                            <h6>
                                @if (!empty($datas->aadhar_card))
                                    <a href="{{ asset($datas->aadhar_card) }}" target="_blank">View</a>
                                @else
                                    #
                                @endif
                            </h6>
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">PAN Card</h6>                                           
                            <h6>
                                @if (!empty($datas->pan_card))
                                    <a href="{{ asset($datas->pan_card) }}" target="_blank">View</a>
                                @else
                                    #
                                @endif
                            </h6>
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Degree Certificates (Bachelor's, Master's, or any relevant qualifications)</h6>                                           
                            <h6>
                                @if (!empty($datas->degree_certificates))
                                    <a href="{{ asset($datas->degree_certificates) }}" target="_blank">View</a>
                                @else
                                    #
                                @endif
                            </h6>
                        </div>
                        <div class="col-md-6 form-group">
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0">Passport-sized Photographs (usually 1 copie)</h6>                                           
                            <h6>
                                @if (!empty($datas->passport_sized_photographs))
                                    <a href="{{ asset($datas->passport_sized_photographs) }}" target="_blank">View</a>
                                @else
                                    #
                                @endif
                            </h6>
                        </div>
                    </div>
                    <!-- <div class="line"></div>
                        <div class="col-md-4 form-group mb-0">    
                            <h6 class=" input-title mb-2 mt-2 mt-lg-0"></h6>        
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                Submit
                            </button>  
                        </div> -->
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
