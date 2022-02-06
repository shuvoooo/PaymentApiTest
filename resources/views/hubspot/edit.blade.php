<!DOCTYPE html>
<html>
<head>
    <title>Stripe Payment Operation</title>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
          integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form class="card" action="{{route('hubspot.update', $contact['hs_object_id'])}}" method="post">
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
                    @method('PUT')

                    <div class="form-group">
                        <label>First Name</label>
                        <input class="form-control" type="text" name="firstname"
                               value="{{old('firstname', $contact['firstname']??'')}}">
                        @error('firstname')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Last Name</label>
                        <input class="form-control" type="text" name="lastname"
                               value="{{old('lastname', $contact['lastname']??'')}}">
                        @error('lastname')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="text" name="email"
                               value="{{old('email', $contact['email']??'')}}">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label>Phone</label>
                        <input class="form-control" type="text" name="phone"
                               value="{{old('phone', $contact['phone']??'')}}">
                        @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label>Company</label>
                        <input class="form-control" type="text" name="company"
                               value="{{old('company', $contact['company']??'')}}">
                        @error('company')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">Update Contact</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
