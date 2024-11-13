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
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Profile</th>
                                    <th>Status</th>
                                    <th>View Resume</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                <tr>
                                    <td>{{ $data->candidate_name }}</td>
                                    <td>{{ $data->candidate_mobile }}</td>
                                    <td>{{ $data->candidate_email }}</td>
                                    <td>{{ $data->candidate_profile }}</td>
                                    @role('Hr')
                                    <td>
                                        @if($data->candidate_status=='p') <span class="badge bg-danger text-white">Pending</span> @else <span class="badge bg-success text-white">Approval</span> @endif
                                    </td>
                                    @endrole
                                    @role('Admin')
                                    <td>
                                        <select class="form-select candidate-status" data-id="{{ $data->id }}">
                                            <option value="p" {{ $data->candidate_status == 'p' ? 'selected' : '' }}>Pending</option>
                                            <option value="a" {{ $data->candidate_status == 'a' ? 'selected' : '' }}>Approved</option>
                                        </select>
                                        <span class="badge bg-{{ $data->candidate_status == 'p' ? 'danger' : 'success' }} text-white status-badge">
                                            {{ $data->candidate_status == 'p' ? 'Pending' : 'Approval' }}
                                        </span>
                                    </td>
                                    @endrole
                                    <td>
                                        <a href="{{ asset($data->candidate_resume) }}" target="_blank">View Resume</a>
                                    </td>
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
