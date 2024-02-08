@extends('dashboard.index')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body align-items-center m-4">
                    <h3 class="text-secondary mb-3"> Update Ticket </h3>

                    <form action="{{ route('ticket.update',$ticket->id)}}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="col-auto">
                            <label  class="col-form-label">Title<small class="text-danger">*</small></label>
                            <input type="text"  class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $ticket->title }}">

                            @error('title')
                            <div class="text-danger">*{{$message}}</div>
                            @enderror

                        </div>

                        <div class="col-auto">
                            <label  class="col-form-label">Message<small class="text-danger">*</small></label>
                            <textarea class="form-control @error('message') is-invalid @enderror" name="message" >{{ $ticket->message }}</textarea>

                            @error('message')
                            <div class="text-danger">*{{$message}}</div>
                            @enderror

                        </div>

                        <div class="col-auto">
                            <label for="priority">Priority</label>
                            <select name="priority" id="priority" class="form-control @error('priority') is-invalid @enderror" >
                                {{-- @foreach($users as $user) --}}
                                <option value="high" selected>HIGH</option>
                                <option value="low">LOW</option>
                                {{-- @endforeach --}}
                            </select>

                            @error('priority')
                                <div class="text-danger">*{{$message}}</div>
                            @enderror

                        </div>

                        <div class="mb-3 mt-2 col-auto">
                            <label for="role" class="form-label">Labels</label><br>
                            @foreach($labels as $label)
                                <input type="checkbox" value="{{ $label->id }}" name="label_id[]" {{ in_array($label->id, $existingLabels) ? 'checked' : '' }}>
                                <label for="label{{ $label->id }}">{{ $label->name }}</label><br>
                            @endforeach
                        </div>


                        <div class="mb-3 mt-2 col-auto">
                            <label for="role" class="form-label">Categories</label><br>
                            @foreach($categories as $category)
                                <input type="checkbox" value="{{ $category->id }}" name="category_id[]" {{ in_array($category->id, $existingCategories) ? 'checked' : '' }}>
                                <label for="label{{ $category->id }}">{{ $category->name }}</label><br>
                            @endforeach
                        </div>

                        <div class="col-auto">
                            <label class="col-form-label">Upload Image<small class="text-danger">*</small></label><br>
                            <img src="/storage/gallery/{{$ticket->file }}" alt="Image Name" width="40px" height="40px"/>
                            <input type="file"  class="form-control" name="files[]" multiple>

                            @error('file')
                            <div class="text-danger">*{{$message}}</div>
                            @enderror
                        </div>

                        <div class="col-auto">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                {{-- @foreach($users as $user) --}}
                                <option value="open" selected>open</option>
                                <option value="close">close</option>
                                {{-- @endforeach --}}
                            </select>

                            @error('status')
                                <div class="text-danger">*{{$message}}</div>
                            @enderror

                        </div>

                        @if(auth()->user()->role == '0')
                        <div class="col-auto">
                            <label for="agent_id">Select Agent To Assign:</label>
                            <select name="agent_id" id="status" class="form-control @error('agent_id') is-invalid @enderror">
                                @foreach($agents as $agent)
                                    <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                @endforeach
                            </select>

                            @error('agent_id')
                                <div class="text-danger">*{{$message}}</div>
                            @enderror
                        </div>
                        @endif
                        <input type="hidden" name="user_id" value="{{ Auth()->user()->id }}">

                        <div class="col-sm mt-3">
                        <a href="{{ route('ticket.index') }}" class="btn btn-outline-dark">Back</a>
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
