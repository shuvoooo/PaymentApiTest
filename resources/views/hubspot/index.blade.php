@extends('layout.app')

@section('title', 'HubSpot')


@section('content')
    <div class="container">
        @foreach (['danger', 'warning', 'success', 'info','error'] as $message)
            @if(session()->has( $message))
                <div class="alert alert-{{ $message }}">{{ session()->get($message) }}</div>
            @endif
        @endforeach

        <div class="">
            <a href="{{ route('hubspot.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i>
                Add Contact
            </a>

        </div>

        <table class="table table-bordered">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Company</th>
                <th>Action</th>
            </tr>

            @foreach($contacts as $contact)
                @php
                    $c =$contact->getProperties()
                @endphp
                <tr>
                    <td>{{ $c['firstname']??'' }}</td>
                    <td>{{ $c['lastname']??'' }}</td>
                    <td>{{ $c['email']??'' }}</td>
                    <td>{{ $c['phone']??'' }}</td>
                    <td>{{ $c['company']??'' }}</td>
                    <td>
                        <a href="{{ route('hubspot.edit', $c['hs_object_id']) }}"
                           class="btn btn-sm btn-primary">Edit</a>

                        <form action="{{ route('hubspot.destroy', $c['hs_object_id']) }}" method="post"
                              style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </table>
    </div>

@endsection
