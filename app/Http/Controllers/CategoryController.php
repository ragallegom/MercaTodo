<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CategoryFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $query = trim($request->get('searchText'));
        $categories = DB::table('categories')
            ->where('name','LIKE', '%' . $query . '%')
            ->orderBy('id', 'desc')
            ->paginate(7);

        return view('store.category.index', ["categories" => $categories, "searchText" => $query]);
    }

    public function create(): View
    {
        return view('store.category.create');
    }

    public function store(CategoryFormRequest $categoryFormRequest): RedirectResponse
    {
        $category = new Category;
        $category->name = $categoryFormRequest->get('name');
        $category->description = $categoryFormRequest->get('description');
        $category->price = $categoryFormRequest->get('price');
        $category->disabled_at = null;
        $category->save();

        return redirect::to('store/category');
    }

    public function show($id): View
    {
        return view('store.category.show', ['category' => Category::findOrFail($id)]);
    }

    public function edit($id): View
    {
        return view('store.category.edit', ['category' => Category::findOrFail($id)]);
    }

    public function update(CategoryFormRequest $categoryFormRequest, $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->name = $categoryFormRequest->get('name');
        $category->description = $categoryFormRequest->get('description');
        if ($categoryFormRequest->get('disabled') == null) {
            $category->disabled_at = null;
        } else {
            $category->disabled_at = now();
        }
        $category->save();

        return redirect::to('store/category');
    }

    public function destroy($id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->disabled_at = now();
        $category->update();

        return Redirect::to('store/category');
    }
}
