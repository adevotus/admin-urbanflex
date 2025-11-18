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
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="border-bottom text-center pb-4">
                                            @if(!empty($user->avatar))
                                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Profile Image" class="img-lg rounded-circle mb-3" />
                                            @else
                                                {{-- Generate fallback initials avatar --}}
                                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary text-white mb-3"
                                                     style="width: 80px; height: 80px; font-size: 24px;">
                                                    {{ strtoupper(substr($user->first_name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0, 1)) }}
                                                </div>
                                            @endif

                                            <div class="mb-2">
                                                <h4 class="fw-bold mb-0">
                                                    {{ $user->first_name }} {{ $user->last_name }}
                                                </h4>
                                                <small class="text-muted">{{ $user->email }}</small>
                                            </div>

                                        </div>

                                        <div class="card shadow-sm border-0 rounded-3">
                                            <div class="card-body">
                                                <h5 class="card-title mb-4 text-primary fw-bold">User Information</h5>

                                                <div class="py-3">
                                                    <p class="clearfix mb-2">
                                                        <span class="float-start fw-medium">Status</span>
                                                        <span class="float-end text-muted">{{ $user->status ?? 'N/A' }}</span>
                                                    </p>

                                                    <p class="clearfix mb-2">
                                                        <span class="float-start fw-medium">Phone</span>
                                                        <span class="float-end text-muted">{{ $user->phone ?? 'N/A' }}</span>
                                                    </p>

                                                    <p class="clearfix mb-2">
                                                        <span class="float-start fw-medium">Email</span>
                                                        <span class="float-end text-muted">{{ $user->email ?? 'N/A' }}</span>
                                                    </p>

                                                    <p class="clearfix mb-2">
                                                        <span class="float-start fw-medium">Address</span>
                                                        <span class="float-end text-muted">{{ $user->address ?? 'N/A' }}</span>
                                                    </p>

                                                    <p class="clearfix mb-2">
                                                        <span class="float-start fw-medium">Role</span>
                                                        <span class="float-end text-muted">{{ $user->role->name ?? 'N/A' }}</span>
                                                    </p>

                                                    <p class="clearfix mb-0">
                                                        <span class="float-start fw-medium">User Number</span>
                                                        <span class="float-end text-muted">{{ $user->userNumber ?? 'N/A' }}</span>
                                                    </p>
                                                </div>

                                                <div class="mt-4">
                                                    <button type="button" class="btn btn-primary w-100 edit-user-btn" data-bs-toggle="modal" data-bs-target="#editUserModal">
                                                        <i class="ti-pencil-alt text-white me-1"></i> Edit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-8">
                                        <!-- Profile Navigation Tabs -->
                                        <div class="mt-4 py-2 border-top border-bottom">
                                            <ul class="nav profile-navbar justify-content-around" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#accounts" role="tab" aria-selected="true">
                                                        <i class="ti-user me-2 text-primary"></i> Accounts
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#roles" role="tab" aria-selected="false">
                                                        <i class="ti-receipt me-2 text-primary"></i> Roles
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#permission" role="tab" aria-selected="false">
                                                        <i class="ti-calendar me-2 text-primary"></i> Permission
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Tab Content -->
                                        <div class="tab-content profile-feed mt-4">
                                            <!-- Accounts Tab -->
                                            <div class="tab-pane fade show active" id="accounts" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-md-10 mx-auto">
                                                        <form id="updatePasswordForm" class="pt-3" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="userNumber" id="userNumber" value="{{ $user->userNumber }}">

                                                            <div class="form-group mb-3">
                                                                <label for="current_password" class="fw-bold">Current Password</label>
                                                                <div class="input-group">
                                                                  <span class="input-group-text bg-transparent border-end-0"><i class="ti-lock text-primary"></i></span>
                                                                    <input type="password" id="current_password" name="current_password" class="form-control border-start-0" placeholder="Enter current password" required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group mb-3">
                                                                <label for="new_password" class="fw-bold">New Password</label>
                                                                <div class="input-group">
                                                                 <span class="input-group-text bg-transparent border-end-0"><i class="ti-lock text-primary"></i></span>
                                                                    <input type="password" id="new_password" name="new_password" class="form-control border-start-0" placeholder="Enter new password" required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group mb-4">
                                                                <label for="confirm_password" class="fw-bold">Confirm Password</label>
                                                                <div class="input-group">
                                                                <span class="input-group-text bg-transparent border-end-0"><i class="ti-lock text-primary"></i></span>
                                                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control border-start-0" placeholder="Confirm new password" required>
                                                                </div>
                                                            </div>

                                                            <div class="d-grid">
                                                                <button id="updatePasswordBtn" class="btn btn-primary btn-md fw-semibold" type="submit"
                                                                        style="background-color: #263e8a; border-color: #263e8a;">
                                                                    <span class="spinner-border spinner-border-sm me-2 d-none" id="btnSpinner" role="status" aria-hidden="true"></span>
                                                                    <span id="btnText">Update Password</span>
                                                                </button>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Roles Tab -->
                                            <div class="tab-pane fade" id="roles" role="tabpanel">
                                                <div class="text-center p-4">
                                                    <h5 class="fw-bold mb-3 text-primary">Manage Roles</h5>
                                                    <p class="text-muted">Here you can assign or edit user roles.</p>
                                                    <div class="d-flex justify-content-center gap-3 mt-3">
                                                        <button class="btn btn-outline-primary btn-sm">Admin</button>
                                                        <button class="btn btn-outline-primary btn-sm">Manager</button>
                                                        <button class="btn btn-outline-primary btn-sm">User</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Permission Tab -->
                                            <div class="tab-pane fade" id="permission" role="tabpanel">
                                                <div class="text-center p-4">
                                                    <h5 class="fw-bold mb-3 text-primary">Permissions</h5>
                                                    <p class="text-muted">View or modify user permissions for specific roles.</p>
                                                    <table class="table table-bordered table-striped">
                                                        <thead class="table-light">
                                                        <tr>
                                                            <th>Permission</th>
                                                            <th>Status</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>View Reports</td>
                                                            <td><span class="badge bg-success">Enabled</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Edit Accounts</td>
                                                            <td><span class="badge bg-danger">Disabled</span></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Edit User Modal -->
                    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-lg">
                            <div class="modal-content">

                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="editUserModalLabel">Edit User Information</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"><i class="ti-close text-black me-1"></i></button>
                                </div>

                                <div class="modal-body">
                                    <form id="editUserForm">
                                        <input type="hidden" id="user_id">

                                        <div class="mb-3">
                                            <label for="first_name" class="form-label">First Name</label>
                                            <input type="text" class="form-control form-control-sm" id="first_name" name="first_name">
                                        </div>

                                        <div class="mb-3">
                                            <label for="last_name" class="form-label">Last Name</label>
                                            <input type="text" class="form-control form-control-sm" id="last_name" name="last_name">
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input type="email" class="form-control form-control-sm" id="email" name="email">
                                        </div>

                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" class="form-control form-control-sm" id="phone" name="phone">
                                        </div>

                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" name="address">
                                        </div>

                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" id="status" name="status">
                                                <option value="ACTIVE">ACTIVE</option>
                                                <option value="INACTIVE">INACTIVE</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" form="editUserForm" class="btn btn-primary">Save changes</button>
                                </div>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        $('#updatePasswordForm').on('submit', function (e) {
            e.preventDefault();

            let $btn = $('#updatePasswordBtn');
            let $spinner = $('#btnSpinner');
            let $text = $('#btnText');

            // Show spinner
            $spinner.removeClass('d-none');
            $text.text('Updating...');
            $btn.prop('disabled', true);

            $.ajax({
                url: "{{ route('user.update-password') }}",
                method: "POST",
                data: {
                    current_password: $('#current_password').val(),
                    new_password: $('#new_password').val(),
                    confirm_password: $('#confirm_password').val(),
                    userNumber: $('#userNumber').val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    console.log("the response",response);
                    if(response.status ==='200'){
                        toastr.success(response.Message || 'Password updated successfully!');
                        $('#updatePasswordForm')[0].reset();
                    }else {
                        toastr.info(response.Message || 'Failed to update password.');
                    }
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
    });
</script>



