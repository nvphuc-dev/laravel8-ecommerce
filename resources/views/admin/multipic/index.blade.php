@extends('admin.admin_master')
@section('admin')
<div class="row">
    <div class="col-md-8">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="card">
            <div class="card-header">All Images</div>
            <div class="card-body">
                <div class="card-group">
                    <div class="row">
                        @foreach($images as $multi_img)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="{{ asset($multi_img->image) }}" alt="">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Multi Image</div>
            <div class="card-body">
                <form action="{{ route('store.image') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="image">Multi Image</label>
                        <input type="file" class="form-control" id="image" name="image[]" multiple="">
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Add Image</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection