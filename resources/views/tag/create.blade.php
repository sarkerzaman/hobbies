@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create New Tag</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('tag.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control{{ $errors->has('name')? ' border-danger' : '' }}" id="name" name="name" value="{{ old('name') }}">
                                <small class="form-text text-danger"><strong>{!! $errors->first('name') !!}</strong></small>
                            </div>
                            <div class="form-group">
                                <label for="style">Style</label>
                                <input type="text" class="form-control{{ $errors->has('style')? ' border-danger' : '' }}" id="style" name="style" value="{{ old('style') }}">
                                <small class="form-text text-danger"><strong>{!! $errors->first('style') !!}</strong></small>
                            </div>
                            <input class="btn btn-primary mt-4" type="submit" value="Save">
                            <a class="btn btn-primary float-right" href="{{ route('tag.index') }}"><i class="fas fa-arrow-circle-up"></i> Go Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
