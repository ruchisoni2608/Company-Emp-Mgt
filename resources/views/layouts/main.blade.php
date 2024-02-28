<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Barlow&display=swap');

        body {
            font-family: 'Barlow', sans-serif;
        }

        a:hover {
            text-decoration: none;
        }

        .border-left {
            border-left: 2px solid var(--primary) !important;
        }


        .sidebar {
            top: 0;
            left: 0;
            z-index: 100;
            overflow-y: auto;
        }

        .overlay {
            background-color: rgb(0 0 0 / 45%);
            z-index: 99;
        }

        /* sidebar for small screens */
        @media screen and (max-width: 767px) {

            .sidebar {
                max-width: 18rem;
                transform: translateX(-100%);
                transition: transform 0.4s ease-out;
            }

            .sidebar.active {
                transform: translateX(0);
            }

        }

        .list-group-item.active {
            z-index: 2;
            color: #fff;
            background-color: #3ac4f8;
            border-color: #007bff;
        }

        #row1 {
            margin-left: 15px;
            justify-content: center;
            color: #09095c;
            font-family: fantasy;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- sidebar -->
            <div class="col-md-3 col-lg-2 px-0 position-fixed h-100 bg-white shadow-sm sidebar" id="sidebar">
                {{-- <h1 class="text-primary d-flex justify-content-center"><img src="{{ asset('images/logo/logo.png') }}"
            style="width: 60%;" alt=""></h1> --}}
                <div class="d-flex justify-content-center">
                    <h1 class="bi bi-bootstrap text-primary d-flex my-4 justify-content-center"></h1>

                    {{-- <a href="{{ route('admin.home') }}"> <img src="{{ asset('images/logo/logo.png') }}"
                            style="width: 60%;" alt=""></a> --}}
                </div>
                <div class="list-group rounded-0">
                    <a href="{{ route('admin.home') }}"
                        class="list-group-item list-group-item-action active border-0 d-flex align-items-center">
                        <span class="bi bi-border-all"></span>
                        <span class="ml-2">Dashboard</span>
                    </a>

                    <button
                        class="list-group-item list-group-item-action border-0 d-flex justify-content-between align-items-center"
                        data-toggle="collapse" data-target="#sale-collapse">
                        <div>
                            <span class="bi bi-box"></span>
                            <span class="ml-2">Company Management</span>
                        </div>
                        <span class="bi bi-chevron-down small"></span>
                    </button>
                    <div class="collapse" id="sale-collapse" data-parent="#sidebar">
                        <div class="list-group">
                            <a href="{{ route('companies.index') }}"
                                class="list-group-item list-group-item-action border-0 pl-5">Company Index</a>
                            <a href="{{ route('companies.create') }}"
                                class="list-group-item list-group-item-action border-0 pl-5">Create Company</a>
                        </div>
                    </div>
                    <button
                        class="list-group-item list-group-item-action border-0 d-flex justify-content-between align-items-center"
                        data-toggle="collapse" data-target="#sale-collapse1">
                        <div>
                            <span class="bi bi-box"></span>
                            <span class="ml-2">Employees Management</span>
                        </div>
                        <span class="bi bi-chevron-down small"></span>
                    </button>
                    <div class="collapse" id="sale-collapse1" data-parent="#sidebar">
                        <div class="list-group">
                            <a href="{{ route('employees.index') }}"
                                class="list-group-item list-group-item-action border-0 pl-5">Employees Index</a>
                            <a href="{{ route('employees.create') }}"
                                class="list-group-item list-group-item-action border-0 pl-5">Create Employees</a>
                        </div>
                    </div>



                </div>
            </div>
            <!-- overlay to close sidebar on small screens -->
            <div class="w-100 vh-100 position-fixed overlay d-none" id="sidebar-overlay"></div>
            <!-- note: in the layout margin auto is the key as sidebar is fixed -->

            <div class="col-md-9 col-lg-10 ml-md-auto px-0">
                <!-- top nav -->
                <nav class="w-100 d-flex px-4 py-2 mb-4 shadow-sm">
                    <!-- close sidebar -->
                    <button class="btn py-0 d-lg-none" id="open-sidebar">
                        <span class="bi bi-list text-primary h3"></span>
                    </button>
                    {{-- <div class="dropdown ml-auto">
                        <button class="btn py-0 d-flex align-items-center" id="logout-dropdown" data-toggle="dropdown"
                            aria-expanded="false">
                            <span class="bi bi-person text-primary h4"></span>
                            <span class="bi bi-chevron-down ml-1 mb-2 small"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right border-0 shadow-sm"
                            aria-labelledby="logout-dropdown">
                            <a class="dropdown-item" href="#">Logout</a>
                            <a class="dropdown-item" href="#">Settings</a>
                        </div>
                    </div> --}}

                    <div class="dropdown ml-auto">
                        <button class="btn py-0 d-flex align-items-center" id="logout-dropdown" data-toggle="dropdown"
                            aria-expanded="false">
                            <span class="bi bi-person text-primary h4"></span>
                            <span class="bi bi-chevron-down ml-1 mb-2 small"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right border-0 shadow-sm"
                            aria-labelledby="logout-dropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="#">Settings</a>
                        </div>
                    </div>
                </nav>
                <main class="container-fluid">
                    @yield('content1')
                </main>
            </div>
        </div>
    </div>

</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

<script>
    $(document).ready(() => {
        $('#open-sidebar').click(() => {
            // add class active on #sidebar
            $('#sidebar').addClass('active');
            // show sidebar overlay
            $('#sidebar-overlay').removeClass('d-none');
        });
        $('#sidebar-overlay').click(function() {
            // add class active on #sidebar
            $('#sidebar').removeClass('active');
            // show sidebar overlay
            $(this).addClass('d-none');
        });
    });
</script>

</html>
