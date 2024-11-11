<ul class="nav nav-tabs mb-4 topTap breadcum-nav" role="tablist">
    <button class="breadcum-nav-close"><i class="las la-times"></i></button>
    <li class="nav-item" role="presentation">
        @permit('admin.setting.notification.global')
            <a href="{{ route('admin.setting.notification.global') }}" class="nav-link text-dark" type="button">
                <i class="las la-globe"></i> @lang('Global Template')
            </a>
        @else 
            <a href="javascript:void(0)" class="nav-link text-dark disabled" type="button">
                <i class="las la-globe"></i> @lang('Global Template')
            </a>
        @endpermit
    </li>
    <li class="nav-item" role="presentation">
        @permit('admin.setting.notification.email')
            <a href="{{ route('admin.setting.notification.email') }}" class="nav-link text-dark" type="button">
                <i class="las la-envelope"></i> @lang('Email Setting')
            </a>
        @else 
            <a href="javascript:void(0)" class="nav-link text-dark disabled" type="button">
                <i class="las la-envelope"></i> @lang('Email Setting')
            </a>
        @endpermit
    </li>
    <li class="nav-item" role="presentation">
        @permit('admin.setting.notification.sms')
            <a href="{{ route('admin.setting.notification.sms') }}" class="nav-link text-dark" type="button">
                <i class="las la-sms"></i> @lang('SMS Setting')
            </a>
        @else 
            <a href="javascript:void(0)" class="nav-link text-dark disabled" type="button">
                <i class="las la-sms"></i> @lang('SMS Setting')
            </a>
        @endpermit
    </li>
    <li class="nav-item" role="presentation">
        @permit('admin.setting.notification.templates')
            <a href="{{ route('admin.setting.notification.templates') }}" class="nav-link text-dark" type="button">
                <i class="las la-bell"></i> @lang('Notification Templates')
            </a>
        @else 
            <a href="javascript:void(0)" class="nav-link text-dark disabled" type="button">
                <i class="las la-bell"></i> @lang('Notification Templates')
            </a>
        @endpermit
    </li>
</ul>

@push('script')
<script> 
    (function($) {
        "use strict";
       
        $(`.topTap li a[href='{{ url()->current() }}']`).addClass('active text--primary');
        $(`.topTap li a[href='{{ url()->current() }}']`).closest('li').addClass('active text--primary');

        $('.breadcum-nav-open').on('click', function(){
            $(this).toggleClass('active');
            $('.breadcum-nav').toggleClass('active');
        });

        $('.breadcum-nav-close').on('click', function(){
            $('.breadcum-nav').removeClass('active');
        });

    })(jQuery);
</script>
@endpush

@push('style')
<style>
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{
        background-color: #f3f3f9;
        border-color: #dee2e6 #dee2e6 #f3f3f9;
    }
</style>
@endpush