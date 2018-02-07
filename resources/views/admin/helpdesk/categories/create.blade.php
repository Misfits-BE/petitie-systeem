@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message')

        <div class="row">
            <div class="col-md-12">
                @include('shared.helpdesk.navigation')
            </div>

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-plus"></i> Create new helpdesk category
                    </div>

                    <div class="panel-body">
                        <form action="" method="POST" class="form-horizontal">
                            {{ csrf_field() }} {{-- Form field protection --}}

                            <div class="form-group">
                                <label class="control-label col-md-3">Category title <span class="text-danger">*</span></label>

                                <div class="col-md-9">
                                    <input type="text" placeholder="Category title" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Category color <span class="text-danger">*</span></label>

                                <div class="col-md-9">
                                    <input type="color" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Category description <span class="text-danger">*</span></label>

                                <div class="col-md-9">
                                    <textarea class="form-control" rows="5" placeholder="An short category description"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fa fa-check"></i> Create
                                    </button>

                                    <button type="reset" class="btn btn-sm btn-danger">
                                        <i class="fa fa-undo"></i> Reset
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                @include('shared.helpdesk.category-sidebar')
            </div>
        </div>
    </div>
@endsection