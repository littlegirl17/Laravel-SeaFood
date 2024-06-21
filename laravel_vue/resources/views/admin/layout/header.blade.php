<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar ">
        <!-- Sidebar scroll-->
        <div>
            <div class="brand-logo d-flex align-items-center justify-content-between">
                <a href="{{ route('dashboard') }}" class="text-nowrap logo-img">
                    <img src="{{ asset('uploads/LoGo.png') }}" width="180" alt="" />
                </a>
                <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                    <img width="40" height="40" src="https://img.icons8.com/ios/50/FFFFFF/close-window--v1.png"
                        alt="close-window--v1" />
                </div>
            </div>
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                <ul id="sidebarnav">
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                            <span style="width:20px">
                                <i class="ti fa-solid fa-gauge-high ico-side" style="color: #B197FC;"></i>
                            </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.banner') }}" aria-expanded="false">
                            <span style="width:20px">
                                <i class="fa-solid fa-image ico-side" style="color: #df076f;"></i>
                            </span>
                            <span class="hide-menu">Banner-Hình</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('category') }}" aria-expanded="false">
                            <span style="width:20px">
                                <i class="ti fa-solid fa-list ico-side" style="color: #FFD43B;"></i> </span>
                            <span class="hide-menu">Danh mục</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('product') }}" aria-expanded="false">
                            <span style="width:20px">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAA1UlEQVR4nO2WMQ6CQBREf2WlF7KQMaClHbueFsbEI3gAPAmGxMLQqZgBMy/ZkmRn3n52I4z5HWDul7zCQai3ABuhvnnYCPVtw0aobxg2Qn2rNsKXJ4qZK1jq/TFGvTE4yIh3GymYOjS5rG/1Kj5k+LZoU1W0+a4z0uQyJmLH80EWpGjr9VRBttfTRhgkVf9hhKkbNvDtjOwv+aidEWpXOAj1FmAj1DcPG6G+bdhI+B7pfbToGen9RMEMfrfwE4X61mEj1DcNG3mibhg2MkLdMGzExOx4ALZ46X829vEOAAAAAElFTkSuQmCC"
                                    style="width:18px; height:18px;">
                            </span>
                            <span class="hide-menu">Sản phẩm</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.coupon') }}" aria-expanded="false">
                            <span style="width:20px">
                                <i class="ti"><img width="20" height="20"
                                        src="https://img.icons8.com/sf-regular-filled/20/FAB005/loyalty-card.png"
                                        alt="loyalty-card" /></i>
                            </span>
                            <span class="hide-menu">Mã giảm giá</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.order') }}" aria-expanded="false">
                            <span style="width:20px">
                                <i class="ti"><img width="20" height="20"
                                        src="https://img.icons8.com/ios/20/FFFFFF/purchase-order.png"
                                        alt="purchase-order" /></i>
                            </span>
                            <span class="hide-menu">Đơn hàng</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('user') }}" aria-expanded="false">
                            <span style="width:20px">
                                <i class="ti fa-solid fa-user ico-side" style="color: #fa0000;"></i>
                            </span>
                            <span class="hide-menu">Khách hàng</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.userGroup') }}" aria-expanded="false">
                            <span style="width:20px">
                                <i class="ti"><img width="25" height="25"
                                        src="https://img.icons8.com/material/64/40C057/group-foreground-selected.png"
                                        alt="group-foreground-selected" /></i>
                            </span>
                            <span class="hide-menu">Nhóm khách hàng</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('comment') }}" aria-expanded="false">
                            <span style="width:20px">
                                <i class="ti fa-regular fa-message ico-side" style="color: #74C0FC;"></i> </span>
                            <span class="hide-menu">Bình luận</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('logout') }}" aria-expanded="false">
                            <span style="width:20px">
                                <i class="ti fa-solid fa-right-from-bracket ico-side" style="color: #ffffff;"></i>
                            </span>
                            <span class="hide-menu">Đăng xuất</span>
                        </a>
                    </li>

                </ul>

            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
        <!--  Header Start -->
        <header class="app-header">
            <nav class="navbar navbar-expand-lg navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item d-block d-xl-none">
                        <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                            <img width="50" height="50"
                                src="https://img.icons8.com/ios/50/FFFFFF/menu-squared-2.png" alt="menu-squared-2" />
                        </a>
                    </li>

                </ul>
                <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                        <li class="nav-item dropdown">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('uploads/' . Session::get('user')->image) }}" alt=""
                                    width="35" height="35" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                aria-labelledby="drop2">
                                <div class="message-body">
                                    <a href="javascript:void(0)"
                                        class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-user fs-6"></i>
                                        <p class="mb-0 fs-3">My Profile</p>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-mail fs-6"></i>
                                        <p class="mb-0 fs-3">My Account</p>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-list-check fs-6"></i>
                                        <p class="mb-0 fs-3">My Task</p>
                                    </a>
                                    <a href="./authentication-login.html"
                                        class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
