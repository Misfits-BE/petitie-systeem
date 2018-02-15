@extends('layouts.app')

@section('content')
<div class="jumbotron margin-top-minus-20">
        <div class="container">
            <h1>{{ config('app.name' )}} - Petitions</h1>
            <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Discover petitions »</a></p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="panel panel-default panel-body">

                <div role="alert" class="tw-bg-blue-lightest tw-border tw-border-blue-light tw-text-blue-dark tw-px-4 tw-py-3 tw-rounded tw-relative"> {{-- INFO alert --}}
                    <strong class="tw-font-bold"><i class="fa fa-fw fa-info-circle"></i></strong> 
                    <span class="tw-font-bold tw-sm:inline">
                        Please read first the <span class="tw-underline">FAQ</span> section before you send us a question.
                    </span> 
                    
                    <br><br> 
                    
                    <span class="tw-sm:inline">
                        If your answer is not provided in the FAQ (you can find the faq at the footer of this page.), or you want to just leave a massage. You can send the form and send it to us. <br>
                        Further we are also active on Facebook and Twitter.
                    </span>
                </div> {{-- // End info alert --}}

                <form action="" method="POST" class="tw-mt-8"> {{-- Contact form --}}
                    {{ csrf_field() }} {{-- form field protection --}}

                    <div class="row"> {{-- Form inputs --}}
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="name">Your name: <span class="text-danger">*</span></label> 
                                <input type="text" id="name" placeholder="Your name" name="name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="subject">Subject: <span class="text-danger">*</span></label>
                                <input type="text" id="subject" placeholder="The message subject" name="subject" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="email">Your email address: <span class="text-danger">*</span></label>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-envelope"></span>
                                    </span> 
                                
                                    <input type="email" id="email" placeholder="Your email address" name="email" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="name">Message: <span class="text-danger">*</span></label> 
                                <textarea name="message" id="Your message" rows="9" cols="25" placeholder="Your message" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12"> {{-- Submit and reset button --}}
                            <button type="submit" style="border-radius: 3px;" class="btn btn-success pull-right">
                                <i class="fa fa-check"></i> Send
                            </button> 
                        </div> {{-- // END submit and reset bbutton --}}
                    </div> {{-- // END Form inputs --}}
                </form> {{-- // END contact form --}}
            
            </div>
        </div>
    </div>
@endsection