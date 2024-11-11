<ul class="nav nav-tabs mb-4 topTap breadcum-nav" role="tablist">
    <button class="breadcum-nav-close"><i class="las la-times"></i></button>
    <li class="nav-item" role="presentation">
      @permit('admin.gateway.automatic.index')
        <a href="{{ route('admin.gateway.automatic.index') }}" class="nav-link text-dark" type="button">
      @else 
        <a href="javascript:void(0)" class="nav-link text-dark disabled" type="button">
      @endpermit
        <i class="las la-money-bill-wave"></i> @lang('Automatic Gateways')
        </a>
    </li>
    <li class="nav-item" role="presentation">
        @permit('admin.gateway.manual.index')
            <a href="{{ route('admin.gateway.manual.index') }}" class="nav-link text-dark" type="button">
        @else 
            <a href="javascript:void(0)" class="nav-link text-dark disabled" type="button">
        @endpermit
            <i class="las la-hand-holding-usd"></i> @lang('Manual Gateways')
        </a>
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