@extends('layouts.app')
@section('content')
<div class="app-main flex-column flex-row-fluid " id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">

<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

<!--begin::Toolbar container-->
<div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



<!--begin::Page title-->
<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
<!--begin::Title-->
<h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
Documents
</h1>
<!--end::Title-->


<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                                        <a href="/keen/demo1/index.html" class="text-muted text-hover-primary">
                    Home                            </a>
                                </li>
                    <!--end::Item-->
                        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-500 w-5px h-2px"></span>
        </li>
        <!--end::Item-->

                <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                                        User Profile                                            </li>
                    <!--end::Item-->

        </ul>
<!--end::Breadcrumb-->
</div>
<!--end::Page title-->
<!--begin::Actions-->
<div class="d-flex align-items-center gap-2 gap-lg-3">
<!--begin::Filter menu-->
<div class="d-flex">
<select name="campaign-type" data-control="select2" data-hide-search="true" class="form-select form-select-sm bg-body border-body w-175px select2-hidden-accessible" data-select2-id="select2-data-7-6v9t" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
    <option value="Twitter" selected="selected" data-select2-id="select2-data-9-uevw">Select Campaign</option>
    <option value="Twitter">Twitter Campaign</option>
    <option value="Twitter">Facebook Campaign</option>
    <option value="Twitter">Adword Campaign</option>
    <option value="Twitter">Carbon Campaign</option>
</select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-8-skur" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-sm bg-body border-body w-175px" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-campaign-type-h1-container" aria-controls="select2-campaign-type-h1-container"><span class="select2-selection__rendered" id="select2-campaign-type-h1-container" role="textbox" aria-readonly="true" title="Select Campaign">Select Campaign</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>

<a href="#" class="btn btn-icon btn-sm btn-success flex-shrink-0 ms-4" data-bs-toggle="modal" data-bs-target="#kt_modal_create_campaign">
    <i class="ki-duotone ki-plus fs-2"></i>
</a>
</div>
<!--end::Filter menu-->


<!--begin::Secondary button-->
<!--end::Secondary button-->

<!--begin::Primary button-->
<!--end::Primary button-->
</div>
<!--end::Actions-->
</div>
<!--end::Toolbar container-->
</div>
<!--end::Toolbar-->

<!--begin::Content-->
<div id="kt_app_content" class="app-content  flex-column-fluid ">


<!--begin::Content container-->
<div id="kt_app_content_container" class="app-container  container-xxl ">

<!--begin::Navbar-->
<div class="card card-flush mb-9" id="kt_user_profile_panel">
<!--begin::Hero nav-->
<div class="card-header rounded-top bgi-size-cover h-200px" style="background-position: 100% 50%; background-image:url('/keen/demo1/assets/media/misc/profile-head-bg.jpg')">
</div>
<!--end::Hero nav-->

<!--begin::Body-->
<div class="card-body mt-n19">
<!--begin::Details-->
<div class="m-0">
<!--begin: Pic-->
<div class="d-flex flex-stack align-items-end pb-4 mt-n19">
    <div class="symbol symbol-125px symbol-lg-150px symbol-fixed position-relative mt-n3">
        <img src="/keen/demo1/assets/media/avatars/300-3.jpg" alt="image" class="border border-white border-4" style="border-radius: 20px">
        <div class="position-absolute translate-middle bottom-0 start-100 ms-n1 mb-9 bg-success rounded-circle h-15px w-15px"></div>
    </div>

    <!--begin::Toolbar-->
    <div class="me-0">
        <button class="btn btn-icon btn-sm btn-active-color-primary  justify-content-end pt-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
            <i class="fonticon-settings fs-2"></i>
        </button>

<!--begin::Menu 3-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">
<!--begin::Heading-->
<div class="menu-item px-3">
<div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
Payments
</div>
</div>
<!--end::Heading-->

<!--begin::Menu item-->
<div class="menu-item px-3">
<a href="#" class="menu-link px-3">
Create Invoice
</a>
</div>
<!--end::Menu item-->

<!--begin::Menu item-->
<div class="menu-item px-3">
<a href="#" class="menu-link flex-stack px-3">
Create Payment

<span class="ms-2" data-bs-toggle="tooltip" aria-label="Specify a target name for future usage and reference" data-bs-original-title="Specify a target name for future usage and reference" data-kt-initialized="1">
    <i class="ki-duotone ki-information fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>            </span>
</a>
</div>
<!--end::Menu item-->

<!--begin::Menu item-->
<div class="menu-item px-3">
<a href="#" class="menu-link px-3">
Generate Bill
</a>
</div>
<!--end::Menu item-->

<!--begin::Menu item-->
<div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-end">
<a href="#" class="menu-link px-3">
<span class="menu-title">Subscription</span>
<span class="menu-arrow"></span>
</a>

<!--begin::Menu sub-->
<div class="menu-sub menu-sub-dropdown w-175px py-4">
<!--begin::Menu item-->
<div class="menu-item px-3">
    <a href="#" class="menu-link px-3">
        Plans
    </a>
</div>
<!--end::Menu item-->

<!--begin::Menu item-->
<div class="menu-item px-3">
    <a href="#" class="menu-link px-3">
        Billing
    </a>
</div>
<!--end::Menu item-->

<!--begin::Menu item-->
<div class="menu-item px-3">
    <a href="#" class="menu-link px-3">
        Statements
    </a>
</div>
<!--end::Menu item-->

<!--begin::Menu separator-->
<div class="separator my-2"></div>
<!--end::Menu separator-->

<!--begin::Menu item-->
<div class="menu-item px-3">
    <div class="menu-content px-3">
        <!--begin::Switch-->
        <label class="form-check form-switch form-check-custom form-check-solid">
            <!--begin::Input-->
            <input class="form-check-input w-30px h-20px" type="checkbox" value="1" checked="checked" name="notifications">
            <!--end::Input-->

            <!--end::Label-->
            <span class="form-check-label text-muted fs-6">
                Recuring
            </span>
            <!--end::Label-->
        </label>
        <!--end::Switch-->
    </div>
</div>
<!--end::Menu item-->
</div>
<!--end::Menu sub-->
</div>
<!--end::Menu item-->

<!--begin::Menu item-->
<div class="menu-item px-3 my-1">
<a href="#" class="menu-link px-3">
Settings
</a>
</div>
<!--end::Menu item-->
</div>
<!--end::Menu 3-->
    </div>
    <!--end::Toolbar-->
</div>
<!--end::Pic-->

<!--begin::Info-->
<div class="d-flex flex-stack flex-wrap align-items-end">
    <!--begin::User-->
    <div class="d-flex flex-column">
        <!--begin::Name-->
        <div class="d-flex align-items-center mb-2">
            <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bolder me-1">Bessie Cooper</a>
            <a href="#" class="" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Account is verified" data-bs-original-title="Account is verified" data-kt-initialized="1">
                <i class="ki-duotone ki-verify fs-1 text-primary"><span class="path1"></span><span class="path2"></span></i>                        </a>
        </div>
        <!--end::Name-->

        <!--begin::Text-->
        <span class="fw-bold text-gray-600 fs-6 mb-2 d-block">
            Design is like a fart. If you have to force it, it’s probably shit.
        </span>
        <!--end::Text-->

        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap fw-semibold fs-7 pe-2">
            <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary">
                UI/UX Design
            </a>
            <span class="bullet bullet-dot h-5px w-5px bg-gray-500 mx-3"></span>
            <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary">
                Austin, TX
            </a>
            <span class="bullet bullet-dot h-5px w-5px bg-gray-500 mx-3"></span>
            <a href="#" class="text-gray-500 text-hover-primary">
                3,450 Followers
            </a>
        </div>
        <!--end::Info-->
    </div>
    <!--end::User-->

    <!--begin::Actions-->
    <div class="d-flex">
        <a href="#" class="btn btn-sm btn-light me-3" id="kt_drawer_chat_toggle">Send Message</a>

        <button class="btn btn-sm btn-primary" id="kt_user_follow_button">
            <i class="ki-duotone ki-check fs-2 d-none"></i>
<!--begin::Indicator label-->
<span class="indicator-label">
Follow</span>
<!--end::Indicator label-->

<!--begin::Indicator progress-->
<span class="indicator-progress">
Please wait...    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
</span>
<!--end::Indicator progress-->                    </button>
    </div>
    <!--end::Actions-->
</div>
<!--end::Info-->
</div>
<!--end::Details-->
</div>
</div>
<!--end::Navbar-->

<!--begin::Nav items-->
<div id="kt_user_profile_nav" class="rounded bg-gray-200 d-flex flex-stack flex-wrap mb-9 p-2" data-kt-page-scroll-position="400" data-kt-sticky="true" data-kt-sticky-name="sticky-profile-navs" data-kt-sticky-offset="{default: false, lg: '200px'}" data-kt-sticky-width="{target: '#kt_user_profile_panel'}" data-kt-sticky-left="auto" data-kt-sticky-top="70px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95" style="">
<!--begin::Nav-->
<ul class="nav flex-wrap border-transparent">
        <!--begin::Nav item-->
<li class="nav-item my-1">
    <a class="btn btn-sm btn-color-gray-600 bg-state-body btn-active-color-gray-800 fw-bolder fw-bold fs-6 fs-lg-base nav-link px-3 px-lg-4 mx-1
        " href="/keen/demo1/pages/user-profile/overview.html">

        Overview                </a>
</li>
<!--end::Nav item-->
        <!--begin::Nav item-->
<li class="nav-item my-1">
    <a class="btn btn-sm btn-color-gray-600 bg-state-body btn-active-color-gray-800 fw-bolder fw-bold fs-6 fs-lg-base nav-link px-3 px-lg-4 mx-1
        " href="/keen/demo1/pages/user-profile/projects.html">

        Projects                </a>
</li>
<!--end::Nav item-->
        <!--begin::Nav item-->
<li class="nav-item my-1">
    <a class="btn btn-sm btn-color-gray-600 bg-state-body btn-active-color-gray-800 fw-bolder fw-bold fs-6 fs-lg-base nav-link px-3 px-lg-4 mx-1
        " href="/keen/demo1/pages/user-profile/campaigns.html">

        Campaigns                </a>
</li>
<!--end::Nav item-->
        <!--begin::Nav item-->
<li class="nav-item my-1">
    <a class="btn btn-sm btn-color-gray-600 bg-state-body btn-active-color-gray-800 fw-bolder fw-bold fs-6 fs-lg-base nav-link px-3 px-lg-4 mx-1
        active" href="/keen/demo1/pages/user-profile/documents.html">

        Documents                </a>
</li>
<!--end::Nav item-->
        <!--begin::Nav item-->
<li class="nav-item my-1">
    <a class="btn btn-sm btn-color-gray-600 bg-state-body btn-active-color-gray-800 fw-bolder fw-bold fs-6 fs-lg-base nav-link px-3 px-lg-4 mx-1
        " href="/keen/demo1/pages/user-profile/followers.html">

        Followers                </a>
</li>
<!--end::Nav item-->
        <!--begin::Nav item-->
<li class="nav-item my-1">
    <a class="btn btn-sm btn-color-gray-600 bg-state-body btn-active-color-gray-800 fw-bolder fw-bold fs-6 fs-lg-base nav-link px-3 px-lg-4 mx-1
        " href="/keen/demo1/pages/user-profile/activity.html">

        Activity                </a>
</li>
<!--end::Nav item-->
</ul>
<!--end::Nav-->
</div>
<!--end::Nav items-->
<!--begin::Documents toolbar-->
<div class="d-flex flex-wrap flex-stack mb-6">
<!--begin::Title-->
<h3 class="fw-bold my-2">
My Documents
<span class="fs-6 text-gray-500 fw-semibold ms-1">100+ resources</span>
</h3>
<!--end::Title-->

<!--begin::Controls-->
<div class="d-flex my-2">
<!--begin::Search-->
<div class="d-flex align-items-center position-relative me-4">
<i class="ki-duotone ki-magnifier fs-3 position-absolute ms-3"><span class="path1"></span><span class="path2"></span></i>            <input type="text" id="kt_filter_search" class="form-control form-control-sm border-body bg-body w-150px ps-10" placeholder="Search">
</div>
<!--end::Search-->

<a href="/keen/demo1/apps/file-manager/files.html" class="btn btn-primary btn-sm">
File Manager
</a>
</div>
<!--end::Controls-->
</div>
<!--end::Documents toolbar-->


<!--begin::Row-->
<div class="row g-6 g-xl-9 mb-6 mb-xl-9">


        <!--begin::Col-->
<div class="col-md-6 col-lg-4 col-xl-3">
    <!--begin::Card-->
    <div class="card h-100 ">
        <!--begin::Card body-->
        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
            <!--begin::Name-->
            <a href="/keen/demo1/apps/file-manager/files.html" class="text-gray-800 text-hover-primary d-flex flex-column">
                <!--begin::Image-->
                <div class="symbol symbol-75px mb-5">
                                                        <img src="/keen/demo1/assets/media/svg/files/folder-document.svg" class="theme-light-show" alt="">
                        <img src="/keen/demo1/assets/media/svg/files/folder-document-dark.svg" class="theme-dark-show" alt="">

                </div>
                <!--end::Image-->

                <!--begin::Title-->
                <div class="fs-5 fw-bold mb-2">
                    Finance                            </div>
                <!--end::Title-->
            </a>
            <!--end::Name-->

            <!--begin::Description-->
            <div class="fs-7 fw-semibold text-gray-500">
                7 files                        </div>
            <!--end::Description-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Col-->

            <!--begin::Col-->
<div class="col-md-6 col-lg-4 col-xl-3">
    <!--begin::Card-->
    <div class="card h-100 ">
        <!--begin::Card body-->
        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
            <!--begin::Name-->
            <a href="/keen/demo1/apps/file-manager/files.html" class="text-gray-800 text-hover-primary d-flex flex-column">
                <!--begin::Image-->
                <div class="symbol symbol-75px mb-5">
                                                        <img src="/keen/demo1/assets/media/svg/files/folder-document.svg" class="theme-light-show" alt="">
                        <img src="/keen/demo1/assets/media/svg/files/folder-document-dark.svg" class="theme-dark-show" alt="">

                </div>
                <!--end::Image-->

                <!--begin::Title-->
                <div class="fs-5 fw-bold mb-2">
                    Customers                            </div>
                <!--end::Title-->
            </a>
            <!--end::Name-->

            <!--begin::Description-->
            <div class="fs-7 fw-semibold text-gray-500">
                3 files                        </div>
            <!--end::Description-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Col-->

            <!--begin::Col-->
<div class="col-md-6 col-lg-4 col-xl-3">
    <!--begin::Card-->
    <div class="card h-100 ">
        <!--begin::Card body-->
        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
            <!--begin::Name-->
            <a href="/keen/demo1/apps/file-manager/files.html" class="text-gray-800 text-hover-primary d-flex flex-column">
                <!--begin::Image-->
                <div class="symbol symbol-75px mb-5">
                                                        <img src="/keen/demo1/assets/media/svg/files/folder-document.svg" class="theme-light-show" alt="">
                        <img src="/keen/demo1/assets/media/svg/files/folder-document-dark.svg" class="theme-dark-show" alt="">

                </div>
                <!--end::Image-->

                <!--begin::Title-->
                <div class="fs-5 fw-bold mb-2">
                    CRM Project                            </div>
                <!--end::Title-->
            </a>
            <!--end::Name-->

            <!--begin::Description-->
            <div class="fs-7 fw-semibold text-gray-500">
                25 files                        </div>
            <!--end::Description-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Col-->



</div>
<!--end:Row-->



<!--begin::Row-->
<div class="row g-6 g-xl-9 mb-6 mb-xl-9">


        <!--begin::Col-->
<div class="col-md-6 col-lg-4 col-xl-3">
    <!--begin::Card-->
    <div class="card h-100 ">
        <!--begin::Card body-->
        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
            <!--begin::Name-->
            <a href="/keen/demo1/apps/file-manager/files.html" class="text-gray-800 text-hover-primary d-flex flex-column">
                <!--begin::Image-->
                <div class="symbol symbol-60px mb-5">
                                                        <img src="/keen/demo1/assets/media/svg/files/pdf.svg" class="theme-light-show" alt="">
                        <img src="/keen/demo1/assets/media/svg/files/pdf-dark.svg" class="theme-dark-show" alt="">

                </div>
                <!--end::Image-->

                <!--begin::Title-->
                <div class="fs-5 fw-bold mb-2">
                    Project Reqs..                            </div>
                <!--end::Title-->
            </a>
            <!--end::Name-->

            <!--begin::Description-->
            <div class="fs-7 fw-semibold text-gray-500">
                3 days ago                        </div>
            <!--end::Description-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Col-->

            <!--begin::Col-->
<div class="col-md-6 col-lg-4 col-xl-3">
    <!--begin::Card-->
    <div class="card h-100 ">
        <!--begin::Card body-->
        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
            <!--begin::Name-->
            <a href="/keen/demo1/apps/file-manager/files.html" class="text-gray-800 text-hover-primary d-flex flex-column">
                <!--begin::Image-->
                <div class="symbol symbol-60px mb-5">
                                                        <img src="/keen/demo1/assets/media/svg/files/doc.svg" class="theme-light-show" alt="">
                        <img src="/keen/demo1/assets/media/svg/files/doc-dark.svg" class="theme-dark-show" alt="">

                </div>
                <!--end::Image-->

                <!--begin::Title-->
                <div class="fs-5 fw-bold mb-2">
                    CRM App Docs..                            </div>
                <!--end::Title-->
            </a>
            <!--end::Name-->

            <!--begin::Description-->
            <div class="fs-7 fw-semibold text-gray-500">
                3 days ago                        </div>
            <!--end::Description-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Col-->

            <!--begin::Col-->
<div class="col-md-6 col-lg-4 col-xl-3">
    <!--begin::Card-->
    <div class="card h-100 ">
        <!--begin::Card body-->
        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
            <!--begin::Name-->
            <a href="/keen/demo1/apps/file-manager/files.html" class="text-gray-800 text-hover-primary d-flex flex-column">
                <!--begin::Image-->
                <div class="symbol symbol-60px mb-5">
                                                        <img src="/keen/demo1/assets/media/svg/files/css.svg" class="theme-light-show" alt="">
                        <img src="/keen/demo1/assets/media/svg/files/css-dark.svg" class="theme-dark-show" alt="">

                </div>
                <!--end::Image-->

                <!--begin::Title-->
                <div class="fs-5 fw-bold mb-2">
                    User CRUD Styles                            </div>
                <!--end::Title-->
            </a>
            <!--end::Name-->

            <!--begin::Description-->
            <div class="fs-7 fw-semibold text-gray-500">
                4 days ago                        </div>
            <!--end::Description-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Col-->

            <!--begin::Col-->
<div class="col-md-6 col-lg-4 col-xl-3">
    <!--begin::Card-->
    <div class="card h-100 ">
        <!--begin::Card body-->
        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
            <!--begin::Name-->
            <a href="/keen/demo1/apps/file-manager/files.html" class="text-gray-800 text-hover-primary d-flex flex-column">
                <!--begin::Image-->
                <div class="symbol symbol-60px mb-5">
                                                        <img src="/keen/demo1/assets/media/svg/files/ai.svg" class="theme-light-show" alt="">
                        <img src="/keen/demo1/assets/media/svg/files/ai-dark.svg" class="theme-dark-show" alt="">

                </div>
                <!--end::Image-->

                <!--begin::Title-->
                <div class="fs-5 fw-bold mb-2">
                    Product Logo                            </div>
                <!--end::Title-->
            </a>
            <!--end::Name-->

            <!--begin::Description-->
            <div class="fs-7 fw-semibold text-gray-500">
                5 days ago                        </div>
            <!--end::Description-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Col-->



        <!--begin::Col-->
<div class="col-md-6 col-lg-4 col-xl-3">
    <!--begin::Card-->
    <div class="card h-100 ">
        <!--begin::Card body-->
        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
            <!--begin::Name-->
            <a href="/keen/demo1/apps/file-manager/files.html" class="text-gray-800 text-hover-primary d-flex flex-column">
                <!--begin::Image-->
                <div class="symbol symbol-60px mb-5">
                                                        <img src="/keen/demo1/assets/media/svg/files/sql.svg" class="theme-light-show" alt="">
                        <img src="/keen/demo1/assets/media/svg/files/sql-dark.svg" class="theme-dark-show" alt="">

                </div>
                <!--end::Image-->

                <!--begin::Title-->
                <div class="fs-5 fw-bold mb-2">
                    Orders backup                            </div>
                <!--end::Title-->
            </a>
            <!--end::Name-->

            <!--begin::Description-->
            <div class="fs-7 fw-semibold text-gray-500">
                1 week ago                        </div>
            <!--end::Description-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Col-->

            <!--begin::Col-->
<div class="col-md-6 col-lg-4 col-xl-3">
    <!--begin::Card-->
    <div class="card h-100 ">
        <!--begin::Card body-->
        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
            <!--begin::Name-->
            <a href="/keen/demo1/apps/file-manager/files.html" class="text-gray-800 text-hover-primary d-flex flex-column">
                <!--begin::Image-->
                <div class="symbol symbol-60px mb-5">
                                                        <img src="/keen/demo1/assets/media/svg/files/xml.svg" class="theme-light-show" alt="">
                        <img src="/keen/demo1/assets/media/svg/files/xml-dark.svg" class="theme-dark-show" alt="">

                </div>
                <!--end::Image-->

                <!--begin::Title-->
                <div class="fs-5 fw-bold mb-2">
                    UTAIR CRM API Co..                            </div>
                <!--end::Title-->
            </a>
            <!--end::Name-->

            <!--begin::Description-->
            <div class="fs-7 fw-semibold text-gray-500">
                2 weeks ago                        </div>
            <!--end::Description-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Col-->

            <!--begin::Col-->
<div class="col-md-6 col-lg-4 col-xl-3">
    <!--begin::Card-->
    <div class="card h-100 ">
        <!--begin::Card body-->
        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
            <!--begin::Name-->
            <a href="/keen/demo1/apps/file-manager/files.html" class="text-gray-800 text-hover-primary d-flex flex-column">
                <!--begin::Image-->
                <div class="symbol symbol-60px mb-5">
                                                        <img src="/keen/demo1/assets/media/svg/files/tif.svg" class="theme-light-show" alt="">
                        <img src="/keen/demo1/assets/media/svg/files/tif-dark.svg" class="theme-dark-show" alt="">

                </div>
                <!--end::Image-->

                <!--begin::Title-->
                <div class="fs-5 fw-bold mb-2">
                    Tower Hill App..                            </div>
                <!--end::Title-->
            </a>
            <!--end::Name-->

            <!--begin::Description-->
            <div class="fs-7 fw-semibold text-gray-500">
                3 weeks ago                        </div>
            <!--end::Description-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Col-->



</div>
<!--end:Row-->


<!--begin::Modals-->
<!--begin::Modal - Offer A Deal-->
<div class="modal fade" id="kt_modal_offer_a_deal" tabindex="-1" aria-hidden="true">
<!--begin::Modal dialog-->
<div class="modal-dialog modal-dialog-centered mw-1000px">
<!--begin::Modal content-->
<div class="modal-content">
<!--begin::Modal header-->
<div class="modal-header py-7 d-flex justify-content-between">
    <!--begin::Modal title-->
    <h2>Offer a Deal</h2>
    <!--end::Modal title-->

    <!--begin::Close-->
    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>                </div>
    <!--end::Close-->
</div>
<!--begin::Modal header-->

<!--begin::Modal body-->
<div class="modal-body scroll-y m-5">
    <!--begin::Stepper-->
    <div class="stepper stepper-links d-flex flex-column" id="kt_modal_offer_a_deal_stepper">
        <!--begin::Nav-->
        <div class="stepper-nav justify-content-center py-2">
            <!--begin::Step 1-->
            <div class="stepper-item me-5 me-md-15 current" data-kt-stepper-element="nav">
                <h3 class="stepper-title">
                    Deal Type
                </h3>
            </div>
            <!--end::Step 1-->

            <!--begin::Step 2-->
            <div class="stepper-item me-5 me-md-15" data-kt-stepper-element="nav">
                <h3 class="stepper-title">
                    Deal Details
                </h3>
            </div>
            <!--end::Step 2-->

            <!--begin::Step 3-->
            <div class="stepper-item me-5 me-md-15" data-kt-stepper-element="nav">
                <h3 class="stepper-title">
                    Finance Settings
                </h3>
            </div>
            <!--end::Step 3-->

            <!--begin::Step 4-->
            <div class="stepper-item" data-kt-stepper-element="nav">
                <h3 class="stepper-title">
                    Completed
                </h3>
            </div>
            <!--end::Step 4-->
        </div>
        <!--end::Nav-->

        <!--begin::Form-->
        <form class="mx-auto mw-500px w-100 pt-15 pb-10" novalidate="novalidate" id="kt_modal_offer_a_deal_form">
            <!--begin::Type-->
<div class="current" data-kt-stepper-element="content">
<!--begin::Wrapper-->
<div class="w-100">
<!--begin::Heading-->
<div class="mb-13">
<!--begin::Title-->
<h2 class="mb-3">Deal Type</h2>
<!--end::Title-->

<!--begin::Description-->
<div class="text-muted fw-semibold fs-5">
    If you need more info, please check out
    <a href="#" class="link-primary fw-bold">FAQ Page</a>.
</div>
<!--end::Description-->
</div>
<!--end::Heading-->

<!--begin::Input group-->
<div class="fv-row mb-15" data-kt-buttons="true" data-kt-initialized="1">
<!--begin::Option-->
<label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6 mb-6 active">
    <!--begin::Input-->
    <input class="btn-check" type="radio" checked="checked" name="offer_type" value="1">
    <!--end::Input-->

    <!--begin::Label-->
    <span class="d-flex">
        <!--begin::Icon-->
        <i class="ki-duotone ki-profile-circle fs-3hx"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>                    <!--end::Icon-->

        <!--begin::Info-->
        <span class="ms-4">
            <span class="fs-3 fw-bold text-gray-900 mb-2 d-block">Personal Deal</span>

            <span class="fw-semibold fs-4 text-muted">
                If you need more info, please check it out
            </span>
        </span>
        <!--end::Info-->
    </span>
    <!--end::Label-->
</label>
<!--end::Option-->

<!--begin::Option-->
<label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6">
    <!--begin::Input-->
    <input class="btn-check" type="radio" name="offer_type" value="2">
    <!--end::Input-->

    <!--begin::Label-->
    <span class="d-flex">
        <!--begin::Icon-->
        <i class="ki-duotone ki-element-11 fs-3hx"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>                    <!--end::Icon-->

        <!--begin::Info-->
        <span class="ms-4">
            <span class="fs-3 fw-bold text-gray-900 mb-2 d-block">Corporate Deal</span>

            <span class="fw-semibold fs-4 text-muted">
                Create corporate account to manage users
            </span>
        </span>
        <!--end::Info-->
    </span>
    <!--end::Label-->
</label>
<!--end::Option-->
</div>
<!--end::Input group-->

<!--begin::Actions-->
<div class="d-flex justify-content-end">
<button type="button" class="btn btn-lg btn-primary" data-kt-element="type-next">
    <span class="indicator-label">
        Offer Details
    </span>
    <span class="indicator-progress">
        Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
    </span>
</button>
</div>
<!--end::Actions-->
</div>
<!--end::Wrapper-->
</div>
<!--end::Type-->
            <!--begin::Details-->
<div data-kt-stepper-element="content">
<!--begin::Wrapper-->
<div class="w-100">
<!--begin::Heading-->
<div class="mb-13">
<!--begin::Title-->
<h2 class="mb-3">Deal Details</h2>
<!--end::Title-->

<!--begin::Description-->
<div class="text-muted fw-semibold fs-5">
    If you need more info, please check out
    <a href="#" class="link-primary fw-bold">FAQ Page</a>.
</div>
<!--end::Description-->
</div>
<!--end::Heading-->

<!--begin::Input group-->
<div class="fv-row mb-8">
<!--begin::Label-->
<label class="required fs-6 fw-semibold mb-2">Customer</label>
<!--end::Label-->

<!--begin::Input-->
<select class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-placeholder="Select an option" name="details_customer" data-select2-id="select2-data-10-paif" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
    <option></option>
    <option value="1" selected="" data-select2-id="select2-data-12-9uef">Keenthemes</option>
    <option value="2">CRM App</option>
</select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-11-v8lz" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-details_customer-ao-container" aria-controls="select2-details_customer-ao-container"><span class="select2-selection__rendered" id="select2-details_customer-ao-container" role="textbox" aria-readonly="true" title="Keenthemes">Keenthemes</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
<!--end::Input-->
</div>
<!--end::Input group-->

<!--begin::Input group-->
<div class="fv-row mb-8">
<!--begin::Label-->
<label class="required fs-6 fw-semibold mb-2">Deal Title</label>
<!--end::Label-->

<!--begin::Input-->
<input type="text" class="form-control form-control-solid" placeholder="Enter Deal Title" name="details_title" value="Marketing Campaign">
<!--end::Input-->
</div>
<!--end::Input group-->

<!--begin::Input group-->
<div class="fv-row mb-8">
<!--begin::Label-->
<label class="fs-6 fw-semibold mb-2">Deal Description</label>
<!--end::Label-->

<!--begin::Label-->
<textarea class="form-control form-control-solid" rows="3" placeholder="Enter Deal Description" name="details_description">                Experience share market at your fingertips with TICK PRO stock investment mobile trading app
</textarea>
<!--end::Label-->
</div>
<!--end::Input group-->

<!--begin::Input group-->
<div class="fv-row mb-8">
<label class="required fs-6 fw-semibold mb-2">Activation Date</label>
<div class="position-relative d-flex align-items-center">
    <!--begin::Icon-->
    <i class="ki-duotone ki-calendar-8 fs-2 position-absolute mx-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></i>                <!--end::Icon-->

    <!--begin::Datepicker-->
    <input class="form-control form-control-solid ps-12" placeholder="Pick date range" name="details_activation_date">
    <!--end::Datepicker-->
</div>
</div>
<!--end::Input group-->

<!--begin::Input group-->
<div class="fv-row mb-15">
<!--begin::Wrapper-->
<div class="d-flex flex-stack">
    <!--begin::Label-->
    <div class="me-5">
        <label class="required fs-6 fw-semibold">Notifications</label>
        <div class="fs-7 fw-semibold text-muted">Allow Notifications by Phone or Email</div>
    </div>
    <!--end::Label-->

    <!--begin::Checkboxes-->
    <div class="d-flex">
        <!--begin::Checkbox-->
        <label class="form-check form-check-custom form-check-solid me-10">
            <!--begin::Input-->
            <input class="form-check-input h-20px w-20px" type="checkbox" value="email" name="details_notifications[]">
            <!--end::Input-->

            <!--begin::Label-->
            <span class="form-check-label fw-semibold">
                Email
            </span>
            <!--end::Label-->
        </label>
        <!--end::Checkbox-->

        <!--begin::Checkbox-->
        <label class="form-check form-check-custom form-check-solid">
            <!--begin::Input-->
            <input class="form-check-input h-20px w-20px" type="checkbox" value="phone" checked="" name="details_notifications[]">
            <!--end::Input-->

            <!--begin::Label-->
            <span class="form-check-label fw-semibold">
                Phone
            </span>
            <!--end::Label-->
        </label>
        <!--end::Checkbox-->
    </div>
    <!--end::Checkboxes-->
</div>
<!--begin::Wrapper-->
</div>
<!--end::Input group-->

<!--begin::Actions-->
<div class="d-flex flex-stack">
<button type="button" class="btn btn-lg btn-light me-3" data-kt-element="details-previous">
    Deal Type
</button>

<button type="button" class="btn btn-lg btn-primary" data-kt-element="details-next">
    <span class="indicator-label">
    Financing
    </span>
    <span class="indicator-progress">
        Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
    </span>
</button>
</div>
<!--end::Actions-->
</div>
<!--end::Wrapper-->
</div>
<!--end::Details-->
            <!--begin::Budget-->
<div data-kt-stepper-element="content">
<!--begin::Wrapper-->
<div class="w-100">
<!--begin::Heading-->
<div class="mb-13">
<!--begin::Title-->
<h2 class="mb-3">Finance</h2>
<!--end::Title-->

<!--begin::Description-->
<div class="text-muted fw-semibold fs-5">
    If you need more info, please check out
    <a href="#" class="link-primary fw-bold">FAQ Page</a>.
</div>
<!--end::Description-->
</div>
<!--end::Heading-->

<!--begin::Input group-->
<div class="fv-row mb-8">
<!--begin::Label-->
<label class="d-flex align-items-center fs-6 fw-semibold mb-2">
    <span class="required">Setup Budget</span>

<span class="lh-1 ms-1" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="
<div class='p-4 rounded bg-light'>
<div class='d-flex flex-stack text-muted mb-4'>
    <i class=&quot;ki-duotone ki-bank fs-3 me-3&quot;><span class=&quot;path1&quot;></span><span class=&quot;path2&quot;></span></i>
    <div class='fw-bold'>INCBANK **** 1245 STATEMENT</div>
</div>

<div class='d-flex flex-stack fw-semibold text-gray-600'>
    <div>Amount</div>
    <div>Transaction</div>
</div>

<div class='separator separator-dashed my-2'></div>

<div class='d-flex flex-stack text-gray-900 fw-bold mb-2'>
    <div>USD345.00</div>
    <div>KEENTHEMES*</div>
</div>

<div class='d-flex flex-stack text-muted mb-2'>
    <div>USD75.00</div>
    <div>Hosting fee</div>
</div>

<div class='d-flex flex-stack text-muted'>
    <div>USD3,950.00</div>
    <div>Payrol</div>
</div>
</div>
" data-kt-initialized="1">
<i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i></span>            </label>
<!--end::Label-->

<!--begin::Dialer-->
<div class="position-relative w-lg-250px" id="kt_modal_finance_setup" data-kt-dialer="true" data-kt-dialer-min="50" data-kt-dialer-max="50000" data-kt-dialer-step="100" data-kt-dialer-prefix="$" data-kt-dialer-decimals="2">

    <!--begin::Decrease control-->
    <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
        <i class="ki-duotone ki-minus-circle fs-1"><span class="path1"></span><span class="path2"></span></i>                </button>
    <!--end::Decrease control-->

    <!--begin::Input control-->
    <input type="text" class="form-control form-control-solid border-0 ps-12" data-kt-dialer-control="input" placeholder="Amount" name="finance_setup" readonly="" value="$50">
    <!--end::Input control-->

    <!--begin::Increase control-->
    <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
        <i class="ki-duotone ki-plus-circle fs-1"><span class="path1"></span><span class="path2"></span></i>                </button>
    <!--end::Increase control-->
</div>
<!--end::Dialer-->
</div>
<!--end::Input group-->

<!--begin::Input group-->
<div class="fv-row mb-8">
<!--begin::Label-->
<label class="fs-6 fw-semibold mb-2">Budget Usage</label>
<!--end::Label-->

<!--begin::Row-->
<div class="row g-9" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']" data-kt-initialized="1">
    <!--begin::Col-->
    <div class="col-md-6 col-lg-12 col-xxl-6">
        <!--begin::Option-->
        <label class="btn btn-outline btn-outline-dashed btn-active-light-primary active d-flex text-start p-6" data-kt-button="true">
            <!--begin::Radio-->
            <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                <input class="form-check-input" type="radio" name="finance_usage" value="1" checked="checked">
            </span>
            <!--end::Radio-->

            <!--begin::Info-->
            <span class="ms-5">
                <span class="fs-4 fw-bold text-gray-800 mb-2 d-block">Precise Usage</span>

                <span class="fw-semibold fs-7 text-gray-600">
                    Withdraw money to your bank account per transaction under $50,000 budget
                </span>
            </span>
            <!--end::Info-->
        </label>
        <!--end::Option-->
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-md-6 col-lg-12 col-xxl-6">
        <!--begin::Option-->
        <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6" data-kt-button="true">
            <!--begin::Radio-->
            <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                <input class="form-check-input" type="radio" name="finance_usage" value="2">
            </span>
            <!--end::Radio-->

            <!--begin::Info-->
            <span class="ms-5">
                <span class="fs-4 fw-bold text-gray-800 mb-2 d-block">Extreme Usage</span>
                <span class="fw-semibold fs-7 text-gray-600">
                    Withdraw money to your bank account per transaction under $50,000 budget
                </span>
            </span>
            <!--end::Info-->
        </label>
        <!--end::Option-->
    </div>
    <!--end::Col-->
</div>
<!--end::Row-->
</div>
<!--end::Input group-->

<!--begin::Input group-->
<div class="fv-row mb-15">
<!--begin::Wrapper-->
<div class="d-flex flex-stack">
    <!--begin::Label-->
    <div class="me-5">
        <label class="fs-6 fw-semibold">Allow Changes in Budget</label>
        <div class="fs-7 fw-semibold text-muted">If you need more info, please check budget planning</div>
    </div>
    <!--end::Label-->

    <!--begin::Switch-->
    <label class="form-check form-switch form-check-custom form-check-solid">
        <input class="form-check-input" type="checkbox" value="1" name="finance_allow" checked="checked">
        <span class="form-check-label fw-semibold text-muted">
            Allowed
        </span>
    </label>
    <!--end::Switch-->
</div>
<!--end::Wrapper-->
</div>
<!--end::Input group-->

<!--begin::Actions-->
<div class="d-flex flex-stack">
<button type="button" class="btn btn-lg btn-light me-3" data-kt-element="finance-previous">
    Project Settings
</button>

<button type="button" class="btn btn-lg btn-primary" data-kt-element="finance-next">
    <span class="indicator-label">
        Build Team
    </span>
    <span class="indicator-progress">
        Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
    </span>
</button>
</div>
<!--end::Actions-->
</div>
<!--end::Wrapper-->
</div>
<!--end::Budget-->
            <!--begin::Complete-->
<div data-kt-stepper-element="content">
<!--begin::Wrapper-->
<div class="w-100">
<!--begin::Heading-->
<div class="mb-13">
<!--begin::Title-->
<h2 class="mb-3">Deal Created!</h2>
<!--end::Title-->

<!--begin::Description-->
<div class="text-muted fw-semibold fs-5">
    If you need more info, please check out
    <a href="#" class="link-primary fw-bold">FAQ Page</a>.
</div>
<!--end::Description-->
</div>
<!--end::Heading-->

<!--begin::Actions-->
<div class="d-flex flex-center pb-20">
<button type="button" class="btn btn-lg btn-light me-3" data-kt-element="complete-start">
    Create New Deal
</button>

<a href="#" class="btn btn-lg btn-primary" data-bs-toggle="tooltip" data-bs-original-title="Coming Soon" data-kt-initialized="1">
    View Deal
</a>
</div>
<!--end::Actions-->

<!--begin::Illustration-->
<div class="text-center px-4">
<img src="/keen/demo1/assets/media/illustrations/sketchy-1/20.png" alt="" class="mw-100 mh-300px">
</div>
<!--end::Illustration-->
</div>
</div>
<!--end::Complete-->                    </form>
        <!--end::Form-->
    </div>
    <!--end::Stepper-->
</div>
<!--begin::Modal body-->
</div>
</div>
</div>
<!--end::Modal - Offer A Deal--><!--end::Modals-->        </div>
<!--end::Content container-->
</div>
<!--end::Content-->

                        </div>
    <!--end::Content wrapper-->


<!--begin::Footer-->
<div id="kt_app_footer" class="app-footer ">



<!--begin::Footer container-->
<div class="app-container  container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3 ">
<!--begin::Copyright-->
<div class="text-gray-900 order-2 order-md-1">
<span class="text-muted fw-semibold me-1">2025©</span>
<a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">Keenthemes</a>
</div>
<!--end::Copyright-->

<!--begin::Menu-->
<ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
<li class="menu-item"><a href="https://keenthemes.com" target="_blank" class="menu-link px-2">About</a></li>

<li class="menu-item"><a href="https://devs.keenthemes.com" target="_blank" class="menu-link px-2">Support</a></li>

<li class="menu-item"><a href="https://themes.getbootstrap.com/product/keen-the-ultimate-bootstrap-admin-theme/" target="_blank" class="menu-link px-2">Purchase</a></li>
</ul>
<!--end::Menu-->        </div>
<!--end::Footer container-->
</div>
<!--end::Footer-->                            </div>

    <script>
        function contratSearch() {
            return {
                searchTerm: '',
                init() {
                    this.filterContrats();
                    this.isLoading = false;
                }
            };
        }
    </script>
@endsection
