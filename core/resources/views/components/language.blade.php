@if($general->multi_language)
    <select class="langSel form-control-sm w-auto">
        @foreach($language as $item)
            <option value="{{ $item->code }}" @if(session('lang')==$item->code) selected @endif>{{ __($item->name) }}</option>
        @endforeach
    </select>

    @push('script')
        <script>
            (function ($) { 
                "use strict"; 
        
                $(".langSel").on("change", function() {
                    window.location.href = "{{route('home')}}/change/"+$(this).val() ;
                });
        
            })(jQuery);
        </script>
    @endpush
@endif