@extends('backend.layouts.main')
@section('main-container')
<div class="main-content pt-4">
    <div class="form_section1_div">
        <div class="breadcrumb">
            <h1 class="me-2">Scholar Bus </h1>
        </div>
        <!-- </form> -->
    </div>
    <!-- end of main-content -->
    <br>
    </div>
        <div class="separator-breadcrumb border-top"></div>

        <div class="row">
            <div class="col-md-12 mb-4">
              <div class="card text-start">
                <div class="card-body">
                    <div class="card-title mb-3 text-end">
                        <input type="hidden" name="column_names[]" value="student_id_select_p">
                        <input type="hidden" name="column_names[]" value="pick_shedule_name">
                        <input type="hidden" name="column_names[]" value="pick_up_routes">
                        <input type="hidden" name="column_names[]" value="pickup_area_name">
                        <input type="hidden" name="column_names[]" value="pickup_bus_stop_names">
                        <input type="hidden" name="column_names[]" value="pickup_bus_no">
                        <input type="hidden" name="column_names[]" value="drop_shedule_name">
                        <input type="hidden" name="column_names[]" value="drop_up_route">
                        <input type="hidden" name="column_names[]" value="drop_area_name">
                        <input type="hidden" name="column_names[]" value="drop_bus_stop_name">
                        <input type="hidden" name="table_name" value="scholarbusassign">
                        <!-- <button type="submit" class="btn btn-raised ripple btn-raised-warning m-1">Export CSV</button> -->
                    </div>
                  <div class="table-responsive">
                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Sr.</th>
                                <th>GPS</th>
                                <th>Vehicle No</th>
                                <th>Vehicletype</th>
                                <th>Status</th>
                                <th>Speed</th>
                                <th>ign</th>
                                <th>battery percentage</th>
                                <!-- <th>Power</th> -->
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($busdatamasters))
                                @foreach($busdatamasters as $busdatamaster)
                                    <tr <?php echo ($busdatamaster->status == 'RUNNING') ? 'class="table-success"' : '' ?> <?php echo ($busdatamaster->status == 'STOP') ? 'class="table-danger"' : '' ?>>
                                        <td >{{ $busdatamaster->id }}</td>
                                        <td>{{ $busdatamaster->gps }}</td>
                                        <td> <a href="{{url('bus_details').'/'.$busdatamaster->vehicle_no}}">{{ $busdatamaster->vehicle_no }}</a> </td>
                                        <td>{{ $busdatamaster->vehicletype }}</td>
                                         <!-- STOP IDLE -->
                                        <td>{{ $busdatamaster->status }}</td>
                                        <td>{{ $busdatamaster->speed }}</td>
                                        <td>{{ $busdatamaster->ign }}</td>
                                        <td>{{ $busdatamaster->battery_percentage }}</td>
                                        <!-- <td>{{ $busdatamaster->power }}</td> -->
                                        <td>{{ $busdatamaster->location }}</td>
                                        <td> 
                                            <?php $a = "vehicel"."-".$busdatamaster->vehicle_no ; ?>
                                            <a href="{{url('map').'/'.$a}}" class="btn btn-primary" target=”_blank” >Show</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                hello 1
                            @endif

                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
<!-- </div> -->

@endsection