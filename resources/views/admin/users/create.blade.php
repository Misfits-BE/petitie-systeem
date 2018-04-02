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
                        <form method="POST" action="{{ route('admin.users.store') }}" class="form-horizontal">
                            {{ csrf_field() }} {{-- Form field protection --}}

                            <div class="form-group @error('name', 'has-error')">
                                <label class="control-label col-md-3">
                                    Username <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-7">
                                    <input type="text" placeholder="The username" @input('name') class="form-control">
                                    @error('name')
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    Person name <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-3 @error('firstname', 'has-error')">
                                    <input type="text" class="form-control" @input('firstname') placeholder="Firstname">
                                </div>

                                <div class="col-md-4 @error('lastname', 'has-error')">
                                    <input type="text" class="form-control" @input('lastname') placeholder="Lastname">
                                </div>
                            </div>

                            <div class="form-group @error('email', 'has-error')">
                                <label class="control-label col-md-3">
                                    Email address <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-7">
                                    <input type="text" class="form-control" @input('email') placeholder="Account e-mail address">
                                    @error('email')
                                </div>
                            </div>

                            <div class="form-group @error('role', 'has-error')">
                                <label class="control-label col-md-3">
                                    Access role <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-7 @error('role', 'has-error')">
                                    <select @input('role') class="form-control">
                                        <option value="">-- Select user access role --</option>

                                        @foreach ($roles as $role) {{-- Loop trough the user access role --}}
                                            <option value="{{ $role->name }}"> {{ ucfirst($role->name) }} </option>
                                        @endforeach {{-- // END loop--}}
                                    </select>

                                     @error('role')
                                </div>
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