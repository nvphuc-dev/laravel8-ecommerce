@extends('admin.admin_master')
@section('admin')
<div class="breadcrumb-wrapper d-flex justify-content-between align-items-center">
	<h1>Home Slider</h1>
	<a href="{{ route('add.slider') }}"><button class="btn btn-info">Add Slider</button></a>
</div>
<div class="row">
	<div class="col-md-12">
		<!-- @if(session('success'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>{{ session('success') }}</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		@endif -->
		<div class="card">
			<div class="card-header">All Slider</div>
			<div class="card-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col" width="5%">SL No</th>
							<th scope="col" width="20%">Slider Title</th>
							<th scope="col" width="40%">Slider Description</th>
							<th scope="col" width="10%">Image</th>
							<th scope="col" width="10%">Create At</th>
							<th scope="col" width="15%">Action</th>
						</tr>
					</thead>
					<tbody>
						@php($i = 1)
						@foreach($sliders as $slider)
						<tr>
							<th scope="row">{{ $i++ }}</th>
							<td>{{ $slider->title }}</td>
							<td>{{ $slider->description }}</td>
							<td><img src="{{ asset($slider->image) }}" alt="" style="height:40px; width: 70px"></td>
							<td>
								@if($slider->created_at == NULL)
								<span class="text-danger">No Date Set</span>
								@else
								{{ Carbon\Carbon::parse($slider->created_at)->diffForHumans() }}
								@endif
							</td>
							<td>
								<a href="{{ url('slider/edit/'.$slider->id) }}" class="btn btn-info">Edit</a>
								<a href="{{ url('slider/delete/'.$slider->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">Delete</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Trash Part -->
@endsection
