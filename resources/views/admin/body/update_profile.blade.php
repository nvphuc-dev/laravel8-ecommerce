@extends('admin.admin_master')
@section('admin')
<div class="row">
    <div class="col-lg-12">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>User Profile Update</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('update.user.profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">User Name</label>
                        <input type="text" class="form-control"  id="name" name="name" placeholder="User Name" value="{{ $user['name'] }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control"  id="email" name="email" placeholder="Email" value="{{ $user['email'] }}">
                    </div>
                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Save</button>
                        <!-- <button type="submit" class="btn btn-secondary btn-default">Cancel</button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection