@extends('backend.layouts.master')
@section('title', __('whatsApp_settings'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="section-title">{{ __('whatsApp_settings') }}</h3>
                <div class="default-tab-list default-tab-list-v2  bg-white redious-border p-20 p-sm-30 mb-4">
                    @if (whatsappConnected())
                        <div class="alert alert-success" role="alert">
                            {{ __('success_!_you_are_now_connected_to_whatsapp_cloud_api') }}
                        </div>
                    @else
                        <div class="alert alert-danger" role="alert">
                            {{ __('not_connected!_please_complete_all_the_steps_in_order_to_connect_to_whatsapp_cloud_api') }}
                        </div>
                    @endif
                    @if (!isWhatsAppWebhookConnected())
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ __('oops') }}</strong> {{ __('whatsapp_webhook_not_connected') }}<br>
                            <small>{{ __('real_time_updates_will_not_be_available_until_the_webhook_is_connected') }}</small>
                            @if (
                                !empty(@Auth::user()->client->whatsappSetting->access_token) &&
                                    !empty(@Auth::user()->client->whatsappSetting->scopes))
                                <a class="alert-link"
                                    href="https://developers.facebook.com/apps/{{ Auth::user()->client->whatsappSetting->app_id }}/whatsapp-business/wa-settings/?business_id={{ Auth::user()->client->whatsappSetting->business_account_id }}"
                                    target="_blank">
                                    <i class="las la-link"></i> {{ __('add_whatsapp_webhook') }}
                                </a>
                            @endif
                        </div>
                    @endif
                    @php
                        $embadedSignupActivated = addon_is_activated('embedded_signup');
                    @endphp
                    @if ($embadedSignupActivated)
                        <div class="row row-eq-height mb-3">
                            <div class="col-12 mx-auto text-center">
                                <div id="fb-root"></div>
                                <button onclick="launchWhatsAppSignup()"
                                    style="background-color: #1877f2; border: 0; border-radius: 4px; color: #fff; cursor: pointer; font-family: Helvetica, Arial, sans-serif; font-size: 16px; font-weight: bold; height: 40px; padding: 0 24px;">
                                    Login with Facebook
                                </button>
                                <p>Session info response:</p>
                                <pre id="session-info-response"></pre>
                                </br>
                                <p>SDK response:</p>
                                <pre id="sdk-response"></pre>
                            </div>
                        </div>
                    @endif


                    <div class="row row-eq-height mb-3">
                        <div class="col-lg-6">
                            <div class="card h-100">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5>{{ __('webhook_config') }}</h5>
                                    @if (setting('whatsApp_settings_video_url'))
                                        <a href="#" class="d-flex align-items-center gap-2" data-bs-toggle="modal"
                                            data-bs-target="#config_tutorial">
                                            <i class="lab la-youtube" style="font-size:24px;"></i> {{ __('tutorial') }}
                                        </a>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <div class="mb-4">
                                        <label for="webhook_callback_url" class="form-label"><i class="las la-link"></i>
                                            {{ __('callback_url') }}</label>
                                        <div class="input-group">
                                            <input type="url"
                                                value="{{ isDemoMode() ? '******************' : route('whatsapp.webhook', @Auth::user()->client->webhook_verify_token) }}"
                                                readonly name="webhook_callback_url" class="form-control"
                                                placeholder="{{ __('enter_webhook_callback_url') }}"
                                                aria-label="{{ __('enter_webhook_callback_url') }}"
                                                aria-describedby="webhook_callback_url">
                                            <span class="input-group-text copy-text" id="webhook_callback_url">
                                                <i class="las la-copy"></i>
                                            </span>
                                        </div>
                                        <div class="nk-block-des text-danger">
                                            <p class="first_name_error error">
                                                {{ $errors->first('webhook_callback_url') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="webhook_verify_token" class="form-label"><i class="las la-key"></i>
                                            {{ __('verify_token') }}</label>
                                        <div class="input-group">
                                            <input type="text"
                                                value="{{ isDemoMode() ? '******************' : old('webhook_verify_token', @Auth::user()->client->webhook_verify_token) }}"
                                                readonly name="webhook_verify_token" class="form-control"
                                                placeholder="{{ __('enter_webhook_verify_token') }}"
                                                aria-label="{{ __('enter_webhook_verify_token') }}"
                                                aria-describedby="webhook_verify_token">
                                            <span class="input-group-text copy-text" id="webhook_verify_token">
                                                <i class="las la-copy"></i>
                                            </span>
                                        </div>
                                        <div class="nk-block-des text-danger">
                                            <p class="first_name_error error">
                                                {{ $errors->first('webhook_verify_token') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="privacy_policy" class="form-label"><i class="las la-link"></i>
                                            {{ __('privacy_policy') }}</label>
                                        <div class="input-group">
                                            <input type="text" value="{{ url('page/privacy-policy') }}" readonly
                                                name="privacy_policy" class="form-control"
                                                placeholder="{{ __('enter_privacy_policy') }}"
                                                aria-label="{{ __('enter_privacy_policy') }}"
                                                aria-describedby="privacy_policy">
                                            <span class="input-group-text copy-text" id="privacy_policy">
                                                <i class="las la-copy"></i>
                                            </span>
                                        </div>
                                        <div class="nk-block-des text-danger">
                                            <p class="first_name_error error">
                                                {{ $errors->first('privacy_policy') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="terms_and_conditions" class="form-label"><i class="las la-link"></i>
                                            {{ __('terms_and_conditions') }}</label>
                                        <div class="input-group">
                                            <input type="text" value="{{ url('page/terms-and-conditions') }}" readonly
                                                name="terms_and_conditions" class="form-control"
                                                placeholder="{{ __('enter_terms_and_conditions') }}"
                                                aria-label="{{ __('enter_terms_and_conditions') }}"
                                                aria-describedby="terms_and_conditions">
                                            <span class="input-group-text copy-text" id="terms_and_conditions">
                                                <i class="las la-copy"></i>
                                            </span>
                                        </div>
                                        <div class="nk-block-des text-danger">
                                            <p class="first_name_error error">
                                                {{ $errors->first('terms_and_conditions') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h5><i class="las la-cloud"></i> {{ __('get_started_with_whatsApp_cloud_api') }}</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <li><i class="las la-check-circle"></i> {{ __('1') }}.
                                            {{ __('whatsApp_cloud_api_line_one') }}
                                            <a href="https://developers.facebook.com/" class="lern-more"
                                                target="_blank">Facebook Developer</a>.
                                        </li>
                                        <li><i class="las la-check-circle"></i> {{ __('2') }}.
                                            {{ __('whatsApp_cloud_api_line_two') }}
                                        </li>
                                        <li><i class="las la-check-circle"></i>{{ __('3') }}.
                                            {{ __('whatsApp_cloud_api_line_three') }} {{ __('callback_url') }} and
                                            {{ __('verify_token') }}.</li>
                                        <li><i class="las la-check-circle"></i> {{ __('4') }}.
                                            {{ __('whatsApp_cloud_api_line_four') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('client.whatsapp.settings.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5><i class="las la-key"></i> {{ __('whatsApp_access_token') }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <label for="access_token" class="form-label">
                                                {{ __('access_token') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control rounded-2" id="access_token"
                                                name="access_token"
                                                value="{{ isDemoMode() ? '******************' : old('access_token', @Auth::user()->client->whatsappSetting->access_token) }}"
                                                placeholder="{{ __('enter_access_token') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="access_token_error error">{{ $errors->first('access_token') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label for="phone_number_id" class="form-label">
                                                {{ __('phone_number_id') }}</label>
                                            <input type="text" class="form-control rounded-2" id="phone_number_id"
                                                name="phone_number_id"
                                                value="{{ isDemoMode() ? '******************' : old('phone_number_id', @Auth::user()->client->whatsappSetting->phone_number_id) }}"
                                                placeholder="{{ __('enter_phone_number_id') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="phone_number_id_error error">
                                                    {{ $errors->first('phone_number_id') }}</p>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label for="business_account_id" class="form-label">
                                                {{ __('business_account_id') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control rounded-2" id="business_account_id"
                                                name="business_account_id"
                                                value="{{ isDemoMode() ? '******************' : old('business_account_id', @Auth::user()->client->whatsappSetting->business_account_id) }}"
                                                placeholder="{{ __('enter_business_account_id') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="business_account_id_error error">
                                                    {{ $errors->first('business_account_id') }}</p>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label for="app_id" class="form-label"> {{ __('app_id') }}</label>
                                            <input type="text" class="form-control rounded-2" id="app_id"
                                                name="app_id"
                                                value="{{ isDemoMode() ? '******************' : old('app_id', @Auth::user()->client->whatsappSetting->app_id) }}"
                                                placeholder="{{ __('enter_app_id') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="app_id_id_error error">
                                                    {{ $errors->first('app_id') }}</p>
                                            </div>
                                        </div>
                                        @if (@Auth::user()->client->whatsappSetting)
                                            <div class="p-2 border rounded bg-light">
                                                @if (
                                                    !empty(@Auth::user()->client->whatsappSetting->access_token) &&
                                                        !empty(@Auth::user()->client->whatsappSetting->scopes))

                                                    <div class="mb-2">
                                                        <strong>{{ __('name') }}:</strong>
                                                        {{ @Auth::user()->client->whatsappSetting->name }}
                                                        <a class="text-success" target="_blank"
                                                            href="https://business.facebook.com/wa/manage/home/?business_id=&waba_id={{ Auth::user()->client->whatsappSetting->business_account_id }}"
                                                            class="small">
                                                            <small>
                                                                <i class="las la-pen"></i>
                                                                {{ __('manage') }}
                                                            </small>
                                                        </a>
                                                    </div>
                                                    @if (!empty(Auth::user()->client->whatsappSetting->expires_at))
                                                        <div class="mb-2">
                                                            <strong>{{ __('expires_at') }}:</strong>
                                                            {{ Auth::user()->client->whatsappSetting->expires_at }}
                                                        </div>
                                                    @endif
                                                    <div class="mb-2">
                                                        <strong>{{ __('app_id') }}:</strong>
                                                        {{ Auth::user()->client->whatsappSetting->app_id }}
                                                    </div>
                                                    <div class="mb-2">
                                                        <strong>{{ __('token_verified') }}:</strong>
                                                        @if (Auth::user()->client->whatsappSetting->token_verified)
                                                            <i class="las la-check-circle text-success"></i>
                                                        @else
                                                            <i class="las la-times-circle text-danger"></i>
                                                        @endif
                                                    </div>
                                                    <?php
                                                    $scopes = @Auth::user()->client->whatsappSetting->scopes ?? [];
                                                    $requiredScopes = config('static_array.whatsapp_required_scopes');
                                                    ?>
                                                    <ul class="list-inline">
                                                        @foreach ($scopes as $scope)
                                                            <li class="list-inline-item">
                                                                @if (in_array($scope, $requiredScopes))
                                                                    <i class="las la-check-circle text-success"></i>
                                                                @else
                                                                    <i class="las la-check-circle text-success"></i>
                                                                @endif
                                                                {{ $scope }}
                                                            </li>
                                                        @endforeach
                                                        @foreach ($requiredScopes as $requiredScope)
                                                            @if (!in_array($requiredScope, $scopes))
                                                                <li class="list-inline-item">
                                                                    <i class="las la-times-circle text-danger"></i>
                                                                    {{ $requiredScope }}
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        @endif
                                        <div class="d-flex justify-content-end align-items-center mt-30 gap-2">
                                            @if (@Auth::user()->client->whatsappSetting->access_token)
                                                <button type="button" class="btn btn-danger text-white __js_delete"
                                                    id="remove_access_token"
                                                    data-id="{{ @Auth::user()->client->whatsappSetting->id }}"
                                                    data-url="{{ route('client.whatsAppSettings.remove-token', @Auth::user()->client->whatsappSetting->id) }}">
                                                    <i class="las la-trash-alt"></i> {{ __('remove') }}
                                                </button>
                                            @endif
                                            @if (@Auth::user()->client->whatsappSetting)
                                                <button type="button" class="btn btn-secondary" id="sync_button"
                                                    data-id="{{ @Auth::user()->client->whatsappSetting->id }}"
                                                    data-url="{{ route('client.whatsapp-settings.sync', @Auth::user()->client->whatsappSetting->id) }}">
                                                    <i class="las la-sync-alt"></i> {{ __('sync') }}
                                                </button>
                                            @endif
                                            <button type="submit" class="btn sg-btn-primary"><i class="las la-save"></i>
                                                {{ __('save') }}</button>
                                            @include('backend.common.loading-btn', [
                                                'class' => 'btn sg-btn-primary',
                                            ])
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5><i class="las la-key"></i> {{ __('get_your_permanent_access_token') }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled">
                                            <li>
                                                <i class="las la-info-circle"></i>
                                                {{ __('follow_the_detailed_process_outlined_in_the_facebook_docs_to_create_a_permanent_access_token') }}
                                                <a class="lern-more"
                                                    href="https://developers.facebook.com/docs/whatsapp/business-management-api/get-started#1--acquire-an-access-token-using-a-system-user-or-facebook-login"
                                                    target="_blank">
                                                    {{ __('facebook_docs') }}
                                                </a>
                                            </li>
                                            <li>
                                                <i class="las la-key"></i>
                                                {{ __('once_you_have_obtained_the_permanent_access_token_enter_it_here') }}
                                            </li>
                                        </ul>
                                        <h5><i class="las la-id-card"></i>
                                            {{ __('get_Your_account_id_and_phone_number_id') }}</h5>
                                        <ul class="list-unstyled mb-4">
                                            <li><i class="las la-check-circle"></i> {{ __('1') }}.
                                                {{ __('setting_line_one') }}</li>
                                            <li><i class="las la-check-circle"></i> {{ __('2') }}.
                                                {{ __('setting_line_two') }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-lg" id="config_tutorial" tabindex="-1" aria-labelledby="config_tutorial"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="embed-responsive videowrapper">
                    <iframe class="embed-responsive-item"
                        src="https://www.youtube.com/embed/{{ getYoutubeVideoId(setting('whatsApp_settings_video_url')) }}"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.7/axios.min.js"></script>
    <script>
        var url = "{{ route('client.whatsapp.embedded-signup') }}";

        $(document).ready(function() {
            $('.copy-text').click(function() {
                var inputField = $(this).closest('.input-group').find('input');
                inputField.select();
                document.execCommand("copy");
                toastr.success("{{ __('copied') }}");
            });
        });
        $(document).on('click', '.__js_delete', function() {
            confirmationAlert(
                $(this).data('url'),
                $(this).data('id'),
                'Yes, Delete It!'
            )
        })
        const confirmationAlert = (url, data_id, button_test = 'Yes, Confirmed it!') => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: button_test,
                confirmButtonColor: '#ff0000'
            }).then((confirmed) => {
                if (confirmed.isConfirmed) {
                    axios.post(url, {
                            data_id: data_id
                        })
                        .then(response => {
                            console.log(response);
                            Swal.fire(
                                response.data.message,
                                '',
                                response.data.status == true ? 'success' : 'error',
                            ).then(() => {
                                if (response.data.status == true) {
                                    location.reload();
                                }
                            });
                        })
                        .catch(error => {
                            console.log(error);
                            Swal.fire(...error.response.data);
                        })
                }
            });
        };
        $('#sync_button').click(function() {
            var button = $(this);
            var url = button.data('url');
            button.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ' +
                '{{ __('syncing') }}');
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    id: button.data('id')
                },
                success: function(data) {
                    button.html('<i class="las la-sync-alt"></i> {{ __('sync') }}');
                    if (data.status) {
                        toastr.success(data.message);
                        location.reload();
                    } else {
                        toastr.error(data.message);
                    }
                },
                error: function(xhr, status, error) {
                    button.html('<i class="las la-sync-alt"></i> {{ __('sync') }}');
                    console.error('Error:', error);
                }
            });
        });
    </script>

<script>
    // Event listener for messages from Facebook
    window.addEventListener('message', (event) => {
        // Ensure the message is from a trusted origin
        if (event.origin !== "https://www.facebook.com" && event.origin !== "https://web.facebook.com") {
            return;
        }

        try {  
            // Parse the message data from Facebook
            const data = JSON.parse(event.data);

            // Check if the message type is for WhatsApp Embedded Signup
            if (data.type === 'WA_EMBEDDED_SIGNUP') {
                // Handle different events from the Embedded Signup flow
                if (data.event === 'FINISH') {
                    // User has finished the signup process
                    const {
                        phone_number_id,
                        waba_id,
                        app_id // Dynamically obtained app_id
                    } = data.data;

                    console.log("Phone number ID: ", phone_number_id, " WhatsApp Business Account ID: ", waba_id, " App ID: ", app_id);

                    // Prepare the data to send to the server
                    const requestData = {
                        phone_number_id: phone_number_id,
                        business_account_id: waba_id,
                        app_id: app_id, // Use the dynamically obtained app_id
                        access_token: response.authResponse.accessToken, // You would need to set this from your Facebook SDK response
                        fb_user_id: response.authResponse.userID // Example user ID from auth response
                    };
 


                    // Send the data to the backend server using Axios
                    axios.post(url, requestData, {
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF token
                        }
                    })
                    .then(response => {
                        console.log('Success:', response.data);
                        document.getElementById("session-info-response").textContent = JSON.stringify(response.data, null, 2);
                        toastr.success('Data saved successfully!', 'Success');
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while saving data. Please try again.'
                        });
                    });

                } else if (data.event === 'CANCEL') {
                    // User has canceled the signup process
                    const { current_step } = data.data;
                    console.warn("Cancel at step: ", current_step);
                    toastr.warning('Signup process was cancelled at step: ' + current_step, 'Cancelled');

                } else if (data.event === 'ERROR') {
                    // An error occurred during the signup process
                    const { error_message } = data.data;
                    console.error("Error: ", error_message);
                    Swal.fire({
                        icon: 'error',
                        title: 'Signup Error',
                        text: error_message
                    });
                }
            }

            // Display the session information response
            document.getElementById("session-info-response").textContent = JSON.stringify(data, null, 2);

        } catch (error) {
            console.log('Non-JSON response received:', event.data);
        }
    });

    // Callback function for Facebook login
    const fbLoginCallback = (response) => {
        if (response.authResponse) {
            // Extract the code from the auth response
            const code = response.authResponse.code;

            // This code needs to be sent to the backend to exchange for an access token
            console.log('Facebook Login Successful:', code);
        }

        // Display the SDK response
        document.getElementById("sdk-response").textContent = JSON.stringify(response, null, 2);
    };

    // Function to launch the WhatsApp signup process
    const launchWhatsAppSignup = () => {
        // Validate if the settings are not empty
        const metaConfigurationId = "{{ setting('meta_configuration_id') }}";
        const metaAppId = "{{ setting('meta_app_id') }}";

        if (!metaConfigurationId || !metaAppId) {
            Swal.fire({
                icon: 'warning',
                title: 'Configuration Missing',
                text: 'Meta configuration ID or App ID is missing. Please contact the administrator.'
            });
            return;
        }

        // Trigger Facebook login using the Facebook SDK
        FB.login(fbLoginCallback, {
            config_id: metaConfigurationId, // Configuration ID set in your settings
            response_type: 'code', // Must be 'code' to get the access token
            override_default_response_type: true,
            extras: {
                setup: {},
                featureType: '',
                sessionInfoVersion: '2',
            }
        });
    };

    // Initialize the Facebook SDK
    window.fbAsyncInit = function() {
        FB.init({
            appId: "{{ setting('meta_app_id') }}", // App ID from your settings
            autoLogAppEvents: true,
            xfbml: true,
            version: 'v20.0'
        });
    };
</script>

    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
@endpush
