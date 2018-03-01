<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-info-circle"></i> Profile information
    </div>
    
    <div class="panel-body">
        <form action="" method="POST" class="form-horizontal">
            {{ csrf_field() }}              {{-- form field protection --}}
            {{ method_field('PATCH') }}     {{-- method spoofing --}}     
            @form($login)                   {{-- Mount database data to the form --}} 

            <div class="form-group @error('name', 'has-error')">
                <label class="col-md-3 control-label">Username: <span class="text-danger">*</span></label>

                <div class="col-md-9">
                    <input type="text" class="form-control" @input('name') placeholder="Your username">
                    @error('name')
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Your name: <span class="text-danger">*</span></label>

                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Firstname">
                </div>

                <div class="col-md-5">
                    <input type="text" class="form-control" placeholder="Lastname">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Location: <span class="text-danger">*</span></label>

                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Name city">
                </div>
                
                <div class="col-md-5">
                    <select class="form-control" @input('country_id')>
                        <option value="">-- Select your country --</option>

                        @foreach ($countries as $country) 
                            <option value="{{ $country->id}}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group @error('email', 'has-error')">
                <label class="col-md-3 control-label">Your email address: <span class="text-danger">*</span></label>

                <div class="col-md-9">
                    <input type="email" class="form-control" @input('email') placeholder="Your email address">
                    @error('email')
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn btn-sm btn-success">
                        <i class="fa fa-check"></i> Update
                    </button>

                    <button type="reset" class="btn btn-sm btn-danger">
                        <i class="fa fa-undo"></i> Reset
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>