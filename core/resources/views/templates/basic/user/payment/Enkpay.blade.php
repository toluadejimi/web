@extends($activeTemplate.'layouts.master')

@section('content')
    <div class="pt-60 pb-60 section-full" style="background: #f2f2f2;"> <!-- Background color added here -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card custom--card style-two">
                        <div class="card-header">
                            <h6 class="card-title text-center">{{ __($pageTitle) }}</h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush text-center">
                                <li class="list-group-item d-flex justify-content-between">
                                    @lang('You have to pay ')
                                    <strong>{{ showAmount($deposit->final_amo) }} {{ __($deposit->method_currency) }}</strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn--base w-100 mt-4" id="btn-confirm" onClick="openIframe()">@lang('Pay Now')</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Centered iframe container with padding -->
    <div id="iframeContainer" class="d-flex justify-content-center align-items-center mt-4" style="min-height: 500px; background: #f9f9f9;"></div>
@endsection

@push('script')
    <script>
        function openIframe() {
            // URL to be loaded in the iframe
            const url = "https://web.sprintpay.online/pay?amount={{ $deposit->final_amo }}&key=23340906095959495&ref={{ random_int(000000000, 999999999) }}&email={{ Auth::user()->email }}";

            // Create iframe element
            const iframe = document.createElement("iframe");
            iframe.src = url;
            iframe.width = "600";
            iframe.height = "400";
            iframe.style.border = "none";

            // Append iframe to container
            const container = document.getElementById("iframeContainer");
            container.innerHTML = ""; // Clear any existing iframes
            container.appendChild(iframe);
        }
    </script>
@endpush
