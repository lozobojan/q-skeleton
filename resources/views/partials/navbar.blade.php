<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="nav-link border-0 bg-transparent"><i class="fas fa-sign-out-alt"></i></button>
            </form>
        </li>
    </ul>

</nav>
<!-- /.navbar -->
