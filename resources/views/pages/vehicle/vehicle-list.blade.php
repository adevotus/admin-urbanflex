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
                                    <h4 class="card-title mb-0">Vehicle  List</h4>
                                    <!-- Button to open modal -->
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
                                            <th>Status</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>John Doe</td>
                                            <td>234555</td>
                                            <td>john@example.com</td>
                                            <td>+255 712 345 678</td>
                                            <td>IT Department</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                            <td>Owner</td>

                                            <td class="text-center">
                                                <button class="btn btn-sm btn-light"><i class="ti-eye text-primary"></i></button>
                                                <button class="btn btn-sm btn-light"><i class="ti-pencil text-warning"></i></button>
                                                <button class="btn btn-sm btn-light"><i class="ti-trash text-danger"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Mary Smith</td>
                                            <td>234456</td>
                                            <td>mary@example.com</td>
                                            <td>+255 713 111 999</td>
                                            <td>Accounts</td>
                                            <td><span class="badge bg-warning text-dark">Pending</span></td>
                                            <td>Driver</td>
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
    });
</script>



