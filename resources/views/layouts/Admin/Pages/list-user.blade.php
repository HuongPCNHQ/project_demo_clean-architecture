@extends('layouts.Admin.master')
@section('content')
<div class="card card-custom">
    <!--begin::Header-->
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">User Management
                <span class="d-block text-muted pt-2 font-size-sm">User management made easy</span>
            </h3>
        </div>
        <div class="d-flex align-items-center flex-wrap mr-2">
            
        </div>
        <div class="card-toolbar" style="width:100%;">
            <!--begin::Dropdown-->
            <div class="dropdown dropdown-inline mr-2">
                <button id="show-all-user" type="button" class="btn btn-light-primary font-weight-bolder">
                    Show ALL
                </button>
            </div>
            <div class="dropdown dropdown-inline mr-2">
                <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="svg-icon svg-icon-md"></span>
                    Role
                </button>
                <!--begin::Dropdown Menu-->
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                    <!--begin::Navigation-->
                    <ul class="navi flex-column navi-hover py-2">
                        <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                        <li class="navi-item">
                            <a id="admin-show-list" class="navi-link">
                                <span class="navi-text">Admin</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a id="user-show-list" class="navi-link">
                                <span class="navi-text">User</span>
                            </a>
                        </li>
                    </ul>
                    <!--end::Navigation-->
                </div>
                <!--end::Dropdown Menu-->
            </div>
            <div class="dropdown dropdown-inline mr-2">
                <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="svg-icon svg-icon-md"></span>
                    Status
                </button>
                <!--begin::Dropdown Menu-->
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                    <!--begin::Navigation-->
                    <ul class="navi flex-column navi-hover py-2">
                        <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                        <li class="navi-item">
                            <a id="lock-show-list" class="navi-link">
                                <span class="navi-text">Lock</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a id="unlock-show-list" class="navi-link">
                                <span class="navi-text">Unlock</span>
                            </a>
                        </li>
                    </ul>
                    <!--end::Navigation-->
                </div>
                <!--end::Dropdown Menu-->
            </div>
            <div class="dropdown dropdown-inline mr-2">
                <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="svg-icon svg-icon-md"></span>
                    Active
                </button>
                <!--begin::Dropdown Menu-->
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                    <!--begin::Navigation-->
                    <ul class="navi flex-column navi-hover py-2">
                        <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                        <li class="navi-item">
                            <a id="active-show-list" class="navi-link">
                                <span class="navi-text">Active</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a id="inactive-show-list" class="navi-link">
                                <span class="navi-text">Inactive</span>
                            </a>
                        </li>
                    </ul>
                    <!--end::Navigation-->
                </div>
                <!--end::Dropdown Menu-->
            </div>
            <!--end::Dropdown-->
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-0">
        
        <!--begin::Table-->
        <div class="table-responsive">
            <table class="table table-head-custom table-vertical-center"
                id="kt_advance_table_widget_2">
                <thead>
                    <tr class="text-uppercase">
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Active</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="users-table">
                    
                </tbody>
            </table>
        </div>

        <!--end::Table-->
    </div>
    <style>
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 3px;
        }
    </style>
    <!--end::Body-->
</div>
@endsection