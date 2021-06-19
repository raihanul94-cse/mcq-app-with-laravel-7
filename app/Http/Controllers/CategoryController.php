<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\SubCategory;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Auth::user()->categories()->get();
        return view('admin-panel.categories.categories', compact('categories'));
    }

    public function create_category(Request $request)
    {
        Auth::user()->categories()->create([
            'title' => $request->input('data.title')
        ]);
    }

    public function create_subcategory(Request $request)
    {
        Auth::user()->sub_categories()->create([
            'title' => $request->input('data.title'),
            'category_id' => $request->input('data.category_id')
        ]);
    }

    public function all_subcategories()
    {
        $sub_categories = Auth::user()->sub_categories()->get();
        $categories = Auth::user()->categories()->get();
        return view('admin-panel.categories.subcategories', compact('sub_categories', 'categories'));
    }

    public function get_cat_based_subcats($id)
    {
        $sub_categories = SubCategory::where('user_id', Auth::id())->where('category_id', $id)->get();
        return $sub_categories;
    }
    
}
