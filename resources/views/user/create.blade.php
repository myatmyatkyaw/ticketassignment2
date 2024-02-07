@extends('dashboard.index')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body align-items-center m-4">
                    <h3 class="text-secondary mb-3"> Create User </h3>

                    <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="col-auto">
                            <label  class="col-form-label">Name<small class="text-danger">*</small></label>
                            <input type="text"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">

                            @error('name')
                            <div class="text-danger">*{{$message}}</div>
                            @enderror

                        </div>
                        <div class="col-auto">
                            <label  class="col-form-label">Email</label><small class="text-danger">*</small></label>
                            <input type="email"  class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">

                            @error('email')
                            <div class="text-danger">*{{$message}}</div>
                            @enderror

                        </div>

                        <div class="col-auto">
                            <label for="role">Select Role:</label>
                            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                                {{-- @foreach($users as $user) --}}
                                <option value="1">Agent</option>
                                <option value="2" selected>User</option>

                                {{-- @endforeach --}}
                            </select>

                            @error('role')
                                <div class="text-danger">*{{$message}}</div>
                            @enderror

                        </div>

                        <div class="col-auto">
                            <label  class="col-form-label">Password<small class="text-danger">*</small></label>
                            <input type="text"  class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}">

                            @error('password')
                            <div class="text-danger">*{{$message}}</div>
                            @enderror

                        </div>


                        <div class="col-sm mt-3">
                        <a href="{{ route('user.index') }}" class="btn btn-outline-dark">Back</a>
                        <button type="submit" class="btn btn-outline-dark">Create</button>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
@endsection
