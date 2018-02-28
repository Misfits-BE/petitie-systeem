@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-plus"></i> Add new user in the application
                    </div>

                    <div class="panel-body">
                        <form method="POST" action="" class="form-horizontal">
                            {{ csrf_field() }} {{-- Form field protection --}}

                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    Username <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-7">
                                    <input type="text" placeholder="The username" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    Person name <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-3">
                                    <input type="text" class="form-control" placeholder="Firstname">
                                </div>

                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Lastname">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    Email address <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-7">
                                    <input type="text" class="form-control" placeholder="Account e-mail address">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    Access role <span class="text-danger">*</span>
                                </label>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-3 col-md-7">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fa fa-check"></i> Create user
                                    </button>

                                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-danger">
                                        <i class="fa fa-undo"></i> Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection