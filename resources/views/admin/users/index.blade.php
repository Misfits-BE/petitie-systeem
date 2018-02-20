@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view partial --}}

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

                            <a href="{{ route('admin.users.create') }}" class="btn btn-xs btn-default">
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
                                    @foreach ($users as $login)
                                        <tr>
                                            <td><strong>#U{{ $user->id }}</strong></td>
                                            
                                            <td>
                                                @if ($login->hasRole('admin'))
                                                    <span class="label label-danger">Administrator</span>
                                                @elseif ($login->hasRole('user'))
                                                    <span class="label label-success">User</span>
                                                @endif
                                            </td>
                                            
                                            <td>{{ $login->name }}</td>
                                            <td></td> {{-- First and lastname from the user --}}
                                            <td><a href="mailto:{{ $login->email }}">{{ $login->email }}</a></td>
                                            <td>{{ $login->created_at->diffForHumans() }}</td>

                                            <td> {{-- Opties --}}
                                                <span class="pull-right">
                                                    <a href="" class="text-muted">
                                                        <i class="fa fa-fw fa-cogs"></i>
                                                    </a>

                                                    @if ($login->isNotBanned() && $user->can('ban-user', $login))
                                                        <a href="{{ route('admin.users.ban', $login) }}" class="text-danger">
                                                            <i class="fa fa-fw fa-lock"></i>
                                                        </a>
                                                    @elseif ($login->isBanned() && $user->can('revoke-ban-user', $login))
                                                        <a href="{{ route('admin.users.ban.revoke', $login) }}" class="text-danger">
                                                            <i class="fa fa-fw fa-unlock"></i>
                                                        </a>
                                                    @endif

                                                    <a href="{{ route('admin.users.delete', $login) }}" class="text-danger">
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