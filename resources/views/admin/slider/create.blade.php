@extends('admin.admin_master')
@section('admin')
<div class="col-lg-12">
	<div class="card card-default">
		<div class="card-header card-header-border-bottom">
			<h2>Create Slider</h2>
		</div>
		<div class="card-body">
			<form action="{{ route('store.slider') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<label for="title">Slider Title</label>
					<input type="text" class="form-control" id="title" name ="title" placeholder="Slider Title">
				</div>
				<div class="form-group">
					<label for="description">Slider Description</label>
					<textarea class="form-control" id="description" name="description" rows="5"></textarea>
				</div>
				<div class="form-group">
					<label for="link">Slider Link</label>
					<input type="text" class="form-control" id="link" name ="link" placeholder="Slider Link">
				</div>
				<div class="form-group">
					<label for="text_button">Slider Text Button</label>
					<input type="text" class="form-control" id="text_button" name ="text_button" placeholder="Slider Text Button">
				</div>
				<div class="form-group">
					<label for="image">Slider Image</label>
					<input type="file" class="form-control-file" id="image" name="image">
				</div>
				<div class="form-footer pt-4 pt-5 mt-4 border-top">
					<button type="submit" class="btn btn-primary btn-default">Submit</button>
					<!-- <button type="submit" class="btn btn-secondary btn-default">Cancel</button> -->
				</div>
			</form>
		</div>
	</div>
</div>
@endsection