@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Update Profile</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control{{ $errors->has('name')? ' border-danger' : '' }}" id="name" name="name" value="{{ old('name') ?? $user->name }}">
                                <small class="form-text text-danger"><strong>{!! $errors->first('name') !!}</strong></small>
                            </div>
                            <div class="form-group">
                                <label for="motto">Motto</label>
                                <textarea class="form-control{{ $errors->has('motto')? ' border-danger' : '' }}" id="motto" name="motto" rows="3">{{ old('motto') ?? $user->motto }}</textarea>
                                <small class="form-text text-danger"><strong>{!! $errors->first('motto') !!}</strong></small>
                            </div>
                            <div class="form-group">
                                <label style="display:block" for="image">Profile Photo</label>
                                <input type="file" style="width: 200px; display:inline" class="form-control-file{{ $errors->has('image')? ' border-danger' : '' }}" id="image" name="image" value="">
                                @if (file_exists('img/users/'. $user->id. '_thumb.jpg'))
                                    <img class="float-right" src="/img/users/{{ $user->id }}_thumb.jpg" alt="user Thumb">
                                @endif
                                <small class="form-text text-danger"><strong>{!! $errors->first('image') !!}</strong></small>
                            </div>
                            <div class="form-group">
                                <label for="about_me">About Me</label>
                                <textarea class="form-control{{ $errors->has('about_me')? ' border-danger' : '' }}" id="about_me" name="about_me" rows="5">{{ old('about_me') ?? $user->about_me }}</textarea>
                                <small class="form-text text-danger"><strong>{!! $errors->first('about_me') !!}</strong></small>
                            </div>
                            <input class="btn btn-primary mt-4" type="submit" value="Update Profile">
                            <a class="btn btn-primary float-right" href="{{ route('user.index') }}"><i class="fas fa-arrow-circle-up"></i> Go Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
