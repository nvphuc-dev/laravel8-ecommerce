@extends('admin.admin_master')
@section('admin')
<div class="breadcrumb-wrapper d-flex justify-content-between align-items-center">
	<h1>Home About</h1>
	<a href="{{ route('add.about') }}"><button class="btn btn-info">Add About</button></a>
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
			<div class="card-header">All About Data</div>
			<div class="card-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col" width="5%">SL No</th>
							<th scope="col" width="20%">About Big Title</th>
							<th scope="col" width="20%">About Title</th>
							<th scope="col" width="30%">About Short Description</th>
							<th scope="col" width="10%">Create At</th>
							<th scope="col" width="15%">Action</th>
						</tr>
					</thead>
					<tbody>
						@php($i = 1)
						@foreach($homeabout as $about)
						<tr>
							<th scope="row">{{ $i++ }}</th>
							<td>{{ $about->big_title }}</td>
							<td>{{ $about->title }}</td>
							<td>{{ $about->short_discription }}</td>
							<td>
								@if($about->created_at == NULL)
								<span class="text-danger">No Date Set</span>
								@else
								{{ Carbon\Carbon::parse($about->created_at)->diffForHumans() }}
								@endif
							</td>
							<td>
								<a href="{{ url('about/edit/'.$about->id) }}" class="btn btn-info">Edit</a>
								<a href="{{ url('about/delete/'.$about->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">Delete</a>
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
