@extends('admin.layouts.app')

@section('panel')

    @if (@json_decode($general->system_info)->version > systemDetails()['version'])
        <div class="row">
            <div class="col-md-12"> 
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">
                        <h3 class="card-title"> @lang('New Version Available') <button class="btn btn--dark float-end">@lang('Version') {{ json_decode($general->system_info)->version }}</button> </h3>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-dark">@lang('What is the Update?')</h5>
                        <p>
                            <pre class="f-size--24">{{ json_decode($general->system_info)->details }}</pre>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (@json_decode($general->system_info)->message)
        <div class="row">
            @foreach (json_decode($general->system_info)->message as $msg)
                <div class="col-md-12">
                    <div class="alert border border--primary" role="alert">
                        <div class="alert__icon bg--primary">
                            <i class="far fa-bell"></i>
                        </div>
                        <p class="alert__message">@php echo $msg; @endphp</p>
                        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="row gy-4">
        <div class="col-xxl-6 col-xl-12">
            <div class="row gy-4">
                <div>
                    <span class="info-badge">@lang('Clients')</span>
                </div>
                <div class="col-xxl-6 col-xl-6 col-md-6 col-sm-6">
                    <x-widget link="{{ permit('admin.users.all') ? route('admin.users.all') : 'javascript:void(0)' }}" icon="las la-users f-size--56" title="Total Clients" value="{{ $widget['total_users'] }}" bg="primary" />
                </div><!-- dashboard-w1 end -->
                <div class="col-xxl-6 col-xl-6 col-md-6 col-sm-6">
                    <x-widget link="{{ permit('admin.users.active') ? route('admin.users.active') : 'javascript:void(0)' }}" icon="las la-user-check f-size--56" title="Active Clients" value="{{ $widget['verified_users'] }}" bg="success" />
                </div><!-- dashboard-w1 end -->
                <div class="col-xxl-6 col-xl-6 col-md-6 col-sm-6">
                    <x-widget link="{{ permit('admin.users.email.unverified') ? route('admin.users.email.unverified') : 'javascript:void(0)' }}" icon="lar la-envelope f-size--56" title="Email Unverified Clients" value="{{ $widget['email_unverified_users'] }}" bg="danger" />
                </div><!-- dashboard-w1 end -->
                <div class="col-xxl-6 col-xl-6 col-md-6 col-sm-6">
                    <x-widget link="{{ permit('admin.users.mobile.unverified') ? route('admin.users.mobile.unverified') : 'javascript:void(0)' }}" icon="las la-comment-slash f-size--56" title="Mobile Unverified Clients" value="{{ $widget['mobile_unverified_users'] }}" bg="red" />
                </div><!-- dashboard-w1 end -->

                <div>
                    <span class="info-badge">@lang('Orders')</span>
                </div>
                <div class="col-xxl-6 col-xl-6 col-md-6 col-sm-6">
                    <x-widget style="3" link="{{ permit('admin.orders') ? route('admin.orders') : 'javascript:void(0)' }}" icon="las la-shopping-cart" icon_style="1" title="Total Orders" value="{{ $general->cur_sym }}{{ showAmount(@$orderStatistics->total) }}" color="white" />
                </div><!-- dashboard-w1 end -->
                <div class="col-xxl-6 col-xl-6 col-md-6 col-sm-6">
                    <x-widget style="3" link="{{ permit('admin.orders.active') ? route('admin.orders.active') : 'javascript:void(0)' }}" icon="las la-check" icon_style="1" title="Active Orders" value="{{ $general->cur_sym }}{{ showAmount(@$orderStatistics->total_active) }}" color="white" bg="1" />
                </div><!-- dashboard-w1 end -->
                <div class="col-xxl-6 col-xl-6 col-md-6 col-sm-6">
                    <x-widget style="3" link="{{ permit('admin.orders.pending') ? route('admin.orders.pending') : 'javascript:void(0)' }}" icon="las la-spinner" icon_style="1" title="Pending Orders" value="{{ $general->cur_sym }}{{ showAmount(@$orderStatistics->total_pending) }}" color="white" bg="14" />
                </div><!-- dashboard-w1 end -->
                <div class="col-xxl-6 col-xl-6 col-md-6 col-sm-6">
                    <x-widget style="3" link="{{ permit('admin.orders.cancelled') ? route('admin.orders.cancelled') : 'javascript:void(0)' }}" icon="las la-times" icon_style="1" title="Cancelled Orders" value="{{ $general->cur_sym }}{{ showAmount(@$orderStatistics->total_cancelled) }}" color="white" bg="19" />
                </div><!-- dashboard-w1 end -->
            </div>
        </div>

        <div class="col-xxl-6">
            <span class="info-badge-two">@lang('Order Statistics')</span>
            <div class="card full-view">
                <div class="card-header d-flex justify-content-between flex-wrap bg--dark">
                    <div>
                        <small class="time_text text--white"></small> @lang('Orders')
                        <small class="text--white">{{ $general->cur_sym }}</small><span class="total_orders text--white"></span>
                    </div>
                    <div class="d-flex justify-content-sm-end gap-2 mt-2 mt-xl-0 mt-md-0 mt-sm-0">
                        <div>
                            <select name="order_statistics" class="widget_select bg--dark text--white">
                                <option value="today">@lang('Today')</option>
                                <option value="week">@lang('This Week')</option>
                                <option value="month" selected>@lang('This Month')</option>
                                <option value="year">@lang('This Year')</option>
                            </select>
                            <select name="order_status" class="widget_select bg--dark text--white ms-1">
                                <option value="" selected>@lang('All')</option>
                                @foreach ($orderStatus as $status)
                                    <option value="{{ strtolower($status) }}">{{ __($status) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="exit-btn text--white">
                            <i class="fullscreen-open las la-compress" onclick="openFullscreen();"></i>
                            <i class="fullscreen-close las la-compress-arrows-alt" onclick="closeFullscreen();"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="order_canvas">
                        <canvas height="162" id="order_chart" class="mt-4"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- row end-->

    <div class="row gy-4 mt-2">
        <div>
            <span class="info-badge">@lang('Invoices')</span>
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="2" link="{{ permit('admin.invoices.paid') ? route('admin.invoices.paid') : 'javascript:void(0)' }}" icon="las la-money-bill-wave" icon_style="outline" title="Paid Invoices" value="{{ $general->cur_sym }}{{ showAmount(@$invoiceStatistics->total_paid) }}" color="success" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="2" link="{{ permit('admin.invoices.unpaid') ? route('admin.invoices.unpaid') : 'javascript:void(0)' }}" icon="las la-file-invoice" icon_style="outline" title="Unpaid Invoices" value="{{ $general->cur_sym }}{{ showAmount(@$invoiceStatistics->total_unpaid) }}" color="warning" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="2" link="{{ permit('admin.invoices.payment.pending') ? route('admin.invoices.payment.pending') : 'javascript:void(0)' }}" icon="las la-spinner" icon_style="outline" title="Payment Pending Invoices" value="{{ $general->cur_sym }}{{ showAmount(@$invoiceStatistics->total_payment_pending) }}" color="danger" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="2" link="{{ permit('admin.invoices.refunded') ? route('admin.invoices.refunded') : 'javascript:void(0)' }}" icon="las la-hand-holding-usd" icon_style="outline" title="Refunded Invoices" value="{{ $general->cur_sym }}{{ showAmount(@$invoiceStatistics->total_refunded) }}" color="primary" />
        </div>
    </div><!-- row end-->

    @include('admin.partials.cron_modal')
@endsection

@push('breadcrumb-plugins')
    <button class="btn btn-outline--primary" data-bs-toggle="modal" data-bs-target="#cronModal">
        <i class="las la-server"></i>@lang('Cron Setup')
    </button>
@endpush

@push('style')
    <style>
        .exit-btn {
            padding: 0;
            font-size: 30px;
            line-height: 1;
            color: #5b6e88;
            background: transparent;
            border: none;
            transition: all .3s ease;
        }

        .exit-btn .fullscreen-close {
            transition: all 0.3s;
            display: none;
        }

        .exit-btn.active .fullscreen-close {
            display: block;
        }

        .widget_select {
            padding: 3px 3px;
            font-size: 13px;
        }

        .exit-btn.active .fullscreen-open {
            display: none;
        }

        .info-badge {
            top: 40%;
            left: -21px;
            background-color: #5352ed;
            color: #fff;
            font-size: 13px;
            width: 92px;
            height: 22px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
            transform: translateY(10px);
        }

        .info-badge-two {
            top: 40%;
            left: -21px;
            background-color: #5352ed;
            color: #fff;
            font-size: 13px;
            width: 150px;
            height: 22px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
            transform: translateY(10px);
            margin-bottom: 25px;
        }
    </style>
@endpush

@push('script')
    <script src="{{ asset('assets/admin/js/vendor/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/chart.js.2.8.0.js') }}"></script>

    <script>
        "use strict";

        $(document).ready(function() {
            if (@json($showCronModal)) {
                $('#cronModal').modal('show');
            }
        });

        orderGraph();

        $('[name=order_statistics], [name=order_status]').on('change', function() {
            orderGraph();
        });

        function orderGraph() {
            var url = "{{ route('admin.order.statistics') }}";
            var time = $('[name=order_statistics] option:selected').val();
            var text = $('[name=order_statistics] option:selected').text();
            var status = $('[name=order_status] option:selected').val();

            $.get(url, {
                time: time,
                status: status,
            }, function(response) {

                $('.time_text').text(text);
                $('.total_orders').text(response.total_orders ? response.total_orders.toFixed(2) : 0);

                $('.order_canvas').html(
                    '<canvas height="162" id="order_chart" class="mt-4"></canvas>'
                )

                var ctx = document.getElementById('order_chart');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(response.orders ?? []),
                        datasets: [{
                            data: Object.values(response.orders ?? []),
                            backgroundColor: [
                                @for ($i = 0; $i < 365; $i++)
                                    '#6c5ce7',
                                @endfor

                            ],
                            borderColor: [
                                'rgba(231, 80, 90, 0.75)'
                            ],
                            borderWidth: 0,
                        }]
                    },
                    options: {
                        aspectRatio: 1,
                        responsive: true,
                        maintainAspectRatio: true,
                        elements: {
                            line: {
                                tension: 0 // disables bezier curves
                            }
                        },
                        scales: {
                            xAxes: [{
                                display: true
                            }],
                            yAxes: [{
                                display: true
                            }]
                        },
                        legend: {
                            display: false,
                        },
                        tooltips: {
                            callbacks: {
                                label: (tooltipItem, data) => data.datasets[0].data[
                                    tooltipItem.index] + ' {{ $general->cur_text }}'
                            }
                        }
                    }
                });
            });
        }

        var elems = document.querySelector(".full-view");
        $('.exit-btn').on('click', function() {
            $(this).toggleClass('active');
        });

        function openFullscreen() {
            if (elems.requestFullscreen) {
                elems.requestFullscreen();
            } else if (elems.mozRequestFullScreen) {
                /* Firefox */
                elems.mozRequestFullScreen();
            } else if (elems.webkitRequestFullscreen) {
                /* Chrome, Safari & Opera */
                elems.webkitRequestFullscreen();
            } else if (elems.msRequestFullscreen) { 
                /* IE/Edge */
                elems.msRequestFullscreen();
            }
        }

        function closeFullscreen() {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) {
                /* Firefox */
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
                /* Chrome, Safari and Opera */
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
                /* IE/Edge */
                document.msExitFullscreen();
            }
        }
        
    </script>
@endpush
