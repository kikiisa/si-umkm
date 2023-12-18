@extends('backend.layouts.master', ['title' => 'Product'])
@section('content')
    <section class="product-list">
        <div class="container">
            <h4>Daftar Pengguna</h4>
            <hr>
            <div class="row justify-content-center">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $pr)
                                        <tr>
                                            <th scope="row">{{$loop->index+=1}}</th>
                                            <td>{{$pr->name}}</td>
                                            <td>{{$pr->email}}</td>
                                            <td>{{$pr->phone}}</td>
                                            <td>
                                                
                                                <form method="GET">
                                                    @if ($pr->status == 'active')
                                                        <button class="btn btn-success" name="status" value="{{$pr->id}}">Aktif</button>
                                                    
                                                    @else
                                                        <button class="btn btn-danger" name="status" value="{{$pr->id}}">Nonaktif</button>
                                                    @endif
                                                  
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{Route('user.destroy',$pr->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{Route('user.edit', $pr->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                    <button onclick="return confirm('apakah anda yakin ingin mengahpus user ini?')" class="btn btn-danger"><i class="fa fa-trash" onclick="return confirm('apakah akan mengahpus produk ini?')"></i></button>
                                                </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                selector: "#description",
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
