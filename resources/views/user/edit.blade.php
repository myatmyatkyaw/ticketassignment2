@extends('dashboard.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body align-users-center m-4">

                <h3 class="text-secondary mb-3"> Edit user </h3>

                <form action="{{route('user.update' , $user->id)}}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="col-auto">
                    <label  class="col-form-label">User Name<small class="text-danger">*</small></label>
                    <input type="text"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}">

                    @error('name')
                    <div class="text-danger">*{{$message}}</div>
                    @enderror

                </div>
                <div class="col-auto">
                    <label  class="col-form-label">Email</label><small class="text-danger">*</small></label>
                    <input type="email"  class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}">

                    @error('email')
                    <div class="text-danger">*{{$message}}</div>
                    @enderror

                </div>

                <div class="col-auto">
                    <label for="role">Select Role:</label>
                    <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                        <option value="1">Agent</option>
                        <option value="2" selected>User</option>

                    </select>

                    @error('role')
                        <div class="text-danger">*{{$message}}</div>
                    @enderror

                </div>

                <div class="col-auto">
                    <label  class="col-form-label">Password<small class="text-danger">*</small></label>
                    <input type="text"  class="form-control @error('password') is-invalid @enderror" name="password" value = "{{ decrypt($user->password ) }}">

                    @error('password')
                    <div class="text-danger">*{{$message}}</div>
                    @enderror

                </div>

                <div class="col-auto mt-3 mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="exampleCheck1" {{ optional($user->role)->is_checked ? 'checked' : '' }}>
                    <label class="form-check-label" for="exampleCheck1">Admin</label>
                </div>



                <div class="col-sm mt-3">
                <a href="{{ route('user.index') }}" class="btn btn-outline-dark">Back</a>
                <button type="submit" class="btn btn-outline-dark">Update</button>

                </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
