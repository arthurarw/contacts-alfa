@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 mb-3 mt-3">
            <div class="float-left">
                <h2>Contact List - Alfa</h2>
            </div>
            <div class="float-end">
                <a class="btn btn-success" href="{{route('contacts.create')}}"> New Contact</a>
            </div>
        </div>
    </div>

    @if ($message = \Illuminate\Support\Facades\Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if (count($data) > 0)
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Email</th>
            <th width="280px">Actions</th>
        </tr>
        @foreach ($data as $value)
            <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->name}}</td>
                <td>{{$value->contact}}</td>
                <td>{{$value->email}}</td>
                <td>
                    ---
                </td>
            </tr>
        @endforeach
    </table>
    {!! $data->links() !!}
    @else
        <div class="alert alert-info" role="alert">
            <strong>Whoops!</strong> No contacts found.
        </div>
    @endif
@endsection
