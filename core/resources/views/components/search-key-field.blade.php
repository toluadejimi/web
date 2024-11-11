@props(['placeholder' => 'Search...', 'btn' => 'btn--primary', 'class'=>''])
<div class="input-group w-auto flex-fill">
    <input type="search" name="search" class="form-control bg--white {{ $class }}" placeholder="{{ __($placeholder) }}" value="{{ request()->search }}">
    <button class="btn {{ $btn }}" type="submit"><i class="la la-search"></i></button>
</div>  