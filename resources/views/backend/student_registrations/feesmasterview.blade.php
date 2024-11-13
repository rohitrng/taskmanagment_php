@extends('backend.layouts.main')
@section('main-container')
<style>

.uperletter{
  text-transform: capitalize;
}  

</style>


<!-- <link rel="stylesheet" href="your-styles.css"> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="main-content pt-4">
    <!-- <h2>hyy</h2> -->
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="breadcrumb">
        <h2>Fees Master Information</h2>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <!-- student information -->
        <section class="ul-product-detail">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <a href="{{url('student-registrations')}}"><button style="float:right" class="btn btn-primary" type="button">Registration List</button></a>
                                <div class="separator-breadcrumb"></div>
                                @if(!empty($all_inquiry))
                                <?php $i = 1; ?>
                                @foreach($all_inquiry as $each_inq)
                                <?php $notificationData1 = json_decode($each_inq->json_str, true); ?>
                                <div class="col-lg-3">
                                    <!-- <div class="ul-product-detail__image"><img src="{{url('assets/frontend/')}}/images/logo.png" alt="" /></div> -->
                                    <div class="card-body text-center">
                                        <div class="avatar box-shadow-2 mb-3" style="border-radius:50%;"><img src="{{url('assets/backend/')}}/images/student.png" alt="" /></div>
                                        <h5 class="m-0 uperletter "><?php if (!empty($notificationData1['studentname_prefix'])) {
                                                            echo $notificationData1['studentname_prefix'] . ' ';
                                                        } ?>{{$each_inq->student_name}}</h5>
                                        <p class="mt-0">Class - {{$each_inq->class_name}}</p>
                                        <!-- <button class="btn btn-primary btn-rounded">Contact Jassica</button> -->
                                        <div class="card-socials-simple mt-4">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <!-- <th scope="row">2</th> -->
                                                            <th><b>Scholar Number</b> </th>
                                                            <td><b><?php if (!empty($each_inq->scholar_no)) {
                                                                        echo $each_inq->scholar_no;
                                                                    } ?></b></td>
                                                        </tr>
                                                        <tr>
                                                            <!-- <th scope="row">2</th> -->
                                                            <th>Name </th>
                                                            <!-- <td><img class="rounded-circle m-0 avatar-sm-table" src="../../dist-assets/images/faces/1.jpg" alt="" /></td> -->
                                                            <td class= "uperletter">{{$each_inq->student_name}}</td>
                                                        </tr>

                                                        <tr>
                                                            <!-- <th scope="row">2</th> -->
                                                            <th>Class </th>
                                                            <!-- <td><img class="rounded-circle m-0 avatar-sm-table" src="../../dist-assets/images/faces/1.jpg" alt="" /></td> -->
                                                            <td>{{$each_inq->class_name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <!-- <th scope="row">2</th> -->
                                                            <th>Session </th>
                                                            <td>{{$each_inq->session_name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <!-- <th scope="row">2</th> -->
                                                            <th>Form No. </th>
                                                            <!-- <td><img class="rounded-circle m-0 avatar-sm-table" src="../../dist-assets/images/faces/1.jpg" alt="" /></td> -->
                                                            <td>{{$each_inq->form_number}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9">

                                                    
                                    <div class="card text-left">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title mb-3">Student Information</h4>
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="home-basic-tab" data-bs-toggle="tab" href="#homeBasic" role="tab" aria-controls="homeBasic" aria-selected="true">Fees Details</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="contact-basic-tab" data-bs-toggle="tab" href="#contactBasic" role="tab" aria-controls="contactBasic" aria-selected="false">Others Information</a>
                                                    </li>
                                                     <li class="nav-item">
                                                        <a class="nav-link" id="profile-basic-tab" data-bs-toggle="tab" href="#profileBasic" role="tab" aria-controls="profileBasic" aria-selected="false">Siblings Details</a>
                                                    </li>
                                                    <!--<li class="nav-item">
                                                        <a class="nav-link" id="upload-documents" data-bs-toggle="tab" href="#uploadDocument" role="tab" aria-controls="uploadDocument" aria-selected="false">Upload Documents</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="fees-Details" data-bs-toggle="tab" href="#feesDetails" role="tab" aria-controls="feesDetails" aria-selected="false">Fees Details</a>
                                                    </li> -->
                                                </ul>
                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade show active" id="homeBasic" role="tabpanel" aria-labelledby="home-basic-tab">
                                                    <button class="btn btn-primary mb-2" type="button" data-bs-toggle="modal" data-target=".addNewStructure" >Add Next Year Fees</button>
                                                    <br><br>
                                                    <?php
                                                        if (!empty($Vehicallist[0])) { ?>
                                                            <!-- <h1>Generate chart for this student </h1> -->
                                                            <!-- start section -->
                                                            <div class="main-content">
                                                                <!-- ============ Body content start ============= -->
                                                                <div class="main-content">
                                                                    <!-- <div class="separator-breadcrumb border-top"></div> -->
                                                                    <div class="row">
                                                                        <div class="separator-breadcrumb border-top"></div>
                                                                        <form id="progress-form" class="p-4 progress-form" action="{{ url('edit-student-fees-structure-master') }}" novalidate method="post">
                                                                            @csrf
                                                                            <div class="row">

                                                                                <?php 
                                                                                $feesstr = json_decode($Vehicallist[0]->json_str, true);
                                                                                $de =  json_decode($feesstr[0]['json_str']);
                                                                                $jsonData = json_encode($de);
                                                                                // print_r($jsonData);exit;
                                                                                if (isset($notificationData1['required_school_transport'])) {
                                                                                    $busValue = $notificationData1['required_school_transport'];
                                                                                }
                                                                                // $busValue = $notificationData1['required_school_transport'];
                                                                                // $showBusFacility = isset($notificationData1['required_school_trasnport']) && $notificationData1['required_school_trasnport'] == 1;
                                                                                // $position = array_search('required_school_trasnport', array_keys($notificationData1));
                                                                                //  $checkubsdata = json_decode($checkBus[0]->json_str, true);

                                                                                //    print_r($notificationData1);
                                                                                // exit;
                                                                                ?>
                                                                                <input type="hidden" name="stid" value="{{$Vehicallist[0]->student_id}}">
                                                                                <input type="hidden" name="id" value="{{$Vehicallist[0]->id}}">
                                                                                <input type="hidden" name="fulldata" value="{{$Vehicallist}}">




                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="col-md-8">
                                                                                        <button type="button" id="addRowButton" class="btn btn-success">Add Row</button>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <input type="checkbox" id="busFacility" name="is_bus_facility" <?php if (!empty($notificationData1['required_school_transport'])) {
                                                                                                                                                            echo "checked";
                                                                                                                                                        } ?>>
                                                                                        <span>
                                                                                            <label class="form__choice-wrapper">
                                                                                                <label class="form-label text-primary" id="busFacility"  for="form1">Bus Facility</label>
                                                                                            </label>
                                                                                        </span>
                                                                                        <span>
                                                                                                   <!-- Your Button -->
    <button id="openModalButton" onclick="form_p('{{ $stor_dat['id'] }}', '{{ $stor_dat['student_check_value'] }}','{{ $stor_dat['stu_driver'] }}');" class="btn btn-raised ripple btn-raised-primary m-1" <?php echo $stor_dat['pickup_bool_s']; ?>>select pickup</button>


                                                                                        </span>
                                                                                        <span>
                                                                                        <div id="feesAmountContainer" style="display: <?php echo (!empty($notificationData1['required_school_transport'])) ? 'block' : 'none'; ?>">
                                                                                            <input type="hidden" id="hiddenInput" name="hiddenInput" value="{{$Vehicallist[0]->student_id}}">
                                                                                            <select id="busFeesSelect" name="busFeesSelect" class="form-control" <?php echo empty($notificationData1['required_school_transport']) ? 'disabled' : ''; ?>>
                                                                                                <option value=""> -- Select amount -- </option>
                                                                                                @foreach($busfeesamount as $feeOption)
                                                                                                    <option value="{{$feeOption->amount}}">
                                                                                                        {{$feeOption->amount}}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                        </span> 
                                                                                        <span>
                                                                                            <div id="dropdownContainer">
                                                                                                <select id="busDropdown" class="form-control">
                                                                                                    @if(!empty($notificationData1['driver_name']))
                                                                                                    <option value=""> -- Please select -- </option>
                                                                                                    @foreach($drivername as $eachStudent)
                                                                                                    @if($notificationData1['driver_name'] == $eachStudent->ename)
                                                                                                    <option selected value="{{$eachStudent->ename}}">{{$eachStudent->ename}}</option>
                                                                                                    @else
                                                                                                    <option value="{{$eachStudent->ename}}">{{$eachStudent->ename}}</option>
                                                                                                    @endif
                                                                                                    @endforeach
                                                                                                    @else
                                                                                                    <option value="" selected> -- Please select -- </option>
                                                                                                    @foreach($drivername as $eachStudent)
                                                                                                    <option value="{{$eachStudent->ename}}">{{$eachStudent->ename}}</option>
                                                                                                    @endforeach
                                                                                                    @endif

                                                                                                </select>
                                                                                            </div>
                                                                                        </span>
                                                                                         
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <br>
                                                                            <div id="data-container"></div>
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <label>Total Amount:</label>
                                                                                    <input type="text" name="totalFees" id="totalFees" class="form-control" readonly>
                                                                                </div>
                                                                                <!-- Display bus facility -->
                                                                                <div class="col-md-5"></div>
                                                                                <div class="col-md-4">
                                                                                    @if(isset($notificationData1['required_school_transport']))
                                                                                    @if(!empty($busValue))
                                                                                    @if(!empty($notificationData1['bus_facility_start_date']))
                                                                                    <label>Bus Facility Start: {{$notificationData1['bus_facility_start_date']}}</label>
                                                                                    @endif
                                                                                    @else
                                                                                    @if(!empty($notificationData1['bus_facility_end_date']))
                                                                                    <label>Bus Facility End: {{$notificationData1['bus_facility_end_date']}}</label>
                                                                                    @endif
                                                                                    @endif
                                                                                    @endif

                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <label>Total Discounted Amount:</label>
                                                                                <input type="text" name="totalDiscountedFees" id="totalDiscountedFees" class="form-control" readonly>
                                                                            </div>
                                                                            <br>
                                                                            <div class="col-md-12">
                                                                                <button class="btn btn-primary">Submit</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                <!-- Your Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">

          <h5 class="modal-title" id="verifyModalContent_title">
            Select Pick Up
          </h5>
          <button class="btn btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form id="studentpickupaddress" class="p-4 progress-form" novalidate>
            @csrf
            <input type="hidden" name="class_name" value="<?php echo (!empty($class_name)) ? $class_name : ''; ?>">
            <div class="form-check">
              <label class="form-check-label" for="disableFieldsCheckbox">Take student address </label>
              <input type="checkbox" class="form-check-input" name="studentaddcheck" id="studentaddcheck"><br>
              <span id="studentAddCheckMessage"></span>
              <span id="studentAddCheckMessage" class="text-danger"></span>
              <input type="hidden" id="latLngInput" name="latLngInput" placeholder="Latitude,Longitude">
              <input type="hidden" id="stu_bus_no" name="pickup_bus_no" placeholder="Latitude,Longitude">
            </div>
            <div class="form-group">
              <label class="col-form-label" for="recipient-name-2">Select Pick Up Shedule Name :</label>
              <select class="form-control" onchange="pickup_shedule_name(this);" name="pick_shedule_name" id="pick_shedule_name">
                <?php
                echo '<option value=" -- Select Pick Up Shedule Name -- "> -- Select Pick Up Shedule Name -- </option>';
                foreach ($schedulemasters as $schedulemaster) {
                  echo '<option value="' . $schedulemaster->schedule_name . '"> ' . $schedulemaster->schedule_name . ' </option>';
                }
                ?>
              </select>
              <input class="form-control" id="student_id_select_p" type="hidden" name="student_id_select_p" />
            </div>
            <div class="form-group">
              <label class="col-form-label" for="recipient-name-2">Pick Up Route :</label>
              <select class="form-control" name="pick_up_routes" onchange=pick_up_route(this) id="pick_up_routes">
                <?php
                echo '<option value=" -- Select Pick Up Route -- "> -- Select Pick Up Route -- </option>';
                // foreach($schedulemasters as $schedulemaster){
                //     echo '<option value="'.$schedulemaster->schedule_name.'"> '.$schedulemaster->schedule_name.' </option>';
                // }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label class="col-form-label" for="recipient-name-2">Pick Up Area Name :</label>
              <select class="form-control" name="pickup_area_name" onclick="pickup_area_names(this)" id="pickup_area_name">
                <?php
                echo '<option value=" -- Select Pick Up Area Name -- "> -- Select Pick Up Area Name -- </option>';
                // foreach($schedulemasters as $schedulemaster){
                //     echo '<option value="'.$schedulemaster->schedule_name.'"> '.$schedulemaster->schedule_name.' </option>';
                // }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label class="col-form-label" for="recipient-name-2">Pick Up Bus Stop Name :</label>
              <select class="form-control" name="pickup_bus_stop_names" onclick="pickup_bus_stop_name(this)" id="pickup_bus_stop_names">
                <?php
                echo '<option value=" -- Select Pick Up Bus Stop Name -- "> -- Select Pick Up Bus Stop Name -- </option>';
                // foreach($schedulemasters as $schedulemaster){
                //     echo '<option value="'.$schedulemaster->schedule_name.'"> '.$schedulemaster->schedule_name.' </option>';
                // }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label class="col-form-label" for="recipient-name-2">Pick Up Bus No :</label>
              <select class="form-control" name="pickup_bus_no" id="pickup_bus_no">
                <?php
                echo '<option value=" -- Select Pick Up Bus No -- "> -- Select Pick Up Bus No -- </option>';
                // foreach($schedulemasters as $schedulemaster){
                //     echo '<option value="'.$schedulemaster->schedule_name.'"> '.$schedulemaster->schedule_name.' </option>';
                // }
                ?>
              </select>
            </div>
        </div>
        <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">
            Close
        </button>
        <button class="btn btn-primary" type="button" id="submitFormButton">
            Send message
        </button>
    </div>
        </form>
      </div>
    </div>
</div>

                                                                <!-- end of main-content -->
                                                                <!-- Footer Start -->
                                                                <div class="flex-grow-1"></div>
                                                                <!-- fotter end -->
                                                            </div>
                                                            <script>
    // Handle button click to open the modal
    $('#openModalButton').click(function () {
        // Show the modal
        $('#myModal').modal('show');
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var busFacilityCheckbox = document.getElementById('busFacility');
        var feesAmountContainer = document.getElementById('feesAmountContainer');
        var busFeesSelect = document.getElementById('busFeesSelect');

        busFacilityCheckbox.addEventListener('change', function() {
            feesAmountContainer.style.display = this.checked ? 'block' : 'none';
            busFeesSelect.disabled = !this.checked; // Enable/disable the select based on the checkbox state
            if (!this.checked) {
                busFeesSelect.value = ""; // Reset select value
            }
        });
    });
</script>
<script>
        $(document).ready(function () {
            var openModalButton = document.getElementById('openModalButton');
            openModalButton.style.display = 'none';
            // Handle form submission through AJAX when the button is clicked
            $('#submitFormButton').click(function () {
                // Serialize the form data
                var formData = $('#studentpickupaddress').serialize();
                console.log(formData);
                // Send an AJAX POST request
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{url("scholarbusassign-post-pickup-fees")}}', // Update with your endpoint
                    data: formData,
                    success: function (response) {
                        // Handle the response here (e.g., show a success message)
                        console.log(response);
                        // Close the modal or perform other actions as needed
                        $('#myModal').modal('hide');
                    },
                    error: function () {
                        // Handle errors (e.g., display an error message)
                        alert('Form submission failed.');
                    }
                });
            });

            // Other JavaScript code here
        });
    </script>
                                                            <script>
                                                                    // Handle checkbox change event
                                                                    document.getElementById('busFacility').addEventListener('change', function() {
                                                                        var openModalButton = document.getElementById('openModalButton');
                                                                        if (this.checked) {
                                                                            // Show the button if the checkbox is checked
                                                                            openModalButton.style.display = 'block';
                                                                        } else {
                                                                            // Hide the button if the checkbox is not checked
                                                                            openModalButton.style.display = 'none';
                                                                        }
                                                                    });

                                                                    // Handle button click to open the modal
                                                                    document.getElementById('openModalButton').addEventListener('click', function () {
                                                                        $('#myModal').modal('show');
                                                                    });
                                                                </script>
                                                            <link rel="stylesheet" href="{{url('assets/backend')}}/css/plugins/sweetalert2.min.css" />
                                                            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
                                                            <script src="{{url('assets/backend')}}/js/plugins/sweetalert2.min.js"></script>
                                                            <script src="{{url('assets/backend')}}/js/scripts/sweetalert.script.min.js"></script>
                                                            <!-- Add jQuery library to your HTML if it's not already included -->
                                                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                                                            <script>
                                                                $(document).ready(function() {
                                                                    $('#busDropdown').change(function() {
                                                                        var isChecked = $('#busFacility').is(':checked') ? 1 : 0; // Set 1 if checked, 0 if unchecked
                                                                        var stuid = <?php echo json_encode($Vehicallist[0]->student_id); ?>;
                                                                        var selectedOption = $('#busDropdown').val();
                                                                        var busfees = $('#busFeesSelect').val();

                                                                        $.ajax({
                                                                            method: 'POST',
                                                                            headers: {
                                                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                            },
                                                                            data: {
                                                                                isChecked: isChecked,
                                                                                value: stuid,
                                                                                driverName: selectedOption,
                                                                                busfees: busfees
                                                                            },
                                                                            url: "{{ url('bus-facility-on') }}",
                                                                            dataType: 'json',
                                                                            success: function(response) {
                                                                                // console.log(response);
                                                                                console.log('AJAX call triggered successfully.');
                                                                                // Handle the response if needed
                                                                                location.reload();

                                                                            },
                                                                            error: function(error) {
                                                                                console.error('Error triggering AJAX call: ' + error);
                                                                            }
                                                                        });
                                                                    });
                                                                });
                                                            </script>
                                                            <script>
                                                                // Sample JSON data (replace this with your actual JSON data)
                                                                // console.log($feesstr[0]['json_str']);
                                                                var notificationData1 = {!!json_encode($notificationData1)!!};
                                                                var jsonData = '<?php echo addslashes($jsonData); ?>';
                                                                var newrowdata = JSON.parse(jsonData);
                                                                // Parse the JSON data from the PHP object
                                                                var newstujsonData = {!!json_encode($all_inquiry[0]->json_str)!!};
                                                                var stujsonData = JSON.parse(newstujsonData);
                                                                var discountedFeesArray = [];
                                                                // console.log(newrowdata.account_name);

                                                                // Function to dynamically generate the HTML table
                                                                function generateTable() {
                                                                    var dataContainer = document.getElementById('data-container');
                                                                    dataContainer.innerHTML = ''; // Clear existing content

                                                                    var table = document.createElement('table');
                                                                    table.className = 'table table-bordered'; // Add Bootstrap classes for styling
                                                                    table.id = 'generatetablerow';
                                                                    // Create table header
                                                                    var thead = document.createElement('thead');
                                                                    var headerRow = document.createElement('tr');

                                                                    var headers = ['S.No.', 'Fees Date', 'Acc. Name', 'Fees', 'Discount', 'Due Date', 'Term', 'Clear'];
                                                                    headers.forEach(function(headerText) {
                                                                        var th = document.createElement('th');
                                                                        th.textContent = headerText;
                                                                        headerRow.appendChild(th);
                                                                    });

                                                                    thead.appendChild(headerRow);
                                                                    table.appendChild(thead);

                                                                    // Create table body
                                                                    var tbody = document.createElement('tbody');
                                                                    var jsonDataNew = JSON.parse(jsonData);
                                                                    // var jsonDataNew = JSON.parse(stujsonData);
                                                                    console.log("table data is : ", jsonDataNew);
                                                                    var tuitionFeesIndex = jsonDataNew.account_name.findIndex(item => item === 'TUITION FEES');
                                                                    console.log('Index of Tuition Fees:', tuitionFeesIndex);
                                                                    // Get the length of fees_date
                                                                    // Get the length of fees_date
                                                                    var totalDiscountedFees = 0;
                                                                    for (var i = 0; i < jsonDataNew.fees_date.length; i++) {
                                                                        let formated_fees_date = jsonDataNew.fees_date[i].split("-").reverse().join("-");
                                                                        let formated_due_date = jsonDataNew.due_date[i].split("-").reverse().join("-");
                                                                        var obj = {
                                                                            // fees_date: jsonDataNew.fees_date[i],
                                                                            fees_date: formated_fees_date,
                                                                            account_name: jsonDataNew.account_name[i],
                                                                            fees: jsonDataNew.fees[i],
                                                                            // due_date: jsonDataNew.due_date[i],
                                                                            due_date: formated_due_date,
                                                                            term: jsonDataNew.term[i],
                                                                        };
                                                                        var row = document.createElement('tr');

                                                                        // S.No.
                                                                        var tdSNo = document.createElement('td');
                                                                        tdSNo.textContent = i + 1; // Increment S.No. starting from 1
                                                                        row.appendChild(tdSNo);

                                                                        // Fees Date
                                                                        var tdFeesDate = document.createElement('td');
                                                                        var inputFeesDate = document.createElement('input');
                                                                        inputFeesDate.type = 'date';
                                                                        inputFeesDate.name = 'fees_date[]';
                                                                        inputFeesDate.value = obj.fees_date; // Set value or leave blank if undefined                                                                        
                                                                        inputFeesDate.className = 'form-control';
                                                                        tdFeesDate.appendChild(inputFeesDate);
                                                                        row.appendChild(tdFeesDate);

                                                                        // Account Name
                                                                        var tdAccountName = document.createElement('td');
                                                                        var selectAccountName = document.createElement('select');
                                                                        selectAccountName.className = 'form-control';
                                                                        selectAccountName.name = 'account_name[]';

                                                                        // Add a "Please Select" option
                                                                        var pleaseSelectOption = document.createElement('option');
                                                                        pleaseSelectOption.value = ''; // You can set the value to an empty string or any other value you prefer
                                                                        pleaseSelectOption.textContent = 'Please Select';
                                                                        selectAccountName.appendChild(pleaseSelectOption);

                                                                        // Add options based on the condition
                                                                        if (obj.account_name === 'BUS FEES') {
                                                                            var option = document.createElement('option');
                                                                            option.value = 'BUS FEES';
                                                                            option.textContent = 'BUS FEES';
                                                                            option.selected = true; // Select "BUS FEES" if it matches
                                                                            selectAccountName.appendChild(option);
                                                                        }

                                                                        // Assuming you have PHP variable $course_fees_head_master available in your JavaScript code
                                                                        @if(!empty($course_fees_head_master))
                                                                        @foreach($course_fees_head_master as $each)
                                                                        // Skip adding "BUS FEES" if required_school_trasnport is set
                                                                        @if($each->ac_head_name !== 'BUS FEES' || empty($notificationData1['required_school_trasnport']))
                                                                        var option = document.createElement('option');
                                                                        option.value = '{{$each->ac_head_name}}';
                                                                        option.textContent = '{{$each->ac_head_name}}';
                                                                        selectAccountName.appendChild(option);
                                                                        @endif
                                                                        @endforeach
                                                                        @endif

                                                                        // Set the selected option based on obj.account_name
                                                                        selectAccountName.value = obj.account_name;
                                                                        tdAccountName.appendChild(selectAccountName);
                                                                        row.appendChild(tdAccountName);


                                                                        // Fees
                                                                        var tdFees = document.createElement('td');
                                                                        var inputFees = document.createElement('input');
                                                                        inputFees.type = 'text';
                                                                        inputFees.name = 'fees[]';
                                                                        inputFees.value = obj.fees || ''; // Set value or leave blank if undefined

                                                                        inputFees.oninput = function() {
                                                                            // Calculate discounted fees
                                                                            var discountPercentage = calculateDiscountPercentage(stujsonData);
                                                                            var feesValue = parseFloat(inputFees.value) || 0;
                                                                            var discountedFees = feesValue * (1 - discountPercentage);
                                                                            // console.log("yoyo");
                                                                            // Update the discounted fees input
                                                                            inputDiscountedFees.value = discountedFees.toFixed(2);
                                                                            // Update the total
                                                                            updateTotal();
                                                                        };

                                                                        inputFees.className = 'form-control orderFees_main';
                                                                        tdFees.appendChild(inputFees);
                                                                        row.appendChild(tdFees);
                                                                        // Function to calculate discount percentage based on conditions
                                                                        function calculateDiscountPercentage(stujsonData) {
                                                                            var discountPercentage = 0;

                                                                            if (stujsonData.staff_name && stujsonData.staff_name[0] !== 'Select Staff') {
                                                                                discountPercentage += 0.5; // 50% discount for staff
                                                                            }

                                                                            if (stujsonData.is_sibling_applied_for_admission === 'yes') {
                                                                                discountPercentage += 0.11; // 11% discount for sibling
                                                                            }

                                                                            if (stujsonData.staff_name && stujsonData.staff_name[0] !== 'Select Staff' && stujsonData.is_sibling_applied_for_admission === 'yes') {
                                                                                discountPercentage += 0.5 + 0.11;
                                                                            }

                                                                            return discountPercentage;
                                                                        }
                                                                        // Calculate the discount based on conditions
                                                                        var discountPercentage = 0;
                                                                        console.log("bahar ka staff");
                                                                        if (stujsonData.staff_name && stujsonData.staff_name[0] !== 'Select Staff') {
                                                                            discountPercentage += 0.5; // 50% discount for staff
                                                                            console.log("staff");
                                                                        }
                                                                        console.log(stujsonData.is_sibling_applied_for_admission);
                                                                        // console.log('is_sibling_applied_for_admission:', stujsonData.is_sibling_applied_for_admission);
                                                                        if (stujsonData.is_sibling_applied_for_admission === 'yes') {
                                                                            discountPercentage += 0.11; // 11% discount for sibling
                                                                            console.log("sibling");

                                                                        }
                                                                        console.log("bhara ke dono");
                                                                        // If both conditions are true, add both discounts
                                                                        if (stujsonData.staff_name && stujsonData.staff_name[0] !== 'Select Staff' && stujsonData.is_sibling_applied_for_admission === 'yes') {
                                                                            discountPercentage += 0.5 + 0.11;
                                                                            console.log("dono");

                                                                        }
                                                                        console.log("aaya to hai");
                                                                        if (i === tuitionFeesIndex) {
                                                                            console.log("hyy");
                                                                            // Calculate discounted fees
                                                                            console.log(inputFees.value);
                                                                            var discountedFees = parseFloat(inputFees.value) * (1 - discountPercentage);
                                                                            console.log(discountedFees);
                                                                        } else {
                                                                            console.log("no");
                                                                            var discountedFees = inputFees.value;
                                                                        }
                                                                        totalDiscountedFees += discountedFees; // Accumulate discounted fees for total

                                                                        // Store discounted fees in the array
                                                                        discountedFeesArray.push(discountedFees);
                                                                        // console.log(discountedFeesArray);
                                                                        // Display the discounted fees in a new column
                                                                        // Display the discounted fees as an input field
                                                                        var tdDiscountedFees = document.createElement('td');
                                                                        var inputDiscountedFees = document.createElement('input');
                                                                        inputDiscountedFees.type = 'text';
                                                                        inputDiscountedFees.name = 'discounted_fees[]';
                                                                        inputDiscountedFees.value = discountedFees; // Set the discounted fees as the value
                                                                        inputDiscountedFees.className = 'form-control orderFees_main';
                                                                        tdDiscountedFees.appendChild(inputDiscountedFees);
                                                                        row.appendChild(tdDiscountedFees);

                                                                        tbody.appendChild(row);
                                                                        // Due Date
                                                                        var tdDueDate = document.createElement('td');
                                                                        var inputDueDate = document.createElement('input');
                                                                        inputDueDate.type = 'date';
                                                                        inputDueDate.name = 'due_date[]';
                                                                        inputDueDate.value = obj.due_date || ''; // Set value or leave blank if undefined
                                                                        inputDueDate.className = 'form-control';
                                                                        tdDueDate.appendChild(inputDueDate);
                                                                        row.appendChild(tdDueDate);

                                                                        // Term
                                                                        var tdTerm = document.createElement('td');
                                                                        var selectTerm = document.createElement('select');
                                                                        selectTerm.className = 'form-control';
                                                                        selectTerm.name = 'term[]';

                                                                        for (var j = 0; j < jsonDataNew.term.length; j++) {
                                                                            var option = document.createElement('option');
                                                                            option.value = jsonDataNew.term[j];
                                                                            option.textContent = jsonDataNew.term[j];
                                                                            if (jsonDataNew.term[j] === '2nd') { // Replace '2nd' with the term value you want to pre-select
                                                                                option.selected = true;
                                                                            }
                                                                            selectTerm.appendChild(option);
                                                                        }

                                                                        tdTerm.appendChild(selectTerm);
                                                                        row.appendChild(tdTerm);

                                                                        // Clear Button
                                                                        var tdClear = document.createElement('td');
                                                                        var clearButton = document.createElement('button');
                                                                        clearButton.textContent = 'Clear';
                                                                        clearButton.className = 'btn btn-danger';

                                                                        clearButton.type = 'button';

                                                                        (function(index) {
                                                                            clearButton.onclick = function() {
                                                                                var sNo = index + 1;
                                                                                clearRowFields(sNo);
                                                                                return false;
                                                                            };
                                                                        })(i);

                                                                        tdClear.appendChild(clearButton);
                                                                        row.appendChild(tdClear);

                                                                        tbody.appendChild(row);
                                                                    }
                                                                    // Create an input for total discounted fees
                                                                    var totalDiscountedFeesInput = document.createElement('input');
                                                                    totalDiscountedFeesInput.type = 'text';
                                                                    totalDiscountedFeesInput.value = totalDiscountedFees;
                                                                    totalDiscountedFeesInput.readOnly = true;

                                                                    // Assuming you have a container element to append this to, replace 'yourContainerId' with the actual ID
                                                                    var container = document.getElementById('totalFees');
                                                                    container.appendChild(totalDiscountedFeesInput);
                                                                    table.appendChild(tbody);
                                                                    dataContainer.appendChild(table);
                                                                }

                                                                function calculateDiscountAndDisplay(inputFees, tdDiscountedFees) {
                                                                    // Get the entered fees value
                                                                    var enteredFees = parseFloat(inputFees.value) || 0;

                                                                    // Calculate the discount based on conditions
                                                                    var discountPercentage = 0;

                                                                    if (stujsonData.staff_name && stujsonData.staff_name[0] !== 'Select Staff') {
                                                                        discountPercentage += 0.5; // 50% discount for staff
                                                                    }

                                                                    if (stujsonData.is_sibling_applied_for_admission === 'yes') {
                                                                        discountPercentage += 0.11; // 11% discount for sibling
                                                                    }

                                                                    // If both conditions are true, add both discounts
                                                                    if (stujsonData.staff_name && stujsonData.staff_name[0] !== 'Select Staff' && stujsonData.is_sibling_applied_for_admission === 'yes') {
                                                                        discountPercentage += 0.5 + 0.11;
                                                                    }

                                                                    // Calculate discounted fees
                                                                    var discountedFees = enteredFees * (1 - discountPercentage);

                                                                    // Display the discounted fees in the respective cell
                                                                    tdDiscountedFees.textContent = discountedFees.toFixed(2);

                                                                    // Update the total fees
                                                                    updateTotal();
                                                                }
                                                                console.log(discountedFeesArray);

                                                                function calculateTotalSum(arr) {
                                                                    var totalSum = arr.reduce(function(acc, fee) {
                                                                        return acc + fee;
                                                                    }, 0);
                                                                    return totalSum;
                                                                }

                                                                // Calculate the total sum of discounted fees
                                                                var totalSumOfDiscountedFees = calculateTotalSum(discountedFeesArray);

                                                                console.log('Total Sum of Discounted Fees:', totalSumOfDiscountedFees);

                                                                // Function to clear fields of the current row

                                                                // Function to clear fields of the current row
                                                                function clearRowFields(sNo) {
                                                                    // alert(sNo);
                                                                    var fff = <?php echo json_encode($Vehicallist[0]->student_id); ?>;
                                                                    var wholedata = <?php echo json_encode($Vehicallist[0]); ?>;
                                                                    // console.log(fff);
                                                                    var row = document.querySelector('tbody tr:nth-child(' + sNo + ')');
                                                                    //  alert(fff);
                                                                    var inputs = row.querySelectorAll('input, select');

                                                                    inputs.forEach(function(input) {
                                                                        input.value = '';
                                                                    });

                                                                    // Make an AJAX request to delete the row on the server
                                                                    $.ajax({
                                                                        method: 'POST',
                                                                        headers: {
                                                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                        },
                                                                        data: {
                                                                            sNo: sNo,
                                                                            value: fff,
                                                                            fulldata: wholedata,
                                                                            jsonData: JSON.stringify(jsonData)
                                                                        }, // Send jsonData as part of the request body
                                                                        url: "{{ url('student-delete-row') }}",
                                                                        dataType: 'json',
                                                                        success: function(response) {
                                                                            // Handle the response from the server if needed
                                                                            // console.log('AJAX request successful:', response);

                                                                            // Assuming the response contains the updated JSON data,
                                                                            // you can replace the current jsonData with the updated data
                                                                            jsonData = response.updatedData;
                                                                            // console.log("pratik00");
                                                                            location.reload();
                                                                            // console.log(jsonData);
                                                                        },
                                                                        error: function(xhr, status, error) {
                                                                            // Handle errors if the AJAX request fails
                                                                            console.error('AJAX request error:', status, error);
                                                                        }
                                                                    });
                                                                }

                                                                function generateTermDropdown(selectElement, selectedTerm) {
                                                                    // Assuming you have PHP variable $terms available in your JavaScript code
                                                                    @if(!empty($terms))
                                                                    @foreach($terms as $term)
                                                                    var option = document.createElement('option');
                                                                    option.value = '{{$term->terms}}';
                                                                    option.textContent = '{{$term->terms}}';

                                                                    // Check if this term matches the selectedTerm and set as selected
                                                                    if ('{{$term->terms}}' === selectedTerm) {
                                                                        option.selected = true;
                                                                    }

                                                                    selectElement.appendChild(option);
                                                                    @endforeach
                                                                    @endif
                                                                }

                                                                // Function to add a new row to the table
                                                                function addRow() {
                                                                    var tbody = document.querySelector('#generatetablerow tbody');
                                                                    var newRow = document.createElement('tr');

                                                                    // S.No.
                                                                    var tdSNo = document.createElement('td');
                                                                    tdSNo.textContent = tbody.children.length + 1; // Increment S.No. starting from the current row count + 1
                                                                    newRow.appendChild(tdSNo);

                                                                    // Fees Date
                                                                    var tdFeesDate = document.createElement('td');
                                                                    var inputFeesDate = document.createElement('input');
                                                                    inputFeesDate.type = 'date';
                                                                    inputFeesDate.name = 'fees_date[]';
                                                                    inputFeesDate.value = '';
                                                                    inputFeesDate.className = 'form-control';
                                                                    tdFeesDate.appendChild(inputFeesDate);
                                                                    newRow.appendChild(tdFeesDate);

                                                                    // Account Name
                                                                    var tdAccountName = document.createElement('td');
                                                                    var selectAccountName = document.createElement('select');
                                                                    selectAccountName.className = 'form-control';
                                                                    selectAccountName.name = 'account_name[]';

                                                                    // Add a "Please Select" option
                                                                    var pleaseSelectOption = document.createElement('option');
                                                                    pleaseSelectOption.value = ''; // You can set the value to an empty string or any other value you prefer
                                                                    pleaseSelectOption.textContent = 'Please Select';
                                                                    selectAccountName.appendChild(pleaseSelectOption);

                                                                    // Assuming you have PHP variable $course_fees_head_master available in your JavaScript code
                                                                    @if(!empty($course_fees_head_master))
                                                                    @foreach($course_fees_head_master as $each)
                                                                    var option = document.createElement('option');
                                                                    option.value = '{{$each->ac_head_name}}';
                                                                    option.textContent = '{{$each->ac_head_name}}';
                                                                    selectAccountName.appendChild(option);
                                                                    @endforeach
                                                                    @endif

                                                                    tdAccountName.appendChild(selectAccountName);
                                                                    newRow.appendChild(tdAccountName);
                                                                    // Add an event listener to get the selected value when it changes
                                                                    selectAccountName.addEventListener('change', function() {
                                                                        var selectedValue = this.value;
                                                                    });
                                                                    // Calculate discount for the new row
                                                                    var discountPercentage = 0;

                                                                    if (stujsonData.staff_name && stujsonData.staff_name[0] !== 'Select Staff') {
                                                                        discountPercentage += 0.5; // 50% discount for staff
                                                                    }

                                                                    if (stujsonData.is_sibling_applied_for_admission === 'yes') {
                                                                        discountPercentage += 0.11; // 11% discount for sibling
                                                                    }

                                                                    // If both conditions are true, add both discounts
                                                                    if (stujsonData.staff_name && stujsonData.staff_name[0] !== 'Select Staff' && stujsonData.is_sibling_applied_for_admission === 'yes') {
                                                                        discountPercentage += 0.5 + 0.11;
                                                                    }

                                                                    // Fees
                                                                    var tdFees = document.createElement('td');
                                                                    var inputFees = document.createElement('input');
                                                                    inputFees.type = 'text';
                                                                    inputFees.name = 'fees[]';
                                                                    inputFees.value = '';

                                                                    // Add onchange event handler to inputFees
                                                                    inputFees.onchange = function() {
                                                                        var selectedValue = selectAccountName.value;

                                                                        // Check if the selected account name is 'TUITION FEES'
                                                                        if (selectedValue === 'TUITION FEES') {
                                                                            // Apply a discount if the selected account name is 'TUITION FEES'
                                                                            var discountedFees = parseFloat(inputFees.value) * (1 - discountPercentage);
                                                                            tdDiscountedFeesInput.value = discountedFees.toFixed(2);
                                                                        } else {
                                                                            // If the selected account name is not 'TUITION FEES', set the input value as it is
                                                                            tdDiscountedFeesInput.value = inputFees.value;
                                                                        }

                                                                        updateTotal(); // Call the function to update the total when fees change
                                                                    };

                                                                    inputFees.className = 'form-control orderFees_main';
                                                                    tdFees.appendChild(inputFees);
                                                                    newRow.appendChild(tdFees);

                                                                    // Calculate discounted fees for the initial empty value
                                                                    var discountedFees = parseFloat(inputFees.value) * (1 - discountPercentage);

                                                                    // Display the discounted fees in a new column
                                                                    var tdDiscountedFees = document.createElement('td');
                                                                    var tdDiscountedFeesInput = document.createElement('input');
                                                                    tdDiscountedFeesInput.type = 'text';
                                                                    tdDiscountedFeesInput.name = 'discounted_fees[]';
                                                                    tdDiscountedFeesInput.value = ''; // Set initial value to an empty string
                                                                    tdDiscountedFeesInput.className = 'form-control orderFees_main';

                                                                    // Add onchange event handler to tdDiscountedFeesInput
                                                                    tdDiscountedFeesInput.onchange = function() {
                                                                        var newDiscountedFees = parseFloat(this.value);
                                                                        // Update the value when it changes
                                                                        updateTotal();
                                                                    };

                                                                    tdDiscountedFees.appendChild(tdDiscountedFeesInput);
                                                                    newRow.appendChild(tdDiscountedFees);
                                                                    // Due Date
                                                                    var tdDueDate = document.createElement('td');
                                                                    var inputDueDate = document.createElement('input');
                                                                    inputDueDate.type = 'date';
                                                                    inputDueDate.name = 'due_date[]';
                                                                    inputDueDate.value = '';
                                                                    inputDueDate.className = 'form-control';
                                                                    tdDueDate.appendChild(inputDueDate);
                                                                    newRow.appendChild(tdDueDate);

                                                                    // Term
                                                                    var tdTerm = document.createElement('td');
                                                                    var selectTerm = document.createElement('select');
                                                                    selectTerm.className = 'form-control';
                                                                    selectTerm.name = 'term[]';

                                                                    // Call the generateTermDropdown function to populate options
                                                                    generateTermDropdown(selectTerm, ''); // Pass the selected term as an empty string for new rows

                                                                    tdTerm.appendChild(selectTerm);
                                                                    newRow.appendChild(tdTerm);

                                                                    // Clear Button
                                                                    var tdClear = document.createElement('td');
                                                                    var clearButton = document.createElement('button');
                                                                    clearButton.textContent = 'Clear';
                                                                    clearButton.className = 'btn btn-danger';

                                                                    // Add type="button" to prevent form submission
                                                                    clearButton.type = 'button';

                                                                    clearButton.onclick = function() {
                                                                        // Remove the new row from the table
                                                                        tbody.removeChild(newRow);
                                                                        return false;
                                                                    };

                                                                    tdClear.appendChild(clearButton);
                                                                    newRow.appendChild(tdClear);

                                                                    tbody.appendChild(newRow);
                                                                    var specifiedTable = document.getElementById('generatetablerow');
                                                                    if (specifiedTable) {
                                                                        specifiedTable.querySelector('tbody').appendChild(newRow);
                                                                    }
                                                                    //  console.log(inputFees);

                                                                }
                                                                // Print the total sum of discounted fees outside the function
                                                                // Calculate the total sum of discounted fees
                                                                // Calculate the total sum of discounted fees
                                                                // var totalDiscountedFees = calculateTotalDiscountedFees(discountedFeesArray);
                                                                // console.log('Total Discounted Fees:', totalDiscountedFees);


                                                                // Function to calculate discounted fees based on discountPercentage
                                                                function calculateDiscountAndDisplay(inputFees, tdDiscountedFees) {
                                                                    var originalFees = parseFloat(inputFees.value);
                                                                    var discountPercentage = parseFloat(inputFees.getAttribute('data-discount'));

                                                                    if (!isNaN(originalFees) && !isNaN(discountPercentage)) {
                                                                        var discountedFees = originalFees * (1 - discountPercentage);
                                                                        tdDiscountedFees.textContent = discountedFees.toFixed(2);
                                                                        updateTotalDiscountedFees(); // Update the total discounted fees when discount changes
                                                                    }
                                                                }

                                                                // Function to update the total fees and total discounted fees
                                                                function updateTotal() {
                                                                    var totalFees = 0;
                                                                    var totalDiscountedFees = 0;

                                                                    // Calculate total fees and total discounted fees
                                                                    var feeInputs = document.querySelectorAll('input[name="fees[]"]');
                                                                    feeInputs.forEach(function(input) {
                                                                        var fee = parseFloat(input.value) || 0;
                                                                        totalFees += fee;
                                                                    });

                                                                    var discountedFeeInputs = document.querySelectorAll('input[name="discounted_fees[]"]');
                                                                    discountedFeeInputs.forEach(function(input) {
                                                                        var discountedFee = parseFloat(input.value) || 0;
                                                                        totalDiscountedFees += discountedFee;
                                                                    });

                                                                    // Update the total fees and total discounted fees in their respective input fields
                                                                    var totalFeesInput = document.getElementById('totalFees');
                                                                    totalFeesInput.value = totalFees.toFixed(2);

                                                                    var totalDiscountedFeesInput = document.getElementById('totalDiscountedFees');
                                                                    totalDiscountedFeesInput.value = totalDiscountedFees.toFixed(2);
                                                                }

                                                                // Function to update the total discounted fees
                                                                function updateTotalDiscountedFees() {
                                                                    var totalDiscountedFees = 0;

                                                                    var discountedFeeInputs = document.querySelectorAll('input[name="discounted_fees[]"]');
                                                                    discountedFeeInputs.forEach(function(input) {
                                                                        var discountedFee = parseFloat(input.value) || 0;
                                                                        totalDiscountedFees += discountedFee;
                                                                    });

                                                                    // Update the total discounted fees in its input field
                                                                    var totalDiscountedFeesInput = document.getElementById('totalDiscountedFees');
                                                                    totalDiscountedFeesInput.value = totalDiscountedFees.toFixed(2);
                                                                }

                                                                window.onload = function() {
                                                                    generateTable();
                                                                    updateTotal();

                                                                    var addRowButton = document.getElementById('addRowButton');
                                                                    addRowButton.addEventListener('click', function() {
                                                                        addRow();
                                                                        updateTotal();
                                                                    });

                                                                    // Add onchange event listener to discount input fields
                                                                    var discountInputs = document.querySelectorAll('input[name="discounted_fees[]"]');
                                                                    discountInputs.forEach(function(input) {
                                                                        input.addEventListener('change', function() {
                                                                            var tdDiscountedFees = input.parentElement; // Get the parent td
                                                                            calculateDiscountAndDisplay(input, tdDiscountedFees);
                                                                            updateTotal();
                                                                            updateTotalDiscountedFees(); // Update the total discounted fees when a discount changes
                                                                        });
                                                                    });
                                                                };
                                                            </script>


                                                            <script type="text/javascript">
                                                                $('.removeItem').click(function(event) {

                                                                    event.preventDefault();

                                                                    var delete_id = $(this).data('delete_id');

                                                                    $(this).parents('tr').hide();
                                                                    swal({
                                                                        title: 'Are you sure?',
                                                                        text: "It will permanently deleted !",
                                                                        type: 'warning',
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: 'success',
                                                                        cancelButtonColor: '#d33',
                                                                        confirmButtonText: 'Yes, delete it!'
                                                                    }).then(function() {

                                                                        var myUrl = "{{url('course-fees-structure-master-delete')}}";

                                                                        $.ajax({
                                                                            url: myUrl,
                                                                            type: "POST",
                                                                            data: {
                                                                                "_token": "{{ csrf_token() }}",
                                                                                delete_id: delete_id
                                                                            },
                                                                            success: function(response) {

                                                                                swal(
                                                                                    'Deleted!',
                                                                                    'Your file has been deleted.',
                                                                                    'success'
                                                                                );

                                                                            }
                                                                        });

                                                                    })

                                                                });
                                                            </script>
                                                        <?php } else { ?>
                                                            <!-- start section -->

                                                            <h3>Generate due chart of this student </h3>

                                                            <!-- end section  -->

                                                        <?php } ?>
                                                    </div>
                                                    <div class="tab-pane fade" id="contactBasic" role="tabpanel" aria-labelledby="contact-basic-tab">
                                                    <style>
                                                        
                                                        tbody {
                                                            text-align: center;

                                                        }
                                                        tbody td {
                                                            text-align: left;

                                                        }
                                                        tbody th {
                                                            text-align: right;

                                                        }
                                                        /* #studentinfotable{
                                                            margin-left: 35%;
                                                        } */
                                                        .imagediv {
                                                            margin-top: 5%;
                                                            height: 200px;
                                                            width: 200px;
                                                            display: flex;
                                                            /* Add additional styling if required */
                                                        }
                                                         .idstuimage {
                                                            margin-top: 5%;
                                                            margin-left: 35%;
                                                            height: 200px;
                                                            width: 200px;
                                                            /* border-radius: 50%; */
                                                        } 
                                                        .stuimage{
                                                            margin-top: 15%;
                                                            padding-top: 1%;
                                                            /* width: 80%;
                                                            height: 80%; */
                                                            /* border-radius: 50%; */
                                                        }
                                                          /* Define the vertical separator */
    .row {
        display: flex;
    }

     .col-8 {
        border-left: 2px solid #ccc; /* Adjust the color and thickness of the vertical line */
        padding: 15px; /* Optional padding for spacing */
    }

    .col-4 {
        padding-right: 5px; /* Optional: Remove right padding for the first column */
    }
                                                    </style>
                                                                    <!-- protrait id card  -->
                                                                    <div class="row">
                                                                            <!-- <div class="ul-product-detail__image"><img src="{{url('assets/frontend/')}}/images/logo.png" alt="" /></div> -->
                                                                            <div class="card-body text-center">
                                                                                <div class="header"><img src="{{url('assets/backend/')}}/images/header-logo (1).png" alt=""/></div>
                                                                                <div class="idstuimage box-shadow-2 mb-3"><img src="{{url('assets/backend/')}}/images/student.png" alt="" /></div>
                                                                                <h1 class="m-0"><?php if (!empty($notificationData1['studentname_prefix'])) {
                                                                                                    echo $notificationData1['studentname_prefix'] . ' ';
                                                                                                } ?>{{$each_inq->student_name}}</h1>
                                                                                <!-- <button class="btn btn-primary btn-rounded">Contact Jassica</button> -->
                                                                                <div class="card-socials-simple mt-4">
                                                                                    <div class="table-responsive">
                                                                                        <table class="table table-borderless" id="studentinfotable">
                                                                                            <thead>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <!-- <th scope="row">2</th> -->
                                                                                                    <th>Scholar Number </th>
                                                                                                    <td>: <?php if (!empty($each_inq->scholar_no)) {
                                                                                                                echo $each_inq->scholar_no;
                                                                                                            } ?>
                                                                                                        <input type="hidden" name="scholar_no" id="scholar_no" value="<?php echo $each_inq->scholar_no; ?>">
                                                                                                    </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                    <!-- <th scope="row">2</th> -->
                                                                                                    <th>Class </th>
                                                                                                    <!-- <td><img class="rounded-circle m-0 avatar-sm-table" src="../../dist-assets/images/faces/1.jpg" alt="" /></td> -->
                                                                                                    <td>: {{$each_inq->class_name}}</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <!-- <th scope="row">2</th> -->
                                                                                                    <th>D.O.B </th>
                                                                                                    <!-- <td><img class="rounded-circle m-0 avatar-sm-table" src="../../dist-assets/images/faces/1.jpg" alt="" /></td> -->
                                                                                                    <td>: 12/12/2023</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <!-- <th scope="row">2</th> -->
                                                                                                    <th>Father </th>
                                                                                                    <!-- <td><img class="rounded-circle m-0 avatar-sm-table" src="../../dist-assets/images/faces/1.jpg" alt="" /></td> -->
                                                                                                    <td>: Student Father </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <!-- <th scope="row">2</th> -->
                                                                                                    <th>Address </th>
                                                                                                    <!-- <td><img class="rounded-circle m-0 avatar-sm-table" src="../../dist-assets/images/faces/1.jpg" alt="" /></td> -->
                                                                                                    <td>: Student Address </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <!-- <th scope="row">2</th> -->
                                                                                                    <th>Contact No. </th>
                                                                                                    <td>: 6546165465</td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="profileBasic" role="tabpanel" aria-labelledby="profile-basic-tab">
                                                        <div class="row">
                                                            <div class="header"><img src="{{url('assets/backend/')}}/images/header-logo (1).png" alt=""/></div>
                                                            <div class="col-4"><div class="stuimage box-shadow-2 mb-3"><img src="{{url('assets/backend/')}}/images/student.png" alt="" /></div></div>
                                                            <div class="col-8"><div class="table-responsive">
                                                                                        <table class="table table-borderless">
                                                                                            <thead>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <!-- <th scope="row">2</th> -->
                                                                                                    <th>Scholar Number </th>
                                                                                                    <td>: <?php if (!empty($each_inq->scholar_no)) {
                                                                                                                echo $each_inq->scholar_no;
                                                                                                            } ?></td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                    <!-- <th scope="row">2</th> -->
                                                                                                    <th>Class </th>
                                                                                                    <!-- <td><img class="rounded-circle m-0 avatar-sm-table" src="../../dist-assets/images/faces/1.jpg" alt="" /></td> -->
                                                                                                    <td>: {{$each_inq->class_name}}</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <!-- <th scope="row">2</th> -->
                                                                                                    <th>D.O.B </th>
                                                                                                    <!-- <td><img class="rounded-circle m-0 avatar-sm-table" src="../../dist-assets/images/faces/1.jpg" alt="" /></td> -->
                                                                                                    <td>: 12/12/2023</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <!-- <th scope="row">2</th> -->
                                                                                                    <th>Father </th>
                                                                                                    <!-- <td><img class="rounded-circle m-0 avatar-sm-table" src="../../dist-assets/images/faces/1.jpg" alt="" /></td> -->
                                                                                                    <td>: Student Father </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <!-- <th scope="row">2</th> -->
                                                                                                    <th>Address </th>
                                                                                                    <!-- <td><img class="rounded-circle m-0 avatar-sm-table" src="../../dist-assets/images/faces/1.jpg" alt="" /></td> -->
                                                                                                    <td>: Student Address </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <!-- <th scope="row">2</th> -->
                                                                                                    <th>Contact No. </th>
                                                                                                    <td>: 6546165465</td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div></div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="uploadDocument" role="tabpanel" aria-labelledby="upload-documents">
                                                        hyy4
                                                    </div>
                                                    <div class="tab-pane fade" id="feesDetails" role="tabpanel" aria-labelledby="fees-Details">
                                                        hyy1
                                                    </div>


                                                </div>
                                            </div>

                                            @endforeach
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
        </section>
        <!-- <Add>To Cart</Add> -->
        <!-- end student information -->
        <!-- Modal -->
        <div class="modal fade addNewStructure" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">
                    Add Next Year Fees
                    </h5>
                    <button
                    class="btn btn-close"
                    type="button"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    ></button>
                </div>
                <!-- <form> -->
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label">Fees Date:</label>
                                {{-- <input name="fees_date_str" class="form-control fees_date_str dateInput" type="date"  /> --}}
                                <input name="fees_date_str" id="picker2" class="form-control fees_date_str" type="date"  />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label">Due Date:</label>
                                <input class="form-control due_date_str" type="date" name="due_date_str" id="picker2" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="col-form-label">Payment Mode:</label>
                                <select id="received_amount" class="form-control" onchange='checkIfYes()' name="received_amount" autocomplete="">
                                    <option value="" disabled selected>Please select</option>
                                    @foreach(config('global.receivedammount') as $each)
                                    <option value="{{$each}}">{{$each}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <span class="validation_err_str_form text-red"></span>
                            </div>
                        </div>
                        <div id="extra" name="extra" style="display: none" class="col-md-3">
                            <div class="form-group">    
                                <label class="col-form-label" for="presentlyclass">Reference Number</label>
                                <input class="form-control" type="text" id="desc" name="reference_number" required>
                            </div>
                        </div>
                        <div class="row" id="rowContainer">
                        </div>
                        <div>
                            <b><span class="save_structure_row_resp text-success"></span></b>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12">
                            Total Amount : 
                            <input type="text" readonly id="totalnextyear" name="totalnextyear">
                        </div>
                    </div>
                    <button class="btn btn-primary add_new_row" type="button"> Add New Row
                    </button>
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal"> Close
                    </button>
                    <button class="btn btn-primary ms-2 save_row_btn" type="button"> Save Row </button>
                </div>
                <!-- </form> -->
            </div>
        </div>
        </div>

    </div>
    <!-- end of main-content -->
</div>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBa0_Zia458Lqzrwk7PzzpU7JIwJAkITdk&libraries=places"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

function checkIfYes() {
    if (document.getElementById('received_amount').value == 'Online' 
    || document.getElementById('received_amount').value == 'Bank Transfer'
    || document.getElementById('received_amount').value == 'Others') {
      document.getElementById('extra').style.display = '';
      document.getElementById('auth_by').disabled = false;
      document.getElementById('desc').disabled = false;
    } else {
      document.getElementById('extra').style.display = 'none';
    }
  }


$('.save_row_btn').click(function(e){
    
   e.preventDefault();
    var data1 = [];
    var fees_date_str = $('.fees_date_str').val();
    var due_date_str = $('.due_date_str').val();
    var reference_number = $('#desc').val();
    var received_amount = $('#received_amount').val();
    //var term_str = $('select[name="term_str"]').val();
    var scholar_no = $('#scholar_no').val();
    var fees_total = $("#totalnextyear").val();
   
   $('.row1').each(function() {
    // alert(fees_total);
   var account_name_str = $(this).find('select[name="account_name_str[]"]').val();
   var fees_str = $(this).find('input[name="fees_str[]"]').val();
      data1.push({
        account_name_str:account_name_str,
        fees_str:fees_str
      });
   });
   
       $.ajax({
           url: '{{url("save-next-year-fees")}}',
           type: "POST",
           data: { 
               "_token": "{{ csrf_token() }}",
               fees_date_str : fees_date_str,
               due_date_str : due_date_str,
               totalnextyear : fees_total,
               scholar_no : scholar_no,
               data1 : data1,
               received_amount : received_amount,
               reference_number : reference_number,
           },
           success: function (res) {
            // alert(res);
                if(res.error!=null){
                    alert('All Ready Have Values.');
                    setTimeout(function() {
                        $('.save_structure_row_resp').fadeOut('fast');
                        $('.btn-close').trigger('click');
                    }, 300);
                } else {
                    $('.save_structure_row_resp').show();
                    $('.save_structure_row_resp').text('Row Added*');
                    setTimeout(function() {
                        $('.save_structure_row_resp').fadeOut('fast');
                        $('.btn-close').trigger('click');
                    }, 300);
                }
               
            //    $(".structure_table").load(location.href + " .structure_table");
            //    $(".order_fees_total_main").load(location.href + ".order_fees_total_main");
               //total();
           },
            error: function () {
                // Handle errors (e.g., display an error message)
                alert('All Ready Have Values.');
            }
       });
   

   });

function addNewRow() {
      //console.log("hello")
      var newRowHtml = `<div class="row row1">
         <div class="col-md-4">
            <div class="form-group">
               <label class="col-form-label">Account Name:</label>
               <select name="account_name_str[]" class="form-control account_name_str" >
                  @if(!empty($course_fees_head_master))
                  <option value="" >-- Select The Head --</option>
                     @foreach($course_fees_head_master as $each)
                     <option value="{{$each->ac_head_name}}" value="{{$each->ac_head_name}}">{{$each->ac_head_name}}</option>
                     @endforeach
                  @endif
               </select>
            </div>
         </div>
         <div class="col-md-3">
            <div class="form-group">
               <label class="col-form-label">Fees:</label>
               <input class="form-control" type="text" oninput="calculateTotal()" name="fees_str[]" />
            </div>
         </div>
         <div class="col-md-2">
            <div class="form-group">
               <label class="col-form-label">Action<br></label>
               <button class="btn btn-danger remove_row" type="button">Remove</button>
            </div>
         </div>
      </div>`;
      $('#rowContainer').append(newRowHtml);
   }
//    totalnextyear

        function calculateTotal() {
            // Get all input fields with name "fees_str[]"
            const inputFields = document.querySelectorAll('input[name="fees_str[]"]');
            
            let total = 0;
            
            // Loop through the input fields and sum the values
            inputFields.forEach(function(input) {
                const value = parseFloat(input.value) || 0; // Convert input value to a number
                total += value;
            });
            
            // Display the total amount
            $("#totalnextyear").val(total);
            // document.getElementById('totalnextyear').textContent = total;
        }

    // Event handler for the "Add New Row" button
   $('.add_new_row').click(function () {
      addNewRow();
   });

   $(document).on('click', '.remove_row', function () {
      $(this).closest('.row').remove();
   });

  const disableFieldsCheckbox = document.getElementById('studentaddcheck');
  const fieldsToDisable = document.querySelectorAll('.form-group select');
  const studentIdSelectP = document.getElementById('student_id_select_p');

  disableFieldsCheckbox.addEventListener('change', () => {
    const isDisabled = disableFieldsCheckbox.checked;

    fieldsToDisable.forEach(field => {
      field.disabled = isDisabled;
    });

    // Ensure student_id_select_p is never disabled
    studentIdSelectP.disabled = false;
  });
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  var latLngInput = document.getElementById('latLngInput');
  var stuBusNo = document.getElementById('stu_bus_no');
  var errorP = document.getElementById('studentAddCheckMessage');
  var form = document.getElementById('progress-form');

  form.addEventListener('submit', function (event) {
    if (stuBusNo.value === '') {
      event.preventDefault(); // Prevent form submission

      // Display error message in the <p> tag
      errorP.textContent = 'Please assign a bus to the student or ensure the present address is correct.';
      errorP.style.color = 'red';
    }
  });
});
function pick_up_route(val) {
    var pickup_area_name = val.value
    $('#pickup_area_name').find('option').remove();
    $('#pickup_area_name_e').find('option').remove();
    $.ajax({
      data: {
        pickup_area_name: pickup_area_name
      },
      url: "{{ url('scholarbusassign_student_pick_up_routes') }}",
      type: "get",
      header: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType: "json",
      success: function(data) {
        $.each(data, function(key, value) {
          $('#pickup_area_name').append($("<option >" + value + "</option>").attr("value", value).text(value));
          $('#pickup_area_name_e').append($("<option >" + value + "</option>").attr("value", value).text(value));
        });
      }
    });
  }
  function pickup_shedule_name(val) {
    var shedule_name = val.value
    $('#pick_up_routes').find('option').remove();
    $('#pick_up_routes_e').find('option').remove();
    $.ajax({
      data: {
        shedule_name: shedule_name
      },
      url: "{{ url('scholarbusassign_student_shedule_name') }}",
      type: "get",
      header: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType: "json",
      success: function(data) {
        $.each(data, function(key, value) {
          $('#pick_up_routes').append($("<option >" + value + "</option>").attr("value", value).text(value));
          $('#pick_up_routes_e').append($("<option >" + value + "</option>").attr("value", value).text(value));
        });
      }
    });
  }
  function pickup_area_names(val) {
    var bus_stop_name = val.value
    $('#pickup_bus_stop_names').find('option').remove();
    $('#pickup_bus_stop_names_e').find('option').remove();

    $.ajax({
      data: {
        bus_stop_name: bus_stop_name
      },
      url: "{{ url('scholarbusassign_student_bus_stop_name') }}",
      type: "get",
      header: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType: "json",
      success: function(data) {
        $.each(data, function(key, value) {
          $('#pickup_bus_stop_names').append($("<option >" + value + "</option>").attr("value", value).text(value));
          $('#pickup_bus_stop_names_e').append($("<option >" + value + "</option>").attr("value", value).text(value));
        });
      }
    });
  }
  function pickup_bus_stop_name(val) {
    // console.log("hyy");
    var shedule_name1 = $("#pick_shedule_name").val();
    // console.log(shedule_name);
    // var pick_up_routes = $("#pick_up_routes").val();
    if (shedule_name1 == " -- Select Pick Up Shedule Name -- " && !empty($data[1]['student_add_check']) && $data[1]['student_add_check'] !== '-') {
      var shedule_name = $("#pick_shedule_name_e").val();
      var pick_up_routes = $("#pick_up_routes_e").val();
    } else {
      var shedule_name = $("#pick_shedule_name").val();
      var pick_up_routes = $("#pick_up_routes").val();
    }
    $('#pickup_bus_no').find('option').remove();
    $('#pickup_bus_no_e').find('option').remove();

    $.ajax({
      data: {
        shedule_name: shedule_name,
        pick_up_routes: pick_up_routes
      },
      url: "{{ url('scholarbusassign_student_bus_no') }}",
      type: "get",
      header: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType: "json",
      success: function(data) {
        $.each(data, function(key, value) {
          console.log(value)
          $('#pickup_bus_no').append($("<option >" + value + "</option>").attr("value", value).text(value));
          $('#pickup_bus_no_e').append($("<option >" + value + "</option>").attr("value", value).text(value));
        });
      }
    });
  }
</script>
<script>
    jQuery(document).ready(function($) {
        $("#resetpassword").click(function() {
            var id = $("#resetpassword").val();
            $.ajax({
                type: "POST",
                data: {
                    id,
                    id
                },
                url: "{{ url('resetpasswordadmin') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function(data) {
                    $("#success").text("Success Fully reset !");
                    console.log(data)
                }
            });
        });

    });
</script>
<script>
      function form_p(id, student_check_value, stu_driver) {
    console.log(id, student_check_value, stu_driver);

    $('#student_id_select_p').val(id);
    $('#studentaddcheck').val(student_check_value);
    $.ajax({
      data: {
        stu_driver: stu_driver
      },
      url: "{{ url('data_studata') }}",
      type: "get",
      header: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType: "json",
      success: function(data) {
        console.log(data);
        $('#stu_bus_no').val(data);
      }
    })
    $('#verifyModalContent').modal('show');

    // Geocode the student address to obtain latitude and longitude
    geocodeAddress(student_check_value, function(lat, lng) {
      console.log('Latitude:', lat, 'Longitude:', lng);

      var latLngString = null; // Declare and initialize latLngString here

      if (lat !== undefined && lng !== undefined) {
        latLngString = lat + ',' + lng;
        if (latLngString === null) {
          $('#studentAddCheckMessage').text('Please assign a present address to this student.');
          return;
        } else {
          $('#studentAddCheckMessage').text(''); // Clear the message if there is a value
        }
        $('#latLngInput').val(latLngString);
        // You can now use lat and lng as needed
      }
    });

    $('#verifyModalContent').modal('show');
  }


  function geocodeAddress(address, callback) {
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({
      'address': address
    }, function(results, status) {
      if (status === 'OK') {
        var location = results[0].geometry.location;
        callback(location.lat(), location.lng());
      } else {
        console.error('Geocode was not successful for the following reason:', status);
        callback(null, null);
      }
    });
  }
</script>
@endsection