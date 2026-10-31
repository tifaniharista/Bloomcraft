<?php

namespace App\Http\Controllers;


use App\Models\Product;

use App\Models\Category;

use Illuminate\Http\Request;



class CatalogController extends Controller
{


    /*
    |--------------------------------------------------------------------------
    | Dashboard Utama
    |--------------------------------------------------------------------------
    */


    public function index(Request $request)
    {


        $products = Product::query();




        if($request->category){


            $products->where(

                'category_id',

                $request->category

            );


        }




        $products = $products

        ->with('category')

        ->latest()

        ->get();





        $categories = Category::all();





        return view(

            'catalog.index',

            compact(

                'products',

                'categories'

            )

        );


    }







    /*
    |--------------------------------------------------------------------------
    | Halaman Collection Produk
    |--------------------------------------------------------------------------
    */


    public function collection(Request $request)
    {


        $products = Product::query();





        if($request->category){


            $products->where(

                'category_id',

                $request->category

            );


        }





        $products = $products

        ->with('category')

        ->latest()

        ->get();






        $categories = Category::all();






        return view(

            'catalog.collection',

            compact(

                'products',

                'categories'

            )

        );


    }








    /*
    |--------------------------------------------------------------------------
    | Detail Produk
    |--------------------------------------------------------------------------
    */


    public function show($slug)
    {


        $product = Product::with('category')

        ->where(

            'slug',

            $slug

        )

        ->firstOrFail();






        $relatedProducts = Product::where(

            'category_id',

            $product->category_id

        )

        ->where(

            'id',

            '!=',

            $product->id

        )

        ->limit(4)

        ->get();







        return view(

            'catalog.show',

            compact(

                'product',

                'relatedProducts'

            )

        );



    }



}
