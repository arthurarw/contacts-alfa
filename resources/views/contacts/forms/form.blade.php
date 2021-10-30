@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 mt-3 mb-3">
            <div class="float-left">
                    <h2>
                        @if(isset($contact))
                            Update Contact {{$contact->name}}
                        @else
                            Add New Contact
                        @endif
                    </h2>
            </div>
            <div class="float-end">
                <a href="{{route('index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (isset($contact))
        <form action="{{ route('contacts.update', ['contact' => $contact]) }}" method="POST">
        @method('PUT')
    @else
        <form action="{{ route('contacts.store') }}" method="POST">
    @endif
        @csrf

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Your name" name="name" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="mb-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="tel" class="form-control" id="contact" placeholder="999999999" name="contact" required maxlength="9">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
