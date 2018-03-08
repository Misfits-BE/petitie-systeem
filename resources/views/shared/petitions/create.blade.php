@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-fw fa-plus"></i> Create new petition
                    </div>

                    <div class="panel-body">
                        <form method="POST" action="{{ route('petitions.store') }}" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }} {{-- Form field protection --}}

                            <div class="form-group @error('title', 'has-error')">
                                <label class="col-md-3 control-label">What is the petition title: <span class="text-danger">*</span></label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Petition title" @input('title')>
                                    @error('title')
                                </div>
                            </div>

                            <div class="form-group @error('decision_maker', 'has-error')">
                                <label class="col-md-3 control-label">Who is the decision maker: <span class="text-danger">*</span></label>
                                
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Decision maker. Ex. Donald Trump" @input('decision_maker')>
                                    @error('decision_maker')
                                </div>
                            </div>

                            <div class="form-group @error('title', 'has-error')">
                                <label class="col-md-3 control-label">What is the petition image: <span class="text-danger">*</span></label>
                            
                                <div class="col-md-9">
                                    <input type="file" class="form-control" @input('image')>
                                    @error('image')
                                </div>
                            </div>

                            <div class="form-group @error('text', 'has-error')">
                                <label class="col-md-3 control-label">Petition text: <span class="text-danger">*</span></label>

                                <div class="col-md-9">
                                    <textarea @input('text') class="form-control wysiwyg" data-provide="markdown" rows="10">{{ old('text') }}</textarea>
                                    @error('text') {{-- Validation error view partial --}}
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
        </div>
    </div>
@endsection

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-markdown.min.css') }}"></link>
@endpush

@push('scripts')
    <script src="{{ asset('js/bootstrap-markdown.js') }}"></script>
    <script> $(function () { $('[data-toggle="tooltip"]').tooltip() }) </script> 
@endpush