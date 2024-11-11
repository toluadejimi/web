<!-- navbar-wrapper start -->
<nav class="navbar-wrapper bg--dark">
    <div class="navbar__left">
        <button type="button" class="res-sidebar-open-btn me-3 flex-shrink-0"><i class="las la-bars"></i></button>
        <form class="navbar-search">
            <input type="search" name="#0" class="navbar-search-field" id="searchInput" autocomplete="off"
                placeholder="@lang('Search here...')">
            <i class="las la-search"></i>
            <ul class="search-list"></ul>
        </form>
    </div>
    <div class="navbar__right">
        <ul class="navbar__action-list align-items-center">

            <li class="dropdown d-flex align-items-center gap-2">

                @permit('admin.domains')
                    <a href="{{ route('admin.domains') }}" class="primary--layer systemSetting" title="@lang('Domains')" data-bs-placement="bottom">
                        <i class="las la-globe text--primary"></i>
                    </a> 
                @endpermit
                @permit('admin.services')
                    <a href="{{ route('admin.services') }}" class="primary--layer systemSetting" title="@lang('Services')" data-bs-placement="bottom">
                        <i class="las la-server text--primary"></i>
                    </a>
                @endpermit
                @permit('admin.notifications')
                    <button type="button" class="primary--layer p-0" data-bs-toggle="dropdown" data-display="static"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="las la-bell text--primary @if($adminNotificationCount > 0) icon-left-right @endif"></i>
                    </button>
                @endpermit
                @permit('admin.system.setting')
                    <a href="{{ route('admin.system.setting') }}" class="primary--layer systemSetting" title="@lang('System Setting')" data-bs-placement="bottom">
                        <i class="las la-wrench text--primary"></i>
                    </a>  
                @endpermit
                <div class="dropdown-menu dropdown-menu--md p-0 border-0 box--shadow1 dropdown-menu-right">
                    <div class="dropdown-menu__header">
                        <span class="caption">@lang('Notification')</span>
                        @if($adminNotificationCount > 0)
                            <p>@lang('You have') {{ $adminNotificationCount }} @lang('unread notification')</p>
                        @else
                            <p>@lang('No unread notification found')</p>
                        @endif
                    </div>
                    <div class="dropdown-menu__body">
                        @foreach($adminNotifications as $notification)
                            <a href="{{ permit('admin.notification.read') ? route('admin.notification.read',$notification->id) : 'javascript:void(0)' }}"
                                class="dropdown-menu__item">
                                <div class="navbar-notifi">
                                    <div class="navbar-notifi__right">
                                        <h6 class="notifi__title">{{ __($notification->title) }}</h6>
                                        <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
                                    </div>
                                </div><!-- navbar-notifi end -->
                            </a>
                        @endforeach
                    </div>
                    <div class="dropdown-menu__footer">
                        <a href="{{ route('admin.notifications') }}"
                            class="view-all-message">@lang('View all notification')</a>
                    </div>
                </div>
            </li>

            <li class="d-flex flex-wrap align-items-center">
                <div class="dropdown">
                    <button type="button" class="" data-bs-toggle="dropdown" data-display="static" aria-haspopup="true"
                        aria-expanded="false">
                        <span class="navbar-user">
                            <span class="navbar-user__thumb"><img
                                    src="{{ getImage('assets/admin/images/profile/'. auth()->guard('admin')->user()->image) }}"
                                    alt="image"></span>
                            <span class="navbar-user__info">
                                <span
                                    class="navbar-user__name">{{ auth()->guard('admin')->user()->username }}</span>
                            </span>
                            <span class="icon"><i class="las la-chevron-circle-down"></i></span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu--sm p-0 border-0 box--shadow1 dropdown-menu-right">
                        <a href="{{ route('admin.profile') }}"
                            class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                            <i class="dropdown-menu__icon las la-user-circle"></i>
                            <span class="dropdown-menu__caption">@lang('Profile')</span>
                        </a>
    
                        <a href="{{ route('admin.password') }}"
                            class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                            <i class="dropdown-menu__icon las la-key"></i>
                            <span class="dropdown-menu__caption">@lang('Password')</span>
                        </a>
    
                        <a href="{{ route('admin.logout') }}"
                            class="dropdown-menu__item d-flex align-items-center px-3 py-2 adminLogout">
                            <i class="dropdown-menu__icon las la-sign-out-alt"></i>
                            <span class="dropdown-menu__caption">@lang('Logout')</span>
                        </a>
                    </div>
                </div> 
    
                <button type="button" class="breadcum-nav-open ms-2 d-none">
                    <i class="las la-sliders-h"></i>
                </button>
            </li>            
        </ul>
    </div>
</nav>
<!-- navbar-wrapper end -->

@push('style')
    <style>
        @media (max-width: 767px) {
            .res-sidebar-open-btn {
                margin-right: 10px !important;
            }
        }
        @media (max-width: 611px) { 
            .navbar__right {
                margin-left: auto;
                width: 100%;
                margin-top: 8px;
            }
            .navbar__action-list {
                justify-content: space-between;
                width: 100%;
            }
            .navbar-user__info {
                display: block;
            }
            .navbar-user .icon {
                display: block;
            }
            .navbar__left {
                width: 100%;
            }
        }
        @media (max-width: 767px) {
            .navbar__right button i, .navbar__right a i {
                font-size: 20px
            }
        }
        .primary--layer {
            line-height: 1;
        }
    </style>
@endpush