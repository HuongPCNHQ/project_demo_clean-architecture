@extends('layouts.Frontend.master')
@section('content')
<div class="d-flex flex-row">
    <!--begin::Content-->
    <div class="flex-row-fluid ml-lg-8">
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">Change Password</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Change your account password</span>
                </div>
                <div class="card-toolbar">
                    <button id="change-password-btn" type="reset" class="btn btn-success mr-2">Save Changes</button>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <style>
                .error {
                    color: red;
                    font-size: 0.9em;
                    margin-top: 3px;
                }
            </style>
            <form class="form">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label text-alert">Current Password</label>
                        <div class="col-lg-9 col-xl-6">
                            <input id="current_password" type="password" class="form-control form-control-lg form-control-solid mb-2" value="" placeholder="Current password" />
                            <div class="error" id="current_password-error"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label text-alert">New Password</label>
                        <div class="col-lg-9 col-xl-6">
                            <input id="new_password" type="password" class="form-control form-control-lg form-control-solid" value="" placeholder="New password" />
                            <div class="error" id="new_password-error"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label text-alert">Verify Password</label>
                        <div class="col-lg-9 col-xl-6">
                            <input id="new_password_confirmation" type="password" class="form-control form-control-lg form-control-solid" value="" placeholder="Verify password" />
                            <div class="error" id="new_password_confirmation-error"></div>
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
    <!--end::Content-->
</div>
@endsection