@extends($activeTemplate.'layouts.app')

@section('app')    
    @include($activeTemplate.'partials.auth_header')
    @include($activeTemplate.'partials.breadcrumb')

    @yield('content')

    @include($activeTemplate.'partials.footer')
@endsection 

@push('script')
    <script>
        "user strict";

        $('form').on('submit', function () {
            if ($(this).hasClass('form')) { 
                return false;
            }
            if ($(this).hasClass('exclude')) { 
                return false;
            }
            if ($(this).valid()) {
                $(':submit', this).attr('disabled', 'disabled');
            }
        });

    </script>
@endpush


