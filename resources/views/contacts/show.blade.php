@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 mt-3 mb-3">
            <div class="float-left">
                <h2>
                    Show Contact: {{$contact->name}}
                </h2>
            </div>
            <div class="float-end">
                <a href="{{route('index')}}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="mb-3">
                <strong>Name:</strong> {{$contact->name}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="mb-3">
                <strong>Contact:</strong> {{$contact->contact}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="mb-3">
                <strong>E-mail:</strong> {{$contact->email}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <a class="btn btn-primary" href="{{ route('contacts.edit', $contact->id) }}"><i
                    class="fas fa-pencil-alt"></i>
                Edit</a>

            <a class="btn btn-danger buttonDelete" data-destroy="{{$contact->id}}" id="buttonDelete"
               href="{{route('contacts.destroy', $contact->id)}}"><i class="fas fa-trash-alt"></i> Delete</a>
        </div>
    </div>
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
                                        window.location.href = "{{route('contacts.index')}}";
                                    });
                                }
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
