@php
    $faqs = @getContent('faq.element', orderById: true);
@endphp

<div class="faq-section section-full pt-60 pb-60 bg--light">
    <div class="container">
        <div class="row gy-4">
            @foreach ($faqs->chunk(2) as $faqData)
                <div class="col-lg-6">
                    @foreach ($faqData as $faq)
                        <div class="faq-item">
                            <div class="faq-item__title">
                                <h6 class="title"> {{ __($faq->data_values->question) }}</h6>
                            </div>
                            <div class="faq-item__content">
                                <p>{{ __($faq->data_values->answer) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
