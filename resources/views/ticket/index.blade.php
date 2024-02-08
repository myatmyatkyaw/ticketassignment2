@extends('dashboard.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body shadow">

                    <h3 class="text-secondary mb-3"> Ticket List </h3>

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('update'))
                    <div class="alert alert-primary alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        {{ session('update') }}
                    </div>
                    @endif

                    @if(session('delete'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        {{ session('delete') }}
                    </div>
                    @endif

                    <table class="table">

                        <thead class="table-dark">
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            {{-- <th scope="col">Message</th> --}}
                            <th scope="col">Priority</th>
                            <th scope="col">Status</th>
                            <th scope="col">Files</th>
                            {{-- <th scope="col">Label</th>
                            <th scope="col">Category</th> --}}
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($tickets as $ticket)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $ticket->title }}</td>
                                <td>{{ $ticket->priority }}</td>
                                <td>{{ $ticket->status }}</td>
                                <td> @foreach ($ticket->ticketFiles as $file)
                                    <img src="{{ asset('storage/gallery/'. $file->file_name) }}" alt="{{ $file->file_name }}" style="max-width: 50px; max-height: 50px;">
                                @endforeach</td>
                                
                                {{-- <td>{{ $ticket->label_id }}</td>
                                <td>{{ $ticket->category_id }}</td> --}}
                                {{-- <td>{{ $user->role  }}</td> --}}

                                {{-- <td> --}}
                                    @if (Auth::check() && (Auth::user()->role == '2' ))
                                    <td>
                                    <a href="{{ route('ticket.show', $ticket->id) }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-info"></i>
                                    </a>
                                    </td>
                                    @else
                                    <td>
                                    <a href="{{ route('ticket.edit', $ticket->id) }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-pencil-alt"></i>
                                      </a>
                                      <a href="{{ route('ticket.show', $ticket->id) }}" class="btn btn-outline-secondary">
                                          <i class="fas fa-info"></i>
                                      </a>
                                     <form method="post" action = "{{ route('ticket.destroy', $ticket->id) }}" class="d-inline-block">
                                      @method('delete')
                                      @csrf
                                      <button class="btn btn-outline-secondary" onclick="return confirm('Are you sure you want to delete?')"><i class="fas fa-trash-alt"></i></button>
                                     </form>
                                    </td>
                                    @endif
                                    {{-- <a href="{{ route('ticket.edit', $ticket->id) }}" class="btn btn-outline-secondary">
                                      <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="{{ route('ticket.show', $ticket->id) }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-info"></i>
                                    </a>
                                   <form method="post" action = "{{ route('ticket.destroy', $ticket->id) }}" class="d-inline-block">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-outline-secondary" onclick="return confirm('Are you sure you want to delete?')"><i class="fas fa-trash-alt"></i></button>
                                   </form> --}}
                                {{-- </td> --}}
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
