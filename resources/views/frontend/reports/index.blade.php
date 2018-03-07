@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session partial --}}

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @include('shared.petitions.partials.navigation') {{-- Specific petition navigation view partial --}}

                        <div class="tab-content">
                            <div role="tabpanel" id="home" class="tab-pane petition-margin-top fade in active">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h3>Report petition - {{ ucfirst($petition->title) }} </h3>

                                        <p>
                                            Creating and signing petitions should be safe, so we take abuse and harrasment seriously at 
                                            {{ config('app.name') }} - petitions. We want to hear about harmful behaviour on petitions that 
                                            violates our <a href="">Code Of Conduct</a>. Let us know the name of the user or petition 
                                            you're concerned with. Rest assured, we'll keep your identifying information private to the creator.
                                        </p>

                                        <hr>

                                        <form method="POST" action="{{ route('petition.report.store', ['slug' => $petition->slug]) }}" class="form-horizontal">
                                            {{ csrf_field() }} {{-- Form field protection --}}

                                            <div class="form-group @error('subject', 'has-error')">
                                                <label class="control-label col-md-3">Subject: <span class="text-danger">*</span></label>

                                                <div class="col-md-7">
                                                     <input type="text" @input('subject', 'Abuse report: ' . $petition->title ) placeholder="Subject" class="form-control">
                                                     @error('subject')
                                                </div>
                                            </div>

                                            <div class="form-group  @error('category', 'has-error')">
                                                <label class="control-label col-md-3">Category: <span class="text-danger">*</span></label>

                                                <div class="col-md-7">
                                                    <select @input('category') class="form-control">
                                                        <option value="">-- Category --</option>

                                                        @foreach ($categories as $category)
                                                            <option name="{{ $category->name }}" @if (old('category') === $category->name)) selected @endif>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    @error('category')
                                                </div>
                                            </div>

                                            <div class="form-group @error('description', 'has-error')">
                                                <label class="control-label col-md-3">What u like to report: <span class="text-danger">*</span></label>

                                                <div class="col-md-9">
                                                    <textarea @input('description') class="form-control wysiwyg" data-provide="markdown" rows="8">{{ old('description') }}</textarea>
                                                    @error('description')
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="fa fa-fw fa-send"></i> Send
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>

                                    <div class="col-md-3">
                                        <div style="margin-top: 40px;">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <i class="fa fa-fw fa-comments-o" aria-hidden="true"></i> Contact {{ config('app.name') }} - Petitions
                                                </div>

                                                <div class="list-group">
                                                    <a href="" class="list-group-item">
                                                        <span class="fa fa-fw fa-question"></span> Privacy concerns
                                                    </a>

                                                    <a href="{{ route('petition.report', ['slug' => $petition->slug])}}" class="list-group-item {{ isActive('petition/report*') }}">
                                                        <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> Report abuse
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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