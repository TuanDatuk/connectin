@extends('backend.layouts.master')
@section('title', __('dashboard'))
@php
$embeddedSignupActivated = addon_is_activated('embedded_signup');
$isEmbeddedSignupActive = setting('is_embedded_signup_active') == 1;
$metaAppName = setting('meta_app_name');
$metaConfigurationId = setting('meta_configuration_id');
$metaAppSecret = setting('meta_app_secret');
$metaAccessToken = setting('meta_access_token');
// $metaAppName = null;
// $metaConfigurationId = null;
// $metaAppSecret = null;
// $metaAccessToken = null;
@endphp
@push('css')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
@endpush
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            @if ($embeddedSignupActivated && $isEmbeddedSignupActive && 
                (empty($metaAppName) || empty($metaConfigurationId) || empty($metaAppSecret) || empty($metaAccessToken)))
                <div class="alert alert-warning" role="alert">
                    <strong>{{ __('Notice:') }}</strong> {{ __('whatsapp_api_setup_notice') }}
                    <a href="{{ route('general.setting.whatsapp-api') }}" class="alert-link">{{ __('go_to_setup_page') }}</a>
                </div>
            @endif

            @if (!isMailSetupValid())
            <div class="alert alert-warning" role="alert">
                <strong>{{ __('notice') }}:</strong>
                {{ __('mail_setup_notice') }}
                <a href="{{ route('email.server-configuration') }}"
                class="alert-link">{{ __('set_up_mail_configuration_here') }}</a>
            </div>
            @endif


            @if ($cron_issue)
                <div class="alert alert-warning" role="alert">
                    <strong>{{ __('notice') }}:</strong>
                    {{ __('cron_job_warning') }}
                    <a href="{{ route('cron.setting') }}" target="_blank"
                       class="alert-link">{{ __('setup_cron_here') }}</a>
                </div>
            @endif
            @if (setting('is_pusher_notification_active') !== '1')
                <div class="alert alert-warning" role="alert">
                    <strong>{{ __('notice') }}:</strong>
                    {{ __('notice_line_one') }}
                    {{ __('notice_line_two') }}
                    <a href="{{ route('pusher.notification') }}" target="_blank"
                        class="alert-link">{{ __('setup_pusher') }}</a>
                </div>
            @endif
            @if (setting('is_onesignal_active') !== '1')
                <div class="alert alert-info" role="alert">
                    <strong>{{ __('notice') }}:</strong>
                    {{ __('notice_line_three') }}
                    {{ __('notice_line_four') }}
                    <a href="{{ route('onesignal.notification') }}" target="_blank"
                        class="alert-link">{{ __('setup_oneSignal') }}</a>
                </div>
            @endif 
            <div class="row">
                <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6">
                    <div class="statistics-card bg-white color-success redious-border mb-20 p-20 p-md-20">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="statistics-info mb-3">
                                    <h6>{{ __('active_subscription') }}</h6>
                                    <h4>{{ ReadableNumbers::make($total_active_subscriptions, 1) }}</h4>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="statistics-gChart mb-20 mb-lg-0">
                                    <canvas id="statisticsChart1"></canvas>
                                </div>
                            </div>
                            <div class="statistics-footer d-flex align-items-center gap-3">
                                <p class="sales-price">{{ ReadableNumbers::make($last_month_subscriptions, 1) }}</p>
                                <h6>{{ __('since_last_month') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- End Statistics Chart1 -->
                <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6">
                    <div class="statistics-card bg-white color-warning redious-border mb-20 p-20 p-sm-20">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="statistics-info mb-3">
                                    <h6>{{ __('total_earning') }}</h6>
                                    <h4>{{ get_price($total_earning) }}</h4>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="statistics-gChart mb-20 mb-lg-0">
                                    <canvas id="statisticsChart2"></canvas>
                                </div>
                            </div>
                            <div class="statistics-footer d-flex align-items-center gap-3">
                                <p class="sales-price">{{ get_price($last_month_earning) }}</p>
                                <h6>{{ __('since_last_month') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Statistics Chart2 -->

                <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6">
                    <div class="statistics-card bg-white color-danger redious-border mb-20 p-20 p-sm-20">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="statistics-info mb-3">
                                    <h6>{{ __('total_client') }}</h6>
                                    <h4>{{ ReadableNumbers::make($total_client, 1) }}</h4>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="statistics-gChart mb-20 mb-lg-0">
                                    <canvas id="statisticsChart3"></canvas>
                                </div>
                            </div>
                            <div class="statistics-footer d-flex align-items-center gap-3">
                                <p class="sales-price">{{ ReadableNumbers::make($last_month_client, 1) }}</p>
                                <h6>{{ __('since_last_month') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6">
                    <div class="statistics-card bg-white color-blue redious-border mb-20 p-20 p-sm-20">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="statistics-info mb-3">
                                    <h6>{{ __('total_campaign') }}</h6>
                                    <h4>{{ ReadableNumbers::make($total_campaign, 1) }}</h4>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="statistics-gChart mb-20 mb-lg-0">
                                    <canvas id="statisticsChart4"></canvas>
                                </div>
                            </div>
                            <div class="statistics-footer d-flex align-items-center gap-3">
                                <p class="sales-price">{{ ReadableNumbers::make($last_month_campaign) }}</p>
                                <h6>{{ __('since_last_month') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Statistics Chart4 -->
            </div>
            <div class="row">
                <div class="col-xl-8 col-md-12">
                    <div class="bg-white redious-border mb-4 pt-20 p-30">
                        <div class="section-top">
                            <h4>{{ __('earning_report') }}</h4>
                        </div>
                        <div class="statistics-report">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="analytics clr-1 mb-40">
                                        <div class="analytics-icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="uil:users-alt">
                                                    <path id="Vector"
                                                        d="M16.4026 16.2933C17.114 15.6775 17.6847 14.9158 18.0758 14.06C18.4669 13.2042 18.6693 12.2743 18.6693 11.3333C18.6693 9.56522 17.9669 7.86953 16.7167 6.61929C15.4664 5.36904 13.7707 4.66666 12.0026 4.66666C10.2345 4.66666 8.5388 5.36904 7.28856 6.61929C6.03832 7.86953 5.33594 9.56522 5.33594 11.3333C5.33593 12.2743 5.53834 13.2042 5.92944 14.06C6.32054 14.9158 6.89117 15.6775 7.6026 16.2933C5.73612 17.1385 4.15256 18.5034 3.04124 20.2247C1.92993 21.9461 1.3379 23.9511 1.33594 26C1.33594 26.3536 1.47641 26.6928 1.72646 26.9428C1.97651 27.1929 2.31565 27.3333 2.66927 27.3333C3.02289 27.3333 3.36203 27.1929 3.61208 26.9428C3.86213 26.6928 4.0026 26.3536 4.0026 26C4.0026 23.8783 4.84546 21.8434 6.34575 20.3431C7.84604 18.8429 9.88087 18 12.0026 18C14.1243 18 16.1592 18.8429 17.6595 20.3431C19.1597 21.8434 20.0026 23.8783 20.0026 26C20.0026 26.3536 20.1431 26.6928 20.3931 26.9428C20.6432 27.1929 20.9823 27.3333 21.3359 27.3333C21.6896 27.3333 22.0287 27.1929 22.2787 26.9428C22.5288 26.6928 22.6693 26.3536 22.6693 26C22.6673 23.9511 22.0753 21.9461 20.964 20.2247C19.8527 18.5034 18.2691 17.1385 16.4026 16.2933ZM12.0026 15.3333C11.2115 15.3333 10.4381 15.0987 9.78032 14.6592C9.12253 14.2197 8.60984 13.595 8.30709 12.8641C8.00434 12.1332 7.92512 11.3289 8.07946 10.553C8.2338 9.77705 8.61477 9.06431 9.17418 8.5049C9.73359 7.94549 10.4463 7.56453 11.2222 7.41019C11.9982 7.25585 12.8024 7.33506 13.5333 7.63781C14.2642 7.94056 14.889 8.45325 15.3285 9.11105C15.768 9.76885 16.0026 10.5422 16.0026 11.3333C16.0026 12.3942 15.5812 13.4116 14.831 14.1618C14.0809 14.9119 13.0635 15.3333 12.0026 15.3333ZM24.9893 15.76C25.8426 14.7991 26.4 13.6121 26.5943 12.3418C26.7887 11.0715 26.6118 9.7721 26.085 8.6C25.5581 7.4279 24.7037 6.43306 23.6246 5.73523C22.5455 5.0374 21.2877 4.66632 20.0026 4.66666C19.649 4.66666 19.3098 4.80714 19.0598 5.05719C18.8097 5.30724 18.6693 5.64638 18.6693 6C18.6693 6.35362 18.8097 6.69276 19.0598 6.94281C19.3098 7.19285 19.649 7.33333 20.0026 7.33333C21.0635 7.33333 22.0809 7.75476 22.831 8.5049C23.5812 9.25505 24.0026 10.2725 24.0026 11.3333C24.0007 12.0336 23.815 12.7212 23.464 13.3272C23.113 13.9332 22.6091 14.4365 22.0026 14.7867C21.8049 14.9007 21.6398 15.0635 21.5231 15.2597C21.4064 15.4558 21.3419 15.6785 21.3359 15.9067C21.3304 16.133 21.3825 16.3571 21.4875 16.5577C21.5925 16.7583 21.7468 16.9289 21.9359 17.0533L22.4559 17.4L22.6293 17.4933C24.2365 18.2556 25.5924 19.4613 26.5372 20.9684C27.4821 22.4755 27.9767 24.2212 27.9626 26C27.9626 26.3536 28.1031 26.6928 28.3531 26.9428C28.6032 27.1929 28.9423 27.3333 29.2959 27.3333C29.6496 27.3333 29.9887 27.1929 30.2387 26.9428C30.4888 26.6928 30.6293 26.3536 30.6293 26C30.6402 23.9539 30.1277 21.939 29.1406 20.1467C28.1534 18.3545 26.7244 16.8444 24.9893 15.76Z"
                                                        fill="#3F52E3" />
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="analytics-content">
                                            <p>{{ __('new_clients') }}</p>
                                            <h4 id="new_student_count">{{ ReadableNumbers::make($total_client, 1) }}</h4>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="analytics clr-2 mb-40">
                                        <div class="analytics-icon">
                                            <i class="las la-tags"></i>
                                        </div>

                                        <div class="analytics-content">
                                            <p>{{ __('total_subscription') }}</p>
                                            <h4 id="new_course_count">
                                                {{ ReadableNumbers::make($subscriptions->count(), 2) }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="analytics clr-4 mb-40">
                                        <div class="analytics-icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="Money/funds">
                                                    <g id="Vector">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M5.0639 5.20407C3.96377 5.75414 3.66406 6.32902 3.66406 6.66667C3.66406 7.00432 3.96377 7.5792 5.0639 8.12926C6.10421 8.64942 7.61136 9 9.33073 9C11.0501 9 12.5573 8.64942 13.5976 8.12926C14.6977 7.5792 14.9974 7.00432 14.9974 6.66667C14.9974 6.32902 14.6977 5.75414 13.5976 5.20407C12.5573 4.68392 11.0501 4.33334 9.33073 4.33334C7.61136 4.33334 6.10421 4.68392 5.0639 5.20407ZM4.16947 3.41522C5.54202 2.72895 7.3682 2.33334 9.33073 2.33334C11.2933 2.33334 13.1194 2.72895 14.492 3.41522C15.8047 4.07159 16.9974 5.16337 16.9974 6.66667C16.9974 8.16997 15.8047 9.26175 14.492 9.91812C13.1194 10.6044 11.2933 11 9.33073 11C7.3682 11 5.54202 10.6044 4.16947 9.91812C2.85674 9.26175 1.66406 8.16997 1.66406 6.66667C1.66406 5.16337 2.85674 4.07159 4.16947 3.41522Z"
                                                            fill="#FF5630" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M2.66406 5.66667C3.21635 5.66667 3.66406 6.11438 3.66406 6.66667H1.66406C1.66406 6.11438 2.11178 5.66667 2.66406 5.66667ZM16.9974 6.66667V11.3333C16.9974 12.8366 15.8047 13.9284 14.492 14.5848C13.1194 15.2711 11.2932 15.6667 9.33073 15.6667C7.36819 15.6667 5.54202 15.2711 4.16947 14.5848C2.85674 13.9284 1.66406 12.8366 1.66406 11.3333V6.66667H3.66406V11.3333C3.66406 11.671 3.96377 12.2459 5.0639 12.7959C6.10421 13.3161 7.61136 13.6667 9.33073 13.6667C11.0501 13.6667 12.5572 13.3161 13.5975 12.7959C14.6977 12.2459 14.9974 11.671 14.9974 11.3333V6.66667H16.9974ZM16.9974 6.66667C16.9974 6.11438 16.5497 5.66667 15.9974 5.66667C15.4451 5.66667 14.9974 6.11438 14.9974 6.66667H16.9974Z"
                                                            fill="#FF5630" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M2.66406 10.3333C3.21635 10.3333 3.66406 10.7811 3.66406 11.3333H1.66406C1.66406 10.7811 2.11178 10.3333 2.66406 10.3333ZM16.9974 11.3333V16C16.9974 17.5033 15.8047 18.5951 14.492 19.2514C13.1194 19.9377 11.2932 20.3333 9.33073 20.3333C7.36819 20.3333 5.54202 19.9377 4.16947 19.2514C2.85674 18.5951 1.66406 17.5033 1.66406 16V11.3333H3.66406V16C3.66406 16.3376 3.96377 16.9125 5.0639 17.4626C6.10421 17.9827 7.61136 18.3333 9.33073 18.3333C11.0501 18.3333 12.5572 17.9827 13.5975 17.4626C14.6977 16.9125 14.9974 16.3376 14.9974 16V11.3333H16.9974ZM16.9974 11.3333C16.9974 10.7811 16.5497 10.3333 15.9974 10.3333C15.4451 10.3333 14.9974 10.7811 14.9974 11.3333H16.9974Z"
                                                            fill="#FF5630" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M2.66406 15C3.21635 15 3.66406 15.4477 3.66406 16H1.66406C1.66406 15.4477 2.11178 15 2.66406 15ZM16.9974 16V20.6667C16.9974 22.17 15.8047 23.2617 14.492 23.9181C13.1194 24.6044 11.2932 25 9.33073 25C7.36819 25 5.54202 24.6044 4.16947 23.9181C2.85674 23.2617 1.66406 22.17 1.66406 20.6667V16H3.66406V20.6667C3.66406 21.0043 3.96377 21.5792 5.0639 22.1293C6.10421 22.6494 7.61136 23 9.33073 23C11.0501 23 12.5572 22.6494 13.5975 22.1293C14.6977 21.5792 14.9974 21.0043 14.9974 20.6667V16H16.9974ZM16.9974 16C16.9974 15.4477 16.5497 15 15.9974 15C15.4451 15 14.9974 15.4477 14.9974 16H16.9974Z"
                                                            fill="#FF5630" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M2.66406 19.6667C3.21635 19.6667 3.66406 20.1144 3.66406 20.6667H1.66406C1.66406 20.1144 2.11178 19.6667 2.66406 19.6667ZM16.9974 20.6667V25.3333C16.9974 26.8366 15.8047 27.9284 14.492 28.5848C13.1194 29.2711 11.2932 29.6667 9.33073 29.6667C7.36819 29.6667 5.54202 29.2711 4.16947 28.5848C2.85674 27.9284 1.66406 26.8366 1.66406 25.3333V20.6667H3.66406V25.3333C3.66406 25.671 3.96377 26.2459 5.0639 26.7959C6.10421 27.3161 7.61136 27.6667 9.33073 27.6667C11.0501 27.6667 12.5572 27.3161 13.5975 26.7959C14.6977 26.2459 14.9974 25.671 14.9974 25.3333V20.6667H16.9974ZM16.9974 20.6667C16.9974 20.1144 16.5497 19.6667 15.9974 19.6667C15.4451 19.6667 14.9974 20.1144 14.9974 20.6667H16.9974Z"
                                                            fill="#FF5630" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M18.3972 14.5374C17.2971 15.0875 16.9974 15.6624 16.9974 16C16.9974 16.3376 17.2971 16.9125 18.3972 17.4626C19.4375 17.9828 20.9447 18.3333 22.6641 18.3333C24.3834 18.3333 25.8906 17.9828 26.9309 17.4626C28.031 16.9125 28.3307 16.3376 28.3307 16C28.3307 15.6624 28.031 15.0875 26.9309 14.5374C25.8906 14.0173 24.3834 13.6667 22.6641 13.6667C20.9447 13.6667 19.4375 14.0173 18.3972 14.5374ZM17.5028 12.7486C18.8754 12.0623 20.7015 11.6667 22.6641 11.6667C24.6266 11.6667 26.4528 12.0623 27.8253 12.7486C29.1381 13.4049 30.3307 14.4967 30.3307 16C30.3307 17.5033 29.1381 18.5951 27.8253 19.2515C26.4528 19.9377 24.6266 20.3333 22.6641 20.3333C20.7015 20.3333 18.8754 19.9377 17.5028 19.2515C16.1901 18.5951 14.9974 17.5033 14.9974 16C14.9974 14.4967 16.1901 13.4049 17.5028 12.7486Z"
                                                            fill="#FF5630" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M15.9974 15C16.5497 15 16.9974 15.4477 16.9974 16H14.9974C14.9974 15.4477 15.4451 15 15.9974 15ZM30.3307 16V20.6667C30.3307 22.17 29.138 23.2617 27.8253 23.9181C26.4528 24.6044 24.6266 25 22.6641 25C20.7015 25 18.8754 24.6044 17.5028 23.9181C16.1901 23.2617 14.9974 22.17 14.9974 20.6667V16H16.9974V20.6667C16.9974 21.0043 17.2971 21.5792 18.3972 22.1293C19.4376 22.6494 20.9447 23 22.6641 23C24.3834 23 25.8906 22.6494 26.9309 22.1293C28.031 21.5792 28.3307 21.0043 28.3307 20.6667V16H30.3307ZM30.3307 16C30.3307 15.4477 29.883 15 29.3307 15C28.7784 15 28.3307 15.4477 28.3307 16H30.3307Z"
                                                            fill="#FF5630" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M15.9974 19.6667C16.5497 19.6667 16.9974 20.1144 16.9974 20.6667H14.9974C14.9974 20.1144 15.4451 19.6667 15.9974 19.6667ZM30.3307 20.6667V25.3333C30.3307 26.8366 29.138 27.9284 27.8253 28.5848C26.4528 29.2711 24.6266 29.6667 22.6641 29.6667C20.7015 29.6667 18.8754 29.2711 17.5028 28.5848C16.1901 27.9284 14.9974 26.8366 14.9974 25.3333V20.6667H16.9974V25.3333C16.9974 25.671 17.2971 26.2459 18.3972 26.7959C19.4376 27.3161 20.9447 27.6667 22.6641 27.6667C24.3834 27.6667 25.8906 27.3161 26.9309 26.7959C28.031 26.2459 28.3307 25.671 28.3307 25.3333V20.6667H30.3307ZM30.3307 20.6667C30.3307 20.1144 29.883 19.6667 29.3307 19.6667C28.7784 19.6667 28.3307 20.1144 28.3307 20.6667H30.3307Z"
                                                            fill="#FF5630" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="analytics-content">
                                            <p>{{ __('total_sale') }}</p>
                                            <h4 id="total_sales">{{ get_price($total_earning) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="statistics-report-chart">
                            <canvas id="statisticsBarChart"></canvas>
                        </div>
                    </div>
                </div>


                <div class="col-xl-4 col-md-12">
                    <div class="row">
                        <div class="col-xxl-6 col-md-6">
                            <div class="statistics-card bg-white color-success redious-border mb-4 p-20 p-sm-20">
                                <div class="statistics-icon">
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="uil:users-alt">
                                            <path id="Vector"
                                                d="M16.4026 16.2933C17.114 15.6775 17.6847 14.9158 18.0758 14.06C18.4669 13.2042 18.6693 12.2743 18.6693 11.3333C18.6693 9.56522 17.9669 7.86953 16.7167 6.61929C15.4664 5.36904 13.7707 4.66666 12.0026 4.66666C10.2345 4.66666 8.5388 5.36904 7.28856 6.61929C6.03832 7.86953 5.33594 9.56522 5.33594 11.3333C5.33593 12.2743 5.53834 13.2042 5.92944 14.06C6.32054 14.9158 6.89117 15.6775 7.6026 16.2933C5.73612 17.1385 4.15256 18.5034 3.04124 20.2247C1.92993 21.9461 1.3379 23.9511 1.33594 26C1.33594 26.3536 1.47641 26.6928 1.72646 26.9428C1.97651 27.1929 2.31565 27.3333 2.66927 27.3333C3.02289 27.3333 3.36203 27.1929 3.61208 26.9428C3.86213 26.6928 4.0026 26.3536 4.0026 26C4.0026 23.8783 4.84546 21.8434 6.34575 20.3431C7.84604 18.8429 9.88087 18 12.0026 18C14.1243 18 16.1592 18.8429 17.6595 20.3431C19.1597 21.8434 20.0026 23.8783 20.0026 26C20.0026 26.3536 20.1431 26.6928 20.3931 26.9428C20.6432 27.1929 20.9823 27.3333 21.3359 27.3333C21.6896 27.3333 22.0287 27.1929 22.2787 26.9428C22.5288 26.6928 22.6693 26.3536 22.6693 26C22.6673 23.9511 22.0753 21.9461 20.964 20.2247C19.8527 18.5034 18.2691 17.1385 16.4026 16.2933ZM12.0026 15.3333C11.2115 15.3333 10.4381 15.0987 9.78032 14.6592C9.12253 14.2197 8.60984 13.595 8.30709 12.8641C8.00434 12.1332 7.92512 11.3289 8.07946 10.553C8.2338 9.77705 8.61477 9.06431 9.17418 8.5049C9.73359 7.94549 10.4463 7.56453 11.2222 7.41019C11.9982 7.25585 12.8024 7.33506 13.5333 7.63781C14.2642 7.94056 14.889 8.45325 15.3285 9.11105C15.768 9.76885 16.0026 10.5422 16.0026 11.3333C16.0026 12.3942 15.5812 13.4116 14.831 14.1618C14.0809 14.9119 13.0635 15.3333 12.0026 15.3333ZM24.9893 15.76C25.8426 14.7991 26.4 13.6121 26.5943 12.3418C26.7887 11.0715 26.6118 9.7721 26.085 8.6C25.5581 7.4279 24.7037 6.43306 23.6246 5.73523C22.5455 5.0374 21.2877 4.66632 20.0026 4.66666C19.649 4.66666 19.3098 4.80714 19.0598 5.05719C18.8097 5.30724 18.6693 5.64638 18.6693 6C18.6693 6.35362 18.8097 6.69276 19.0598 6.94281C19.3098 7.19285 19.649 7.33333 20.0026 7.33333C21.0635 7.33333 22.0809 7.75476 22.831 8.5049C23.5812 9.25505 24.0026 10.2725 24.0026 11.3333C24.0007 12.0336 23.815 12.7212 23.464 13.3272C23.113 13.9332 22.6091 14.4365 22.0026 14.7867C21.8049 14.9007 21.6398 15.0635 21.5231 15.2597C21.4064 15.4558 21.3419 15.6785 21.3359 15.9067C21.3304 16.133 21.3825 16.3571 21.4875 16.5577C21.5925 16.7583 21.7468 16.9289 21.9359 17.0533L22.4559 17.4L22.6293 17.4933C24.2365 18.2556 25.5924 19.4613 26.5372 20.9684C27.4821 22.4755 27.9767 24.2212 27.9626 26C27.9626 26.3536 28.1031 26.6928 28.3531 26.9428C28.6032 27.1929 28.9423 27.3333 29.2959 27.3333C29.6496 27.3333 29.9887 27.1929 30.2387 26.9428C30.4888 26.6928 30.6293 26.3536 30.6293 26C30.6402 23.9539 30.1277 21.939 29.1406 20.1467C28.1534 18.3545 26.7244 16.8444 24.9893 15.76Z"
                                                fill="#3F52E3" />
                                        </g>
                                    </svg>
                                </div>
                                <div class="statistics-gChart">
                                    <canvas id="statisticsChart5"></canvas>
                                </div>
                                <div class="statistics-info mt-1">
                                    <h6>{{ __('total_contact_list') }}</h6>
                                    <h4>{{ ReadableNumbers::make($total_contact_list, 2) }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-6 col-md-6">
                            <div class="statistics-card bg-white color-danger redious-border mb-4 p-20 p-sm-20">
                                <div class="statistics-icon">
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="uil:users-alt">
                                            <path id="Vector"
                                                d="M16.4026 16.2933C17.114 15.6775 17.6847 14.9158 18.0758 14.06C18.4669 13.2042 18.6693 12.2743 18.6693 11.3333C18.6693 9.56522 17.9669 7.86953 16.7167 6.61929C15.4664 5.36904 13.7707 4.66666 12.0026 4.66666C10.2345 4.66666 8.5388 5.36904 7.28856 6.61929C6.03832 7.86953 5.33594 9.56522 5.33594 11.3333C5.33593 12.2743 5.53834 13.2042 5.92944 14.06C6.32054 14.9158 6.89117 15.6775 7.6026 16.2933C5.73612 17.1385 4.15256 18.5034 3.04124 20.2247C1.92993 21.9461 1.3379 23.9511 1.33594 26C1.33594 26.3536 1.47641 26.6928 1.72646 26.9428C1.97651 27.1929 2.31565 27.3333 2.66927 27.3333C3.02289 27.3333 3.36203 27.1929 3.61208 26.9428C3.86213 26.6928 4.0026 26.3536 4.0026 26C4.0026 23.8783 4.84546 21.8434 6.34575 20.3431C7.84604 18.8429 9.88087 18 12.0026 18C14.1243 18 16.1592 18.8429 17.6595 20.3431C19.1597 21.8434 20.0026 23.8783 20.0026 26C20.0026 26.3536 20.1431 26.6928 20.3931 26.9428C20.6432 27.1929 20.9823 27.3333 21.3359 27.3333C21.6896 27.3333 22.0287 27.1929 22.2787 26.9428C22.5288 26.6928 22.6693 26.3536 22.6693 26C22.6673 23.9511 22.0753 21.9461 20.964 20.2247C19.8527 18.5034 18.2691 17.1385 16.4026 16.2933ZM12.0026 15.3333C11.2115 15.3333 10.4381 15.0987 9.78032 14.6592C9.12253 14.2197 8.60984 13.595 8.30709 12.8641C8.00434 12.1332 7.92512 11.3289 8.07946 10.553C8.2338 9.77705 8.61477 9.06431 9.17418 8.5049C9.73359 7.94549 10.4463 7.56453 11.2222 7.41019C11.9982 7.25585 12.8024 7.33506 13.5333 7.63781C14.2642 7.94056 14.889 8.45325 15.3285 9.11105C15.768 9.76885 16.0026 10.5422 16.0026 11.3333C16.0026 12.3942 15.5812 13.4116 14.831 14.1618C14.0809 14.9119 13.0635 15.3333 12.0026 15.3333ZM24.9893 15.76C25.8426 14.7991 26.4 13.6121 26.5943 12.3418C26.7887 11.0715 26.6118 9.7721 26.085 8.6C25.5581 7.4279 24.7037 6.43306 23.6246 5.73523C22.5455 5.0374 21.2877 4.66632 20.0026 4.66666C19.649 4.66666 19.3098 4.80714 19.0598 5.05719C18.8097 5.30724 18.6693 5.64638 18.6693 6C18.6693 6.35362 18.8097 6.69276 19.0598 6.94281C19.3098 7.19285 19.649 7.33333 20.0026 7.33333C21.0635 7.33333 22.0809 7.75476 22.831 8.5049C23.5812 9.25505 24.0026 10.2725 24.0026 11.3333C24.0007 12.0336 23.815 12.7212 23.464 13.3272C23.113 13.9332 22.6091 14.4365 22.0026 14.7867C21.8049 14.9007 21.6398 15.0635 21.5231 15.2597C21.4064 15.4558 21.3419 15.6785 21.3359 15.9067C21.3304 16.133 21.3825 16.3571 21.4875 16.5577C21.5925 16.7583 21.7468 16.9289 21.9359 17.0533L22.4559 17.4L22.6293 17.4933C24.2365 18.2556 25.5924 19.4613 26.5372 20.9684C27.4821 22.4755 27.9767 24.2212 27.9626 26C27.9626 26.3536 28.1031 26.6928 28.3531 26.9428C28.6032 27.1929 28.9423 27.3333 29.2959 27.3333C29.6496 27.3333 29.9887 27.1929 30.2387 26.9428C30.4888 26.6928 30.6293 26.3536 30.6293 26C30.6402 23.9539 30.1277 21.939 29.1406 20.1467C28.1534 18.3545 26.7244 16.8444 24.9893 15.76Z"
                                                fill="#3F52E3" />
                                        </g>
                                    </svg>
                                </div>
                                <div class="statistics-gChart">
                                    <canvas id="statisticsChart6"></canvas>
                                </div>
                                <div class="statistics-info mt-1">
                                    <h6>{{ __('total_contacts') }}</h6>
                                    <h4>{{ ReadableNumbers::make($total_contacts, 2) }}</h4>
                                </div>
                            </div>
                        </div>
                       <!-- End Statistics Chart6 -->
                        <div class="col-lg-12">
                            <div class="bg-white redious-border mb-4 pt-20 p-30">
                                <div class="section-top mb-2">
                                    <h4>{{ __('best_selling_plan') }}</h4>
                                </div>
                                <div id="payout_table_container">
                                    @include('backend.admin.dashboard.best_selling_package_table')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-lg-12 col-xxl-6">
                    <div class="bg-white redious-border mb-4 pt-20 p-30">
                        <div class="section-top mb-2">
                            <h4>{{ __('recent_subscription') }}</h4>
                        </div>
                        <div id="best_selling_table_container">
                            @include('backend.admin.dashboard.recent_subscription_table')
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-xxl-6">
                    <div class="bg-white redious-border pt-20 p-30">
                        <div class="section-top mb-2">
                            <h4>{{ __('best_clients') }}</h4>
                        </div>
                        <div id="best_instructor_container">
                            @include('backend.admin.dashboard.best_client_table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <input type="hidden" id="chart_data" value="{{ json_encode($charts) }}">
@endsection
@push('js')
    <script src="{{ static_asset('admin\js\custom\dashboard\__chart.js') }}"></script>
    <script>
        $(document).on('click', '.__js_earning_filterable_item', function(event) {
            let url = "{{ url()->current() }}";
            $('#filterable_parent_item').html(event.target.innerHTML)
            axios.get(url, {
                    params: {
                        earning_report: true,
                        query_string: $(this).data('query')
                    }
                })
                .then(response => {
                    const data = response.data;
                    earningChartBar.data.lebels = data.lebels;
                    earningChartBar.data.datasets[0].data = data.student;
                    earningChartBar.data.datasets[1].data = data.course;
                    earningChartBar.data.datasets[2].data = data.earning;

                    earningChartBar.update();

                    $('#new_student_count').html(data.new_student_count)
                    $('#new_course_count').html(data.new_course_count)
                    $('#total_sales').html(data.total_sales)
                })
        })
        $(document).on('click', '.__js_best_selling_filterable_item', function(event) {
            $('#best_selling_dropdown_item_container').html(event.target.innerHTML)
            let url = "{{ url()->current() }}"
            axios.get(url, {
                    params: {
                        best_selling_course: true,
                        query_string: $(this).data('query'),
                    }
                })
                .then(response => {
                    $('#best_selling_table_container').html(response.data);
                })
        })

        $(document).on('click', '.__js_best_instructor_filterable_item', function(event) {
            $('#best_instructor_dropdown_item_container').html(event.target.innerHTML)
            let url = "{{ url()->current() }}"
            axios.get(url, {
                    params: {
                        best_instructor: true,
                        query_string: $(this).data('query'),
                    }
                })
                .then(response => {
                    $('#best_instructor_container').html(response.data);
                })
        })
        $(document).on('click', '.__js_payout_filterable_item', function(event) {
            $('#payout_dropdown_item_container').html(event.target.innerHTML)
            let url = "{{ url()->current() }}"
            axios.get(url, {
                    params: {
                        payout: true,
                        query_string: $(this).data('query'),
                    }
                })
                .then(response => {
                    $('#payout_table_container').html(response.data);
                })
        })
    </script>
@endpush
