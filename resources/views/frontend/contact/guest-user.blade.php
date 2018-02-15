@extends('layouts.app')

@section('content')
<div class="jumbotron margin-top-minus-20">
        <div class="container">
            <h1>{{ config('app.name' )}} - Petitions</h1>
            <p>
                Change isn’t a product exclusively manufactured by the industrial leaders or governments. <br>
                That’s something that’s in everybody.
            </p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Discover petitions »</a></p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="panel panel-default panel-body">

                <div class="alert-message alert-message-success">
                    <h4><strong><i class="fa fa-info-circle"></i> Please read first the <span class="tw-underline">FAQ</span> section before you send us a question. </strong></h4>

                    <p>
                        If your answer is not provided in the FAQ (you can find the faq at the footer of this page.), or you want to just leave a massage. You can send the form and send it to us. <br>
                        Further we are also active on Facebook and Twitter.
                    </p>
                </div>

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
                            <button type="submit" class="btn btn-success pull-right">
                                <i class="fa fa-check"></i> Send
                            </button> 
                        </div> {{-- // END submit and reset bbutton --}}
                    </div> {{-- // END Form inputs --}}
                </form> {{-- // END contact form --}}
            
            </div>
        </div>
    </div>
@endsection