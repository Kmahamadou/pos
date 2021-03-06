@extends('layouts.pos')
@section('title', 'Customers')
@section('block-header', 'Add New Customer')

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="body">
                    @include('layouts.messages')
                    <form action="{{route('customer.store')}}" method="post">
                        <div class="row clearfix">
                            @csrf
                            <div class="col-sm-6">
                                <label for="name">Nom</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control" placeholder="Enter Customer Name" type="text" name="name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="email">Email</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control" placeholder="Enter Customer Email" type="text" name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="phone">Tel. (Required)***</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control" placeholder="Enter Customer Phone No." type="text" name="phone">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="address">Addresse</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control" placeholder="Enter Customer Address" type="text" name="address">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label for="tin_number">Munero NIT</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control" placeholder="Enter Customer TIN Number" type="text" name="tin_number">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <button class="btn btn-primary" type="submit">Valider</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection