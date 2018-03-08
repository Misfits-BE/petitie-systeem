<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-key"></i> Profile password
    </div>

    <div class="panel-body">
        <form method="POST" action="{{ route('account.settings.security') }}" class="form-horizontal">
            {{ csrf_field() }}          {{-- Form field protection --}}
            {{ method_field('PATCH') }} {{-- Method spoofing --}}

            <div class="form-group @error('password', 'has-error')">
                <label class="col-md-3 control-label">
                    New Password <span class="text-danger">*</span>
                </label>

                <div class="col-md-9">
                    <input type="password" placeholder="Your new password" @input('password') class="form-control">
                    @error('password')
                </div>
            </div>

            <div class="form-group @error('password_confirmation', 'has-error')">
                <label class="col-md-3 control-label">
                    Repeat password: <span class="text-danger">*</span>
                </label>

                <div class="col-md-9">
                    <input type="password" placeholder="Repeat your new password" @input('password_confirmation') class="form-control">
                    @error('password_information')
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn btn-sm btn-success">
                        <i class="fa fa-check"></i> Update
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>