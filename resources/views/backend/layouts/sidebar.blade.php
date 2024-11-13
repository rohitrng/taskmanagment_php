        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                    <i class="ion-close"></i>
                </button>

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center bg-logo">
                        <a href="index.html" class="logo"><!-- <i class="mdi mdi-bowling text-success"></i> --> RNG DEV HR</a>
                        <!-- <a href="index.html" class="logo"><img src="assets/images/logo.png" height="24" alt="logo"></a> -->
                    </div>
                </div>
                <div class="sidebar-user">
                    <!-- <img src="assets/images/users/avatar-6.jpg" alt="user" class="rounded-circle img-thumbnail mb-1"> -->
                    <h6 class="">Hello {{Auth::user()->student_name}}</h6> 
                    <p class=" online-icon text-dark"><i class="mdi mdi-record text-success"></i>online</p>                    
                    <ul class="list-unstyled list-inline mb-0 mt-2">
                        <!-- <li class="list-inline-item">
                            <a href="#" class="" data-toggle="tooltip" data-placement="top" title="Profile"><i class="dripicons-user text-purple"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="" data-toggle="tooltip" data-placement="top" title="Settings"><i class="dripicons-gear text-dark"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="" data-toggle="tooltip" data-placement="top" title="Log out"><i class="dripicons-power text-danger"></i></a>
                        </li> -->
                    </ul>           
                </div>

                <div class="sidebar-inner slimscrollleft">

                    <div id="sidebar-menu">
                        <ul>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><!--<i class="dripicons-jewel"></i>--> <span> Candidate data </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ url('admin-dashboard') }}">Resume Add</a></li>
                                </ul>
                                <ul class="list-unstyled">
                                    <li><a href="{{ url('resume-list') }}">Resume List</a></li>
                                </ul>
                                <ul class="list-unstyled">
                                    <li><a href="{{ url('candidate-onboarding') }}">Candidate Onboarding</a></li>
                                </ul>
                                <ul class="list-unstyled">
                                    <li><a href="{{ url('candidate-onboarding-list') }}">Candidate Onboarding List</a></li>
                                </ul>

                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div> <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->
                    <div class="topbar">

                        <nav class="navbar-custom">

                            <ul class="list-inline float-right mb-0">
                                <!-- language-->
                                <li class="list-inline-item dropdown notification-list">
                                    
                                </li>

                                <li class="list-inline-item dropdown notification-list">
                                    <!-- <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                                       aria-haspopup="false" aria-expanded="false">
                                        <i class="dripicons-bell noti-icon"></i>
                                        <span class="badge badge-success noti-icon-badge">2</span>
                                    </a> -->
                                    <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">
                                        <!-- item-->
                                        <!-- <div class="dropdown-item noti-title">
                                            <h5><span class="badge badge-danger float-right">87</span>Notification</h5>
                                        </div> -->

                                        <!-- item-->
                                        <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-primary"><i class="mdi mdi-cart-outline"></i></div>
                                            <p class="notify-details"><b>Your order is placed</b><small class="text-muted">Dummy text of the printing and typesetting industry.</small></p>
                                        </a> -->

                                        <!-- item-->
                                        <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-success"><i class="mdi mdi-message"></i></div>
                                            <p class="notify-details"><b>New Message received</b><small class="text-muted">You have 87 unread messages</small></p>
                                        </a> -->

                                        <!-- item-->
                                        <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-warning"><i class="mdi mdi-glass-cocktail"></i></div>
                                            <p class="notify-details"><b>Your item is shipped</b><small class="text-muted">It is a long established fact that a reader will</small></p>
                                        </a> -->
                                        
                                        <!-- All-->
                                        <!-- <a href="javascript:void(0);" class="dropdown-item notify-item border-top">
                                            View All 
                                        </a> -->

                                    </div>
                                </li>

                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                       aria-haspopup="false" aria-expanded="false">
                                        <img src="{{url('assets/backend')}}/images/users/avatar-6.jpg" alt="user" class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                        <!-- item-->
                                        <div class="dropdown-item noti-title">
                                            <h5>Welcome</h5>
                                        </div>
                                        <!-- <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                                        <a class="dropdown-item" href="#"><i class="mdi mdi-wallet m-r-5 text-muted"></i> My Wallet</a>
                                        <a class="dropdown-item" href="#"><span class="badge badge-success float-right">5</span><i class="mdi mdi-settings m-r-5 text-muted"></i> Settings</a>
                                        <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> Lock screen</a> -->
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="mdi mdi-logout m-r-5 text-muted"></i>
                      {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                                    </div>
                                </li>
                            </ul>

                            <ul class="list-inline menu-left mb-0">
                                <li class="float-left">
                                    <button class="button-menu-mobile open-left waves-light waves-effect">
                                        <i class="mdi mdi-menu"></i>
                                    </button>
                                </li>
                                <!-- <li class="hide-phone app-search">
                                    <form role="search" class="">
                                        <input type="text" placeholder="Search..." class="form-control">
                                        <a href=""><i class="fas fa-search"></i></a>
                                    </form>
                                </li> -->
                            </ul>

                            <div class="clearfix"></div>
                        </nav>
                    </div>
                    <!-- Top Bar End -->

