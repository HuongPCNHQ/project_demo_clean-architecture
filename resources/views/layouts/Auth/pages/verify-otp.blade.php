@extends('layouts.Auth.master')
@section('content')
<div class="login-container order-2 order-lg-1 d-flex flex-center flex-row-fluid px-7 pt-lg-0 pb-lg-0 pt-4 pb-6 bg-white">
    <!--begin::Wrapper-->
    <div class="login-content d-flex flex-column pt-lg-0 pt-12">
        <!--begin::Logo-->
        <a href="#" class="login-logo pb-xl-20 pb-15" style="padding-bottom: 1rem !important;">
            <img src="/auth/assets/media/logos/logo-4.png" class="max-h-70px" alt="" />
        </a>
        <div class="wizard-nav pt-5 pt-lg-15 pb-10">
            <!--begin::Wizard Steps-->
            <div class="wizard-steps d-flex flex-column flex-sm-row">
                <!--begin::Wizard Step 1 Nav-->
                <div class="wizard-step flex-grow-1 flex-basis-0" data-wizard-type="step"
                    data-wizard-state="current">
                    <div class="wizard-wrapper pr-7">
                        <div id="focus-step1" class="wizard-icon" style="background-color: #F3F6F9;">
                            <span id="focus-step1-span" class="wizard-number" style="color: #3F4254;">1</span>
                        </div>
                        <div class="wizard-label">
                            <h3 class="wizard-title">Đăng ký</h3>
                            <div class="wizard-desc">Điền thông tin</div>
                        </div>
                        <span class="svg-icon pl-6">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <rect fill="#000000" opacity="0.3"
                                        transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)"
                                        x="7.5" y="7.5" width="2" height="9" rx="1" />
                                    <path
                                        d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                        fill="#000000" fill-rule="nonzero"
                                        transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                </g>
                            </svg>
                        </span>
                    </div>
                </div>
                <!--end::Wizard Step 1 Nav-->
                <!--begin::Wizard Step 2 Nav-->
                <div class="wizard-step flex-grow-1 flex-basis-0" data-wizard-type="step">
                    <div class="wizard-wrapper pr-7">
                        <div id="focus-step2" class="wizard-icon" style="background-color: #C9F7F5;">
                            <span id="focus-step2-span" class="wizard-number" style="color: #1BC5BD;">2</span>
                        </div>
                        <div class="wizard-label">
                            <h3 class="wizard-title">Kích hoạt</h3>
                            <div class="wizard-desc">Kiểm tra email</div>
                        </div>
                    </div>
                </div>
                <!--end::Wizard Step 2 Nav-->

            </div>
            <!--end::Wizard Steps-->
        </div>
        <!--end::Logo-->
        <!--begin::Signin-->
        <div id="content-forgot" class="login-form">
            <form class="form" id="kt_login_forgot_form" action="">
                <!--begin::Title-->
                <div class="pb-5 pb-lg-15">
                    <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Xác thực kích hoạt tài khoản ?</h3>
                    <p class="text-muted font-weight-bold font-size-h4">Vui lòng điền mã OTP !</p>
                </div>
                <!--end::Title-->
                <!--begin::Form group-->
                <div class="form-group">
                    <label class="font-size-h6 font-weight-bolder text-dark">Mã OTP</label> <label style="color: red;">*</label>
                    <input id="otp" type="text"
                        class="form-control form-control-solid h-auto py-7 px-6 border-0 rounded-lg font-size-h6" placeholder="Nhập OTP" value="" />
                    <div class="error" id="otp-error"></div>
                </div>

                <!--end::Form group-->
                <!--begin::Form group-->
                <div style="display: flex; padding-top: 22.75px;">
                    <button id="forgot-btn" type="button"
                        style="color: #FFFFFF;
                            background-color: #187DE4;
                            font-size: 1.175rem;
                            font-weight: 600;
                            border: none;
                            padding: 13px 26px;
                            border-radius: 0.42rem;">
                        Tiếp tục
                    </button>
                </div>
                <!--end::Form group-->
            </form>
        </div>

        <style>
            .error {
                color: red;
                font-size: 0.9em;
                margin-top: 3px;
            }
        </style>
        <!--end::Signin-->
    </div>
    <!--end::Wrapper-->
</div>
@endsection