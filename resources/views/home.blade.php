@extends('layouts.app', ['page' => 'Home', 'page2' => '', 'page3' => ''])

@section('content')
    <!-- Row start -->
    <div class="row">
        <div class="col-xxl-3 col-sm-6 col-12">
            <div class="stats-tile">
                <div class="sale-icon shade-red">
                    <i class="bi bi-pie-chart"></i>
                </div>
                <div class="sale-details">
                    <h3 class="text-red">250k</h3>
                    <p>Sales</p>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6 col-12">
            <div class="stats-tile">
                <div class="sale-icon shade-blue">
                    <i class="bi bi-emoji-smile"></i>
                </div>
                <div class="sale-details">
                    <h3 class="text-blue">24m</h3>
                    <p>Customers</p>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6 col-12">
            <div class="stats-tile">
                <div class="sale-icon shade-yellow">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div class="sale-details">
                    <h3 class="text-yellow">15k</h3>
                    <p>Products</p>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6 col-12">
            <div class="stats-tile">
                <div class="sale-icon shade-green">
                    <i class="bi bi-handbag"></i>
                </div>
                <div class="sale-details">
                    <h3 class="text-green">180m</h3>
                    <p>Revenue</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->

    <!-- Row start -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Orders</div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table v-middle">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>User ID</th>
                                    <th>Ordered Placed</th>
                                    <th>Amount</th>
                                    <th>Payment Status</th>
                                    <th>Order Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="media-box">
                                            <img src="assets/images/user3.png" class="media-avatar" alt="Bootstrap Gallery">
                                            <div class="media-box-body">
                                                <div class="text-truncate">Ellie Collins</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="media-box">
                                            <img src="assets/images/food/img3.jpg" class="media-avatar" alt="Admin Themes">
                                            <div class="media-box-body">
                                                <div class="text-truncate">Ginger Snacks</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Arise827</td>
                                    <td>12/12/2021</td>
                                    <td>$18.00</td>
                                    <td>
                                        <span class="text-green td-status"><i class="bi bi-check-circle"></i> Paid</span>
                                    </td>
                                    <td>
                                        <span class="badge shade-green min-90">Delivered</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="media-box">
                                            <img src="assets/images/user.png" class="media-avatar" alt="Bootstrap Gallery">
                                            <div class="media-box-body">
                                                <div class="text-truncate">Sophie Nguyen</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="media-box">
                                            <img src="assets/images/food/img6.jpg" class="media-avatar" alt="Admin Themes">
                                            <div class="media-box-body">
                                                <div class="text-truncate">Guava Sorbet</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Arise253</td>
                                    <td>18/12/2021</td>
                                    <td>$32.00</td>
                                    <td>
                                        <span class="text-red td-status"><i class="bi bi-x-circle"></i> Failed</span>
                                    </td>
                                    <td>
                                        <span class="badge shade-red min-90">Cancelled</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="media-box">
                                            <img src="assets/images/user4.png" class="media-avatar" alt="Bootstrap Gallery">
                                            <div class="media-box-body">
                                                <div class="text-truncate">Darcy Ryan</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="media-box">
                                            <img src="assets/images/food/img5.jpg" class="media-avatar" alt="Admin Themes">
                                            <div class="media-box-body">
                                                <div class="text-truncate">Gooseberry Surprise</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Arise878</td>
                                    <td>22/12/2021</td>
                                    <td>$19.00</td>
                                    <td>
                                        <span class="text-blue td-status"><i class="bi bi-clock-history"></i> Awaiting</span>
                                    </td>
                                    <td>
                                        <span class="badge shade-blue min-90">Processing</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->

    <!-- Row start -->
    <div class="row">
        <div class="col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Transactions</div>
                </div>
                <div class="card-body">
                    <div class="scroll370">
                        <div class="transactions-container">
                            <div class="transaction-block">
                                <div class="transaction-icon shade-blue">
                                    <i class="bi bi-credit-card"></i>
                                </div>
                                <div class="transaction-details">
                                    <h4>Visa Card</h4>
                                    <p class="text-truncate">Laptop Ordered</p>
                                </div>
                                <div class="transaction-amount text-blue">$1590</div>
                            </div>
                            <div class="transaction-block">
                                <div class="transaction-icon shade-green">
                                    <i class="bi bi-paypal"></i>
                                </div>
                                <div class="transaction-details">
                                    <h4>Paypal</h4>
                                    <p class="text-truncate">Payment Received</p>
                                </div>
                                <div class="transaction-amount text-green">$310</div>
                            </div>
                            <div class="transaction-block">
                                <div class="transaction-icon shade-blue">
                                    <i class="bi bi-pin-map"></i>
                                </div>
                                <div class="transaction-details">
                                    <h4>Travel</h4>
                                    <p class="text-truncate">Yosemite Trip</p>
                                </div>
                                <div class="transaction-amount text-blue">$4900</div>
                            </div>
                            <div class="transaction-block">
                                <div class="transaction-icon shade-blue">
                                    <i class="bi bi-bag-check"></i>
                                </div>
                                <div class="transaction-details">
                                    <h4>Shopping</h4>
                                    <p class="text-truncate">Bill Paid</p>
                                </div>
                                <div class="transaction-amount text-blue">$285</div>
                            </div>
                            <div class="transaction-block">
                                <div class="transaction-icon shade-green">
                                    <i class="bi bi-boxes"></i>
                                </div>
                                <div class="transaction-details">
                                    <h4>Bank</h4>
                                    <p class="text-truncate">Investment</p>
                                </div>
                                <div class="transaction-amount text-green">$150</div>
                            </div>
                            <div class="transaction-block">
                                <div class="transaction-icon shade-green">
                                    <i class="bi bi-paypal"></i>
                                </div>
                                <div class="transaction-details">
                                    <h4>Paypal</h4>
                                    <p class="text-truncate">Amount Received</p>
                                </div>
                                <div class="transaction-amount text-green">$790</div>
                            </div>
                            <div class="transaction-block">
                                <div class="transaction-icon shade-blue">
                                    <i class="bi bi-credit-card-2-front"></i>
                                </div>
                                <div class="transaction-details">
                                    <h4>Credit Card</h4>
                                    <p class="text-truncate">Online Shopping</p>
                                </div>
                                <div class="transaction-amount text-red">$280</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tasks</div>
                </div>
                <div class="card-body">
                    <div id="taskGraph"></div>
                    <ul class="task-list-container">
                        <li class="task-list-item">
                            <div class="task-icon shade-blue">
                                <i class="bi bi-clipboard-plus"></i>
                            </div>
                            <div class="task-info">
                                <h5 class="task-title">New</h5>
                                <p class="amount-spend">12</p>
                            </div>
                        </li>
                        <li class="task-list-item">
                            <div class="task-icon shade-green">
                                <i class="bi bi-clipboard-check"></i>
                            </div>
                            <div class="task-info">
                                <h5 class="task-title">Done</h5>
                                <p class="amount-spend">15</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->
@endsection

@section('script')

    <script src="{{asset('vendor/apex/apexcharts.min.js')}}"></script>
    <script src="{{asset('vendor/apex/custom/sales/salesGraph.js')}}"></script>
    <script src="{{asset('vendor/apex/custom/sales/revenueGraph.js')}}"></script>
    <script src="{{asset('vendor/apex/custom/sales/taskGraph.js')}}"></script>

@endsection