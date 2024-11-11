@extends('admin.layouts.app')

@section('panel')
<div class="row justify-content-center">
    @if(request()->routeIs('admin.deposit.list') || request()->routeIs('admin.deposit.method') || request()->routeIs('admin.users.deposits') || request()->routeIs('admin.users.deposits.method'))
        <div class="col-xxl-3 col-sm-6 mb-30">
            <div class="widget-two box--shadow2 b-radius--5 bg--success has-link">
                <a href="{{ permit('admin.deposit.successful') ? route('admin.deposit.successful') : 'javascript:void(0)' }}" class="item-link"></a>
                <div class="widget-two__content">
                    <h2 class="text-white">{{ __($general->cur_sym) }}{{ showAmount($successful) }}</h2>
                    <p class="text-white">@lang('Successful Payment')</p>
                </div>
            </div><!-- widget-two end -->
        </div>
        <div class="col-xxl-3 col-sm-6 mb-30">
            <div class="widget-two box--shadow2 b-radius--5 bg--6 has-link">
                <a href="{{ permit('admin.deposit.pending') ? route('admin.deposit.pending') : 'javascript:void(0)' }}" class="item-link"></a>
                <div class="widget-two__content">
                    <h2 class="text-white">{{ __($general->cur_sym) }}{{ showAmount($pending) }}</h2>
                    <p class="text-white">@lang('Pending Payment')</p>
                </div>
            </div><!-- widget-two end -->
        </div>
        <div class="col-xxl-3 col-sm-6 mb-30"> 
            <div class="widget-two box--shadow2 has-link b-radius--5 bg--pink">
                <a href="{{ permit('admin.deposit.rejected') ? route('admin.deposit.rejected') : 'javascript:void(0)' }}" class="item-link"></a>
                <div class="widget-two__content">
                    <h2 class="text-white">{{ __($general->cur_sym) }}{{ showAmount($rejected) }}</h2>
                    <p class="text-white">@lang('Rejected Payment')</p>
                </div>
            </div><!-- widget-two end -->
        </div>
        <div class="col-xxl-3 col-sm-6 mb-30">
            <div class="widget-two box--shadow2 has-link b-radius--5 bg--dark">
                <a href="{{ permit('admin.deposit.initiated') ? route('admin.deposit.initiated') : 'javascript:void(0)' }}" class="item-link"></a>
                <div class="widget-two__content">
                    <h2 class="text-white">{{ __($general->cur_sym) }}{{ showAmount($initiated) }}</h2>
                    <p class="text-white">@lang('Initiated Payment')</p>
                </div>
            </div><!-- widget-two end -->
        </div>
    @endif

    <div class="col-md-12">
        <div class="card b-radius--10">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                        <tr> 
                            <th>@lang('Type')</th>
                            <th>@lang('Gateway | Transaction')</th>
                            <th>@lang('Initiated')</th>
                            <th>@lang('User')</th>
                            <th>@lang('Amount')</th>
                            <th>@lang('Conversion')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Action')</th>
                        </tr> 
                        </thead>
                        <tbody>
                        @forelse($deposits as $deposit)
                            @php
                                $details = $deposit->detail ? json_encode($deposit->detail) : null;
                            @endphp
                            <tr>
                                <td>
                                    @if($deposit->invoice)
                                        @permit('admin.invoices.details')
                                            <a href="{{ route('admin.invoices.details', $deposit->invoice_id) }}" class="fw-bold">@lang('Payment')</a>
                                        @else 
                                            <a href="javascript:void(0)" class="fw-bold">@lang('Payment')</a>
                                        @endpermit
                                    @else
                                        <a href="{{ permit('admin.deposit.details') ? route('admin.deposit.details', $deposit->id) : 'javascript:void(0)' }}" class="fw-bold">
                                            @lang('Deposit')
                                        </a>
                                    @endif
                                </td>
                                <td>
                                     <span class="fw-bold"> <a href="{{ appendQuery('method',@$deposit->gateway->alias) }}">{{ __(@$deposit->gateway->name) }}</a> </span>
                                     <br>
                                     <small> {{ $deposit->trx }} </small>
                                </td>

                                <td>
                                    {{ showDateTime($deposit->created_at) }}<br>{{ diffForHumans($deposit->created_at) }}
                                </td>
                                <td>
                                    <span class="fw-bold">{{ $deposit->user->fullname }}</span>
                                    <br>
                                    <span class="small">
                                    <a href="{{ appendQuery('search',@$deposit->user->username) }}"><span>@</span>{{ $deposit->user->username }}</a>
                                    </span>
                                </td>
                                <td>
                                   {{ __($general->cur_sym) }}{{ showAmount($deposit->amount ) }} + <span class="text-danger" title="@lang('charge')">{{ showAmount($deposit->charge)}} </span>
                                    <br>
                                    <strong title="@lang('Amount with charge')">
                                    {{ showAmount($deposit->amount+$deposit->charge) }} {{ __($general->cur_text) }}
                                    </strong>
                                </td>
                                <td>
                                   1 {{ __($general->cur_text) }} =  {{ showAmount($deposit->rate) }} {{__($deposit->method_currency)}}
                                    <br>
                                    <strong>{{ showAmount($deposit->final_amo) }} {{__($deposit->method_currency)}}</strong>
                                </td>
                                <td>
                                    @php echo $deposit->statusBadge @endphp
                                </td>
                                <td>
                                    @permit('admin.deposit.details')
                                        <a href="{{ route('admin.deposit.details', $deposit->id) }}"
                                        class="btn btn-sm btn-outline--primary ms-1">
                                            <i class="la la-desktop"></i> @lang('Details')
                                        </a>
                                    @else 
                                        <button class="btn btn-sm btn-outline--primary ms-1" disabled>
                                            <i class="la la-desktop"></i> @lang('Details')
                                        </button>
                                    @endpermit
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table><!-- table end -->
                </div>
            </div>
            @if ($deposits->hasPages())
            <div class="card-footer py-4">
                @php echo paginateLinks($deposits) @endphp
            </div>
            @endif
        </div><!-- card end -->
    </div>
</div>


@endsection


@push('breadcrumb-plugins')
<div class="d-flex flex-wrap justify-content-end gap-2 align-items-center">
    @if(!@$invoice)
        @if(!request()->routeIs('admin.users.deposits') && !request()->routeIs('admin.users.deposits.method'))
            <x-search-form dateSearch='yes' placeholder='Trx number/Username' />
        @endif
    @else
        @permit('admin.invoices.details')
            <a href="{{ route('admin.invoices.details', @$invoice->id ?? 0) }}" class="btn btn-sm btn-outline--dark">
        @else 
            <a href="javascript:void(0)" class="btn btn-sm btn-outline--dark">
        @endpermit
            <i class="la la-undo"></i> @lang('Go to Invoice')
        </a>
    @endif
</div>
@endpush 

