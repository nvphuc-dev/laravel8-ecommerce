@extends('admin.admin_master')
@section('admin')
<div class="row">
    <div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Change Password</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" class="form-control"  id="current_password" name="old_password" placeholder="Current Password">
                    @error('old_password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="New Password">
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                    @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
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