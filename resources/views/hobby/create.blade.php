@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create New Hobby</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('hobby.store') }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control{{ $errors->has('name')? ' border-danger' : '' }}" id="name" name="name" value="{{ old('name') }}">
                                <small class="form-text text-danger"><strong>{!! $errors->first('name') !!}</strong></small>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control{{ $errors->has('image')? ' border-danger' : '' }}" id="image" name="image" value="">
                                <small class="form-text text-danger"><strong>{!! $errors->first('image') !!}</strong></small>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control{{ $errors->has('description')? ' border-danger' : '' }}" id="description" name="description" rows="5">{{ old('description') }}</textarea>
                                <small class="form-text text-danger"><strong>{!! $errors->first('description') !!}</strong></small>
                            </div>
                            <input class="btn btn-primary mt-4" type="submit" value="Save">
                            <a class="btn btn-primary float-right" href="{{ route('hobby.index') }}"><i class="fas fa-arrow-circle-up"></i> Go Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
