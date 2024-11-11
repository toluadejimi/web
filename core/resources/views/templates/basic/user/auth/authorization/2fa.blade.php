@extends($activeTemplate .'layouts.frontend')
@section('content')
<div class="pt-120 pb-120 bg--light">
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="verification-code-wrapper"> 
                <div class="verification-area">
                    <h5 class="pb-3 text-center border-bottom">@lang('2FA Verification')</h5>
                    <form action="{{route('user.go2fa.verify')}}" method="POST" class="submit-form">
                        @csrf
      
                        <div class="mt-3">@include($activeTemplate.'partials.verification_code')</div>
    
                        <div class="mb-3">
                            <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection