@extends('layouts.pos')
@section('title', 'Customers')
@section('block-header', 'Add New Customer')
@section('content')

<script>
function imprimer(printinvoice) {
      var printContents = document.getElementById(printinvoice).innerHTML;    
   var originalContents = document.body.innerHTML;      
   document.body.innerHTML = printContents;     
   window.print();     
   document.body.innerHTML = originalContents;
   }
</script>

<div id="printinvoice">
 
     <div class="card" style="padding: 5%">
         <div class="card-header ">
             
             <div class="float-right">
                 <h3 class="mb-0">{{$invoice->invoice_no}}</h3>
                 {{-- {{date('l j F Y, H:i')}} --}}
                 {{$invoice->created_at}}
             </div>
         </div>
         <div class="card-body">
             <div class="row mb-4">
                 <div class="col-sm-6">
                     <h5 class="mb-3">DE:</h5>
                     <h4 class="text-dark mb-1">{{$invoice->from}}</h4>
                     <div>Sotuba ACI - Bamako</div>
                     <div>Mali</div>
                     <div>Email: contact@entreprise.com</div>
                     <div>Phone: +223 60 69 03 43</div>
                 </div>
                 <div class="col-sm-6 ">
                    
                     <div></div>
                       <h5 class="mb-3">A:</h5>
                       <h4 class="text-dark mb-1">{{$invoice->to}}</h4>
                    <div></div>
                     <div></div>
                     <div></div>
                 </div>
             </div>
             <p>*****************************************************</p>
             <div class="table-responsive-sm">
                 <table class="table table-striped">
                     <thead>
                         <tr>
                             <th class="center">N°</th>
                             <th>Produit</th>
                             <th>Description</th>
                             <th class="right">Prix</th>
                             <th class="center">Qantité</th>
                             <th class="right">Total</th>
                         </tr>
                     </thead>
                     <tbody>
                     	@foreach($factureItem as $item)
                         <tr>
                             <td class="center">{{$item->id}}</td>
                             <td class="left strong">{{$item->name}}</td>
                             <td class="left">{{$item->description}}</td>
                             <td class="left">{{$item->retail_price}}</td>
                             <td class="left">{{$item->cart_quantity}}</td>
                             <td class="right">{{$item->cart_quantity * $item->retail_price}}</td>
                        @endforeach
                        
                             <td class="right"></td>
                             {{-- <td class="center">{{$item->id}}</td>
                             <td class="right">{{$item->id}}</td> --}}
                         </tr>
                         
                     </tbody>
                 </table>
             </div>
             <div class="row">
                 <div class="col-lg-4 col-sm-5">
                 </div>
                 <div class="col-lg-4 col-sm-5 ml-auto">
                     <table class="table table-clear">
                         <tbody>
                             <tr>
                                 <td class="left">
                                     <strong class="text-dark">Total</strong>
                                 </td>
                                 <td class="right">{{$invoice->total_amount}} Fcfa</td>
                             </tr>
                             <tr>
                                 <td class="left">
                                     <strong class="text-dark">Montant Payé</strong>
                                 </td>
                                 <td class="right">{{$invoice->amount_paid}} Fcfa</td>
                             </tr>
                             <tr>
                                 <td class="left">
                                     <strong class="text-dark">Montant Due</strong>
                                 </td>
                                 <td class="right">{{$invoice->amount_due}} Fcfa</td>
                             </tr>
                             <tr>
                                 <td class="left">
                                     <strong class="text-dark">Montant à Retourner</strong>
                                 </td>
                                 <td class="right">{{$invoice->amount_return}} Fcfa</td>
                             </tr>
                             <!-- <tr>
                                 <td class="left">
                                     <strong class="text-dark">VAT (10%)</strong>
                                 </td>
                                 <td class="right">{{$invoice->amount_due}} Fcfa</td>
                             </tr> -->
                             {{-- <tr>
                                 <td class="left">
                                     <strong class="text-dark">Total</strong> </td>
                                 <td class="right">
                                     <strong class="text-dark"> Fcfa</strong>
                                 </td>
                             </tr> --}}
                         </tbody>
                     </table>
                 </div>
             </div>
             
         </div>
         <div class="card-footer bg-white">
             <p class="mb-0">CAMARA ELECTRONIQUES</p>
         </div>
     </div>
 </div>
        <div class="card-footer">
            <button class="btn btn-primary m-5 py-5" onClick="imprimer('printinvoice')">IMPRIMER</button>
        </div> 
@endsection
