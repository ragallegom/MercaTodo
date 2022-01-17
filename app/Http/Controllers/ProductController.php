<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $searchName = trim($request->get('searchName'));
        $searchDescription = trim($request->get('searchDescription'));
        $searchRangeMin = $request->get('searchRangeMin');
        $searchRangeMax = $request->get('searchRangeMax');

        $categories = DB::table('categories')
            ->where('name','LIKE', '%' . $searchName . '%')
            ->where('description','LIKE', '%' . $searchDescription . '%')
            ->where('')
            ->whereNull('disabled_at')
            ->orderBy('id', 'desc')
            ->paginate(7);

        return view('store.products.index', [
            "categories" => $categories,
            "searchName" => $searchName,
            "searchDescription" => $searchDescription,
            "searchRangeMin" => $searchRangeMin,
            "searchRangeMax" => $searchRangeMax
        ]);
    }
}
