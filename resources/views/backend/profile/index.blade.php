@extends('backend.layouts.master', ['title' => 'Edit Profile | Update Password'])
@section('content')
    <section class="product-list">
        <div class="container">
            <h4>Edit Profile / Update Password</h4>
            <hr>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ Route('profile.update') }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-2">
                                    <label class="mb-2"><strong>Nama</strong></label>
                                    <input type="text" value="{{$data->name}}" placeholder="Nama" name="name" class="form-control">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="mb-2"><strong>Email</strong></label>
                                    <input type="text" name="email" value="{{$data->email}}" placeholder="Email" name="email" class="form-control">
                                </div>
                                <button class="btn btn-dark fw-bold w-100">update profile</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ Route('profile.password') }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-2">
                                    <label class="mb-2"><strong>Password Lama</strong></label>
                                    <input type="text"  placeholder="Password Lama" name="old" class="form-control">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="mb-2"><strong>Password Baru</strong></label>
                                    <input type="text"  placeholder="Password Baru" name="new" class="form-control">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="mb-2"><strong>Konfirmasi Password</strong></label>
                                    <input type="text"  placeholder="Konfirmasi Password" name="confirm" class="form-control">
                                </div>
                                <button class="btn btn-dark fw-bold w-100">update password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('theme/vendor/toastify/src/toastify.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const themeOptions = document.body.classList.contains("theme-dark") ? {
                skin: "oxide-dark",
                content_css: "dark",
            } : {
                skin: "oxide",
                content_css: "default",
            }

            tinymce.init({
                selector: "#deskripsi",
                ...themeOptions
            })
            tinymce.init({
                selector: "#dark",
                toolbar: "undo redo styleselect bold italic alignleft aligncenter alignright bullist numlist outdent indent code",
                plugins: "code",
                ...themeOptions,
            })
        })
    </script>
    @if (count($errors) > 0)
        <script>
            var errors = @json($errors->all());
            Toastify({
                text: errors,
                duration: 3000,
                close: true,
                backgroundColor: "#D61355",
            }).showToast();
        </script>
    @enderror
    @if (session()->has('success'))
        <script>
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000,
                close: true,
                backgroundColor: "#19C37D",
            }).showToast();
        </script>
    @endif
    @if (session()->has('error'))
        <script>
            Toastify({
                text: "{{ session('error') }}",
                duration: 3000,
                close: true,
                backgroundColor: "#D61355",
            }).showToast();
        </script>
    @endif
@endsection
