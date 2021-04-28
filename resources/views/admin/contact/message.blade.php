@extends('admin.admin_master')
@section('admin')
<div class="breadcrumb-wrapper d-flex justify-content-between align-items-center">
	<h1>Contact Message</h1>
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
			<div class="card-header">All Contact Message</div>
			<div class="card-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col" width="5%">#</th>
							<th scope="col" width="20%">Name</th>
							<th scope="col" width="20%">Email</th>
							<th scope="col" width="30%">Subject</th>
							<th scope="col" width="10%">Create At</th>
							<th scope="col" width="15%">Action</th>
						</tr>
					</thead>
					<tbody>
						@php($i = 1)
						@foreach($messages as $message)
						<tr>
							<th scope="row">{{ $i++ }}</th>
							<td>{{ $message->name }}</td>
							<td>{{ $message->email }}</td>
							<td>{{ $message->subject }}</td>
							<td>
								@if($message->created_at == NULL)
								<span class="text-danger">No Date Set</span>
								@else
								{{ Carbon\Carbon::parse($message->created_at)->diffForHumans() }}
								@endif
							</td>
							<td>
								<a href="{{ url('contact/viewmsg/'.$message->id) }}" class="btn btn-info">View</a>
								<a href="{{ url('message/delete/'.$message->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">Delete</a>
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
