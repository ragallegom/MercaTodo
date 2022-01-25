<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\ProductIndexRequest;
use App\Models\Category;
use App\Cart;
use Session;

class ProductController extends Controller
{
    public function index(ProductIndexRequest $request): View
    {
        $searchName = trim($request->get('searchName'));
        $searchDescription = trim($request->get('searchDescription'));
        $searchRangeMin = $request->get('searchRangeMin') ? $request->get('searchRangeMin') : 0;
        $searchRangeMax = $request->get('searchRangeMax') ? $request->get('searchRangeMax') : 1000000;

        $categories = DB::table('categories')
            ->where('name','LIKE', '%' . $searchName . '%')
            ->where('description','LIKE', '%' . $searchDescription . '%')
            ->whereBetween('price', [$searchRangeMin, $searchRangeMax])
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

    public function getAddToCart(Request $request, string $id): RedirectResponse
    {
        $product = Category::findOrFail($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return redirect()->route('products.index');
    }

    public function getCart(): view
    {
        if (!Session::has('cart'))
        {
            return view('store.products.shopping-cart', ['products' => null]);
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('store.products.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout(): view
    {
        if(!Session::has('cart'))
        {
            return view('store.products.shopping-cart');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('store.products.checkout', ['total' => $total]);
    }

    public function getIncreaseProductShopping(Request $request, string $id): view
    {
        $product = Category::findOrFail($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return view('store.products.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getDecreaseProductShopping(Request $request, string $id): view
    {
        $product = Category::findOrFail($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->remove($product, $product->id);

        $request->session()->put('cart', $cart);
        return view('store.products.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }
}
