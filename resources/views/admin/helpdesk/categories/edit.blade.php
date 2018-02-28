@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view partial --}}

        <div class="col-md-12"> {{-- Helpdesk navigation --}}
            @include('shared.helpdesk.navigation')
        </div> {{-- /// End helpdesk navigation --}}

        <div class="col-md-9"> {{-- content --}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-pencil"></i> Wijzig categorie: <strong>{{ $category->name }}</strong>
                </div>
            
                <div class="panel-body">
                    <form method="" action="POST" class="form-horizontal">
                        {{ csrf_field() }} {{-- Form field protection --}}
                        @form($category)   {{-- Bind the data from the database to the form --}}

                        <div class="form-group @error('name', 'has-error')">
                            <label class="control-label col-md-3">Category title <span class="text-danger">*</span></label>

                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Category title" @input('name')>
                                @error('name')
                            </div>
                        </div>

                        <div class="form-group @error('color', 'has-error')">
                            <label class="control-label col-md-3">Category color <span class="text-danger">*</span></label>

                            <div class="col-md-9">
                                <input type="color" @input('color') class="form-control">
                                @error('color')
                            </div>
                        </div>

                        <div class="form-group @error('description', 'has-error')">
                            <label class="control-label col-md-3">Category description <span class="text-danger">*</span></label>

                            <div class="col-md-9">
                                <textarea class="form-control" rows="5" @input('description') placeholder="A short category description">{{ $category->description }}</textarea>
                                @error('description')
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fa fa-check"></i> Save
                                </button>

                                <a href="" class="btn btn-sm btn-danger">
                                    <i class="fa fa-undo"></i> Cancel
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div> {{-- /// Content --}}

        <div class="col-md-3"> {{-- Sidebar --}}
            @include('shared.helpdesk.category-sidebar')
        </div> {{-- /// Sidebar --}}
    </div>
@endsection