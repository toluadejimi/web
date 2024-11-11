@props([
    'placeholder' => 'Search...',
    'btn' => 'btn--primary',
    'dateSearch' => 'no',
    'keySearch' => 'yes',
    'class' => '',
]) 

<form action="" method="GET" class="d-flex flex-wrap gap-2">
    @if ($keySearch == 'yes')
        <x-search-key-field placeholder="{{ $placeholder }}" btn="{{ $btn }}" class="{{ $class }}" />
    @endif
    @if ($dateSearch == 'yes')
        <x-search-date-field />
    @endif
</form>