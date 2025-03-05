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
                                    Home </a>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->

                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">
                                User Profile </li>
                            <!--end::Item-->

                        </ul>
                        <!--end::Breadcrumb-->
                    </div>

                </div>
                <!--end::Toolbar container-->
            </div>
            <!--end::Toolbar-->

            <!--begin::Content-->
            <div id="kt_app_content" class="app-content  flex-column-fluid ">


                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container  container-xxl ">

                    <!--begin::Navbar-->



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
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-3"><span
                                        class="path1"></span><span class="path2"></span></i> <input type="text"
                                    id="kt_filter_search"
                                    class="form-control form-control-sm border-body bg-body w-150px ps-10"
                                    placeholder="Rechercher">
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
                                    <a href="/keen/demo1/apps/file-manager/files.html"
                                        class="text-gray-800 text-hover-primary d-flex flex-column">
                                        <!--begin::Image-->
                                        <div class="symbol symbol-75px mb-5">
                                            <img src="{{asset('folder-document.svg')}}"
                                                class="theme-light-show" alt="">
                                            <img src="/keen/demo1/assets/media/svg/files/folder-document-dark.svg"
                                                class="theme-dark-show" alt="">

                                        </div>
                                        <!--end::Image-->

                                        <!--begin::Title-->
                                        <div class="fs-5 fw-bold mb-2">
                                            Finance </div>
                                        <!--end::Title-->
                                    </a>
                                    <!--end::Name-->

                                    <!--begin::Description-->
                                    <div class="fs-7 fw-semibold text-gray-500">
                                        7 files </div>
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
                                    <a href="/keen/demo1/apps/file-manager/files.html"
                                        class="text-gray-800 text-hover-primary d-flex flex-column">
                                        <!--begin::Image-->
                                        <div class="symbol symbol-75px mb-5">
                                            <img src="/keen/demo1/assets/media/svg/files/folder-document.svg"
                                                class="theme-light-show" alt="">
                                            <img src="/keen/demo1/assets/media/svg/files/folder-document-dark.svg"
                                                class="theme-dark-show" alt="">

                                        </div>
                                        <!--end::Image-->

                                        <!--begin::Title-->
                                        <div class="fs-5 fw-bold mb-2">
                                            Customers </div>
                                        <!--end::Title-->
                                    </a>
                                    <!--end::Name-->

                                    <!--begin::Description-->
                                    <div class="fs-7 fw-semibold text-gray-500">
                                        3 files </div>
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
                                    <a href="/keen/demo1/apps/file-manager/files.html"
                                        class="text-gray-800 text-hover-primary d-flex flex-column">
                                        <!--begin::Image-->
                                        <div class="symbol symbol-75px mb-5">
                                            <img src="/keen/demo1/assets/media/svg/files/folder-document.svg"
                                                class="theme-light-show" alt="">
                                            <img src="/keen/demo1/assets/media/svg/files/folder-document-dark.svg"
                                                class="theme-dark-show" alt="">

                                        </div>
                                        <!--end::Image-->

                                        <!--begin::Title-->
                                        <div class="fs-5 fw-bold mb-2">
                                            CRM Project </div>
                                        <!--end::Title-->
                                    </a>
                                    <!--end::Name-->

                                    <!--begin::Description-->
                                    <div class="fs-7 fw-semibold text-gray-500">
                                        25 files </div>
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
                                    <a href="/keen/demo1/apps/file-manager/files.html"
                                        class="text-gray-800 text-hover-primary d-flex flex-column">
                                        <!--begin::Image-->
                                        <div class="symbol symbol-60px mb-5">
                                            <img src="/keen/demo1/assets/media/svg/files/pdf.svg" class="theme-light-show"
                                                alt="">
                                            <img src="/keen/demo1/assets/media/svg/files/pdf-dark.svg"
                                                class="theme-dark-show" alt="">

                                        </div>
                                        <!--end::Image-->

                                        <!--begin::Title-->
                                        <div class="fs-5 fw-bold mb-2">
                                            Project Reqs.. </div>
                                        <!--end::Title-->
                                    </a>
                                    <!--end::Name-->

                                    <!--begin::Description-->
                                    <div class="fs-7 fw-semibold text-gray-500">
                                        3 days ago </div>
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
                                    <a href="/keen/demo1/apps/file-manager/files.html"
                                        class="text-gray-800 text-hover-primary d-flex flex-column">
                                        <!--begin::Image-->
                                        <div class="symbol symbol-60px mb-5">
                                            <img src="/keen/demo1/assets/media/svg/files/doc.svg" class="theme-light-show"
                                                alt="">
                                            <img src="/keen/demo1/assets/media/svg/files/doc-dark.svg"
                                                class="theme-dark-show" alt="">

                                        </div>
                                        <!--end::Image-->

                                        <!--begin::Title-->
                                        <div class="fs-5 fw-bold mb-2">
                                            CRM App Docs.. </div>
                                        <!--end::Title-->
                                    </a>
                                    <!--end::Name-->

                                    <!--begin::Description-->
                                    <div class="fs-7 fw-semibold text-gray-500">
                                        3 days ago </div>
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
                                    <a href="/keen/demo1/apps/file-manager/files.html"
                                        class="text-gray-800 text-hover-primary d-flex flex-column">
                                        <!--begin::Image-->
                                        <div class="symbol symbol-60px mb-5">
                                            <img src="/keen/demo1/assets/media/svg/files/css.svg" class="theme-light-show"
                                                alt="">
                                            <img src="/keen/demo1/assets/media/svg/files/css-dark.svg"
                                                class="theme-dark-show" alt="">

                                        </div>
                                        <!--end::Image-->

                                        <!--begin::Title-->
                                        <div class="fs-5 fw-bold mb-2">
                                            User CRUD Styles </div>
                                        <!--end::Title-->
                                    </a>
                                    <!--end::Name-->

                                    <!--begin::Description-->
                                    <div class="fs-7 fw-semibold text-gray-500">
                                        4 days ago </div>
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
                                    <a href="/keen/demo1/apps/file-manager/files.html"
                                        class="text-gray-800 text-hover-primary d-flex flex-column">
                                        <!--begin::Image-->
                                        <div class="symbol symbol-60px mb-5">
                                            <img src="/keen/demo1/assets/media/svg/files/ai.svg" class="theme-light-show"
                                                alt="">
                                            <img src="/keen/demo1/assets/media/svg/files/ai-dark.svg"
                                                class="theme-dark-show" alt="">

                                        </div>
                                        <!--end::Image-->

                                        <!--begin::Title-->
                                        <div class="fs-5 fw-bold mb-2">
                                            Product Logo </div>
                                        <!--end::Title-->
                                    </a>
                                    <!--end::Name-->

                                    <!--begin::Description-->
                                    <div class="fs-7 fw-semibold text-gray-500">
                                        5 days ago </div>
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
                                    <a href="/keen/demo1/apps/file-manager/files.html"
                                        class="text-gray-800 text-hover-primary d-flex flex-column">
                                        <!--begin::Image-->
                                        <div class="symbol symbol-60px mb-5">
                                            <img src="/keen/demo1/assets/media/svg/files/sql.svg" class="theme-light-show"
                                                alt="">
                                            <img src="/keen/demo1/assets/media/svg/files/sql-dark.svg"
                                                class="theme-dark-show" alt="">

                                        </div>
                                        <!--end::Image-->

                                        <!--begin::Title-->
                                        <div class="fs-5 fw-bold mb-2">
                                            Orders backup </div>
                                        <!--end::Title-->
                                    </a>
                                    <!--end::Name-->

                                    <!--begin::Description-->
                                    <div class="fs-7 fw-semibold text-gray-500">
                                        1 week ago </div>
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
                                    <a href="/keen/demo1/apps/file-manager/files.html"
                                        class="text-gray-800 text-hover-primary d-flex flex-column">
                                        <!--begin::Image-->
                                        <div class="symbol symbol-60px mb-5">
                                            <img src="/keen/demo1/assets/media/svg/files/xml.svg" class="theme-light-show"
                                                alt="">
                                            <img src="/keen/demo1/assets/media/svg/files/xml-dark.svg"
                                                class="theme-dark-show" alt="">

                                        </div>
                                        <!--end::Image-->

                                        <!--begin::Title-->
                                        <div class="fs-5 fw-bold mb-2">
                                            UTAIR CRM API Co.. </div>
                                        <!--end::Title-->
                                    </a>
                                    <!--end::Name-->

                                    <!--begin::Description-->
                                    <div class="fs-7 fw-semibold text-gray-500">
                                        2 weeks ago </div>
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
                                    <a href="/keen/demo1/apps/file-manager/files.html"
                                        class="text-gray-800 text-hover-primary d-flex flex-column">
                                        <!--begin::Image-->
                                        <div class="symbol symbol-60px mb-5">
                                            <img src="/keen/demo1/assets/media/svg/files/tif.svg" class="theme-light-show"
                                                alt="">
                                            <img src="/keen/demo1/assets/media/svg/files/tif-dark.svg"
                                                class="theme-dark-show" alt="">

                                        </div>
                                        <!--end::Image-->

                                        <!--begin::Title-->
                                        <div class="fs-5 fw-bold mb-2">
                                            Tower Hill App.. </div>
                                        <!--end::Title-->
                                    </a>
                                    <!--end::Name-->

                                    <!--begin::Description-->
                                    <div class="fs-7 fw-semibold text-gray-500">
                                        3 weeks ago </div>
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
                                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                                class="path2"></span></i>
                                    </div>
                                    <!--end::Close-->
                                </div>
                                <!--begin::Modal header-->

                                <!--begin::Modal body-->
                                <div class="modal-body scroll-y m-5">
                                    <!--begin::Stepper-->
                                    <div class="stepper stepper-links d-flex flex-column"
                                        id="kt_modal_offer_a_deal_stepper">
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


                                    </div>
                                    <!--end::Stepper-->
                                </div>
                                <!--begin::Modal body-->
                            </div>
                        </div>
                    </div>
                    <!--end::Modal - Offer A Deal--><!--end::Modals-->
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->

        </div>
        <!--end::Content wrapper-->


     
    </div>

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
