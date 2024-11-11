@extends($activeTemplate . 'layouts.auth')

@php
    $policyPages = getContent('policy_pages.element', orderById: true);
@endphp

@section('auth')
    <form action="{{ route('user.register') }}" class="account-form verify-gcaptcha" method="POST">
        @csrf
        <div class="mb-4">
            <h4 class="mb-2">@lang('Create an Account')</h4>
            <p>@lang('You can create account using email or username and the registration is fully free')</p>
        </div>
        <div class="row gy-3">
            @if (session()->get('reference') != null)
                <div class="col-12">
                    <div class="form-group">
                        <label>@lang('Reference by') <span class="text--danger">*</span></label>
                        <input type="text" name="referBy" class="form-control form--control h-45" value="{{ session()->get('reference') }}" readonly>
                    </div>
                </div>
            @endif
            <div class="col-12">
                <div class="form-group">
                    <label>@lang('Username') <span class="text--danger">*</span></label>
                    <input type="text" name="username" value="{{ old('username') }}" class="form-control form--control h-45 checkUser" required>
                    <small class="text--danger usernameExist"></small>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label>@lang('E-Mail Address') <span class="text--danger">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control form--control h-45 checkUser" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>@lang('Country') <span class="text--danger">*</span></label>
                    <select name="country" class="form-select form--control h-45">
                        @foreach ($countries as $key => $country)
                            <option data-mobile_code="{{ $country->dial_code }}" value="{{ $country->country }}" data-code="{{ $key }}">
                                {{ __($country->country) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>@lang('Mobile') <span class="text--danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text mobile-code"></span>
                        <input type="hidden" name="mobile_code">
                        <input type="hidden" name="country_code">
                        <input type="number" name="mobile" value="{{ old('mobile') }}" class="form-control form--control h-45 checkUser" required>
                    </div>
                    <small class="text--danger mobileExist"></small>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label>@lang('Password') <span class="text--danger">*</span></label>
                    <div class="input-group">
                        <input type="password" class="form-control form--control h-45" name="password" required>
                        @if ($general->secure_password)
                            <div class="input-popup">
                                <p class="error lower">@lang('1 small letter minimum')</p>
                                <p class="error capital">@lang('1 capital letter minimum')</p>
                                <p class="error number">@lang('1 number minimum')</p>
                                <p class="error special">@lang('1 special character minimum')</p>
                                <p class="error minimum">@lang('6 character password')</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label>@lang('Confirm Password') <span class="text--danger">*</span></label>
                    <input type="password" class="form-control form--control h-45" name="password_confirmation" required>
                </div>
            </div>

            <x-captcha />

            @if ($general->agree)
                <div class="col-12">
                    <div class="d-flex flex-wrap gap-2 justify-content-between">
                        <div class="form-group custom--checkbox">
                            <input type="checkbox" id="agree" @checked(old('agree')) name="agree" class="form-check-input" required>
                            <label for="agree">@lang('I agree with')</label>

                            @foreach ($policyPages as $policy)
                                <a href="{{ route('policy.pages', [slug($policy->data_values->title), $policy->id]) }}" target="_blank">
                                    {{ __($policy->data_values->title) }}
                                </a> {{ !$loop->last ? ',' : null }}
                            @endforeach

                        </div>
                    </div>
                </div>
            @endif
            <div class="col-12">
                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
            </div>
            <div class="col-12">
                <p class="text-center">
                    @lang('Have an account?') <a href="{{ route('user.login') }}" class="fw-bold text--base">@lang('Login Here')</a>
                </p>
            </div>
        </div>
    </form>

    <div class="modal fade" id="existModalCenter" tabindex="-1" role="dialog" aria-labelledby="existModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="existModalLongTitle">@lang('You are with us')</h5>
                    <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <span class="text-center d-block">@lang('You already have an account please Login ')</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark btn--sm" data-bs-dismiss="modal">@lang('Close')</button>
                    <a href="{{ route('user.login') }}" class="btn btn--base btn--sm">@lang('Login')</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@if ($general->secure_password)
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif

@push('script')
    <script>
        "use strict";
        (function($) {
            @if ($mobileCode)
                $(`option[data-code={{ $mobileCode }}]`).attr('selected', '');
            @endif

            $('select[name=country]').change(function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            });
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));

            $('.checkUser').on('focusout', function(e) {
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';
                if ($(this).attr('name') == 'mobile') {
                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    var data = {
                        mobile: mobile,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'email') {
                    var data = {
                        email: value,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response.data != false && response.type == 'email') {
                        $('#existModalCenter').modal('show');
                    } else if (response.data != false) {
                        $(`.${response.type}Exist`).text(`${response.type} already exist`);
                    } else {
                        $(`.${response.type}Exist`).text('');
                    }
                });
            });
        })(jQuery);
    </script>
@endpush
