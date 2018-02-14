@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-users"></i> User Management

                        <span class="pull-right">
                            <a href="" class="btn btn-xs btn-default">
                                <i class="fa fa-search"></i> Search user
                            </a>

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
                                        <th>Status:</th>
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection