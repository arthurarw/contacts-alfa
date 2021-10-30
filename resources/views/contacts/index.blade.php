@extends('layouts.template')

@section('content')
    <div class="row">
        <div class="col-lg-12 mb-3 mt-3">
            <div class="float-left">
                <h2>Contact List - Alfa</h2>
            </div>
            <div class="float-end">
                <a class="btn btn-success" href="{{route('contacts.create')}}"><i class="fas fa-plus-circle"></i> New Contact</a>
            </div>
        </div>
    </div>

    @if ($message = \Illuminate\Support\Facades\Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <strong>Whoops!</strong> We found some errors:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (count($data) > 0)
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Created At</th>
                <th width="280px">Actions</th>
            </tr>
            @foreach ($data as $value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->name}}</td>
                    <td>{{$value->contact}}</td>
                    <td>{{$value->email}}</td>
                    <td>{{$value->created_at}}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('contacts.show', $value->id) }}"><i class="fas fa-eye"></i> Show</a>
                        <a class="btn btn-primary" href="{{ route('contacts.edit', $value->id) }}"><i class="fas fa-pencil-alt"></i> Edit</a>

                        <a class="btn btn-danger buttonDelete" data-destroy="{{$value->id}}" id="buttonDelete"
                           href="{{route('contacts.destroy', $value->id)}}"><i class="fas fa-trash-alt"></i> Delete</a>
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

@section('js')
    <script>
        $(document).ready(function () {
            $(".buttonDelete").click(function (e) {
                e.preventDefault();

                let contactId = $(this).data('destroy');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'DELETE',
                            url: '{{url('/contacts/')}}/' + contactId,
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function (data) {
                                console.log(data);
                                if (data.success) {
                                    Swal.fire({
                                        title: 'Deleted',
                                        text: 'The contact has been deleted.',
                                        icon: 'success'
                                    }).then((result) => {
                                        location.reload();
                                    });
                                }
                            },
                            error: function (error) {
                                if (error.status === 401) {
                                    Swal.fire({
                                        title: 'Whoops!',
                                        text: 'Unauthorized!',
                                        icon: 'warning'
                                    }).then((result) => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Sorry!',
                                        text: 'Unknown error',
                                        icon: 'warning'
                                    }).then((result) => {
                                        location.reload();
                                    });
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
