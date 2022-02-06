@extends('layout.app')

@section('title', 'Stripe')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form class="card" action="{{route('stripe.pay')}}" method="post">
                    <div class="card-header">Stripe Payment Method</div>

                    <div class="card-body">
                        @foreach (['danger', 'warning', 'success', 'info','error'] as $message)
                            @if(session()->has( $message))
                                <div class="alert alert-{{ $message }}">{{ session()->get($message) }}</div>
                            @endif
                        @endforeach


                        @csrf
                        <div class="form-group">
                            <label>Card Holder Name</label>
                            <input class="form-control" size="4" type="text" name="card_holder_name"
                                   value="{{old('card_holder_name')}}">
                            @error('card_holder_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Card Number</label>
                            <input class="form-control" size="20" type="number" name="card_no"
                                   value="{{old('card_no')}}">
                            @error('card_no')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <div class="col-xs-12 col-md-4">
                                <label>CVC</label>
                                <input class="form-control" size="4" type="number" name="card_cvc"
                                       value="{{old('card_cvc')}}">
                                @error('card_cvc')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <label>Valid Month</label>
                                <input class="form-control" size="2" type="number" name="card_exp_month"
                                       value="{{old('card_exp_month')}}">
                                @error('card_exp_month')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <label>Valid Year</label>
                                <input class="form-control" size="4" type="number" name="card_exp_year"
                                       value="{{old('card_exp_year')}}">
                                @error('card_exp_year')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Amount</label>
                            <input class="form-control" size="4" type="number" name="amount" value="{{old('amount')}}">
                            @error('amount')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">Pay</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
