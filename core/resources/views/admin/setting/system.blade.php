@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-8 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group position-relative mb-0">
                                <div class="system-search-icon"><i class="las la-search"></i></div>
                                <input class="form-control systemSearch" type="text" name="systemSearch" placeholder="@lang('Search')...">
                                <div class="system-search-icon-reset"><i class="las la-times"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           
            <div class="row gy-4">
                <div class="emptyArea"></div>

                @permit('admin.setting.index')
                    <div class="col-xxl-6 col-sm-6 settingItems">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.setting.index')}}" class="item-link"></a>
                            <i class="las la-cog overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-cog"></i>
                            </div>
                            <div class="widget-two__content">
                                <h3>@lang('General Settings')</h3>
                                <p>@lang('General settings and configuration')</p>
                            </div>
                        </div>
                    </div>
                @endpermit

                @permit('admin.setting.system.configuration')
                    <div class="col-xxl-6 col-sm-6 settingItems">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.setting.system.configuration')}}" class="item-link"></a>
                            <i class="las la-cogs overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-cogs"></i>
                            </div>
                            <div class="widget-two__content">
                                <h3>@lang('System Configuration')</h3>
                                <p>@lang('System settings and configuration')</p>
                            </div>
                        </div>
                    </div>
                @endpermit

                @permit('admin.billing.setting')
                    <div class="col-xxl-6 col-sm-6 settingItems">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.billing.setting')}}" class="item-link"></a>
                            <i class="las la-file-alt overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-file-alt"></i>
                            </div>
                            <div class="widget-two__content">
                                <h3>@lang('Billing Settings')</h3>
                                <p>@lang('Manage billing setting')</p>
                            </div>
                        </div>
                    </div>
                @endpermit

                @permit('admin.service.category')
                    <div class="col-xxl-6 col-sm-6 settingItems">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.service.category')}}" class="item-link"></a>
                            <i class="fab fa-servicestack overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="fab fa-servicestack"></i>
                            </div>
                            <div class="widget-two__content">
                                <h3>@lang('Service Categories')</h3>
                                <p>@lang('Manage categories')</p>
                            </div>
                        </div>
                    </div>
                @endpermit

                @permit('admin.configurable.groups')
                    <div class="col-xxl-6 col-sm-6 settingItems">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.configurable.groups')}}" class="item-link"></a>
                            <i class="las la-sliders-h overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-sliders-h"></i>
                            </div>
                            <div class="widget-two__content"> 
                                <h3>@lang('Configuration')</h3>
                                <p>@lang('Manage extras and options for products')</p>
                            </div>
                        </div>
                    </div>
                @endpermit

                @permit('admin.gateway.automatic.index')
                    <div class="col-xxl-6 col-sm-6 settingItems" data-setting="Invoices">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.gateway.automatic.index')}}" class="item-link"></a>
                            <i class="las la-university overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-university"></i> 
                            </div> 
                            <div class="widget-two__content"> 
                                <h3>@lang('Payment Gateways')</h3>
                                <p>@lang('Setup and manage payment gateways')</p>
                            </div>
                        </div>
                    </div>
                @endpermit

                @permit('admin.groups.server')
                    <div class="col-xxl-6 col-sm-6 settingItems">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.groups.server')}}" class="item-link"></a>
                            <i class="las la-server overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-server"></i>
                            </div>
                            <div class="widget-two__content">
                                <h3>@lang('Server Groups')</h3>
                                <p>@lang('Manage server groups')</p>
                            </div>
                        </div>
                    </div>
                @endpermit

                @permit('admin.servers')
                    <div class="col-xxl-6 col-sm-6 settingItems">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.servers')}}" class="item-link"></a>
                            <i class="las la-server overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-server"></i>
                            </div>
                            <div class="widget-two__content">
                                <h3>@lang('Servers')</h3>
                                <p>@lang('Configure and manage your servers')</p>
                            </div>
                        </div>
                    </div>
                @endpermit

                @permit('admin.tld')
                    <div class="col-xxl-6 col-sm-6 settingItems">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.tld')}}" class="item-link"></a>
                            <i class="las la-table overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-table"></i>
                            </div>
                            <div class="widget-two__content">
                                <h3>@lang('Domain Pricing/TLDS')</h3>
                                <p>@lang('Setup domain extensions and pricing')</p>
                            </div>
                        </div>
                    </div>
                @endpermit 

                @permit('admin.register.domain')
                    <div class="col-xxl-6 col-sm-6 settingItems">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.register.domain')}}" class="item-link"></a>
                            <i class="las la-globe overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-globe"></i>
                            </div>
                            <div class="widget-two__content">
                                <h3>@lang('Domain Registers')</h3>
                                <p>@lang('Configure and manage registers')</p>
                            </div>
                        </div>
                    </div>
                @endpermit

                @permit('admin.products')
                    <div class="col-xxl-6 col-sm-6 settingItems">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.products')}}" class="item-link"></a>
                            <i class="las la-cube overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-cube"></i>
                            </div>
                            <div class="widget-two__content">
                                <h3>@lang('Products/Services')</h3>
                                <p>@lang('Setup and manage products')</p>
                            </div> 
                        </div>
                    </div>
                @endpermit

                @permit('admin.coupons')
                    <div class="col-xxl-6 col-sm-6 settingItems">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.coupons')}}" class="item-link"></a>
                            <i class="las la-ticket-alt overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-ticket-alt"></i>
                            </div> 
                            <div class="widget-two__content">
                                <h3>@lang('Coupon')</h3>
                                <p>@lang('Setup and manage coupn codes')</p>
                            </div>
                        </div> 
                    </div>
                @endpermit

                @permit('admin.orders')
                    <div class="col-xxl-6 col-sm-6 settingItems">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.orders')}}" class="item-link"></a>
                            <i class="las la-shopping-cart overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-shopping-cart"></i>
                            </div> 
                            <div class="widget-two__content">
                                <h3>@lang('Orders')</h3>
                                <p>@lang('Manage orders')</p>
                            </div>
                        </div> 
                    </div>
                @endpermit

                @permit('admin.invoices')
                    <div class="col-xxl-6 col-sm-6 settingItems" data-setting="Invoices">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.invoices')}}" class="item-link"></a>
                            <i class="las la-file-alt overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-file-alt"></i>
                            </div> 
                            <div class="widget-two__content">
                                <h3>@lang('Invoices')</h3>
                                <p>@lang('Manage invoices')</p>
                            </div>
                        </div>
                    </div>
                @endpermit

                @permit('admin.setting.logo.icon')
                    <div class="col-xxl-6 col-sm-6 settingItems" data-setting="Invoices">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.setting.logo.icon')}}" class="item-link"></a>
                            <i class="las la-images overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-images"></i>
                            </div> 
                            <div class="widget-two__content">
                                <h3>@lang('Logo & Favicon')</h3>
                                <p>@lang('Site icons and logo upload here')</p>
                            </div>
                        </div>
                    </div>
                @endpermit

                @permit('admin.extensions.index')
                    <div class="col-xxl-6 col-sm-6 settingItems" data-setting="Invoices">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.extensions.index')}}" class="item-link"></a>
                            <i class="las la-cogs overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-cogs"></i>
                            </div> 
                            <div class="widget-two__content">
                                <h3>@lang('Extensions')</h3>
                                <p>@lang('Configure and manage extensions')</p>
                            </div>
                        </div>
                    </div>
                @endpermit

                @permit('admin.language.manage')
                    <div class="col-xxl-6 col-sm-6 settingItems" data-setting="Invoices">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.language.manage')}}" class="item-link"></a>
                            <i class="las la-language overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-language"></i>
                            </div> 
                            <div class="widget-two__content">
                                <h3>@lang('Language')</h3>
                                <p>@lang('Configure site language')</p>
                            </div>
                        </div>
                    </div>
                @endpermit

                @permit('admin.seo')
                    <div class="col-xxl-6 col-sm-6 settingItems" data-setting="Invoices">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.seo')}}" class="item-link"></a>
                            <i class="las la-globe-americas overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-globe-americas"></i>
                            </div> 
                            <div class="widget-two__content">
                                <h3>@lang('SEO Manager')</h3>
                                <p>@lang('Setup meta keywords, description and social title for SEO')</p>
                            </div>
                        </div>
                    </div>
                @endpermit

                @permit('admin.kyc.setting')
                    <div class="col-xxl-6 col-sm-6 settingItems" data-setting="Invoices">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.kyc.setting')}}" class="item-link"></a>
                            <i class="las la-user-check overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-user-check"></i>
                            </div> 
                            <div class="widget-two__content">
                                <h3>@lang('KYC Setting')</h3>
                                <p>@lang('Setup KYC setting to know your customer and verify')</p>
                            </div>
                        </div>
                    </div>
                @endpermit

                @permit('admin.subscriber.index')
                    <div class="col-xxl-6 col-sm-6 settingItems" data-setting="Invoices">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.subscriber.index')}}" class="item-link"></a>
                            <i class="las la-thumbs-up overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-thumbs-up"></i>
                            </div> 
                            <div class="widget-two__content">
                                <h3>@lang('Subscribers')</h3>
                                <p>@lang('View all subscribers ')</p>
                            </div>
                        </div>
                    </div>
                @endpermit

                @permit('admin.maintenance.mode')
                    <div class="col-xxl-6 col-sm-6 settingItems" data-setting="Invoices">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.maintenance.mode')}}" class="item-link"></a>
                            <i class="las la-robot overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-robot"></i>
                            </div> 
                            <div class="widget-two__content">
                                <h3>@lang('Maintenance Mode')</h3>
                                <p>@lang('Website in under construction mode')</p>
                            </div>
                        </div>
                    </div>
                @endpermit

                @permit('admin.setting.cookie')
                    <div class="col-xxl-6 col-sm-6 settingItems" data-setting="Invoices">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.setting.cookie')}}" class="item-link"></a>
                            <i class="las la-cookie-bite overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-cookie-bite"></i>
                            </div> 
                            <div class="widget-two__content">
                                <h3>@lang('GDPR Cookie')</h3>
                                <p>@lang('The General Data Protection Regulation (GDPR) is the toughest privacy and security law in the world')</p>
                            </div>
                        </div>
                    </div> 
                @endpermit

                @permit('admin.setting.custom.css')
                    <div class="col-xxl-6 col-sm-6 settingItems" data-setting="Invoices">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.setting.custom.css')}}" class="item-link"></a>
                            <i class="fab fa-css3-alt overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="fab fa-css3-alt"></i>
                            </div> 
                            <div class="widget-two__content"> 
                                <h3>@lang('Custom CSS')</h3>
                                <p>@lang('Add your own CSS code here to customize the layout of your site')</p>
                            </div>
                        </div>
                    </div>
                @endpermit

                @permit('admin.system.info')
                    <div class="col-xxl-6 col-sm-6 settingItems" data-setting="Invoices">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.system.info')}}" class="item-link"></a>
                            <i class="las la-server overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-server"></i>
                            </div> 
                            <div class="widget-two__content"> 
                                <h3>@lang('System Information')</h3>
                                <p>@lang('This page can show you every detail about the configuration of your laravel website')</p>
                            </div>
                        </div>
                    </div>
                @endpermit

                @permit('admin.setting.notification.global')
                    <div class="col-xxl-6 col-sm-6 settingItems" data-setting="Invoices">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.setting.notification.global')}}" class="item-link"></a>
                            <i class="las la-bell overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-bell"></i>
                            </div> 
                            <div class="widget-two__content"> 
                                <h3>@lang('Notification Setting')</h3>
                                <p>@lang('Configure notification setting')</p>
                            </div>
                        </div>
                    </div>
                @endpermit

                @permit('admin.cancel.requests')
                    <div class="col-xxl-6 col-sm-6 settingItems" data-setting="Invoices">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.cancel.requests')}}" class="item-link"></a>
                            <i class="las la-ban overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-ban"></i>
                            </div> 
                            <div class="widget-two__content"> 
                                <h3>@lang('Cancellation Requests')</h3>
                                <p>@lang('Manage cancellation requests')</p>
                            </div>
                        </div>
                    </div> 
                @endpermit

                @permit('admin.automation.errors')
                    <div class="col-xxl-6 col-sm-6 settingItems" data-setting="Invoices">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.automation.errors')}}" class="item-link"></a>
                            <i class="las la-exclamation-triangle overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-exclamation-triangle"></i>
                            </div> 
                            <div class="widget-two__content"> 
                                <h3>@lang('Automation Errors')</h3>
                                <p>@lang('Failed module actions')</p>
                            </div>
                        </div>
                    </div>
                @endpermit

                @permit('admin.request.report')
                    <div class="col-xxl-6 col-sm-6 settingItems" data-setting="Invoices">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.request.report')}}" class="item-link"></a>
                            <i class="las la-bug overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-bug"></i>
                            </div> 
                            <div class="widget-two__content"> 
                                <h3>@lang('Report & Request')</h3>
                                <p>@lang('Submit your report and request')</p>
                            </div>
                        </div>
                    </div>
                @endpermit

                @permit('admin.domains')
                    <div class="col-xxl-6 col-sm-6 settingItems" data-setting="Invoices">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.domains')}}" class="item-link"></a>
                            <i class="las la-globe overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-globe"></i>
                            </div> 
                            <div class="widget-two__content"> 
                                <h3>@lang('All Domains')</h3>
                                <p>@lang('Manage Domains')</p>
                            </div>
                        </div>
                    </div>
                @endpermit

                @permit('admin.services')
                    <div class="col-xxl-6 col-sm-6 settingItems" data-setting="Invoices">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.services')}}" class="item-link"></a>
                            <i class="las la-server overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-server"></i>
                            </div> 
                            <div class="widget-two__content"> 
                                <h3>@lang('All Services')</h3>
                                <p>@lang('Manage Services')</p>
                            </div>
                        </div>
                    </div>
                @endpermit

                @permit('admin.cron.index')
                    <div class="col-xxl-6 col-sm-6 settingItems" data-setting="Invoices">
                        <div class="widget-two box--shadow2 b-radius--5 bg--white has-link">
                            <a href="{{route('admin.cron.index')}}" class="item-link"></a>
                            <i class="las la-clock overlay-icon text--success"></i>
                            <div class="widget-two__icon b-radius--5 bg--primary">
                                <i class="las la-clock"></i>
                            </div> 
                            <div class="widget-two__content"> 
                                <h3>@lang('Cron Job Setting')</h3>
                                <p>@lang('Manage Cron Job')</p>
                            </div>
                        </div>
                    </div>
                @endpermit
            </div>
        </div>

        <div class="col-lg-4 col-md-12 mb-30">
            <div class="card bg--dark setupWrapper">
                <div class="card-header d-flex justify-content-between flex-wrap align-items-center">
                    <h5 class="text--white">@lang('Setup')</h5>
                    <small>{{ array_sum($completed) }} @lang('of') <span class="totalCompletedSetup text--white"></span> @lang('Completed') </small>
                </div>
                <div class="card-body">
                    <div class="row">  
                        <div class="col-md-12 col-sm-12">
                            <ul class="ul-border setup">
                                <li class="text-dot">
                                    <i class="las la-{{ $completed['name_and_logo'] ? 'check text--success' : 'times text--danger' }}"></i> 
                                    <a href="{{ permit('admin.setting.index') ? route('admin.setting.index') : 'javascript:void(0)' }}">@lang('Set company name') </a> @lang('and')
                                    <a href="{{ permit('admin.setting.logo.icon') ? route('admin.setting.logo.icon') : 'javascript:void(0)' }}">@lang('logo')</a>
                                </li>
                                <li class="mt-2 text-dot">
                                    <i class="las la-{{ @$completed['cron'] ? 'check text--success' : 'times text--danger' }}"></i> 
                                    <a href="javascript:void(0)" class="cronModalBtn">@lang('Setup cron automation tasks') </a>
                                </li>
                                <li class="mt-2 text-dot">
                                    <i class="las la-{{ @$completed['domain_setup'] ? 'check text--success' : 'times text--danger' }}"></i> 
                                    <a href="{{ permit('admin.tld') ? route('admin.tld') : 'javascript:void(0)' }}">
                                        @lang('Manage domain/TLD setup') 
                                    </a>
                                </li>
                                <li class="mt-2 text-dot">
                                    <i class="las la-{{ @$completed['domain_register'] ? 'check text--success' : 'times text--danger' }}"></i> 
                                    <a href="{{ permit('admin.register.domain') ? route('admin.register.domain') : 'javascript:void(0)' }}">
                                        @lang('Activate your first domain register') 
                                    </a>
                                </li>  
                                <li class="mt-2 text-dot">
                                    <i class="las la-{{ @$completed['configurable_group'] ? 'check text--success' : 'times text--danger' }}"></i> 
                                    <a href="{{ permit('admin.configurable.groups') ? route('admin.configurable.groups') : 'javascript:void(0)' }}">
                                        @lang('Set configurable group') 
                                    </a>
                                </li>
                                <li class="mt-2 text-dot"> 
                                    <i class="las la-{{ @$completed['product'] ? 'check text--success' : 'times text--danger' }}"></i> 
                                    <a href="{{ permit('admin.products') ? route('admin.products') : 'javascript:void(0)' }}">
                                        @lang('Create your first product') 
                                    </a>
                                </li>
                                <li class="mt-2 text-dot"> 
                                    <i class="las la-{{ @$completed['setup_gateway'] ? 'check text--success' : 'times text--danger' }}"></i> 
                                    <a href="{{ permit('admin.gateway.automatic.index') ? route('admin.gateway.automatic.index') : 'javascript:void(0)' }}">
                                        @lang('Activate/add your first payment gateway') 
                                    </a>
                                </li>
                                <li class="mt-2 text-dot">
                                    <i class="las la-{{ @$completed['service_category'] ? 'check text--success' : 'times text--danger' }}"></i> 
                                    <a href="{{ permit('admin.service.category') ? route('admin.service.category') : 'javascript:void(0)' }}">
                                        @lang('Create first service category') 
                                    </a>
                                </li>
                                <li class="mt-2 text-dot">
                                    <i class="las la-{{ @$completed['server_group'] ? 'check text--success' : 'times text--danger' }}"></i> 
                                    <a href="{{ permit('admin.groups.server') ? route('admin.groups.server') : 'javascript:void(0)' }}">
                                        @lang('Create server group') 
                                    </a>
                                </li>
                                <li class="mt-2 text-dot">
                                    <i class="las la-{{ @$completed['server'] ? 'check text--success' : 'times text--danger' }}"></i> 
                                    <a href="{{ permit('admin.servers') ? route('admin.servers') : 'javascript:void(0)' }}">
                                        @lang('Setup at least one server') 
                                    </a>
                                </li>
                                <li class="mt-2 text-dot">
                                    <i class="las la-{{ @$completed['billing_setting'] ? 'check text--success' : 'times text--danger' }}"></i> 
                                    <a href="{{ permit('admin.billing.setting') ? route('admin.billing.setting') : 'javascript:void(0)' }}">
                                        @lang('Setup invoice generation days') 
                                    </a>
                                </li>
                                <li class="mt-2 text-dot">
                                    <i class="las la-{{ @$completed['defaultDomainRegister'] ? 'check text--success' : 'times text--danger' }}"></i> 
                                    <a href="{{ permit('admin.register.domain') ? route('admin.register.domain') : 'javascript:void(0)' }}">
                                        @lang('Setup default domain register for domain availability') 
                                    </a>
                                </li> 
                                @if(isSuperAdmin())
                                    <li class="mt-2 text-dot">
                                        <i class="las la-{{ @$completed['admin_profile_setup'] ? 'check text--success' : 'times text--danger' }}"></i> 
                                        <a href="{{ route('admin.profile') }}">@lang('Setup profile information for Namecheap') </a>
                                    </li> 
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@include('admin.partials.cron_modal')

@endsection

@push('script')
<script>
    (function($) {
        "use strict";

        $('.cronModalBtn').on('click', function(){
            $('#cronModal').modal('show');
        });

        var systemSearch = $('.systemSearch');
        var settingItems = $('.settingItems');
        var systemSearchActive = $('.system-search-icon-reset');

        var emptyArea = $('.emptyArea');
        var emptyHtml = `<div class="col-xxl-12 col-sm-12 settingItems text-center mt-4">
                            <div class="widget-two box--shadow2 b-radius--5 bg--white">
                                <div class="widget-two__content">
                                    <p>@lang('No search results found')</p>
                                </div>
                            </div>
                        </div>`;

        systemSearch.on('keyup', function(){

            var searchInput = $(this).val().toLowerCase();
            var empty = true;
            toogleSystemSearch(searchInput);

            settingItems.filter(function (idx, elem){

                if( $(elem).find('.widget-two__content h3').text().trim().toLowerCase().indexOf(searchInput) >= 0 ){
                    $(elem).show();
                    emptyArea.empty();
                    empty = false;
                }else{
                    $(elem).hide();
                }

            }).sort();

            if(empty){
                emptyArea.html(emptyHtml);
            }
         
        });

        $('.system-search-icon-reset').on('click', function(){
            var input = systemSearch.val(null);
            toogleSystemSearch(null);
            emptyArea.empty();
            settingItems.show();
        });
        
        function toogleSystemSearch(input){
            if(input){
                systemSearchActive.addClass('active');
            }else{
                systemSearchActive.removeClass('active');
            }
        }

        $('.totalCompletedSetup').text($('.setup li').length);

    })(jQuery);
</script>
@endpush

@push('style')
<style>
    .setupWrapper{
        position: sticky;
        top: 40px;
    }
    .system-search-icon {
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        aspect-ratio: 1;
        padding: 5px;
        display: grid;
        place-items: center;
        color: #888;
    }
    .system-search-icon ~ .form-control {
        padding-left: 45px;
    }
    .system-search-icon-reset {
        position: absolute;
        right: 0px;
        top: 0;
        height: 100%;
        aspect-ratio: 1;
        display: grid;
        place-items: center;
        color: #888;
        visibility: hidden;
        opacity: 0;
        cursor: pointer;
    }
    .system-search-icon-reset.active{
        visibility: visible;
        opacity: 1;
    }
    .ul-border li, .ul-border li a{
        color: #ffffff;
    }
    .ul-border li a:hover{
        color: #ffffff;
        text-decoration: underline;
    }
    .ul-border li:not(:last-child){
        border-bottom: 1px dotted #ffffff4a;
        padding-bottom: 30px;
    }
</style>
@endpush
