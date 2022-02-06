@extends('layout.app')




@section('content')
    <a href="{{route('stripe')}}" class="btn btn-primary">Stripe Payment Gateway</a>

    <a href="{{route('hubspot.index')}}" class="btn btn-success">Hubspot Contact</a>
@endsection
