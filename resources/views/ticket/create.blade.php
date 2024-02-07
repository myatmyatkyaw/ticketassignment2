@extends('dashboard.index')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body align-items-center m-4">
                        <h3 class="text-secondary mb-3"> Create Ticket </h3>

                        <form action="{{ route('ticket.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="col-auto">
                                <label class="col-form-label">Title<small class="text-danger">*</small></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" value="{{ old('title') }}">

                                @error('title')
                                    <div class="text-danger">*{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="col-auto">
                                <label class="col-form-label">Message<small class="text-danger">*</small></label>
                                <textarea class="form-control @error('message') is-invalid @enderror" name="message" value="{{ old('message') }}"></textarea>

                                @error('message')
                                    <div class="text-danger">*{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="col-auto">
                                <label for="priority">Priority</label>
                                <select name="priority" id="priority"
                                    class="form-control @error('priority') is-invalid @enderror">
                                    {{-- @foreach ($users as $user) --}}
                                    <option value="high" selected>HIGH</option>
                                    <option value="low">LOW</option>
                                    {{-- @endforeach --}}
                                </select>

                                @error('priority')
                                    <div class="text-danger">*{{ $message }}</div>
                                @enderror
                            </div>



                            {{-- <div class="col-auto">
                            <label for="label_id">Labels</label>
                            <select class="form-control" name="label_id" id="label_id">
                                @foreach ($labels as $label)
                                    <option name="label_id" value="{{ $label->id }}">{{ $label->name }}</option>
                                @endforeach
                            </select>

                            @error('label_id')
                                <div class="text-danger">*{{$message}}</div>
                            @enderror
                        </div> --}}
<<<<<<< HEAD
{{--
                            <div class="col-auto mt-3 mb-3 form-check">

                                <label class="form-check-label" for="Check1">Labels</label>

                                    @foreach ($labels as $label)
                                        <div class="col-auto mt-3 mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="Check{{ $label->label_id }}"
                                                name="Check{{ $label->label_id }}" value="{{ $label->label_id }}">
                                            <label class="form-check-label"
                                                for="Check{{ $label->label_id }}">{{ $label->name }}</label>
                                        </div>
                                    @endforeach
                            </div> --}}
                            <div class="mb-3 mt-2 col-auto">
                                <label for="role" class="form-label">Labels</label><br>
                                @foreach($labels as $label)
                                    <input type="checkbox" value="{{ $label->id }}" name="label_id[]">
                                    <label for="label{{ $label->id }}">{{ $label->name }}</label><br>
                                @endforeach
                            </div>

                            <div class="mb-3 mt-2 col-auto">
                                <label for="role" class="form-label">Categories</label><br>
                                @foreach($categories as $category)
                                    <input type="checkbox" value="{{ $category->id }}" name="category_id[]">
                                    <label for="label{{ $category->id }}">{{ $category->name }}</label><br>
                                @endforeach
                            </div>

                            <div class="col-auto">
                                <label class="col-form-label">Upload Image<small class="text-danger">*</small></label>
                                <input type="file"  class="form-control" name="file">

                                @error('file')
                                <div class="text-danger">*{{$message}}</div>
                                @enderror

                            </div>


                            {{-- <div class="mt-4">
                            <x-input-label for="labels" :value="__('Labels')" />
                                @foreach ($labels as $id => $name)
                                    <div class="mt-1 inline-flex space-x-1">
                                        <input class="text-purple-600 form-checkbox focus:shadow-outline-purple focus:border-purple-400 focus:outline-none"
                                               type="checkbox" name="labels[]" id="label-{{ $id }}" value="{{ $id }}"
                                                @checked(in_array($id, old('labels', [])))>
                                        <x-input-label for="label-{{ $id }}">{{ $name }}</x-input-label>
                                    </div>
                                @endforeach
                            <x-input-error :messages="$errors->get('labels')" class="mt-2" />
                        </div> --}}

                        {{-- <div class="col-auto mt-3 mb-3 form-check">

                            <label class="form-check-label" for="Check">Categories</label>

                                @foreach ($categories as $category)
                                    <span class="col-auto mt-3 mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Check{{ $category->category_id }}"
                                            name="Check{{ $category->category_id }}" value="{{ $category->category_id }}">
                                        <label class="form-check-label"
                                            for="Check{{ $category->category_id }}">{{ $category->name }}</label>
                                    </span>
                                @endforeach
                        </div> --}}

                            {{-- <div class="col-auto">
                                <label for="category_id">Categories</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    @foreach ($categories as $category)
                                        <option name="category_id" value="{{ $category->id }}">{{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('category_id')
                                    <div class="text-danger">*{{ $message }}</div>
                                @enderror

                            </div> --}}

=======

                            <div class="col-auto mt-3 mb-3 form-check">
                                {{-- <input type="checkbox" class="form-check-input" id="Check1" name="Check1"> --}}
                                <label class="form-check-label" for="Check1">Labels</label>
                                    {{-- @foreach ($labels as $label)
                                <option name="Check1" value="{{ $label->id }}">{{ $label->name }}</option>
                            @endforeach</label> --}}
                                    @foreach ($labels as $label)
                                        <div class="col-auto mt-3 mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="Check{{ $label->id }}"
                                                name="Check{{ $label->id }}" value="{{ $label->id }}">
                                            <label class="form-check-label"
                                                for="Check{{ $label->id }}">{{ $label->name }}</label>
                                        </div>
                                    @endforeach
                            </div>

                            {{-- <div class="mt-4">
                            <x-input-label for="labels" :value="__('Labels')" />
                                @foreach ($labels as $id => $name)
                                    <div class="mt-1 inline-flex space-x-1">
                                        <input class="text-purple-600 form-checkbox focus:shadow-outline-purple focus:border-purple-400 focus:outline-none"
                                               type="checkbox" name="labels[]" id="label-{{ $id }}" value="{{ $id }}"
                                                @checked(in_array($id, old('labels', [])))>
                                        <x-input-label for="label-{{ $id }}">{{ $name }}</x-input-label>
                                    </div>
                                @endforeach
                            <x-input-error :messages="$errors->get('labels')" class="mt-2" />
                        </div> --}}

                        <div class="col-auto mt-3 mb-3 form-check">
                            {{-- <input type="checkbox" class="form-check-input" id="Check1" name="Check1"> --}}
                            <label class="form-check-label" for="Check1">Categories</label>
                                {{-- @foreach ($labels as $label)
                            <option name="Check1" value="{{ $label->id }}">{{ $label->name }}</option>
                        @endforeach</label> --}}
                                @foreach ($categories as $category)
                                    <div class="col-auto mt-3 mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Check{{ $category->category_id }}"
                                            name="Check{{ $category->category_id }}" value="{{ $category->category_id }}">
                                        <label class="form-check-label"
                                            for="Check{{ $category->category_id }}">{{ $category->name }}</label>
                                    </div>
                                @endforeach
                        </div>
                            {{-- <div class="col-auto">
                                <label for="category_id">Categories</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    @foreach ($categories as $category)
                                        <option name="category_id" value="{{ $category->id }}">{{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('category_id')
                                    <div class="text-danger">*{{ $message }}</div>
                                @enderror

                            </div> --}}

>>>>>>> 4f6e6fb0aba077bf7c03627090d7dc4c36d33b3c
                            <div class="col-auto">
                                <label for="status">Status</label>
                                <select name="status" id="status"
                                    class="form-control @error('status') is-invalid @enderror">
                                    {{-- @foreach ($users as $user) --}}
                                    <option value="open" selected>open</option>
                                    <option value="close">close</option>
                                    {{-- @endforeach --}}
                                </select>

                                @error('status')
                                    <div class="text-danger">*{{ $message }}</div>
                                @enderror

                            </div>



                            <div class="col-sm mt-3">
                                <a href="{{ route('ticket.index') }}" class="btn btn-outline-dark">Back</a>
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
