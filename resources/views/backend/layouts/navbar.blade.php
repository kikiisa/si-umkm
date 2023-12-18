<div class="fixed-top">
    <nav class="navbar bg-dark position-static">
        <div class="container justify-content-center">
            <div class="row">
                <div class="col-lg-6">
                    <a href="" class="navbar-brand text-light fw-bold"><i class="fa fa-store"></i> UMKM - BONE
                        BOLANGO</a>
                </div>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{Route('dashboard')}}"><i class="fa fa-fire"></i> BERANDA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{Route('product.index')}}"><i class="fa fa-cart-shopping"></i> MASTER
                            PRODUCT</a>
                    </li>
                    @if (Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{Route('category.index')}}"><i class="fa fa-cube"></i> MASTER
                                KATEGORI</a>
                        </li>
                       
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{Route('slider.index')}}"><i class="fa fa-image"></i>
                                SLIDER</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{Route('setting.index')}}"><i class="fa fa-wrench"></i> PENGATURAN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{Route('user.index')}}"><i class="fa fa-users"></i> MASTER USER</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{Route('profile')}}"><i class="fa fa-user"></i> PROFILE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{Route('login.logout')}}"><i class="fa fa-sign-out" onclick="return confirm('apakah anda yakin ingin keluar ?')"></i> KELUAR</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
