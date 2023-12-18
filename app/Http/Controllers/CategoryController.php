<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    private $path = 'data/category/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::all();
        return view('backend.kategori.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'image' => 'required|image|mimes:webp,png|max:2048'
        ]);

        $file = $request->file('image');
        $newName = $file->hashName();
        $file->move(public_path($this->path), $newName);
        $send = Category::create([
            'uuid' => Str::uuid()->toString(),
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $newName
        ]);

        if ($send) {
            return back()->with('success', 'Data berhasil ditambahkan');
        } else {
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
        echo $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Category::all()->where('uuid', $id)->first();
        return view('backend.kategori.edit', compact('data'));
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
        $data = Category::find($id);
        if ($request->hasFile('image')) {
            $request->validate([
                'name' => 'required',
                'image' => 'required|image|mimes:webp,png,jpg|max:2048'
            ]);
            File::delete($this->path . $data->image);
            $file = $request->file('image');
            $newName = $file->hashName();
            $file->move(public_path($this->path), $newName);
            $data->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'image' => $newName
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
        $data = Category::find($id);
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
