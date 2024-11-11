@extends($activeTemplate.'layouts.frontend')

@section('content') 
<div class="pt-60 pb-60 bg--light section-full">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card custom--card style-two"> 
                    <div class="card-header">
                        <h6 class="card-title text-center">{{ __($pageTitle) }}</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.data.submit') }}">
                            @csrf
                            <div class="row gy-4"> 
                                <div class="col-sm-6"> 
                                    <div class="form-group">
                                        <label>@lang('First Name') <span class="text--danger">*</span></label>
                                        <input type="text" class="form-control form--control h-45" name="firstname" value="{{ old('firstname') }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>@lang('Last Name') <span class="text--danger">*</span></label>
                                        <input type="text" class="form-control form--control h-45" name="lastname" value="{{ old('lastname') }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>@lang('Address')</label>
                                        <input type="text" class="form-control form--control h-45" name="address" value="{{ old('address') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>@lang('State')</label>
                                        <input type="text" class="form-control form--control h-45" name="state" value="{{ old('state') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>@lang('Zip Code')</label>
                                        <input type="text" class="form-control form--control h-45" name="zip" value="{{ old('zip') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>@lang('City')</label>
                                        <input type="text" class="form-control form--control h-45" name="city" value="{{ old('city') }}">
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
