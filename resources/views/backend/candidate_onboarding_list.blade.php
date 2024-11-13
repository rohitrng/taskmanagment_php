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
                                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                                <li class="breadcrumb-item active">Datatable</li>
                            </ol> -->
                        </div>
                        <h4 class="page-title">Resume List</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Emp Id</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Team Leader</th>
                                    <th>Joing Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                <tr>
                                    <td>
                                        @if (!empty($data->employee_id))
                                            RNG{{ $data->employee_id }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($data->full_name))
                                            {{ $data->full_name }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($data->email_address))
                                            {{ $data->email_address }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($data->contact_number))
                                            {{ $data->contact_number }}
                                        @else
                                            -
                                        @endif    
                                    </td>
                                    <td>
                                        @if (!empty($data->managers_name))
                                            {{ $data->managers_name }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($data->date_of_joining))
                                            {{ $data->date_of_joining }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <a href="onboarding-single-page/{{ $data->id }}" class="btn btn-success">View</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div><!-- container -->

    </div> <!-- Page content Wrapper -->


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.candidate-status').on('change', function() {
            var candidateId = $(this).data('id');
            var status = $(this).val();
            var statusBadge = $(this).next('.status-badge');

            // Send an AJAX request to update the status
            $.ajax({
                url: 'update-candidate-status', // Your update route URL
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Include CSRF token for security
                    id: candidateId,
                    status: status
                },
                success: function(response) {
                    if (response.success) {
                        // Update the badge color and text
                        if (status === 'p') {
                            statusBadge.removeClass('bg-success').addClass('bg-danger').text('Pending');
                        } else {
                            statusBadge.removeClass('bg-danger').addClass('bg-success').text('Approval');
                        }
                    } else {
                        alert('Error updating status');
                    }
                },
                error: function() {
                    alert('An error occurred. Please try again.');
                }
            });
        });
    });
</script>

@endsection 
