<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\WebCheckoutPostRequest;
use Illuminate\Support\Facades\Redirect;
use App\Models\WebCheckout;
use Illuminate\View\View;
use Session;

class WebCheckoutController extends Controller
{
    public function createRequest(WebCheckoutPostRequest $request): RedirectResponse
    {
        $cart = Session::has('cart') ? Session::get('cart') : null;

        $checkout = new WebCheckout;
        $checkout->name = $request->get('name');
        $checkout->surname = $request->get('surname');
        $checkout->document = $request->get('document');
        $checkout->document_type = $request->get('documentType');
        $checkout->company = $request->get('company');
        $checkout->email = $request->get('email');
        $checkout->mobile = $request->get('mobile');
        $checkout->address = $request->get('address');
        $checkout->value = $request->get('totalValue');
        $checkout->cart = serialize($cart);

        $login = '6dd490faf9cb87a9862245da41170ff2';
        $seed = date('c');
        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }
        $nonceBase64 = base64_encode($nonce);
        $secretKey = '024h1IlD';
        $tranKey = base64_encode(sha1($nonce . $seed . $secretKey, true));

        $checkout->reference = uniqid();

        $postData = [
            "locale" => "es_CO",
            "auth" => [
                "login" => $login,
                "tranKey" => $tranKey,
                "nonce" => $nonceBase64,
                "seed" => $seed
            ],
            "payment" => [
                "reference" => $checkout->reference,
                "description" => "Prueba Transacción",
                "amount" => [
                    "currency" => 'COP',
                    "total" => $checkout->value
                ],
                "allowPartial" => false
            ],
            "buyer" => [
                "document" => $checkout->document,
                "documentType" => $checkout->document_type,
                "name" => $checkout->name,
                "surname" => $checkout->surname,
                "company" => $checkout->company,
                "email" => $checkout->email,
                "mobile" => $checkout->mobile,
                "address" => $checkout->address
            ],
            "payer" => [
                "document" => "1115190522",
                "documentType" => "CC",
                "name" => "Rodrigo",
                "surname" => "Gallego",
                "company" => "PlacetoPay",
                "email" => "rgallegomoreno@gmail.com",
                "mobile" => "3205478801",
                "address" => "Calle 18 #70-51"
            ],
            "expiration" => date('c', strtotime('+10 minutes', strtotime($seed))),
            "returnUrl" => "http://127.0.0.1:8000/checkout_request/".$checkout->reference,
            "ipAddress" => "127.0.0.1",
            "userAgent" => "PlacetoPay Sandbox"
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->timeout(30)
            ->post('https://dev.placetopay.com/redirection/api/session', $postData);


        $responseData = $response->json();

        $checkout->status = $responseData['status']['status'];
        $checkout->message = $responseData['status']['message'];

        if ($response->successful())
        {
            $checkout->request_id = $responseData['requestId'];
            $checkout->save();

            Session::forget('cart');

            return redirect::to($responseData['processUrl']);
        }

        $checkout->save();
        return redirect()->route('product.checkout');
    }

    public function consultRequest(Request $request, string $id): View
    {
        $checkout = WebCheckout::where('reference', '=', $id)->firstOrFail();

        $login = '6dd490faf9cb87a9862245da41170ff2';
        $seed = date('c');
        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }
        $nonceBase64 = base64_encode($nonce);
        $secretKey = '024h1IlD';
        $tranKey = base64_encode(sha1($nonce . $seed . $secretKey, true));

        $postData = [
            "auth" => [
                "login" => $login,
                "tranKey" => $tranKey,
                "nonce" => $nonceBase64,
                "seed" => $seed
            ],
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->timeout(30)
            ->post('https://dev.placetopay.com/redirection/api/session/'.$checkout->request_id, $postData);

        $responseData = $response->json();

        $checkout->status = $responseData['status']['status'];
        $checkout->message = $responseData['status']['message'];
        $checkout->save();

        return view('store.checkout.response', [
            "checkout" => $checkout
        ]);
    }

    public function index(Request $request): View
    {
        $checkouts = DB::table('web_checkouts')
            ->orderBy('id', 'desc')
            ->paginate(7);

        return view('store.checkout.index', ['checkouts' => $checkouts]);
    }

    public function retryRequest(Request $request, string $id): RedirectResponse
    {
        $checkout = WebCheckout::where('reference', '=', $id)->firstOrFail();

        $newCheckout = new WebCheckout;
        $newCheckout->name = $checkout->name;
        $newCheckout->surname = $checkout->surname;
        $newCheckout->document = $checkout->document;
        $newCheckout->document_type = $checkout->document_type;
        $newCheckout->company =$checkout->company;
        $newCheckout->email = $checkout->email;
        $newCheckout->mobile = $checkout->mobile;
        $newCheckout->address = $checkout->address;
        $newCheckout->value = $checkout->value;
        $newCheckout->cart = $checkout->cart;

        $login = '6dd490faf9cb87a9862245da41170ff2';
        $seed = date('c');
        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }
        $nonceBase64 = base64_encode($nonce);
        $secretKey = '024h1IlD';
        $tranKey = base64_encode(sha1($nonce . $seed . $secretKey, true));

        $newCheckout->reference = uniqid();

        $postData = [
            "locale" => "es_CO",
            "auth" => [
                "login" => $login,
                "tranKey" => $tranKey,
                "nonce" => $nonceBase64,
                "seed" => $seed
            ],
            "payment" => [
                "reference" => $newCheckout->reference,
                "description" => "Prueba Transacción",
                "amount" => [
                    "currency" => 'COP',
                    "total" => $newCheckout->value
                ],
                "allowPartial" => false
            ],
            "buyer" => [
                "document" => $newCheckout->document,
                "documentType" => $newCheckout->document_type,
                "name" => $newCheckout->name,
                "surname" => $newCheckout->surname,
                "company" => $newCheckout->company,
                "email" => $newCheckout->email,
                "mobile" => $newCheckout->mobile,
                "address" => $newCheckout->address
            ],
            "payer" => [
                "document" => "1115190522",
                "documentType" => "CC",
                "name" => "Rodrigo",
                "surname" => "Gallego",
                "company" => "PlacetoPay",
                "email" => "rgallegomoreno@gmail.com",
                "mobile" => "3205478801",
                "address" => "Calle 18 #70-51"
            ],
            "expiration" => date('c', strtotime('+10 minutes', strtotime($seed))),
            "returnUrl" => "http://127.0.0.1:8000/checkout_request/".$newCheckout->reference,
            "ipAddress" => "127.0.0.1",
            "userAgent" => "PlacetoPay Sandbox"
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->timeout(30)
            ->post('https://dev.placetopay.com/redirection/api/session', $postData);


        $responseData = $response->json();

        $newCheckout->status = $responseData['status']['status'];
        $newCheckout->message = $responseData['status']['message'];

        if ($response->successful())
        {
            $newCheckout->request_id = $responseData['requestId'];
            $newCheckout->save();

            Session::forget('cart');
            return redirect::to($responseData['processUrl']);
        }

        $newCheckout->save();
        return redirect()->route('product.checkout');
    }
}
