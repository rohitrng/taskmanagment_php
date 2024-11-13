@extends('backend.layouts.main')
@section('main-container')

<style>

.uperletter{
  text-transform: capitalize;
} 

</style>
<div class="main-content pt-4">
    <div class="row">
        <div class="col-md-4 form-group mb-3">
            <div class="form_section1_div">
                <div class="breadcrumb">
                    <h1 class="me-2">Area Master</h1>
                </div>
                <div class="separator-breadcrumb border-top"></div>
                    @if(!empty($area_s))
                        <form id="progress-form" class="p-4 progress-form" action="{{url('area-master')}}" method="post">
                        <input type="hidden" 
                            @if(!empty($area_s))
                                @foreach($area_s as $area)
                                value=" {{ $area->id }}"
                                @endforeach
                            @else
                                value=""
                            @endif
                            name="id"
                    >
                    @else
                        <form id="progress-form" class="p-4 progress-form" action="{{url('area-master')}}" method="post">
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                            <label for="lastName1">Area Name:</label>
                            <input required type="text" class="form-control uperletter" placeholder="Area Name" 
                            name="area_name" id="area_name" <?php 
                            if(!empty($area_s)){ 
                                foreach($area_s as $area){
                                    echo 'value="'.$area->area_name.'"'; 
                                }
                            } 
                            else{
                                echo 'value=""';
                            } 
                            ?> >
                        </div>
                        <div class="col-md-42">
                            <button class="btn btn-primary">Submit</button>
                            <button type="button" id="reset" class="btn btn-primary" name="btn" value="Reset Form">Reset</button>


                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="breadcrumb">
                <h1 class="me-2">Area Master</h1>
            </div>
            <div class="separator-breadcrumb border-top"></div>

            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="card text-start">
                    <div class="card-body">
                    <div class="card-title mb-3 text-end"><form method="POST" action="{{ route('export.csv') }}">
                      @csrf
                      <input type="hidden" name="column_names[]" value="area_name">
                      <input type="hidden" name="table_name" value="areamaster">
                      <button type="submit" class="btn btn-raised ripple btn-raised-warning m-1">Export CSV</button>
                  </form></div>
                        <div class="table-responsive">
                        <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width: 100%">
                            <thead>
                            <tr>
                                <th>Sr.</th>
                                <th>Area Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1;  ?>
                            @if(!empty($areas))
                            @foreach ($areas as $area)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $area->area_name }}</td>
                                <td class='d-flex'>
                                    <a class="btn btn-raised ripple btn-raised-primary m-1" href="{{ url('view-area-master') .'/'.$area->id}}">Edit</a>
                                    <?php $a = "areamaster"."-".$area->id ; ?>
                                <a class="btn btn-raised ripple btn-danger m-1" href="{{url('delete-area-master').'/'.$a}}" onclick="confirmDelete(event)">Delete</a>
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
                                <th>Area Name</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                        </div>
                    </div>
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
        $("#area_name").val("");
            
    });

})

</script>
@endsection