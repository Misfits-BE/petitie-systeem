<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-info-circle"></i> Profile information
    </div>
    
    <div class="panel-body">
        <form action="" method="POST" class="form-horizontal">
            {{ csrf_field() }}              {{-- form field protection --}}
            {{ method_field('PATCH') }}     {{-- method spoofing --}}      

            <div class="form-group">
                <label class="col-md-3 control-label">
                    Username: <span class="text-danger">*</span>
                </label>

                <div class="col-md-9">
                    <input type="text" class="form-control" placeholder="Your username">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">
                    Your email address: <span class="text-danger">*</span>
                </label>

                <div class="col-md-9">
                    <input type="email" class="form-control" placeholder="Your email address">
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