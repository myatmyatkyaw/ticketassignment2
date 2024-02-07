@extends('dashboard.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body shadow">

                    <h3 class="text-secondary mb-3"> Category List </h3>

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
                            <th scope="col">CategoryName</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($categories as $category)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $category->name }}</td>

                                <td>
                                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-outline-secondary">
                                      <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    {{-- <a href="{{ route('label.show', $label->id) }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-info"></i>
                                    </a> --}}
                                   <form method="post" action = "{{ route('category.destroy', $category->id) }}" class="d-inline-block">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-outline-secondary" onclick="return confirm('Are you sure you want to delete?')"><i class="fas fa-trash-alt"></i></button>
                                   </form>
                                </td>
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
