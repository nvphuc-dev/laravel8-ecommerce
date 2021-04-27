@extends('admin.admin_master')
@section('admin')
<div class="breadcrumb-wrapper d-flex justify-content-between align-items-center">
	<h1>Contact Page</h1>
	<a href="{{ route('add.contact') }}"><button class="btn btn-info">Add Contact</button></a>
</div>
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
			<div class="card-header">All Contact Data</div>
			<div class="card-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col" width="5%">#</th>
							<th scope="col" width="20%">Contact Email</th>
							<th scope="col" width="20%">Contact Phone</th>
							<th scope="col" width="30%">Contact Address</th>
							<th scope="col" width="10%">Create At</th>
							<th scope="col" width="15%">Action</th>
						</tr>
					</thead>
					<tbody>
						@php($i = 1)
						@foreach($contacts as $contact)
						<tr>
							<th scope="row">{{ $i++ }}</th>
							<td>{{ $contact->email }}</td>
							<td>{{ $contact->phone }}</td>
							<td>{{ $contact->address }}</td>
							<td>
								@if($contact->created_at == NULL)
								<span class="text-danger">No Date Set</span>
								@else
								{{ Carbon\Carbon::parse($contact->created_at)->diffForHumans() }}
								@endif
							</td>
							<td>
								<a href="{{ url('contact/edit/'.$contact->id) }}" class="btn btn-info">Edit</a>
								<a href="{{ url('contact/delete/'.$contact->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">Delete</a>
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
