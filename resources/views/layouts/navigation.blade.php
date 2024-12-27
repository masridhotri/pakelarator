<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{request()->is('dashboard') ? 'active' : ''}}" aria-current="page" href="/dashboard">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
    <a class="nav-link {{request()->is('user*') ? 'active' : ''}}" href="/user">
        <span data-feather="alert-octagon" class="align-text-bottom"></span>
        User
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{route('showbuku')}}">
        <span data-feather="alert-octagon" class="align-text-bottom"></span>
        Buku
    </a>
</li>

<li class="nav-item">
    <a class="nav-link {{route('pinjam')}}" href="/kategori">
        <span data-feather="alert-octagon" class="align-text-bottom"></span>
        Kategori
    </a>
</li>

<li class="nav-item">
    <a class="nav-link {{request()->is('peminjaman*') ? 'active' : ''}}" href="/peminjaman">
        <span data-feather="alert-octagon" class="align-text-bottom"></span>
        Peminjaman
    </a>
</li>


        </ul>

        <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
            <span>reports</span>
        </h6>

        <ul class="nav flex-column mb-2">
             <li class="nav-item">
    <a class="nav-link" href="/user-export">
        <span data-feather="file-text" class="align-text-bottom"></span>
        User
    </a>
</li>

 <li class="nav-item">
    <a class="nav-link" href="/buku-export">
        <span data-feather="file-text" class="align-text-bottom"></span>
        Buku
    </a>
</li>

 <li class="nav-item">
    <a class="nav-link" href="/kategori-export">
        <span data-feather="file-text" class="align-text-bottom"></span>
        Kategori
    </a>
</li>

 <li class="nav-item">
    <a class="nav-link" href="/peminjaman-export">
        <span data-feather="file-text" class="align-text-bottom"></span>
        Peminjaman
    </a>
</li>


        </ul>
    </div>
</nav>
