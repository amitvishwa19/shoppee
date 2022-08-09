<div class="card">
    <div class="card-header">
        <h4 class="card-title">Password Management</h4>
    </div><!--end card-header-->
    <div class="card-body"> 

    <form action="{{route('setting.store',['type'=>'password'])}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label class=""><b>Current Password</b></label>
            <div class="">
                <input class="form-control" type="password" placeholder="Password" name="current_password">
                @if ($errors->has('current_password'))
                    <span class="help-block">
                        <small class="badge badge-secondary">{{ $errors->first('current_password') }}</small>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label class=""><b>New Password</b></label>
            <div class="">
                <input class="form-control" type="password" placeholder="New Password" name="new_password">
                @if ($errors->has('new_password'))
                    <span class="help-block">
                        <small class="badge badge-secondary">{{ $errors->first('new_password') }}</small>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label class=""><b>Confirm Password</b></label>
            <div class="">
                <input class="form-control" type="password" placeholder="Re-Password" name="confirm_password">
                @if ($errors->has('confirm_password'))
                    <span class="help-block">
                        <small class="badge badge-secondary">{{ $errors->first('confirm_password') }}</small>
                    </span>
                @endif
                <span class="form-text text-muted font-12">Never share your password.</span>
            </div>
        </div>

            <button type="submit" class="btn btn-info waves-effect waves-light btn-sm">Change Password</button>
    </form>

    </div>
</div>


