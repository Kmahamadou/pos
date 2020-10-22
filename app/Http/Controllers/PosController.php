<?php

namespace App\Http\Controllers;

use App\Account;
use App\Cart;
use App\Customer;
use App\Invoice;
use App\Item;
use App\Sell;
use App\invoiceItem;
use App\PrintInvoice;
use App\Carts_history;

use redirect;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Helper\Table;

class PosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $items = Item::all();
        $carts = DB::table('carts')
            ->join('items', 'item_id', '=', 'items.id')
            ->select('*', 'carts.id as cart_id', 'carts.quantity as cart_quantity')
            ->where('user_id', '=', Auth::user()->id)
            ->get();
        $accounts = Account::all();
        $total = 0;
        $vat = 0;
        foreach($carts as $cart){
            $total += $cart->retail_price * $cart->cart_quantity;
            $vat += $cart->retail_price*$cart->cart_quantity*$cart->vat/100;
        }
        return view('posindex', ['items'=>$items, 'carts'=>$carts, 'total' => $total, 'vat'=>$vat, 'accounts'=>$accounts]);
    }
    public function addToCart(Request $request){
        $user = Auth::user();
        $cart = new Cart();
        $cart_history = new Carts_history();
        $item = Item::find($request->item_id);

        $newQuantity = $item->quantity - $request->quantity;
        $item->quantity = $newQuantity;
        $item->update();

        $cart->user_id = $user->id;
        $cart->item_id = $request->item_id;
        $cart->quantity = $request->quantity;
        $cart->save();
        
        $cart_history->user_id = $user->id;
        $cart_history->item_id = $request->item_id;
        $cart_history->quantity = $request->quantity;
        $cart_history->save();

        // $invoice_items->user_id = $user->id;
        // $invoice_items->item_id = $item->id;
        // $invoice_items->itemQty = $request->quantity;
        // $invoice_items->save();
        
        return 'done';
    }
    public function deleteCartItem(Request $request){
        try{
            $cart = DB::table('carts')->select(['item_id', 'quantity'])->where('id', $request->id)->get()->first();
            $item = Item::find($cart->item_id);
            $item->quantity += $cart->quantity;
            $item->update();
            Cart::destroy([$request->id]);

        }catch(\Illuminate\Database\QueryException $e){
            return 'Wrong!';
        }

        return 'Rifat';
    }

    public function deleteAllCartItem(Request $request){
        $keys = $request->dataId;
        // dd($Keys);
        $values = $request->dataQty;
        $rifat = [];
        foreach($keys as $index => $key){
            if(isset($rifat[$key])){
                $rifat[$key]+=$values[$index];
            }else{
                $rifat[$key] = $values[$index];
            }
        }
        foreach($rifat as $id => $quantity){
            $item = Item::find($id);
            $item->quantity += $quantity;
            $item->update();
         }
        $id = Auth::user()->id;
        $cartIds = DB::table('carts')->select('id')->where('user_id', '=', $id)->get()->toArray();
        $ids = [];
        foreach($cartIds as $cards){
            array_push($ids, $cards->id);
        }
        Cart::destroy($ids);
        return ['success-message' => 'Cart Deleted'];
    }

    public function itemSellInvoiceShow(Request $request){
       if($request){
//        return $request;
        $id =  Auth::user()->id;
        $carts = DB::table('carts')
            ->join('items', 'item_id', '=', 'items.id')
            ->select('*', 'carts.id as cart_id', 'carts.quantity as cart_quantity')
            ->where('user_id', '=', $id)
            ->get();        

            foreach($carts as $cart){
            $sell = new Sell();
            $sell->item_id = $cart->item_id;
            $sell->quantity = $cart->cart_quantity;
            $sell->total_price = $cart->retail_price*$cart->cart_quantity + $cart->retail_price*$cart->cart_quantity*$cart->vat/100;
            $sell->save();
        }
        if(count(Invoice::all())==0){
            $invoiceNo = 'Facture N° ##1';
        }else{
            $invoiceNo = 'Facture N° ##'.(count(Invoice::all())+1);
        }
        $customer = Customer::where('phone', '=', $request->customer_no)->get();
//        return $customer;
        if(count($customer)>0){
            $customer_name = $customer->first()->name;
        }else{
            $customer_name = 'Client '.$request->customer_no;
        }
        if($request->amount_paid<$request->amount_payable){
            $due = $request->amount_payable-$request->amount_paid;
        }else{
            $due = 0;
        }

        $payable=$request->amount_payable;
        $paid=$request->amount_paid;
        if($payable<$paid){
$amount_return = $paid - $payable;}
else{
    $amount_return = 0;
}
        $facture = Invoice::create([
            'invoice_no'    =>  $invoiceNo,
            'from'          =>  Auth::user()->name,
            'to'            =>  $customer_name,
            'invoice_type'  =>  'type',
            'total_amount'  =>  $request->amount_payable,
            'amount_paid'   =>  $request->amount_paid,
            'amount_due'    =>  $due,
            'amount_return' =>  $amount_return,
            'status'        =>  $request->note,
        ]);
        
        $factureItems = $carts;
        //dd($factureItems);\

        $id = Auth::user()->id;
        $cartIds = DB::table('carts')->select('id')->where('user_id', '=', $id)->get()->toArray();
        $ids = [];

        foreach($cartIds as $cards){
            array_push($ids, $cards->id);
        }

        $facture_id = $facture->id;

        //$myarray_  = array($facture_id,$ids);
        //dd($myarray_);

        
        
        //$print_invoice = new PrintInvoice;
        foreach ($ids as $cart_id) {
            $print_invoice = PrintInvoice::create([
                'invoice_id' => $facture_id,
                'cart_ids' => $cart_id,
            ]);
        }

        Cart::destroy($ids);

        // $lastInvoice = DB::table('invoices')->latest('id')->first();
        // $facture = $lastInvoice->id;
        
        // dd($factureItems);
        //return view('invoices')->with('factureItem',$factureItems)->with('invoice',$facture);
        //return view('invoices.show');
        return redirect('/pos/invoice');
    
        }// return redirect()->route('posindex');
    }


    public function InvoiceShow()
    {
       
        $last_invoice = Invoice::OrderBy('id', 'desc')->first();
        $invoice_id = $last_invoice->id;

        //Returns a unique invoice id and the cart ids that are linked to it. A cart represent an item
        $invoice_cart = PrintInvoice::where('invoice_id', $invoice_id)->get();
        $this_cart_ids = [];
    
        //Invoice Card (IC)
        foreach ($invoice_cart as $IC) {
            array_push($this_cart_ids, $IC->cart_ids); 
        }

       
        $cart_items = DB::table('carts_histories')
            ->join('items', 'item_id', '=', 'items.id')
            ->select('*', 'carts_histories.id as cart_id', 'carts_histories.quantity as cart_quantity')
            ->wherein('carts_histories.id', $this_cart_ids)
            ->get();

            //dd($cart_items);

        //$invoiceItems = $cart_items;

        //dd($invoiceItems);
        return view('invoices.show')->with('invoice', $last_invoice)->with('factureItem', $cart_items);
    }



    public function InvoiceHistory(Request $request)
    {
       
       $invoice_id = $request->invoice_id;

        $invoice = Invoice::where('id', $invoice_id)->first();
        //$invoice_id = $invoice->id;

        //Returns a unique invoice id and the cart ids that are linked to it. A cart represent an item
        $invoice_cart = PrintInvoice::where('invoice_id', $invoice_id)->get();
        $this_cart_ids = [];
    
        //Invoice Card (IC)
        foreach ($invoice_cart as $IC) {
            array_push($this_cart_ids, $IC->cart_ids); 
        }

       
        $cart_items = DB::table('carts_histories')
            ->join('items', 'item_id', '=', 'items.id')
            ->select('*', 'carts_histories.id as cart_id', 'carts_histories.quantity as cart_quantity')
            ->wherein('carts_histories.id', $this_cart_ids)
            ->get();


        return view('invoices.show')->with('invoice', $invoice)->with('factureItem', $cart_items);
    }



    public function InvoiceList()
    {
        $invoices = Invoice::OrderBy('created_at', 'desc')->get();
        
        return view('invoices.index')->with('invoices', $invoices);
    }
}
