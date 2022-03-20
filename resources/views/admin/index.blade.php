<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ \Osiset\ShopifyApp\Util::getShopifyConfig('app_name') }}</title>
        <style>
            #loader{transition:all .3s ease-in-out;opacity:1;visibility:visible;position:fixed;height:100vh;width:100%;background:#fff;z-index:90000}#loader.fadeOut{opacity:0;visibility:hidden}.spinner{width:40px;height:40px;position:absolute;top:calc(50% - 20px);left:calc(50% - 20px);background-color:#333;border-radius:100%;-webkit-animation:sk-scaleout 1s infinite ease-in-out;animation:sk-scaleout 1s infinite ease-in-out}@-webkit-keyframes sk-scaleout{0%{-webkit-transform:scale(0)}100%{-webkit-transform:scale(1);opacity:0}}@keyframes sk-scaleout{0%{-webkit-transform:scale(0);transform:scale(0)}100%{-webkit-transform:scale(1);transform:scale(1);opacity:0}}
        </style>
        <link href="{{ asset('assets') }}/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.0/css/all.min.css" integrity="sha512-3PN6gfRNZEX4YFyz+sIyTF6pGlQiryJu9NlGhu9LrLMQ7eDjNgudQoFDK3WSNAayeIKc6B8WXXpo4a7HqxjKwg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
        @yield('styles')
    </head>

    <body class="app">
        <div>
            <div class="sidebar">
                <div class="sidebar-inner">
                    <div class="sidebar-logo">
                        <div class="peers ai-c fxw-nw"><div class="peer peer-greed"><a class="sidebar-link td-n" href="{{ route('admin') }}"><div class="peers ai-c fxw-nw">
                            <div class="peer">
                                <div class="logo">
                                    {{-- <img src="assets/logo.png" alt=""> --}}
                                </div>
                            </div>
                            <div class="peer peer-greed">
                                <h5 class="lh-1 mB-0 logo-text"><img style="width:100%;" src="assets/logo.png" alt=""></h5></div></div></a></div><div class="peer"><div class="mobile-toggle sidebar-toggle"><a href="" class="td-n"><i class="ti-arrow-circle-left"></i></a>
                            </div>
                        </div>
                        </div>
                    </div>
                    <ul class="sidebar-menu scrollable pos-r">
                        <li class="nav-item mT-30 actived">
                            <a class="sidebar-link" href="{{ route('admin') }}"><span class="icon-holder"><i class="fas fa-list"></i> </span><span class="title">Dashboard</span></a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="sidebar-link" href="{{ URL::tokenRoute('test') }}"><span class="icon-holder"><i class="fas fa-clipboard-list"></i> </span><span class="title">Test</span></a>
                        </li> --}}
                    </ul>
                </div>
            </div>
            <div class="page-container">
                <div class="header navbar">
                    <div class="header-container">
                        {{-- <ul class="nav-left">
                            <li><a id="sidebar-toggle" class="sidebar-toggle" href="javascript:void(0);"><i class="ti-menu"></i></a></li><li class="search-box"><a class="search-toggle no-pdd-right" href="javascript:void(0);"><i class="search-icon ti-search pdd-right-10"></i> <i class="search-icon-close ti-close pdd-right-10"></i></a></li><li class="search-input"><input class="form-control" type="text" placeholder="Search..."></li>
                        </ul>
                        <ul class="nav-right">
                            <li class="notifications dropdown">
                                <span class="counter bgc-red">3</span> <a href="" class="dropdown-toggle no-after" data-toggle="dropdown"><i class="ti-bell"></i></a><ul class="dropdown-menu"><li class="pX-20 pY-15 bdB"><i class="ti-bell pR-10"></i> <span class="fsz-sm fw-600 c-grey-900">Notifications</span></li><li><ul class="ovY-a pos-r scrollable lis-n p-0 m-0 fsz-sm"><li><a href="" class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100"><div class="peer mR-15"><img class="w-3r bdrs-50p" src="https://randomuser.me/api/portraits/men/1.jpg" alt=""></div><div class="peer peer-greed"><span><span class="fw-500">John Doe</span> <span class="c-grey-600">liked your <span class="text-dark">post</span></span></span><p class="m-0"><small class="fsz-xs">5 mins ago</small></p></div></a></li><li><a href="" class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100"><div class="peer mR-15"><img class="w-3r bdrs-50p" src="https://randomuser.me/api/portraits/men/2.jpg" alt=""></div><div class="peer peer-greed"><span><span class="fw-500">Moo Doe</span> <span class="c-grey-600">liked your <span class="text-dark">cover image</span></span></span><p class="m-0"><small class="fsz-xs">7 mins ago</small></p></div></a></li><li><a href="" class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100"><div class="peer mR-15"><img class="w-3r bdrs-50p" src="https://randomuser.me/api/portraits/men/3.jpg" alt=""></div><div class="peer peer-greed"><span><span class="fw-500">Lee Doe</span> <span class="c-grey-600">commented on your <span class="text-dark">video</span></span></span><p class="m-0"><small class="fsz-xs">10 mins ago</small></p></div></a></li></ul></li><li class="pX-20 pY-15 ta-c bdT"><span><a href="" class="c-grey-600 cH-blue fsz-sm td-n">View All Notifications <i class="ti-angle-right fsz-xs mL-10"></i></a></span></li></ul>
                            </li>
                            <li class="notifications dropdown">
                                <span class="counter bgc-blue">3</span> <a href="" class="dropdown-toggle no-after" data-toggle="dropdown"><i class="ti-email"></i></a><ul class="dropdown-menu"><li class="pX-20 pY-15 bdB"><i class="ti-email pR-10"></i> <span class="fsz-sm fw-600 c-grey-900">Emails</span></li><li><ul class="ovY-a pos-r scrollable lis-n p-0 m-0 fsz-sm"><li><a href="" class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100"><div class="peer mR-15"><img class="w-3r bdrs-50p" src="https://randomuser.me/api/portraits/men/1.jpg" alt=""></div><div class="peer peer-greed"><div><div class="peers jc-sb fxw-nw mB-5"><div class="peer"><p class="fw-500 mB-0">John Doe</p></div><div class="peer"><small class="fsz-xs">5 mins ago</small></div></div><span class="c-grey-600 fsz-sm">Want to create your own customized data generator for your app...</span></div></div></a></li><li><a href="" class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100"><div class="peer mR-15"><img class="w-3r bdrs-50p" src="https://randomuser.me/api/portraits/men/2.jpg" alt=""></div><div class="peer peer-greed"><div><div class="peers jc-sb fxw-nw mB-5"><div class="peer"><p class="fw-500 mB-0">Moo Doe</p></div><div class="peer"><small class="fsz-xs">15 mins ago</small></div></div><span class="c-grey-600 fsz-sm">Want to create your own customized data generator for your app...</span></div></div></a></li><li><a href="" class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100"><div class="peer mR-15"><img class="w-3r bdrs-50p" src="https://randomuser.me/api/portraits/men/3.jpg" alt=""></div><div class="peer peer-greed"><div><div class="peers jc-sb fxw-nw mB-5"><div class="peer"><p class="fw-500 mB-0">Lee Doe</p></div><div class="peer"><small class="fsz-xs">25 mins ago</small></div></div><span class="c-grey-600 fsz-sm">Want to create your own customized data generator for your app...</span></div></div></a></li></ul></li><li class="pX-20 pY-15 ta-c bdT"><span><a href="email.html" class="c-grey-600 cH-blue fsz-sm td-n">View All Email <i class="fs-xs ti-angle-right mL-10"></i></a></span></li></ul>
                            </li>
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-toggle="dropdown"><div class="peer mR-10"><img class="w-2r bdrs-50p" src="https://randomuser.me/api/portraits/men/10.jpg" alt=""></div><div class="peer"><span class="fsz-sm c-grey-900">John Doe</span></div></a><ul class="dropdown-menu fsz-sm"><li><a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-settings mR-10"></i> <span>Setting</span></a></li><li><a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-user mR-10"></i> <span>Profile</span></a></li><li><a href="email.html" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-email mR-10"></i> <span>Messages</span></a></li><li role="separator" class="divider"></li><li><a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-power-off mR-10"></i> <span>Logout</span></a></li></ul>
                            </li>
                        </ul> --}}
                    </div>
                </div>
                <main class="main-content bgc-grey-100">
                    <div id="mainContent">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="bgc-white bd bdrs-3 p-20 mB-20">
                                        <h4 class="c-grey-900 mB-20">All inquiries</h4>
                                        <table id="datatable_1" class="table table-striped table-bordered" style="width:100%;">
                                            <thead></thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                {{-- <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600"><span>Copyright © 2019 Designed by <a href="https://colorlib.com" target="_blank" title="Colorlib">Colorlib</a>. All rights reserved.</span></footer> --}}
            </div>
        </div>
        <script type="text/javascript" src="{{ asset('assets') }}/vendor.js"></script>
        <script type="text/javascript" src="{{ asset('assets') }}/bundle.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(function(){
                $('#datatable_1').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route("admin.data") }}',
                    columns: {!!json_encode($dt_info['labels'])!!},
                    order: {!!json_encode($dt_info['order'])!!},
                });
                $(document).on('click','.changeStatus',function(){
                    let id = $(this).data('id')
                    Swal.fire({
                        title: 'Change Status',
                        input: 'select',
                        inputOptions: {
                            pending: 'Pending',
                            inprogress : 'In Progress ',
                            completed: 'Completed',
                        },
                        inputPlaceholder: 'Select Status',
                        showCancelButton: true,
                        confirmButtonText: 'Change',
                        showLoaderOnConfirm: true,
                        preConfirm: (value) => {
                            url = "{{ route("admin.changeStatus","") }}/"+id;
                            return fetch(url,{
                                method: 'POST',
                                headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({status: value})
                            })
                            .then(response => {
                                if (!response.ok) {
                                throw new Error(response.statusText)
                                }
                                return response.json()
                            })
                            .catch(error => {
                                Swal.showValidationMessage(
                                `Request failed: ${error}`
                                )
                            })
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                        console.log(result)
                        if (result.value.status == 'success') {
                            Swal.fire({
                            title: `Success`,
                            text: "Status changed successfully",
                            })
                        }
                    })
                })
            })
        </script>
        @yield('scripts')
    </body>
</html>
