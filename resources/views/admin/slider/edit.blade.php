@extends('admin.admin_master')
@section('admin')
<div class="row">
	<div class="col-md-12">
		<!-- Alert with bootstrap -> Notification-->
		<!-- @if(session('success'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>{{ session('success') }}</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		@endif -->
		<div class="card">
			<div class="card-header">Edit Slider</div>
			<div class="card-body">
				<form action="{{ url('slider/update/'.$sliders->id) }}" method="POST" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="old_image" value="{{ $sliders->image }}">
					<div class="form-group">
						<label for="title">Update Slider Title</label>
						<input type="text" class="form-control" id="title" name="title" value="{{ $sliders->title }}">
						@error('name')
						<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<div class="form-group">
						<label for="description">Update Slider Description</label>
						<textarea class="form-control" id="description" name="description" rows="5">{{ $sliders->description }}</textarea>
					</div>
					<div class="form-group">
						<label for="link">Update Slider Link</label>
						<input type="text" class="form-control" id="link" name ="link" placeholder="Slider Link" value="{{ $sliders->link }}">
					</div>
					<div class="form-group">
						<label for="text_button">Update Slider Text Button</label>
						<input type="text" class="form-control" id="text_button" name ="text_button" placeholder="Slider Text Button" value="{{ $sliders->text_button }}">
					</div>
					<div class="form-group">
						<label for="image">Current Slider Image</label>
						<span style="display: block"><img src="{{ asset($sliders->image) }}" alt="" style="width: 70px; height: 40px; border: solid 1px #ddd; padding: 5px"></span>
					</div>
					<div class="form-group">
						<label for="image">Update Slider Image</label>
						<input type="file" class="form-control" id="image" name="image" value="{{ $sliders->image }}">
						@error('brand_image')
						<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<div class="form-footer pt-4 pt-5 mt-4 border-top">
					<button type="submit" class="btn btn-primary">Update Slider</button>
						<a href="{{ url('slider/delete/'.$sliders->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-secondary btn-danger">Delete</a>
					</div>
					
				</form>
			</div>
		</div>
	</div>
</div>
@endsection