@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-users"></i> User Management

                        <span class="pull-right">
                            @if (count($users) > 10)
                                <a href="" class="btn btn-xs btn-default">
                                    <i class="fa fa-search"></i> Search user
                                </a> 
                            @endif

                            <a href="" class="btn btn-xs btn-default">
                                <i class="fa fa-user-plus"></i> Add user
                            </a>
                        </span>
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Role:</th>
                                        <th>Username:</th>
                                        <th>Name:</th>
                                        <th>Email:</th>
                                        <th colspan="2">Created on:</th> {{-- Colspan="2" needed for the functions --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td><strong>#U{{ $user->id }}</strong></td>
                                            
                                            <td>
                                                @if ($user->hasRole('admin'))
                                                    <span class="label label-danger">Administrator</span>
                                                @elseif ($user->hasRole('user'))
                                                    <span class="label label-success">User</span>
                                                @endif
                                            </td>
                                            
                                            <td>{{ $user->name }}</td>
                                            <td></td> {{-- First and lastname from the user --}}
                                            <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                            <td>{{ $user->created_at->diffForHumans() }}</td>

                                            <td> {{-- Opties --}}
                                                <span class="pull-right">
                                                    <a href="" class="text-muted">
                                                        <i class="fa fa-fw fa-cogs"></i>
                                                    </a> 
                                                
                                                    <a href="{{ route('admin.users.ban', $user) }}" class="text-danger">
                                                        <i class="fa fa-fw fa-lock"></i>
                                                    </a>

                                                    <a href="{{ route('admin.users.delete', $user) }}" class="text-danger">
                                                        <i class="fa fa-fw fa-close"></i>
                                                    </a>
                                                </span>
                                            </td> {{-- /Opties --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{ $users->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection