@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Update Hobby</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('hobby.update', $hobby->id) }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control{{ $errors->has('name')? ' border-danger' : '' }}" id="name" name="name" value="{{ old('name') ?? $hobby->name }}">
                                <small class="form-text text-danger"><strong>{!! $errors->first('name') !!}</strong></small>
                            </div>
                            <div class="form-group">
                                <label style="display:block" for="image">Image</label>
                                <input type="file" style="width: 200px; display:inline" class="form-control-file{{ $errors->has('image')? ' border-danger' : '' }}" id="image" name="image" value="">
                                @if (file_exists('img/hobbies/'. $hobby->id. '_thumb.jpg'))
                                    <img class="float-right" src="/img/hobbies/{{ $hobby->id }}_thumb.jpg" alt="Hobby Thumb">
                                @endif
                                <small class="form-text text-danger"><strong>{!! $errors->first('image') !!}</strong></small>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control{{ $errors->has('description')? ' border-danger' : '' }}" id="description" name="description" rows="5">{{ old('description') ?? $hobby->description }}</textarea>
                                <small class="form-text text-danger"><strong>{!! $errors->first('description') !!}</strong></small>
                            </div>
                            <input class="btn btn-primary mt-4" type="submit" value="Update Hobby">
                            <a class="btn btn-primary float-right" href="{{ route('hobby.index') }}"><i class="fas fa-arrow-circle-up"></i> Go Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
