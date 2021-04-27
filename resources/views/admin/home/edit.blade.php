@extends('admin.admin_master')
@section('admin')
<div class="col-lg-12">
	<div class="card card-default">
		<div class="card-header card-header-border-bottom">
			<h2>Edit Home About</h2>
		</div>
		<div class="card-body">
			<form action="{{ url('update/homeabout/'.$homeabout->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<label for="bigTitle">Home About Big Title</label>
					<input type="text" class="form-control" id="bigTitle" name ="big_title" value="{{ $homeabout->big_title }}">
				</div>
				<div class="form-group">
					<label for="title">Home About Title</label>
					<input type="text" class="form-control" id="title" name ="title" value="{{ $homeabout->title }}">
				</div>
				<div class="form-group">
					<label for="shortDescription">Home About Short Description</label>
					<textarea class="form-control" id="shortDescription" name="short_discription" rows="5">{{ $homeabout->short_discription }}</textarea>
				</div>
				<div class="form-group">
					<label for="longDescription">Home About Long Description</label>
					<textarea class="form-control" id="longDescription" name="long_discription" rows="5">{{ $homeabout->long_discription }}</textarea>
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