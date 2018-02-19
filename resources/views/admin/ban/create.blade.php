@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="text-danger fa fa-lock"></i> Ban an user in the system. 
                        User: <strong class="pull-right">{{ $dbUser->name }} ({{ $dbUser->email }})</strong>
                    </div>

                    <div class="panel-body">
                        <form method="POST" action="{{ route('admin.users.ban.create', $dbUser) }}" class="form-horizontal">
                            {{ csrf_field() }} {{-- Form field protection --}}
                        
                            <div class="form-group">
                                <label class="control-label col-md-3" for="user">
                                    Person that will be banned:
                                </label>

                                <div class="col-md-9">
                                    <input type="type" id="user" class="form-control" value="{{ $dbUser->name }}" disabled>
                                    <small class="help-block">
                                        <span class="text-danger">*</span> User ({{ $dbUser->name }}) will be banned for 2 weeks.
                                    </small>
                                </div>
                            </div>

                            <div class="form-group @error('reason', 'has-error')">
                                <label for="reason" class="control-label col-md-3">
                                    Reason: <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-9">
                                    <textarea @input('reason') placeholder="The reason why {{ $dbUser->name }} will be banned. This reason will ben mailed to the user." class="form-control" rows="8">{{ old('reason') }}</textarea>
                                    @error('reason') {{-- Error view partial --}}
                                </div>
                            </div>

                            <div class="form-group"> {{-- Reset and sumbit button group --}}
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fa fa-check"></i> Block user
                                    </button>

                                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-danger">
                                        <i class="fa fa-undo"></i> Annuleren
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