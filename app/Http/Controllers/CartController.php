<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

use App\Category;

class CartController extends Controller
{
    // Show Cart Page
    public function index()
    {
        $categories = Http::get('http://myloloid-backend.test/api/categories')['data'];

        if (session()->has('cart')){
            $cartTotal = $this->getCartTotal();
            return view('client/shopping_cart', compact('categories', 'cartTotal'));
        }

        $title = 'Error, Cart Empty';
        $message = [
            'heading' => 'Error - Cart Empty!!',
            'message' => "Oops, seems like you haven't add any products."
        ];

        return view('client/error', compact('categories', 'title', 'message'));
    }


    // Show Checkout Form Page
    public function indexCheckout()
    {
        $categories = Http::get('http://myloloid-backend.test/api/categories')['data'];

        if (session()->has('cart')){
            $cartTotal = $this->getCartTotal();
            if (auth()->user()){
                $user = auth()->user();
                return view('client/checkout_form', compact('categories', 'cartTotal', 'user'));

            }
            return view('client/checkout_form', compact('categories', 'cartTotal'));
        }

        $title = 'Error, Cart Empty';
        $message = [
            'heading' => 'Error - Cart Empty!!',
            'message' => "Oops, seems like you haven't add any products."
        ];

        return view('client/error', compact('categories', 'title', 'message'));
    }


    // Show invoice page
    public function indexInvoice($invoice_no)
    {
        $categories = Http::get('http://myloloid-backend.test/api/categories')['data'];

        $invoice = Http::get('http://myloloid-backend.test/api/transactions/'.$invoice_no)['data'];

        return view('client/invoice', compact('categories', 'invoice'));
    }


    // Show confirmation page
    public function indexConfirmation()
    {
        $categories = Http::get('http://myloloid-backend.test/api/categories')['data'];

        return view('client/confirmation', compact('categories'));
    }


    // Send cart data to API
    public function store(Request $request)
    {
        if (!session()->has('cart'))
        {
            $title = 'Error, Cart Empty';
            $message = [
                'heading' => 'Error - Cart Empty!!',
                'message' => "Oops, seems like you haven't add any products."
            ];
    
            return view('client/error', compact('categories', 'title', 'message'));    
        }

        $storeCustomer = Http::post('http://myloloid-backend.test/api/customers', $request->toArray());
        $storeDelivery = Http::post('http://myloloid-backend.test/api/deliveries', $request->toArray());
        $storeTransaction = Http::post('http://myloloid-backend.test/api/transactions', [
            'customer_id' => $storeCustomer['data']['id'],
            'delivery_id' => $storeDelivery['data']['id']
        ]);

        $storeTransactionDetails = Http::post('http://myloloid-backend.test/api/transaction_details', [
            'cart' => session('cart'),
            'transaction_id' => $storeTransaction['data']['id']
        ]);

        return redirect('invoice/'.$storeTransaction['data']['invoice_no']);
    }


    // Send confirmation data to API
    public function storeConfirmation(Request $request)
    {
        // Delete all files in uplaods/temp
        $files = glob('uploads/temp/*'); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file))
            {
                unlink($file); // delete file
            }
        }

        $image_inp = $request->file('file');
        $ext = $image_inp->getClientOriginalExtension();
        while(true){
            $newName = rand(100000,1001238912).".".$ext;

            if (!file_exists('uploads/temp/'.$newName)){
                $image_inp->move('uploads/temp', $newName);
                break;
            }
        }

        $photo = fopen('uploads/temp/'.$newName, 'r');

        $storeTransferData = Http::attach(
            'image', $photo
        )->post('http://myloloid-backend.test/api/transfers', $request->toArray());

        if (!$storeTransferData['success']){
            $categories = Http::get('http://myloloid-backend.test/api/categories')['data'];

            $title = $storeTransferData['message']['title'];
            $message = [
                'heading' => $storeTransferData['message']['heading'],
                'message' => $storeTransferData['message']['message']
            ];
    
            return view('client/error', compact('categories', 'title', 'message'));    
        }

        $transaction = Http::get('http://myloloid-backend.test/api/transactions/'.$request['invoice_no']);

        return redirect('invoice/'.$transaction['data']['invoice_no']);
    }


    // Update session['cart]
    public function update(Request $request)
    {
        $cart = session()->get('cart');

        $flag = array();

        $index = 0;
        foreach ($request['data'] as $item)
        {
            if ($this->inCart($item['id'], $item['colour'], $item['size']))
            {
                if ($item['quantity'] <= 0)
                {
                    array_push($flag, $index);
                } else {
                    $cart[$index]['quantity'] = $item['quantity'];
                }
            }
            $index++;
        }

        foreach ($flag as $key){
            unset($cart[$key]);
        }

        if (count($cart) == 0){
            session()->forget('cart');
        } else {
            $cart = array_values($cart);
            session()->put('cart', $cart);
        }

        return redirect('cart');
    }


    // Check if product exists in session['cart']
    private function inCart($productID, $colourID, $sizeID) {
        // If cart data in session is empty, return false
        if (!session()->has('cart')) 
        {
            return false;
        }

        // Iterate through cart and check if any of the product exist
        foreach(session()->get('cart') as $item)
        {
            if (($item['id'] == $productID) and ($item['colour'] == $colourID) and ($item['size'] == $sizeID))
            {
                return true;
            }
        }

        return false;
    }

    // Get Cart Total IDR
    private function getCartTotal() {
        $total = 0;
        foreach(session()->get('cart') as $item)
        {
            $total = $total + ($item['quantity'] * $item['price']);
        }
        return $total;
    }
}
