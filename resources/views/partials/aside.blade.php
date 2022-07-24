<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('profile-view') }}" class="brand-link">
        <img src="{{ asset('img/logo.png') }}" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-light"> Skeleton</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('profile-view') }}" class="d-block">{{ session()->get('userDetails')?->first_name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('profile-view') }}" class="nav-link {{ request()->is('profile') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-alt"></i>
                        <p> Profile </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('authors.index') }}" class="nav-link {{ request()->is('authors*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p> Authors </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('books.create') }}" class="nav-link {{ request()->is('books*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p> Books </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
