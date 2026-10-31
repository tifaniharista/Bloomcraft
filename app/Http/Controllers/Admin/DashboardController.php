<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;



class DashboardController extends Controller
{


    public function index()
    {


        $totalProducts = Product::count();


        $totalCategories = Category::count();


        $totalUsers = User::whereIn('role',['user','customer'])->count();


        $totalAdmins = User::where('role','admin')->count();



        $products = Product::with('category')

            ->latest()

            ->limit(5)

            ->get();



        return view('admin.dashboard', compact(

            'totalProducts',

            'totalCategories',

            'totalUsers',

            'totalAdmins',

            'products'

        ));


    }


}
