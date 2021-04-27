@extends('admin.admin_master')
@section('admin')
<div class="row">
	<div class="col-md-12">
		@if(session('success'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>{{ session('success') }}</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		@endif
		<div class="card">
			<div class="card-header">Edit Brand</div>
			<div class="card-body">
				<form action="{{ url('brand/update/'.$brands->id) }}" method="POST" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="old_image" value="{{ $brands->brand_image }}">
					<div class="form-group">
						<label for="brandName">Update Brand Name</label>
						<input type="text" class="form-control" id="brandName" name="brand_name" value="{{ $brands->brand_name }}">
						@error('category_name')
						<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<div class="form-group">
						<label for="brandImage">Current Brand Image</label>
						<span style="display: block"><img src="{{ asset($brands->brand_image) }}" alt="" style="width: 70px; height: 40px; border: solid 1px #ddd; padding: 5px"></span>
					</div>
					<div class="form-group">
						<label for="brandImage">Update Brand Image</label>
						<input type="file" class="form-control" id="brandImage" name="brand_image" value="{{ $brands->brand_image }}">
						@error('brand_image')
						<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<button type="submit" class="btn btn-primary">Update Brand</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection