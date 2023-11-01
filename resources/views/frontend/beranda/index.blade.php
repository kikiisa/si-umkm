@extends('frontend.layouts.master',['title' => 'BERANDA'])
@section('content')
    @if ($slider->count() > 0)
        <section class="slider container">
            <div class="row justify-content-center">
                <div class="col-lg-12 bg-transparent rounded-4">
                    <div class="card">
                        <div id="carouselExampleDark" class="carousel carousel-dark slide">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                                    aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active" data-bs-interval="10000">
                                    <img src="{{asset('data/slider/'.$slider[0]->image)}}"
                                        class="d-block w-100">
                                    
                                </div>
                                @foreach ($slider as $sl)
                                    <div class="carousel-item">
                                        <img src="{{asset('data/slider/'.$sl->image)}}"
                                            class="d-block w-100">
                                        
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="slider container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="bg-danger p-4 rounded-4 text-light fw-bold text-center">
                        Maaf Data Slider Belum Tersedia
                    </div>
                </div>
            </div>
        </section>
    @endif
    <section class="product container mt-4">
        <h4>Daftar Product UMKM</h4>
        <hr>
        <div class="row">
            @forelse ($product as $item)
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-img img-fluid">
                            <img
                                src="{{asset('data/product/'.$item->image)}}">
                        </div>
                        <div class="card-body bg-wraper">
                            <div class="text-center">
                                <a href="{{Route('product', $item->slug)}}" class="fw-bold text-dark" style="text-decoration: none;"><strong>{{$item->name}}</strong></a><br>
                                <a href="{{Route('category',$item->category->slug)}}" class="text-muted" style="text-decoration: none;">{{$item->category->name}}</a>
                                @if ($item->diskon > 0)
                                    <h6><span class="price-diskon text-danger">Rp {{number_format($item->price, 0, ',', '.')}} </span> / <span class="text-muted"> {{$item->diskon}}%</span></h6>
                                @endif
                                @php
                                    $price = $item->price - ($item->price * $item->diskon / 100)
                                @endphp
                                <h5 class="text-success fw-bold">Rp.{{number_format($price, 0, ',', '.')}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                
            @empty
                <div class="col-lg-4">
                    <div class="alert alert-danger fw-bold">Product Kosong</div>
                </div>
            @endforelse
        </div>
        <a href="{{Route('product.all')}}" class="text-center btn btn-light fw-bold mb-4">LIHAT LEBIH BANYAK</a>
    </section>
@endsection
