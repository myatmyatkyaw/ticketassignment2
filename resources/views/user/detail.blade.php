@extends('dashboard.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body shadow">

                    <h3 class="text-secondary mb-3"> User Information </h3>

                    <table class="table">

                        <thead class="table-dark">
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>

                          </tr>
                        </thead>
                        <tbody>


                            <tr>
                                <th scope="row">{{ 1 }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                            </tr>


                        </tbody>
                    </table>
                    <div class="col-sm mt-3">
                        <a href="{{ route('ticket.index') }}" class="btn btn-outline-dark">Back</a>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
