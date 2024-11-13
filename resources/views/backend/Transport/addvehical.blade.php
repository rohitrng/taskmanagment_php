@extends('backend.layouts.main')
@section('main-container')
<style>
    input {
    position: relative;
}
    input[type="date"]::-webkit-calendar-picker-indicator {
    background-position: right;
    background-size: auto;
    cursor: pointer;
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    top: 7px;
    width: auto;
}

.uperletter{
  text-transform: capitalize;
} 


</style>
<div class="main-content">
    <div class="form_section1_div">
        <div class="breadcrumb">
            <h1 class="me-2">Vehicle Master</h1>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        @if(!empty($Vehicallist))
                  <form id="progress-form" class="p-4 progress-form" action="{{url('AddVehical-store')}}" method="post">
                  <input type="hidden" 
                    @if(!empty($Vehicallist))
                      @foreach($Vehicallist as $listV)
                        value=" {{ $listV->id }}"
                      @endforeach
                    @else
                      value=""
                    @endif
                    name="id"
                  >
                  @else
                  <form id="progress-form" class="p-4 progress-form" action="{{url('save-addvehical')}}" method="post">
                  <!-- <form action="{{url('save-addvehical')}}" novalidate method="post"> -->
                  @endif
            @csrf
            <div class="row">
                <div class="col-md-3 form-group mb-3">
                    <label for="firstName1">Call NO.</label>
                    <input required name="callno" class="form-control" id="callno" type="number" 
                    @if(!empty($Vehicallist))
                      @foreach($Vehicallist as $listV)
                        value="{{ $listV->callno }}"
                      @endforeach
                    @else
                      value=""
                    @endif
                    placeholder="Call no." />
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label for="lastName1">Vehicle NO.</label>
                    <input required name="vehicel" class="form-control" id="vehicel" type="text" 
                    @if(!empty($Vehicallist))
                      @foreach($Vehicallist as $listV)
                        value="{{ $listV->vehicelno }}"
                      @endforeach
                    @else
                      value=""
                    @endif
                    placeholder="Vehicle NO" />
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label for="lastName1">Vehicle Type</label>
                    <input name="vehiceltype" class="form-control uperletter" id="vehiceltype" type="text"
                    @if(!empty($Vehicallist))
                      @foreach($Vehicallist as $listV)
                        value="{{ $listV->vehiceltype }}"
                      @endforeach
                    @else
                      value=""
                    @endif   
                    placeholder="vehiceltype" />
                </div>
                
                <div class="col-md-3 form-group mb-3">
                    <label for="picker2">Model no.</label>
                    <input type="text" class="form-control" id="picker01" 
                    @if(!empty($Vehicallist))
                      @foreach($Vehicallist as $listV)
                        value="{{ $listV->model }}"
                      @endforeach
                    @else
                      value=""
                    @endif   name="year" />
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label for="picker2">Purchase Date</label>
                    <input type="date" class="form-control" id="picker2-" 
                    @if(!empty($Vehicallist))
                      @foreach($Vehicallist as $listV)
                        value="{{ $listV->purchase }}"
                      @endforeach
                    @else
                      value=""
                    @endif name="dp" />
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label for="firstName1">Capacity</label>
                    <input name="capacity" class="form-control" id="capacity" 
                    @if(!empty($Vehicallist))
                      @foreach($Vehicallist as $listV)
                        value="{{ $listV->capacity }}"
                      @endforeach
                    @else
                      value=""
                    @endif type="number" placeholder="Capacity" />
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label for="lastName1">Standard Avg</label>
                    <input name="StandardAvg" class="form-control uperletter" id="StandardAvg" 
                    @if(!empty($Vehicallist))
                      @foreach($Vehicallist as $listV)
                        value="{{ $listV->standard }}"
                      @endforeach
                    @else
                      value=""
                    @endif
                    type="text"
                        placeholder="StandardAvg" />
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label for="lastName1">IMEI NO.</label>
                    <input name="imei" class="form-control" id="IMEI"  @if(!empty($Vehicallist))
                      @foreach($Vehicallist as $listV)
                        value="{{ $listV->imei }}"
                      @endforeach
                    @else
                      value=""
                    @endif
                     type="text" placeholder="IMEI No" />
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label for="lastName1">Machine ID</label>
                    <input name="Machine" class="form-control" id="Machine" type="text"  @if(!empty($Vehicallist))
                      @foreach($Vehicallist as $listV)
                        value="{{ $listV->machine }}"
                      @endforeach
                    @else
                      value=""
                    @endif
                    placeholder="Machine Id" />
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label for="lastName1">Nature of Work</label>
                    <select id="application-for" class="form-control" name="Nature" autocomplete="shipping address-level1" required>
                    @if(!empty($Vehicallist))
                            @foreach($Vehicallist as $listV)
                              value=" {{ $listV->nature }}"
                              <option value="{{ $listV->nature }}">{{ $listV->nature }}</option>
                            @endforeach
                          @else
                          <option>select option</option>
                          @endif
                              <option value="For-Student">For Student</option>
                              <option value="For-Staff">For Staff</option>
                              <option value="For-Worker">For Worker</option>
                           </select>
                </div>
                <div class="col-md-3 form-group mb-3">
                    <br>
                    <label for="lastName1">Student Related </label>
                    <input type="checkbox" id="StudentRelated" name="StudentRelated" 
                    @if(!empty($Vehicallist))
                      @foreach($Vehicallist as $listV)
                       {{ $listV->studentrelated == "on"? 'checked':''  }} 
                      @endforeach
                    @else
                      value=""
                    @endif />
                </div>
                <div class="col-md-3 form-group mb-3">
                    <br>
                    <label for="lastName1">Is Scrapped ?</label>
                    <input type="checkbox" id="Scrapped" name="Scrapped" 
                    @if(!empty($Vehicallist))
                      @foreach($Vehicallist as $listV)
                       {{ $listV->scrapped == "on"? 'checked':''  }} 
                      @endforeach
                    @else
                      value=""
                    @endif
                    />
                </div>
                <div class="col-md-12">
                    <button class="btn btn-primary">Submit</button>
                    <button type="button" id="reset" class="btn btn-primary" name="btn" value="Reset Form">Reset</button>

                    @if(request()->route()->getName() !== 'addvehical')
                    <a href="{{ url('addvehical') }}" class="btn btn-primary">Add New</a>
             @endif

                </div>
            </div>
        </form><br>
    </div>
    <div class="breadcrumb">
            <h1 class="me-2">List of Vehicle saved Records</h1>
          </div>
        <div class="separator-breadcrumb border-top"></div>

    <div class="row">
            <div class="col-md-12 mb-4">
              <div class="card text-start">
                <div class="card-body">
                  
                  <div class="card-title mb-3 text-end"><form method="POST" action="{{ route('export.csv') }}">
                      @csrf
                      <input type="hidden" name="column_names[]" value="callno">
                      <input type="hidden" name="column_names[]" value="vehicelno">
                      <input type="hidden" name="column_names[]" value="nature">
                      <input type="hidden" name="column_names[]" value="vehiceltype">
                      <input type="hidden" name="column_names[]" value="model">
                      <input type="hidden" name="column_names[]" value="purchase">
                      <input type="hidden" name="column_names[]" value="capacity">
                      <input type="hidden" name="column_names[]" value="standard">
                      <input type="hidden" name="column_names[]" value="imei">
                      <input type="hidden" name="column_names[]" value="machine">
                      <input type="hidden" name="column_names[]" value="studentrelated">
                      <input type="hidden" name="column_names[]" value="scrapped">
                      <input type="hidden" name="table_name" value="vehicel">
                      <button type="submit" class="btn btn-raised ripple btn-raised-warning m-1">Export CSV</button>
                  </form></div>

                  <div class="table-responsive">
                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width: 100%">
                      <thead>
                        <tr>
                          <th>Sr.</th>
                          <th>Call No.</th>
                          <th>Vehicle No.</th>
                          <th>Vehicle Type</th>
                          <th>Nature of Work</th>
                          <th>Student Related</th>
                          <th>Purchase Dt.</th>
                          <th>Model No.</th>
                          <th>Capacity</th>
                          <th>IMEI No</th>
                          <th>Standard Avg</th>
                          <th>MachineID</th>
                          <th>Is Scrapped</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1;  ?> 
                        @if(!empty($vehicals))
                        @foreach ($vehicals as $vehical)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $vehical->callno }}</td>
                            <td>{{ $vehical->vehicelno }}</td>
                            <td>{{ $vehical->vehiceltype }}</td>
                            <td>{{ $vehical->nature }}</td>
                            <td>{{ $vehical->studentrelated }}</td>
                            <td>{{ date('d-m-Y', strtotime($vehical->purchase)) }}</td>
                            <td>{{ $vehical->model }}</td>
                            <td>{{ $vehical->capacity }}</td>
                            <td>{{ $vehical->imei }}</td>
                            <td>{{ $vehical->standard }}</td>
                            <td>{{ $vehical->machine }}</td>
                            <td>{{ $vehical->scrapped }}</td>
                            <td> 
                              <a class="btn btn-raised ripple btn-primary m-1" href="{{ url('AddVehical-view') .'/'.$vehical->id}}">Edit</a>
                              <!-- <a class="btn btn-raised ripple btn-raised-danger m-1" href="{{ url('delete') .'/'.$vehical->id}}">Delete</a> -->
                              <!-- <form id="deleteForm" method="post" action="{{ url('AddVehical-delete') }}"> 
                                  @csrf
                                  <input type="hidden" name="table_name" value="vehicel">
                                  <input type="hidden" name="delete_id" value="{{ $vehical->id }}">
                                  <button type="submit" class="btn btn-danger btn-sm" onclick="confirmDelete(event)">Delete</button>
                              </form> -->
                              <?php $a = "vehicel"."-".$vehical->id ; ?>
                                <a class="btn btn-raised ripple btn-danger m-1" href="{{url('AddVehical-delete').'/'.$a}}" onclick="confirmDelete(event)">delete</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                        @endforeach
                        @else
                        <tr><td colspan="9" class="text-center">No Data Found</td></tr>
                        @endif
                      </tbody>
                      <tfoot>
                        <tr>
                            <th>Sr.</th>
                            <th>Call No.</th>
                            <th>Vehicle No.</th>
                            <th>Vehicle Type</th>
                            <th>Nature of Work</th>
                            <th>Student Related</th>
                            <th>Purchase Dt.</th>
                            <th>Model No.</th>
                            <th>Capacity</th>
                            <th>IMEI No</th>
                            <th>Standard Avg</th>
                            <th>MachineID</th>
                            <th>Is Scrapped</th>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Function to handle the date input
    $("#picker2").on("input", function() {
      // Do something with the date value
      const dateValue = $(this).val();
      console.log("Selected Date:", dateValue);
    });
  });
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
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      var select = document.getElementById('application-for');
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
        $("#callno").val("");
        $("#vehicel").val("");
        $("#vehiceltype").val("");
        $("#picker01").val(""); 
        $("#picker2-").val(""); 
        $("#capacity").val("");
        $("#StandardAvg").val("");
        $("#IMEI").val("");
        $("#Machine").val("");
        $("#application-for").val("");  
        $("#StudentRelated").val("");  
        $("#Scrapped").val("");  
        $("input[type='checkbox']").prop('checked', false);
        $("input[type='radio']").prop('checked', false);
        

    });

})
  
</script>

@endsection