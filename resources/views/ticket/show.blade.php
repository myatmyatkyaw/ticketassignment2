@extends('dashboard.index')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body shadow">
                    <h3 class="text-dark mb-3"> Ticket Detail </h3>
                    <table class="table">
                        <thead class="table-primary">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Message</th>
                            <th scope="col">Priority</th>
                            <th scope="col">Status</th>
                            <th scope="col">File</th>
                            <th scope="col">Category</th>
                            <th scope="col">Label</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>{{ $ticket->title }}</td>
                                <td>{{ $ticket->message }}</td>
                                <td>{{ $ticket->priority }}</td>
                                <td>{{ $ticket->status }}</td>
                                <td> <img src="{{ asset('storage/gallery/'. $ticket->file) }}" alt="{{ $ticket->name }}" style="max-width: 50px; max-height: 50px;" ></td>
                                <td>
                                  @foreach($ticket->category as $category)
                                        {{ $category->name }}
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($ticket->label as $label)
                                          {{ $label->name }}
                                      @endforeach
                                  </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mb-4">
                        <a href="{{ route('ticket.index') }}" class="btn btn-outline-dark">Back</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body shadow">
                            <form class="row g-2" action="{{ route('comment.store') }}" method="post">
                                @csrf
                                <div class="col-auto">
                                  <label for="inputtext" class="">Comment</label>
                                  <input type="text" class="form-control mb-3" id="inputtext" placeholder="Add comment" name="message">
                                  <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                  <button type="submit" class="btn btn-primary">Send</button>
                                  </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        @foreach($ticket->comment as $comment)
                        <div class="card-body shadow">
                            <div class="row justify-content-around">
                                <div class="col-auto">
                                    <h5 class="card-title">{{ $comment->user->name}}</h5>
                                    <p class="card-text">{{ $comment->message }}</p>
                                </div>
                                <div class="col-auto">
                                    <form method="post" action = "{{ route('comment.destroy', $comment->id) }}" class="d-inline-block">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete?')"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
