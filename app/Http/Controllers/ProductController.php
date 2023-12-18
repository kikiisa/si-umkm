<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\JenisUmkm;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    private $path = 'data/product/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Category::all();
        $product = Auth::user()->role != 'admin'? Product::all()->where('user_id',Auth::user()->id) : Product::all();
        $umkm = JenisUmkm::all();
        return view('backend.product.index', compact('kategori', 'product','umkm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            
            'name' => 'required',
            'image' => 'required|image|mimes:webp,png,jpg,jpeg|max:2048',
            'category_id' => 'required',
            'price' => 'required',
            'diskon' => 'required',
            'description' => 'required',
            'status' => 'required',
            'phone' => 'required',
        ]);
        $file = $request->file('image');
        $newName = $file->hashName();
        $file->move($this->path,$newName);
        $send = Product::create([
            'uuid' => Str::uuid()->toString(),
            'user_id' => Auth::user()->id,
            'jenis_umkm_id' => $request->jenis_umkm,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'price' => $request->price,
            'diskon' => $request->diskon,
            'description' => $request->description,
            'status' => $request->status,
            'image' => $newName,
            'phone' => $request->phone
        ]);
        if ($send) {
            return back()->with('success', 'Data berhasil ditambahkan');
        }else{
            return back()->with('error', 'Data gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Product::all()->where('uuid', $id)->first();
        $kategori = Category::all();
        return view('backend.product.edit',compact('kategori','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $data = Product::find($id);
        if ($request->hasFile('image')) {
            $request->validate([
                'name' => 'required',
                'category_id' => 'required',
                'description' => 'required',
                'price' => 'required',
                'diskon' => 'required',
                'status' => 'required',
                'image' => 'required|image|mimes:webp,png,jpg|max:2048'
            ]);
            if (File::hash($this->path . $data->image)) {
                File::delete($this->path . $data->image);
            }
            $file = $request->file('image');
            $newName = $file->hashName();
            $file->move($this->path,$newName);
            $data->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'category_id' => $request->category_id,
                'price' => $request->price,
                'diskon' => $request->diskon,
                'description' => $request->description,
                'status' => $request->status,
                'image' => $newName,
                'phone' => $request->phone,
            ]);
            if($data)
            {
                return back()->with('success', 'Data berhasil diubah');
            }else{
                return back()->with('error', 'Data gagal diubah');
            }
        } else {
            $request->validate([
                'name' => 'required',
                'category_id' => 'required',
                'description' => 'required',
                'price' => 'required',
                'diskon' => 'required',
                'status' => 'required',
            ]);
            $data->update($request->all());
            if ($data) {
                return back()->with('success', 'Data berhasil diubah');
            } else {
                return back()->with('error', 'Data gagal diubah');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::find($id);
        if (File::hash($this->path . $data->image)) {
            File::delete($this->path . $data->image);
        }
        $data->delete();
        if ($data) {
            return back()->with('success', 'Data berhasil dihapus');
        }else{
            return back()->with('error', 'Data gagal dihapus');
        }
    }
}
