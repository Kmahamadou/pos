@extends('layouts.pos')
@section('title', 'Customers')
@section('block-header', 'Add New Customer')

@section('content')
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Historique des ventes</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>N°Facture</th>
                      <th>Nom Produit</th>
                      <th></th>
                      <th>Status</th>
                      <th>Reason</th>
                    </tr>
                  </thead>
                  <tbody>
                  {{-- 	@foreach($invoice as $lastInvoice)
                    <tr>
                      <td>{{$lastInvoice->invoice_no}}</td>
                      <td>{{$lastInvoice->invoice_type}}</td>
                      <td>{{$lastInvoice->status}}</td>
                    </tr>
                   @endforeach --}}
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
@endsection