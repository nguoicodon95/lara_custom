<?php namespace App\Http\Controllers\Front;

use App\Models;
use Illuminate\Http\Request;

class CheckoutController extends BaseFrontController
{
    public function __construct()
    {
        parent::__construct();
        $this->bodyClass = 'checkout';
    }

    public function getCheckout(Request $request)
    {
    	$originalCart = \Session::get('originalCart');
    	if( !isset($originalCart) || count($originalCart) <= 0 ) {
    		return redirect('/');
    	}
        return view('front.order.index');
    }

    public function postCheckout(Request $request)
    {
        // print('Chức năng đang cập nhật. <a href="/"><u>Quay lại</u></a>');die;
        $validator = \Validator::make($request->all(), [
            'name' => 'required|min:2',
            'email' => 'required|email',
            'phone' => 'required|regex:/^0[0-9]{9,10}$/',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // dd($request->all());
        $transaction = Models\Transaction::create([
            'gender' => $request->gender,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'messages' => $request->note,
            'amount' => $request->amount ? $request->amount : $this->cart['cartSubTotal'],
        ]);

        foreach ($this->cart['cartItems'] as $product) {
            Models\Order::create([
                'transaction_id' => $transaction->id,
                'product_id' => $product->product_id,
                'qty' => $product->quantity,
                'amount' => $product->quantity*$product->price,
            ]);
        }

        $this->_unsetCart();
        $request->session()->put('view_order', '1');
        return redirect()->route('show.order', $transaction->id);
    }

    public function getOrder(Request $request, $id) {
        $view_order = $request->session()->get('view_order');
        $this->dis['transaction'] = Models\Transaction::find($id);
        if(!$this->dis['transaction']) return redirect('/');

        if ($request->session()->has('view_order')) {
            $request->session()->forget('view_order');
            return view('front.order.show', $this->dis);
        } else {
            return redirect('/');
        }

    }
}
