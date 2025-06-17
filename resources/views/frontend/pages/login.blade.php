@extends('layouts.frontend.auth')

@section('title')
Employee Login
@endsection

@section('frontend_content')
    @if(session()->has('employee'))
        <script>
            window.location.href = '{{ route("app.social") }}';
        </script>
    @endif

    <!-- Add CSRF Token Meta Tag -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <script>
        // Prevent going back after successful login
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        });
    </script>

    <div class="flex items-center justify-center bg-center bg-no-repeat grow page-bg">
        <div class="kt-card max-w-[370px] w-full " x-data="loginForm()">
            <div class="flex justify-center mt-6 mb-6">
                <img src="{{ asset('frontend_assets/media/images/site-logo.svg') }}" alt="Crust Pizza Co" class="w-auto h-32">
            </div>
            <!-- Alert Messages -->
            <div x-show="alert.show" :class="alert.type === 'success' ? 'bg-green-50 border-green-200 text-green-700' : alert.type === 'error' ? 'bg-red-50 border-red-200 text-red-700' : 'bg-blue-50 border-blue-200 text-blue-700'"
                 class="p-4 m-4 border rounded-md" x-transition>
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg x-show="alert.type === 'success'" class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <svg x-show="alert.type === 'error'" class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <svg x-show="alert.type === 'info'" class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium" x-text="alert.message"></p>
                    </div>
                    <div class="pl-3 ml-auto">
                        <button @click="hideAlert()" class="inline-flex text-gray-400 hover:text-gray-600">
                            <span class="sr-only">Dismiss</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Loading Indicator -->
            <div x-show="loading" class="p-4 m-4 border border-blue-200 rounded-md bg-blue-50" x-transition>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3 -ml-1 text-blue-500 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="font-medium text-blue-700" x-text="loadingText"></span>
                </div>
            </div>

            <form class="flex flex-col gap-5 p-10 kt-card-content">
                {{-- <div class="text-center mb-2.5">
                    <h3 class="text-lg font-medium text-mono leading-none mb-2.5">
                        Sign in
                    </h3>
                    <div class="flex items-center justify-center font-medium">
                        <span class="text-sm text-secondary-foreground me-1.5">
                            Team App Portal
                        </span>
                    </div>
                </div> --}}

                <!-- Step 1: Phone Number -->
                <div x-show="step === 1" x-transition>
                    <div class="space-y-4">
                        @include('frontend.components.form_elements.input', [
                            'label' => 'Mobile',
                            'id' => 'phone',
                            'type' => 'tel',
                            'placeholder' => 'Enter Mobile',
                            'iclass' => 'x-model="formData.phone" @input="validatePhone()" @keyup.enter="requestOtp()" maxlength="12"'
                        ])
                        <button @click="requestOtp()"
                                :disabled="!isValidPhone || loading"
                                :class="{ 'opacity-50 cursor-not-allowed': !isValidPhone || loading }"
                                type="button"
                                class="flex justify-center kt-btn kt-btn-primary grow">
                            <span x-text="loading ? 'Requesting...' : 'Request Passcode'"></span>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Email -->
                <div x-show="step === 2" x-transition>
                    <div class="space-y-4">
                        @include('frontend.components.form_elements.input', [
                            'label' => 'Email',
                            'id' => 'email',
                            'type' => 'email',
                            'placeholder' => 'Enter Email',
                            'iclass' => 'x-model="formData.email" @keyup.enter="requestEmailOtp()"'
                        ])
                        <button @click="requestEmailOtp()"
                                :disabled="!formData.email || loading"
                                :class="{ 'opacity-50 cursor-not-allowed': !formData.email || loading }"
                                type="button"
                                class="flex justify-center kt-btn kt-btn-primary grow">
                            <span x-text="loading ? 'Requesting...' : 'Request Passcode'"></span>
                        </button>
                    </div>
                </div>

                <!-- Step 3: OTP Verification -->
                <div x-show="step === 3" x-transition>
                    <div class="space-y-4">
                        @include('frontend.components.form_elements.input', [
                            'label' => 'One Time Passcode',
                            'id' => 'otp',
                            'type' => 'text',
                            'placeholder' => 'Enter OTP',
                            'maxlength' => '4',
                            'iclass' => 'x-model="formData.otp" @input="formData.otp = formData.otp.replace(/\D/g, \'\')" @keyup.enter="verifyOtp()"'
                        ])
                        <div class="text-center">
                            <p class="text-sm text-gray-600">Didn't receive a text?</p>
                            <button @click="switchToEmail()" type="button" class="text-sm font-medium text-primary hover:text-primary-dark">
                                Click here to send to your email
                            </button>
                        </div>
                        <button @click="verifyOtp()"
                                :disabled="formData.otp.length !== 4 || loading"
                                :class="{ 'opacity-50 cursor-not-allowed': formData.otp.length !== 4 || loading }"
                                type="button"
                                class="flex justify-center kt-btn kt-btn-primary grow">
                            <span x-text="loading ? 'Processing...' : 'Login'"></span>
                        </button>
                    </div>
                </div>

                <!-- Step 4: PIN Reset -->
                <div x-show="step === 4" x-transition>
                    <div class="space-y-4">
                        <div class="p-4 border border-yellow-200 rounded-md bg-yellow-50">
                            <p class="text-sm font-medium text-yellow-800">
                                You must update your PIN to continue. PIN must be 4 to 6 digits.
                            </p>
                        </div>
                        @include('frontend.components.form_elements.input', [
                            'label' => 'New PIN',
                            'id' => 'pin',
                            'type' => 'password',
                            'placeholder' => 'Enter new PIN',
                            'minlength' => '4',
                            'maxlength' => '6',
                            'iclass' => 'x-model="formData.pin" @input="formData.pin = formData.pin.replace(/\D/g, \'\')" @keyup.enter="resetPin()"'
                        ])
                        <button @click="resetPin()"
                                :disabled="!isValidPin || loading"
                                :class="{ 'opacity-50 cursor-not-allowed': !isValidPin || loading }"
                                type="button"
                                class="flex justify-center kt-btn kt-btn-primary grow">
                            <span x-text="loading ? 'Processing...' : 'Reset PIN'"></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="absolute text-sm text-center text-gray-600 bottom-4">
            Crust Pizza Co. © 2025.<br>
            All Rights Reserved.
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        function loginForm() {
            return {
                step: 1,
                loading: false,
                loadingText: '',
                formData: {
                    phone: '',
                    email: '',
                    otp: '',
                    pin: '',
                    secureToken: ''
                },
                alert: {
                    show: false,
                    type: 'info',
                    message: ''
                },

                // init() {
                //     // Get CSRF token from meta tag or use the one from the page
                //     const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
                //     if (token) {
                //         window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
                //     }
                // },
                init() {
                        // Get CSRF token from meta tag or use the one from the page
                        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 'fXTFeU8LMgMYg2vPnifFGt8rJaIXnOA76XapOQbH';
                        if (token && window.axios) {
                            window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
                        }
                    },

                get isValidPhone() {
                    const phone = this.formData.phone.replace(/\D/g, '');
                    return phone.length >= 10;
                },

                get isValidPin() {
                    return this.formData.pin.length >= 4 && this.formData.pin.length <= 6;
                },

                validatePhone() {
                    // Format phone number as user types
                    let phone = this.formData.phone.replace(/\D/g, '');

                    if (phone.length > 0) {
                        if (phone.length <= 3) {
                            phone = phone;
                        } else if (phone.length <= 6) {
                            phone = phone.slice(0, 3) + '-' + phone.slice(3);
                        } else {
                            phone = phone.slice(0, 3) + '-' + phone.slice(3, 6) + '-' + phone.slice(6, 10);
                        }
                    }
                    this.formData.phone = phone;
                },

                showAlert(type, message) {
                    this.alert = { show: true, type, message };
                },

                hideAlert() {
                    this.alert.show = false;
                },

                async requestOtp() {
                    if (!this.isValidPhone) return;

                    this.loading = true;
                    this.loadingText = 'Requesting...';
                    this.hideAlert();

                    const phoneNumber = this.formData.phone.replace(/\D/g, '');

                    try {
                        // Get CSRF token from meta tag or use the one from the page
                        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

                        const response = await fetch('/otp', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                phone: phoneNumber
                            })
                        });


                        const data = await response.json();

                        if (data.success) {
                            this.formData.secureToken = data.secure_token;
                            this.step = 3;
                            this.showAlert('success', data.message);
                        } else {
                            this.showAlert('error', data.message || 'Failed to send OTP. Please try again.');
                        }
                    } catch (error) {
                        console.error('API Error Details:', {
                            message: error.message,
                            stack: error.stack
                        });
                        this.showAlert('error', 'Something went wrong. Please try again.');
                    } finally {
                        this.loading = false;
                    }
                },

                switchToEmail() {
                    this.step = 2;
                    this.hideAlert();
                },

                async requestEmailOtp() {
                    if (!this.formData.email) return;

                    this.loading = true;
                    this.loadingText = 'Requesting...';
                    this.hideAlert();

                    try {
                        const response = await fetch('/email-otp', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                email: this.formData.email
                            })
                        });

                        const data = await response.json();

                        if (data.success) {
                            this.formData.secureToken = data.secure_token;
                            this.step = 3;
                            this.showAlert('success', data.message);
                        } else {
                            this.showAlert('error', data.message);
                        }
                    } catch (error) {
                        this.showAlert('error', 'Something went wrong. Please try again.');
                        console.error('Error:', error);
                    } finally {
                        this.loading = false;
                    }
                },

                async verifyOtp() {
                    if (this.formData.otp.length !== 4) return;

                    this.loading = true;
                    this.loadingText = 'Processing...';
                    this.hideAlert();

                    try {
                        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

                        const response = await fetch('/login', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                step: this.step,
                                secure_token: this.formData.secureToken,
                                otp: this.formData.otp,
                                phone: this.formData.phone,
                                email: this.formData.email,
                                reset_pin: false
                            })
                        });

                        const data = await response.json();

                        if (data.success) {
                            this.showAlert('success', data.message);
                            // Store session data
                            localStorage.setItem('employee_session', JSON.stringify(data.authuser));

                            // Replace the current history state to prevent going back
                            window.history.replaceState(null, '', data.redirect_url);

                            // Redirect to dashboard
                            window.location.href = data.redirect_url;
                        } else if (data.pin_reset) {
                            this.step = 4;
                            this.showAlert('info', 'Please set up your PIN to continue.');
                        } else {
                            this.showAlert('error', data.message);
                        }
                    } catch (error) {
                        this.showAlert('error', 'Something went wrong. Please try again.');
                        console.error('Error:', error);
                    } finally {
                        this.loading = false;
                    }
                },

                async resetPin() {
                    if (!this.isValidPin) return;

                    this.loading = true;
                    this.loadingText = 'Processing...';
                    this.hideAlert();

                    try {
                        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

                        const response = await fetch('/login', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                step: 4,
                                secure_token: this.formData.secureToken,
                                otp: this.formData.otp,
                                phone: this.formData.phone,
                                email: this.formData.email,
                                pin: this.formData.pin,
                                reset_pin: true
                            })
                        });

                        const data = await response.json();

                        if (data.success) {
                            this.showAlert('success', data.message);
                            // Store session data
                            localStorage.setItem('employee_session', JSON.stringify(data.authuser));
                            setTimeout(() => {
                                window.location.href = data.redirect_url;
                            }, 1500);
                        } else {
                            this.showAlert('error', data.message);
                        }
                    } catch (error) {
                        this.showAlert('error', 'Something went wrong. Please try again.');
                        console.error('Error:', error);
                    } finally {
                        this.loading = false;
                    }
                },

                // Add logout method
                logout() {
                    fetch('/logout', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.href = '/access/login';
                        }
                    });
                }
            }
        }
    </script>
   {{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        // If the hash is not #/access/login, redirect to it
        if (window.location.hash !== '#/access/login') {
            window.location.hash = '#/access/login';
        }

        // Optionally, you can show/hide content based on the hash
        // For Alpine.js, you can use x-show or x-if with window.location.hash
    });
    </script> --}}

@endsection
