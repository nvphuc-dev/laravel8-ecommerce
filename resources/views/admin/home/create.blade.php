@extends('admin.admin_master')
@section('admin')
<div class="col-lg-12">
	<div class="card card-default">
		<div class="card-header card-header-border-bottom">
			<h2>Create Home About</h2>
		</div>
		<div class="card-body">
			<form action="{{ route('store.about') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<label for="bigTitle">Home About Big Title</label>
					<input type="text" class="form-control" id="bigTitle" name ="big_title" placeholder="Home About Big Title">
				</div>
				<div class="form-group">
					<label for="title">Home About Title</label>
					<input type="text" class="form-control" id="title" name ="title" placeholder="Home About Title">
				</div>
				<div class="form-group">
					<label for="shortDescription">Home About Short Description</label>
					<textarea class="form-control" id="shortDescription" name="short_discription" rows="5" placeholder="Home About Short Description"></textarea>
				</div>
				<div class="form-group">
					<label for="longDescription">Home About Long Description</label>
					<textarea class="form-control" id="longDescription" name="long_discription" rows="5" placeholder="Home About Long Description"></textarea>
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