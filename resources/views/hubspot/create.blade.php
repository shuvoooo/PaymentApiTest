@extends('layout.app')

@section('title', 'HubSpot | Create Contact')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form class="card" action="{{route('hubspot.store')}}" method="post">
                    <div class="card-header">
                        Create Contact

                        <div class="card-actions">
                            <a href="{{route('hubspot.index')}}">
                                view all contacts
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        @foreach (['danger', 'warning', 'success', 'info','error'] as $message)
                            @if(session()->has( $message))
                                <div class="alert alert-{{ $message }}">{{ session()->get($message) }}</div>
                            @endif
                        @endforeach

                        @csrf

                        <div class="form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" name="firstname" value="{{old('firstname')}}">
                            @error('firstname')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" name="lastname" value="{{old('lastname')}}">
                            @error('lastname')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="text" name="email" value="{{old('email')}}">
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" type="text" name="phone" value="{{old('phone')}}">
                            @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label>Company</label>
                            <input class="form-control" type="text" name="company" value="{{old('company')}}">
                            @error('company')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">Add Contact</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
