<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Search filter
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%');
        }

        // Category filter
        if ($request->has('categories') && is_array($request->input('categories')) && count($request->input('categories')) > 0) {
            $query->whereIn('category_id', $request->input('categories'));
        }

        // Price filter
        if ($request->has('price') && $request->input('price') != '') {
            $priceRange = $request->input('price');
            switch ($priceRange) {
                case '0-100':
                    $query->whereBetween('price', [0, 100000]);
                    break;
                case '100-500':
                    $query->whereBetween('price', [100000, 500000]);
                    break;
                case '500-1000':
                    $query->whereBetween('price', [500000, 1000000]);
                    break;
                case '1000+':
                    $query->where('price', '>=', 1000000);
                    break;
            }
        }

        // Rating filter (assuming rating is a direct column)
        if ($request->has('rating') && $request->input('rating') != '') {
            $rating = (int) $request->input('rating');
            $query->where('rating', '>=', $rating);
        }

        // Sort filter
        if ($request->has('sort') && $request->input('sort') != '') {
            $sort = $request->input('sort');
            switch ($sort) {
                case 'price-low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price-high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'rating':
                    $query->orderBy('rating', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        }

        $products = $query->paginate(6)->withQueryString(); // Mengambil 6 produk per halaman dengan query string
        $categories = Category::all();
        return view('home', compact('products', 'categories'));
    }
}
