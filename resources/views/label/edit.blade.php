@extends('dashboard.index')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body align-items-center m-4">
                    <h3 class="text-secondary mb-3"> Edit Label </h3>

                    <form action="{{ route('label.update',$label->id) }}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="col-auto">
                            <label class="col-form-label">Label<small class="text-danger">*</small></label>
                            <input type="text"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $label->name }}">

                            @error('name')
                            <div class="text-danger">*{{$message}}</div>
                            @enderror

                        </div>
                        <div class="col-sm mt-3">
                        <a href="{{ route('label.index') }}" class="btn btn-outline-dark">Back</a>
                        <button type="submit" class="btn btn-outline-dark">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
@endsection
