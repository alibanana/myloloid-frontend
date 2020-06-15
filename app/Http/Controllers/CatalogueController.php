<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CatalogueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        // Gets first category available and call subindex
        $response = Http::get(env('API_URL').'/api/categories/first');

        return redirect('catalogue/'.$response['data']['category']);
    }

    public function subindex(Request $request, $category)
    {
        $categories = Http::get(env('API_URL').'/api/categories')['data'];

        // Set active_category from the param given
        foreach ($categories as $category_itr)
        {
            if ($category_itr['category'] == $category)
            {
                $active_category = $category_itr;
            }
        }

        $params = array();

        if ($request->has('orderby'))
        {
            $params['orderby'] = $request['orderby'];
        }

        // Get products in that category
        $products = Http::get(env('API_URL').'/api/categories/'.$active_category['id'].'/products', $params)['data'];

        return view('client/catalogue', compact('categories', 'active_category', 'products', 'params'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Http::get(env('API_URL').'/api/categories')['data'];

        $product = Http::get(env('API_URL').'/api/products/'.$id)['data'];

        return view('client/catalogue_show', compact('categories', 'product'));
    }

    // Add product to cart
    public function addtocart(Request $request, $id)
    {
        $product = Http::get(env('API_URL').'/api/products/'.$id)['data'];
        
        $data = [
            'id' => $product['id'],
            'file' => $product['photos'][0]['file'],
            'name' => $product['name'],
            'price' => $product['price'],
            'colour' => $request['colour'],
            'size' => $request['size'],
            'quantity' => $request['quantity']
        ];

        if (session()->has('cart')) 
        {
            if ($this->inCart($data['id'], $data['colour'], $data['size']))
            {
                $this->addCartQuantity($data['id'], $data['colour'], $data['size'], $data['quantity']);
            } else {
                session()->push('cart', $data);
            }
        } else {
            session(['cart' => array()]);
            session()->push('cart', $data);
        }

        return redirect('/catalogue');
    }

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

    private function addCartQuantity($id, $colour, $size, $quantity){
        $cart = session()->get('cart');
        foreach($cart as &$item)
        {
            if (($item['id'] == $id) and ($item['colour'] == $colour) and ($item['size'] == $size))
            {
                $item['quantity'] += $quantity;
            }
        }

        session()->put('cart', $cart);
    }
}
