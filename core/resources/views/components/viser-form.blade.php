@foreach($formData as $data)
    <div class="form-group">
        <label class="form-label">
            {{ __($data->name) }}
            @if($data->is_required == 'required')
                <span class="text--danger">*</span>
            @endif
        </label>
        @if($data->type == 'text')
            <input type="text"
            class="form-control form--control h-45"
            name="{{ $data->label }}"
            value="{{ old($data->label) }}"
            @if($data->is_required == 'required') required @endif
            >
        @elseif($data->type == 'textarea')
            <textarea
                class="form-control form--control h-45"
                name="{{ $data->label }}"
                @if($data->is_required == 'required') required @endif
            >{{ old($data->label) }}</textarea> 
        @elseif($data->type == 'select')
            <select
                class="form-control form--control h-45 form-select"
                name="{{ $data->label }}"
                @if($data->is_required == 'required') required @endif
            >
                <option value="">@lang('Select One')</option>
                @foreach ($data->options as $item)
                    <option value="{{ $item }}" @selected($item == old($data->label))>{{ __($item) }}</option>
                @endforeach
            </select>
        @elseif($data->type == 'checkbox') 
            @foreach($data->options as $option)
                <div class="form-check">
                    <input
                        class="form-check-input exclude"
                        name="{{ $data->label }}[]"
                        type="checkbox"
                        value="{{ $option }}"
                        id="{{ $data->label }}_{{ titleToKey($option) }}"
                    >
                    <label class="form-check-label" for="{{ $data->label }}_{{ titleToKey($option) }}">{{ $option }}</label>
                </div>
            @endforeach
        @elseif($data->type == 'radio')
            @foreach($data->options as $option)
                <div class="form-check">
                    <input
                    class="form-check-input exclude"
                    name="{{ $data->label }}"
                    type="radio"
                    value="{{ $option }}"
                    id="{{ $data->label }}_{{ titleToKey($option) }}"
                    @checked($option == old($data->label))
                    >
                    <label class="form-check-label" for="{{ $data->label }}_{{ titleToKey($option) }}">{{ $option }}</label>
                </div>
            @endforeach
        @elseif($data->type == 'file')
            <input
            type="file"
            class="form-control form--control h-45"
            name="{{ $data->label }}"
            @if($data->is_required == 'required') required @endif
            accept="@foreach(explode(',',$data->extensions) as $ext) .{{ $ext }}, @endforeach"
            >
            <pre class="text--base mt-1">@lang('Supported mimes'): {{ $data->extensions }}</pre>
        @endif
    </div>
@endforeach


@push('style')
    <style>
        .form-group{
            margin-bottom: 1rem;
        }
        input::file-selector-button{
            height: 45px;
        }
    </style>
@endpush