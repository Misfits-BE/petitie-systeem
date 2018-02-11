@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-info-circle"></i> Create new helpdesk ticket.
                    </div>

                    <div class="panel-body">
                        <div class="media">
                            <div class="media-left">
                                <a href="">
                                    <img class="media-object img-thumbnail img-rounded img-100" src="" alt="helpdesk">
                                </a>
                            </div>

                            <div class="media-body">
                                <p>
                                    We are always prepared to help u. So you can ask your question here. But much answers on your question you can find in our FAQ section.
                                    We suggest you to read the FAQ section first. And if you can't find the needed answer. You can still create an helpdesk ticket. for your question.
                                </p>

                                <p>If you create an helpdesk ticket, please follow the following rules.</p>

                                <ul class="list-unstyled">
                                    <li><span class="text-danger">*</span> The helpdesk not an amusement park.</li>
                                    <li><span class="text-danger">*</span> Please don't heropen tickets for an 'ok' or 'Thank you' answer.</li>
                                    <li><span class="text-danger">*</span> We are working voluntary on this platform, so please be kind in your questions and answers.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-plus"></i> Create your helpdesk ticket.
                    </div>

                    <div class="panel-body">
                        <form action="{{ route('helpdesk.store') }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }} {{-- Form field protection --}}

                            <div class="form-group @error('title', 'has-error')">
                                <label class="col-md-3 control-label">
                                    Title: <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-5">
                                    <input type="text" @input('title') placeholder="Ticket title" class="form-control">
                                    @error('title')
                                </div>
                            </div>

                            <div class="form-group @error('category', 'has-error')">
                                <label class="col-md-3 control-label">
                                    Category: <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-5">
                                    <select @input('category') class="form-control">
                                        <option value="">-- Select your category --</option>

                                        @foreach ($categories as $category) {{-- Categories loop --}}
                                            <option value="{{ $category->id }}" @if (old('category') == $category->id) selected @endif>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('category') {{-- Error message display --}}
                                </div>
                            </div>

                            <div class="form-group @error('description', 'has-error')">
                                <label class="control-label col-md-3">
                                    Your question/feedback: <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-9">
                                    <textarea rows="8" @input('description') class="form-control" placeholder="Describe your question or feedback.">{{ old('description') }}</textarea>
                                    
                                    @if ($errors->has('decription')) {{-- Display validation error --}}
                                        @error('description') {{-- View partials --}}
                                    @else {{-- Display help text --}}
                                        <span class="help-block">
                                            <span class="text-danger">*</span> Dit veld is <a href="">Markdown</a> ondersteund
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-check"></i> Save
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