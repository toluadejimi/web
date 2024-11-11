<div class="sidebar bg--dark">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{route('admin.dashboard')}}" class="sidebar__main-logo"><img src="{{getImage(getFilePath('logoIcon') .'/logo.png')}}" alt="@lang('image')"></a>
        </div>
 
        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">

                @permit('admin.dashboard')
                    <li class="sidebar-menu-item {{menuActive('admin.dashboard')}}">
                        <a href="{{route('admin.dashboard')}}" class="nav-link ">
                            <i class="menu-icon las la-home"></i>
                            <span class="menu-title">@lang('Dashboard')</span>
                        </a>
                    </li>
                @endpermit

                @permit(['admin.staff.index', 'admin.roles.index', 'admin.permissions.index'])
                    <li class="sidebar-menu-item sidebar-dropdown"> 
                        <a class="{{ menuActive(['admin.staff*', 'admin.roles.*'], 3) }}" href="javascript:void(0)">
                            <i class="menu-icon las la-user-friends"></i>
                            <span class="menu-title">@lang('Manage Staff')</span>
                        </a>
                        <div class="sidebar-submenu {{ menuActive(['admin.staff*', 'admin.roles.*', 'admin.permissions*'], 2) }}">
                            <ul>
                                @permit('admin.staff.index')
                                    <li class="sidebar-menu-item {{ menuActive('admin.staff*') }}">
                                        <a class="nav-link" href="{{ route('admin.staff.index') }}">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('All Staff')</span>
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.roles.index')
                                    <li class="sidebar-menu-item {{ menuActive('admin.roles*') }}">
                                        <a class="nav-link" href="{{ route('admin.roles.index') }}">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Roles')</span>
                                        </a>
                                    </li>
                                @endpermit
                            </ul>
                        </div>
                    </li>
                @endpermit

                @permit([
                    'admin.users.active', 'admin.users.banned', 'admin.users.email.unverified', 'admin.users.mobile.unverified', 
                    'admin.users.kyc.unverified', 'admin.users.kyc.pending', 'admin.users.with.balance', 'admin.users.all', 'admin.users.notification.all'
                ])
                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a href="javascript:void(0)" class="{{menuActive('admin.users*',3)}}">
                            <i class="menu-icon las la-users"></i>
                            <span class="menu-title">@lang('Manage Clients')</span>

                            @if($bannedUsersCount > 0 || $emailUnverifiedUsersCount > 0 || $mobileUnverifiedUsersCount > 0 || $kycUnverifiedUsersCount > 0 || $kycPendingUsersCount > 0)
                                <span class="menu-badge pill bg--danger ms-auto">
                                    <i class="fa fa-exclamation"></i>
                                </span>
                            @endif
                        </a>
                        <div class="sidebar-submenu {{menuActive('admin.users*',2)}} ">
                            <ul>
                                @permit('admin.users.active')
                                    <li class="sidebar-menu-item {{menuActive('admin.users.active')}} ">
                                        <a href="{{route('admin.users.active')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Active Clients')</span>
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.users.banned')
                                    <li class="sidebar-menu-item {{menuActive('admin.users.banned')}} ">
                                        <a href="{{route('admin.users.banned')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Banned Clients')</span>
                                            @if($bannedUsersCount)
                                                <span class="menu-badge pill bg--danger ms-auto">{{$bannedUsersCount}}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.users.email.unverified')
                                    <li class="sidebar-menu-item  {{menuActive('admin.users.email.unverified')}}">
                                        <a href="{{route('admin.users.email.unverified')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Email Unverified')</span>

                                            @if($emailUnverifiedUsersCount)
                                                <span class="menu-badge pill bg--danger ms-auto">{{$emailUnverifiedUsersCount}}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.users.mobile.unverified')
                                    <li class="sidebar-menu-item {{menuActive('admin.users.mobile.unverified')}}">
                                        <a href="{{route('admin.users.mobile.unverified')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Mobile Unverified')</span>
                                            @if($mobileUnverifiedUsersCount)
                                                <span
                                                    class="menu-badge pill bg--danger ms-auto">{{$mobileUnverifiedUsersCount}}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.users.kyc.unverified')
                                    <li class="sidebar-menu-item {{menuActive('admin.users.kyc.unverified')}}">
                                        <a href="{{route('admin.users.kyc.unverified')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('KYC Unverified')</span>
                                            @if($kycUnverifiedUsersCount)
                                                <span class="menu-badge pill bg--danger ms-auto">{{$kycUnverifiedUsersCount}}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.users.kyc.pending')
                                    <li class="sidebar-menu-item {{menuActive('admin.users.kyc.pending')}}">
                                        <a href="{{route('admin.users.kyc.pending')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('KYC Pending')</span>
                                            @if($kycPendingUsersCount)
                                                <span class="menu-badge pill bg--danger ms-auto">{{$kycPendingUsersCount}}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.users.with.balance')
                                    <li class="sidebar-menu-item {{menuActive('admin.users.with.balance')}}">
                                        <a href="{{route('admin.users.with.balance')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('With Balance')</span>
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.users.all')
                                    <li class="sidebar-menu-item {{menuActive('admin.users.all')}} ">
                                        <a href="{{route('admin.users.all')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('All Clients')</span>
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.users.notification.all')
                                    <li class="sidebar-menu-item {{menuActive('admin.users.notification.all')}}">
                                        <a href="{{route('admin.users.notification.all')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Notification to All')</span>
                                        </a>
                                    </li>
                                @endpermit
                            </ul>
                        </div>
                    </li>
                @endpermit

                @permit(['admin.deposit.pending', 'admin.deposit.approved', 'admin.deposit.successful', 'admin.deposit.rejected', 'admin.deposit.initiated', 'admin.deposit.list'])
                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a href="javascript:void(0)" class="{{menuActive('admin.deposit*',3)}}">
                            <i class="menu-icon las la-file-invoice-dollar"></i>
                            <span class="menu-title">@lang('Payments')</span>
                            @if(0 < $pendingDepositsCount)
                                <span class="menu-badge pill bg--danger ms-auto">
                                    <i class="fa fa-exclamation"></i>
                                </span>
                            @endif
                        </a>
                        <div class="sidebar-submenu {{menuActive('admin.deposit*',2)}} ">
                            <ul>
                                @permit('admin.deposit.pending')
                                    <li class="sidebar-menu-item {{menuActive('admin.deposit.pending')}} ">
                                        <a href="{{route('admin.deposit.pending')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Pending Payments')</span>
                                            @if($pendingDepositsCount)
                                                <span class="menu-badge pill bg--danger ms-auto">{{$pendingDepositsCount}}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.deposit.approved')
                                    <li class="sidebar-menu-item {{menuActive('admin.deposit.approved')}} ">
                                        <a href="{{route('admin.deposit.approved')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Approved Payments')</span>
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.deposit.successful')
                                    <li class="sidebar-menu-item {{menuActive('admin.deposit.successful')}} ">
                                        <a href="{{route('admin.deposit.successful')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Successful Payments')</span>
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.deposit.rejected')
                                    <li class="sidebar-menu-item {{menuActive('admin.deposit.rejected')}} ">
                                        <a href="{{route('admin.deposit.rejected')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Rejected Payments')</span>
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.deposit.initiated')
                                    <li class="sidebar-menu-item {{menuActive('admin.deposit.initiated')}} ">
                                        <a href="{{route('admin.deposit.initiated')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Initiated Payments')</span>
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.deposit.list')
                                    <li class="sidebar-menu-item {{menuActive('admin.deposit.list')}} ">
                                        <a href="{{route('admin.deposit.list')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('All Payments')</span>
                                        </a>
                                    </li>
                                @endpermit
                            </ul>
                        </div>
                    </li>
                @endpermit

                @permit(['admin.orders.active', 'admin.orders.pending', 'admin.orders.cancelled', 'admin.orders'])
                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a href="javascript:void(0)" class="{{menuActive('admin.orders*',3)}}">
                            <i class="menu-icon la la-shopping-bag"></i>
                            <span class="menu-title">@lang('Orders') </span>
                            @if(0 < $pendingOrderCount)
                                <span class="menu-badge pill bg--danger ms-auto">
                                    <i class="fa fa-exclamation"></i>
                                </span>
                            @endif
                        </a>
                        <div class="sidebar-submenu {{menuActive('admin.orders*',2)}} ">
                            <ul>
                                @permit('admin.orders.active')
                                    <li class="sidebar-menu-item {{menuActive('admin.orders.active')}} ">
                                        <a href="{{route('admin.orders.active')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Active Orders')</span>
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.orders.pending')
                                    <li class="sidebar-menu-item {{menuActive('admin.orders.pending')}} ">
                                        <a href="{{route('admin.orders.pending')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Pending Orders')</span>
                                            @if($pendingOrderCount)
                                                <span class="menu-badge pill bg--danger ms-auto">{{$pendingOrderCount}}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.orders.cancelled')
                                    <li class="sidebar-menu-item {{menuActive('admin.orders.cancelled')}} ">
                                        <a href="{{route('admin.orders.cancelled')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Cancelled Orders')</span>
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.orders')
                                    <li class="sidebar-menu-item {{menuActive('admin.orders')}} ">
                                        <a href="{{route('admin.orders')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('All Orders')</span>
                                        </a>
                                    </li>
                                @endpermit
                            </ul>
                        </div>
                    </li>
                @endpermit
                
                @permit(['admin.invoices.paid', 'admin.invoices.unpaid', 'admin.invoices.payment.pending', 'admin.invoices.cancelled', 'admin.invoices.refunded', 'admin.invoices'])
                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a href="javascript:void(0)" class="{{menuActive('admin.invoices*',3)}}">
                            <i class="menu-icon la la-file-invoice"></i>
                            <span class="menu-title">@lang('Invoices') </span>
                            @if(0 < $unpaidInvoiceCount)
                                <span class="menu-badge pill bg--danger ms-auto">
                                    <i class="fa fa-exclamation"></i>
                                </span>
                            @endif
                        </a>
                        <div class="sidebar-submenu {{menuActive('admin.invoices*',2)}} ">
                            <ul>
                                @permit('admin.invoices.paid')
                                    <li class="sidebar-menu-item {{menuActive('admin.invoices.paid')}} ">
                                        <a href="{{route('admin.invoices.paid')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Paid Invoices')</span>
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.invoices.unpaid')
                                    <li class="sidebar-menu-item {{menuActive('admin.invoices.unpaid')}} ">
                                        <a href="{{route('admin.invoices.unpaid')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Unpaid Invoices')</span>
                                            @if($unpaidInvoiceCount)
                                                <span class="menu-badge pill bg--danger ms-auto">{{$unpaidInvoiceCount}}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.invoices.payment.pending')
                                    <li class="sidebar-menu-item {{menuActive('admin.invoices.payment.pending')}} ">
                                        <a href="{{route('admin.invoices.payment.pending')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Payment Pending')</span>
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.invoices.cancelled')
                                    <li class="sidebar-menu-item {{menuActive('admin.invoices.cancelled')}} ">
                                        <a href="{{route('admin.invoices.cancelled')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Cancelled Invoices')</span>
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.invoices.refunded')
                                    <li class="sidebar-menu-item {{menuActive('admin.invoices.refunded')}} ">
                                        <a href="{{route('admin.invoices.refunded')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Refunded Invoices')</span>
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.invoices')
                                    <li class="sidebar-menu-item {{menuActive('admin.invoices')}} ">
                                        <a href="{{route('admin.invoices')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('All Invoices')</span>
                                        </a>
                                    </li>
                                @endpermit
                            </ul>
                        </div>
                    </li>
                @endpermit

                @permit(['admin.cancel.request.pending', 'admin.cancel.request.completed', 'admin.cancel.requests'])
                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a href="javascript:void(0)" class="{{menuActive('admin.cancel.request*',3)}}">
                            <i class="menu-icon la la-ban"></i>
                            <span class="menu-title">@lang('Cancellation') </span>
                            @if(0 < $pendingCancelRequestCount)
                                <span class="menu-badge pill bg--danger ms-auto">
                                    <i class="fa fa-exclamation"></i>
                                </span>
                            @endif
                        </a>
                        <div class="sidebar-submenu {{menuActive('admin.cancel.request*',2)}} ">
                            <ul>
                                @permit('admin.cancel.request.pending')
                                    <li class="sidebar-menu-item {{menuActive('admin.cancel.request.pending')}} ">
                                        <a href="{{route('admin.cancel.request.pending')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Pending Requests')</span>
                                            @if($pendingCancelRequestCount)
                                                <span class="menu-badge pill bg--danger ms-auto">{{$pendingCancelRequestCount}}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.cancel.request.completed')
                                    <li class="sidebar-menu-item {{menuActive('admin.cancel.request.completed')}} ">
                                        <a href="{{route('admin.cancel.request.completed')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Completed Requests')</span>
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.cancel.requests')
                                    <li class="sidebar-menu-item {{menuActive('admin.cancel.requests')}} ">
                                        <a href="{{route('admin.cancel.requests')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('All Requests')</span>
                                        </a>
                                    </li>
                                @endpermit
                            </ul>
                        </div>
                    </li>
                @endpermit

                @permit(['admin.ticket.pending', 'admin.ticket.closed', 'admin.ticket.answered', 'admin.ticket.index'])
                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a href="javascript:void(0)" class="{{menuActive('admin.ticket*',3)}}">
                            <i class="menu-icon la la-ticket"></i>
                            <span class="menu-title">@lang('Support Ticket') </span>
                            @if(0 < $pendingTicketCount)
                                <span class="menu-badge pill bg--danger ms-auto">
                                    <i class="fa fa-exclamation"></i>
                                </span>
                            @endif
                        </a>
                        <div class="sidebar-submenu {{menuActive('admin.ticket*',2)}} ">
                            <ul>
                                @permit('admin.ticket.pending')
                                    <li class="sidebar-menu-item {{menuActive('admin.ticket.pending')}} ">
                                        <a href="{{route('admin.ticket.pending')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Pending Ticket')</span>
                                            @if($pendingTicketCount)
                                            <span
                                            class="menu-badge pill bg--danger ms-auto">{{$pendingTicketCount}}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.ticket.closed')
                                    <li class="sidebar-menu-item {{menuActive('admin.ticket.closed')}} ">
                                        <a href="{{route('admin.ticket.closed')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Closed Ticket')</span>
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.ticket.answered')
                                    <li class="sidebar-menu-item {{menuActive('admin.ticket.answered')}} ">
                                        <a href="{{route('admin.ticket.answered')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Answered Ticket')</span>
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.ticket.index')
                                    <li class="sidebar-menu-item {{menuActive('admin.ticket.index')}} ">
                                        <a href="{{route('admin.ticket.index')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('All Ticket')</span>
                                        </a>
                                    </li>
                                @endpermit
                            </ul>
                        </div>
                    </li>
                @endpermit

                @permit(['admin.report.transaction', 'admin.report.login.history', 'admin.report.notification.history'])
                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a href="javascript:void(0)" class="{{menuActive('admin.report*',3)}}">
                            <i class="menu-icon la la-list"></i>
                            <span class="menu-title">@lang('Report') </span>
                        </a>
                        <div class="sidebar-submenu {{menuActive('admin.report*',2)}} ">
                            <ul>
                                @permit('admin.report.transaction')
                                    <li class="sidebar-menu-item {{menuActive(['admin.report.transaction','admin.report.transaction.search'])}}">
                                        <a href="{{route('admin.report.transaction')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Transaction Log')</span>
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.report.login.history')
                                    <li class="sidebar-menu-item {{menuActive(['admin.report.login.history','admin.report.login.ipHistory'])}}">
                                        <a href="{{route('admin.report.login.history')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Login History')</span>
                                        </a>
                                    </li>
                                @endpermit
                                @permit('admin.report.notification.history')
                                    <li class="sidebar-menu-item {{menuActive('admin.report.notification.history')}}">
                                        <a href="{{route('admin.report.notification.history')}}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Notification History')</span>
                                        </a>
                                    </li>
                                @endpermit
                            </ul>
                        </div>
                    </li>
                @endpermit

                @permit('admin.system.setting')
                    @php
                        $active = [
                            'admin.system*', 'admin.setting*', 'admin.billing.setting', 'admin.service.category', 
                            'admin.configurable*', 'admin.server*', 'admin.groups.server', 'admin.tld', 'admin.register.domain',
                            'admin.products', 'admin.product*', 'admin.coupons', 'admin.extensions.index', 
                            'admin.language.manage', 'admin.seo', 'admin.kyc.setting', 'admin.subscriber.index', 'admin.maintenance.mode','admin.gateway*', 'admin.request.report', 'admin.cron*'
                        ];
                    @endphp 
                    <li class="sidebar__menu-header">@lang('Settings')</li>
                    <li class="sidebar-menu-item {{menuActive($active)}}">
                        <a href="{{route('admin.system.setting')}}" class="nav-link">
                            <i class="menu-icon las la-cog"></i>
                            <span class="menu-title">@lang('System Setting')</span>
                        </a>
                    </li>  
                @endpermit

                @permit(['admin.frontend.templates', 'admin.frontend.sections*'])
                    <li class="sidebar__menu-header">@lang('Frontend')</li>

                    @permit('admin.frontend.templates')
                        <li class="sidebar-menu-item {{menuActive(['admin.frontend.templates*'])}}">
                            <a href="{{route('admin.frontend.templates')}}" class="nav-link ">
                                <i class="menu-icon la la-html5"></i>
                                <span class="menu-title">@lang('Manage Templates')</span>
                            </a>
                        </li>
                    @endpermit 
                    @permit('admin.frontend.sections')
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a href="javascript:void(0)" class="{{menuActive('admin.frontend.sections*',3)}}">
                                <i class="menu-icon la la-puzzle-piece"></i>
                                <span class="menu-title">@lang('Manage Section')</span>
                            </a>
                            <div class="sidebar-submenu {{menuActive('admin.frontend.sections*',2)}} ">
                                <ul>
                                    @php
                                    $lastSegment =  collect(request()->segments())->last();
                                    @endphp
                                    @foreach(getPageSections(true) as $k => $secs)
                                        @if($secs['builder'])
                                            <li class="sidebar-menu-item  @if($lastSegment == $k) active @endif ">
                                                <a href="{{ route('admin.frontend.sections',$k) }}" class="nav-link">
                                                    <i class="menu-icon las la-dot-circle"></i>
                                                    <span class="menu-title">{{__($secs['name'])}}</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @endpermit
                @endpermit
 
                @permit(['admin.automation.errors', 'admin.system.update'])
                    <li class="sidebar__menu-header">@lang('Others')</li>

                    @permit('admin.automation.errors')
                        <li class="sidebar-menu-item  {{menuActive('admin.automation.errors')}}">
                            <a href="{{route('admin.automation.errors')}}" class="nav-link" data-default-url="{{ route('admin.automation.errors') }}">
                                <i class="menu-icon las la-exclamation-triangle"></i>
                                <span class="menu-title">@lang('Automation Errors') </span>
                                @if($countAutomationError)
                                    <span class="menu-badge pill bg--danger ms-auto">{{$countAutomationError}}</span>
                                @endif
                            </a>
                        </li>
                    @endpermit
                    @permit('admin.system.update')
                        <li class="sidebar-menu-item {{menuActive('admin.system.update')}} ">
                            <a href="{{route('admin.system.update')}}" class="nav-link">
                                <i class="menu-icon las la-dot-circle"></i>
                                <span class="menu-title">@lang('System Update')</span>
                            </a>
                        </li>
                    @endpermit
                @endpermit

            </ul>
            <div class="text-center mb-3 text-uppercase">
                <span class="text--primary">{{__(systemDetails()['name'])}}</span>
                <span class="text--success">@lang('V'){{systemDetails()['version']}} </span>
            </div>
        </div>
    </div>
</div>
<!-- sidebar end -->

@push('script')
    <script>
        if($('li').hasClass('active')){
            $('#sidebar__menuWrapper').animate({
                scrollTop: eval($(".active").offset().top - 320)
            },500);
        }
    </script>
@endpush
