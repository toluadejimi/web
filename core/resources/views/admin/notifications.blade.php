@extends('admin.layouts.app')
@section('panel')
    <div class="notify__area">
    	@forelse($notifications as $notification)

        <a class="notify__item @if($notification->is_read == 0) unread--notification @endif" 
            href="{{ permit('admin.notification.read') ? route('admin.notification.read',$notification->id) : 'javascript:void(0)' }}" 
        >

            <div class="notify__content">
                <h6 class="title">{{ __($notification->title) }}</h6>
                <span class="date"><i class="las la-clock"></i> {{ $notification->created_at->diffForHumans() }}</span>
            </div>
        </a>
        @empty
        <div class="card">
            <div class="card-body">
                <h3 class="text-center">{{ __($emptyMessage) }}</h3>
            </div>
        </div>
        @endforelse
        <div class="mt-3">
            {{ paginateLinks($notifications) }}
        </div>
    </div>
@endsection

@permit('admin.notifications.readAll')
    @push('breadcrumb-plugins')
    <a href="{{ route('admin.notifications.readAll') }}" class="btn btn-sm btn-outline--primary">@lang('Mark All as Read')</a>
    @endpush
@endpermit
