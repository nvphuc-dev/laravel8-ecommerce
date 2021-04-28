@extends('admin.admin_master')
@section('admin')
<div class="col-lg-12">
	<div class="card card-default">
		<div class="card-header card-header-border-bottom">
			<h2>View Contact Message</h2>
		</div>
		<div class="card-body">
			<form action="{{ url('update/contact/'.$contacts->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" id="email" name ="email" value="{{ $contacts->email }}">
				</div>
				<div class="form-group">
					<label for="phone">Phone Number</label>
					<input type="text" class="form-control" id="phone" name ="phone" value="{{ $contacts->phone }}">
				</div>
				<div class="form-group">
					<label for="address">Address</label>
					<textarea class="form-control" id="address" name="address" rows="5">{{ $contacts->address }}</textarea>
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