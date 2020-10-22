@extends('layouts.pos')

@section('content')
<div class="row clearfix">
        <div >
            <div class="card">
				<table class="table table-striped">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Facture Numero</th>
				      <th scope="col">Le</th>
				      <th scope="col">A</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@foreach($invoices as $invoice)
				  	 	
					  		<tr>
					  			
							      <th scope="row">{!! $invoice->id !!}</th>
							      <td><a href="{!! route('invoice.history', ['invoice_id' => $invoice->id]) !!}">Fature No {!! $invoice->id !!}</a></td>
		  					      <td>{!! $invoice->created_at !!}</td>
	  					      	
						    </tr>
						
				  	@endforeach
				  </tbody>
				</table>
			</div>
		</div>
	</div>
@endsection