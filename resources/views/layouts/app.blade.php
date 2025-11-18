@include('assets.css')
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('layouts.header')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">

        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
        @include('layouts.sidebar')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="row">
                            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                @if(session('user'))
                                    @php $user = session('user'); @endphp
                                    <h3 class="font-weight-bold">
                                        Good
                                        @php
                                            $hour = now()->hour;
                                            if ($hour < 12) echo 'morning';
                                            elseif ($hour < 18) echo 'afternoon';
                                            else echo 'evening';
                                        @endphp,
                                        {{ $user['first_name'] ?? $user['name'] ?? 'User' }}!
                                    </h3>

                                @endif
{{--                                <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6>--}}
                            </div>
                            <div class="col-12 col-xl-4">
                                <div class="justify-content-end d-flex">
                                    <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                        <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                            <a class="dropdown-item" href="#">January - March</a>
                                            <a class="dropdown-item" href="#">March - June</a>
                                            <a class="dropdown-item" href="#">June - August</a>
                                            <a class="dropdown-item" href="#">August - November</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">Total Users</p>
                                <p class="fs-30 mb-2">406</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">Total Vehicles</p>
                                <p class="fs-30 mb-2">61344</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">Total Drivers</p>
                                <p class="fs-30 mb-2">340</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">Amount Collected</p>
                                <p class="fs-30 mb-2">470,033.00(Tsh)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title mb-0">Top Payment Transactions</p>
                                <div class="table-responsive">
                                    <table class="table table-striped table-borderless">
                                        <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Search Engine Marketing</td>
                                            <td class="font-weight-bold">$362</td>
                                            <td>21 Sep 2018</td>
                                            <td class="font-weight-medium"><div class="badge badge-success">Completed</div></td>
                                        </tr>
                                        <tr>
                                            <td>Search Engine Optimization</td>
                                            <td class="font-weight-bold">$116</td>
                                            <td>13 Jun 2018</td>
                                            <td class="font-weight-medium"><div class="badge badge-success">Completed</div></td>
                                        </tr>
                                        <tr>
                                            <td>Display Advertising</td>
                                            <td class="font-weight-bold">$551</td>
                                            <td>28 Sep 2018</td>
                                            <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
                                        </tr>
                                        <tr>
                                            <td>Pay Per Click Advertising</td>
                                            <td class="font-weight-bold">$523</td>
                                            <td>30 Jun 2018</td>
                                            <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
                                        </tr>
                                        <tr>
                                            <td>E-Mail Marketing</td>
                                            <td class="font-weight-bold">$781</td>
                                            <td>01 Nov 2018</td>
                                            <td class="font-weight-medium"><div class="badge badge-danger">Cancelled</div></td>
                                        </tr>
                                        <tr>
                                            <td>Referral Marketing</td>
                                            <td class="font-weight-bold">$283</td>
                                            <td>20 Mar 2018</td>
                                            <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
                                        </tr>
                                        <tr>
                                            <td>Social media marketing</td>
                                            <td class="font-weight-bold">$897</td>
                                            <td>26 Oct 2018</td>
                                            <td class="font-weight-medium"><div class="badge badge-success">Completed</div></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Loan-Repayment Trending</p>
                                <p class="font-weight-500">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                                <div class="d-flex flex-wrap mb-5">
                                    <div class="mr-5 mt-3">
                                        <p class="text-muted">Order value</p>
                                        <h3 class="text-primary fs-30 font-weight-medium">12.3k</h3>
                                    </div>
                                    <div class="mr-5 mt-3">
                                        <p class="text-muted">Orders</p>
                                        <h3 class="text-primary fs-30 font-weight-medium">14k</h3>
                                    </div>
                                    <div class="mr-5 mt-3">
                                        <p class="text-muted">Users</p>
                                        <h3 class="text-primary fs-30 font-weight-medium">71.56%</h3>
                                    </div>
                                    <div class="mt-3">
                                        <p class="text-muted">Downloads</p>
                                        <h3 class="text-primary fs-30 font-weight-medium">34040</h3>
                                    </div>
                                </div>
                                <canvas id="order-chart"></canvas>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            @include('layouts.footer')
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->


@include('assets.js')

<script>
    @if(session('success'))
    toastr.success("{{ session('success') }}");
    @endif
</script>
