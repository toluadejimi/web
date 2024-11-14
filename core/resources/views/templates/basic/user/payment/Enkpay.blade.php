@extends($activeTemplate.'layouts.master')

@section('content')
    <div class="pt-60 pb-60 section-full" style="background: #f2f2f2;">
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

    <!-- Modal for iframe -->
    <div class="modal fade" id="iframeModal" tabindex="-1" aria-labelledby="iframeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="iframeModalLabel">@lang('Payment')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="iframeContainer" style="text-align: center;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function openIframe() {
            // URL to be loaded in the iframe
            const url = "https://web.sprintpay.online/pay?amount={{ $deposit->final_amo }}&key=23340906095959495&ref={{ random_int(000000000, 999999999) }}&email={{ Auth::user()->email }}";

            // Create iframe element
            const iframe = document.createElement("iframe");
            iframe.src = url;
            iframe.width = "100%";
            iframe.height = "700";
            iframe.style.border = "none";

            // Append iframe to container
            const container = document.getElementById("iframeContainer");
            container.innerHTML = ""; // Clear any existing iframes
            container.appendChild(iframe);

            // Show the modal
            var myModal = new bootstrap.Modal(document.getElementById('iframeModal'));
            myModal.show();
        }
    </script>
@endpush
