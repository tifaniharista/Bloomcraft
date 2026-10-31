<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\Category;

use Illuminate\Http\Request;

use Illuminate\Support\Str;



class CategoryController extends Controller
{


    public function index()
    {

        $categories = Category::latest()->get();


        return view(
            'admin.categories.index',
            compact('categories')
        );

    }




    public function create()
    {

        return view(
            'admin.categories.create'
        );

    }





    public function store(Request $request)
    {


        $request->validate([

            'name'=>'required|string|max:120'

        ]);



        Category::create([

            'name'=>$request->name,

            'slug'=>Str::slug($request->name)

        ]);



        return redirect()

        ->route('admin.categories.index')

        ->with(
            'success',
            'Kategori berhasil ditambahkan'
        );


    }







    public function edit(Category $category)
    {


        return view(
            'admin.categories.edit',
            compact('category')
        );


    }







    public function update(Request $request, Category $category)
    {


        $request->validate([

            'name'=>'required|string|max:120'

        ]);



        $category->update([

            'name'=>$request->name,

            'slug'=>Str::slug($request->name)

        ]);



        return redirect()

        ->route('admin.categories.index')

        ->with(
            'success',
            'Kategori berhasil diperbarui'
        );


    }

    public function destroy(Category $category)
    {
        if($category->products()->count() > 0)
        {


            return redirect()

            ->route('admin.categories.index')

            ->with(
                'error',
                'Kategori tidak bisa dihapus karena masih digunakan oleh produk.'
            );


        }



        $category->delete();



        return redirect()

        ->route('admin.categories.index')

        ->with(
            'success',
            'Kategori berhasil dihapus'
        );


    }
}
