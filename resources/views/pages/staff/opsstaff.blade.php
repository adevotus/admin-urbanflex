@include('assets.css')
<div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    @include('layouts.header')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_settings-panel.html -->

        <!-- partial -->
        <!-- partial:../../partials/_sidebar.html -->
        @include('layouts.sidebar')
        <!-- partial -->

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">

                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="card-title mb-0">Operations Staff List</h4>
                                    <!-- Button to open modal -->
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addStaffModal">
                                        <i class="ti-plus"></i> Add New Staff
                                    </button>
                                </div>

                                <div class="table-responsive">
                                    <table id="staffTable" class="table table-striped table-bordered table-sm align-middle" style="width:100%">
                                        <thead class="bg-primary text-white text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Full Name</th>
                                            <th>User Number</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>2</td>
                                            <td>Mary Smith</td>
                                            <td>234456</td>
                                            <td>mary@example.com</td>
                                            <td>+255 713 111 999</td>
                                            <td>Accounts</td>
                                            <td><span class="badge bg-warning text-dark">Pending</span></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-light"><i class="ti-eye text-primary"></i></button>
                                                <button class="btn btn-sm btn-light"><i class="ti-pencil text-warning"></i></button>
                                                <button class="btn btn-sm btn-light"><i class="ti-trash text-danger"></i></button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Staff Modal -->
                    <div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <form id="addStaffForm">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="addStaffModalLabel">Add New Operation Staff</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-md-6 mt-2">
                                                <label class="form-label">First Name</label>
                                                <input type="text" class="form-control form-control-sm" name="first_name" placeholder="Enter full name" required>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control form-control-sm" name="last_name" placeholder="Enter full name" required>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control form-control-sm" name="email" placeholder="Enter email address" required>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label class="form-label">Phone</label>
                                                <input type="text" class="form-control form-control-sm" name="phone" placeholder="Enter phone number" required>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label class="form-label">Role</label>
                                                <select class="form-select form-select-sm" name="role_id" required>
                                                    <option value="2">Manager</option>
                                                    <option value="3">Help Desk</option>
                                                    <option value="4">Owner</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label class="form-label">Address</label>
                                                <input type="text" class="form-control" name="address" placeholder="Enter address">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Create Staff</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
            @include('layouts.footer')
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
@include('assets.js')
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>--}}

<script>
    $(document).ready(function () {
        $('#staffTable').DataTable({
            pageLength: 5,
            lengthMenu: [5, 10, 20],
        });

        // Handle Add Staff submission
        $('#addStaffForm').on('submit', function (e) {
            e.preventDefault();
            // Here, you can use AJAX to send the form data to your Laravel route
            alert('Staff saved successfully!');
            $('#addStaffModal').modal('hide');
            this.reset();
        });

        const tableBody = $("#staffTable tbody");
        tableBody.html('<tr><td colspan="10" class="text-center">Loading ...</td></tr>');

        $.ajax({
            url: "{{ route('ops-staff-list') }}",
            method: "GET",
            data: {
                current_password: $('#current_password').val(),
                new_password: $('#new_password').val(),
                confirm_password: $('#confirm_password').val(),
                userNumber: $('#userNumber').val(),
                _token: '{{ csrf_token() }}'
            },
            success: function (data) {
                console.log("the response",data);
                table.clear().draw();
                if ( Object.keys(data).length === 0) {return;}
                let counter = 1;
                $.each(data, function (index, staff) {

                    let staffStatus = (staff.status) ? staff.status : "N/A";

                    let statusLabel = (staffStatus === "ACTIVE")
                        ? `<span class="badge bg-success text-small">ACTIVE</span>`
                        : `<span class="badge bg-danger tex-small">INACTIVE</span>`;

                    table.row.add([
                        counter++,
                        staff.firstName || 'N/A',
                        staff.lastName || 'N/A',
                        staff.email || 'N/A',
                        staff.role.name || 'N/A',
                        staff.address || 'N/A',
                        staff.phone || 'N/A',
                        "Learning Plan",
                        statusLabel,
                        `<a href="" class="btn btn-sm btn-primary"><i class="bx bxs-eyedropper"></i></a>`
                    ]).draw(false);
                });
            },
            error: function (xhr) {
                let msg = xhr.responseJSON?.message || 'Failed to update password.';
                toastr.error(msg);
            },
            complete: function () {
                // Reset button
                $spinner.addClass('d-none');
                $text.text('Update Password');
                $btn.prop('disabled', false);
            }
        });
    });
</script>






