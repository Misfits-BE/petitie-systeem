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
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1>Terms of service</h1>

                        <p>
                            This website is property of Activisme_BE. By accessing and using this website you explicity agree
                            with the following terms and conditions.
                        </p>

                        <h3>Intellectual property rights</h3>

                        <p>
                            The contents of this site including brands, logos, drawings, data, product or company names,
                            texts, images are protected by intellectual rights and belong to Activisme_BE or entitled
                            third parties.
                        </p>

                        <h3>Limitation of liability</h3>

                        <p>
                            The information on the website is of a general nature. The information in not
                            adapted to personal or specific circumstances. And therefore can not be considered as
                            personal, professional or legal advice for the user.
                        </p>

                        <p>
                            Activisme_BE makes every effort to ensure that the information provided is complete,
                            correct, accurate and up-to-date. Despite these efforts,
                            inaccuracies may occur in the information provided. If the information provided
                            contains inaccuracies or if certain information on or via the site is unavailable, Activisme_BE
                            will make the greatest possible effort to rectify this as soon as possible. Activisme_BE can
                            not be held liable for direct or indirect damage resulting from the use of the
                            information on this site. If you find inaccuracies in the information made available via the site,
                            you can contact the webmaster.
                        </p>

                        <p>
                            The content of the site (including links) can be adapted, modified of supplemented at any time
                            without notice or notification. Activisme_BE gives no guarantees for the proper functioning
                            of the wesbite and can in no wat be held liable for a malfunction or temporary (un) availability
                            of for any kind of damage, direct or indirect, that would result from the access to or use of the website.
                        </p>

                        <p>
                            Activisme_BE can not under any circumstances be held liable in any way whatsoever in a direct or indirect,
                            special or other way for damage resulting from the use of this site or of another, in particular as a result
                            of links or hyperlinks, including, without limitation all losses, work interruptions,
                            damage to programs or other data on the computer system, equipment, software or other of the user.
                        </p>

                        <p>
                            The website may contain hyperlinks to websites or pages of third parties, or indirectly refer to them.
                            Placing links to these websites or parges in no way implies an implicit approval of their content.
                            Activisme_BE explicity declares that it has no control over the content of the content or other
                            characteristics of these websites and can in no case be held liable for the content or features or for
                            any other form of damage resulting from its use.
                        </p>

                        <h3>Privacy policy</h3>
                        <p><strong>Activisme_BE attaches importance to your privacy.</strong></p>

                        <p>In case the user of the website is asked for personal information.</p>

                        <p>
                            The person responsible for processing. Activisme_BE respects the Belgian legislation of 8 December 1992
                            regarding the protection of private life in the processing of personal data. The personal data you provide will be
                            used for the following purposes. Our member management and signing petitions. By signing petitions.
                        </p>

                        <p>
                            You have the legal right to inspect and correct your personal data. With proof of identity (copy of identity card)
                            you can obtain the written notification of your personal data via a written dated and signed request to
                            <a href="mailto:acties@activisme.be">Activisme_BE</a>. Free of charge. If necessary, you can also ask to correct the
                            data that would be incorrect, incomplete or non-pertinent.
                        </p>

                        <p>
                            Its is possible that the obtained personal data are passed on to the technical people of Activisme_BE.
                            Your personal data will not be passed on to third parties. If this is applicable, this will be communicated.
                        </p>

                        <p>
                            The technical people of Activisme_BE can also collect aggregated data of a non-personal nature,
                            such as browser type or IP address. THe operating system you use or the domain name of the website
                            from which u came to this website. Or by which you leave it. This allows us to permanenty optimize
                            this website for the users.
                        </p>

                        <h3>The use of "cookies"</h3>

                        <p>
                            During a visit to the site, 'cookies' can be placed on the hard disk of your computer. A cookie
                            is a text file that is placed by the server of a website. in the browser of your computer or mobile device when
                            you consult a website. Cookies can not be used to identify people, a cookie can only identify a machine.
                        </p>

                        <p>
                            You can configure your internet browser in such a way that cookies are not accepted, that you recieve a warning when a cookie
                            is installed or that the cookies are subsequently removed from your hard drive. You can do this via the settings of your
                            browser (via the help function). Keep in mind that certain graphic elements may not appear correctly or that you will not be able to use
                            certain applications optimally.
                        </p>

                        <p>By using our website, you agree to our use of cookies.</p>

                        <h3>Google Analytics</h3>

                        <p>
                            This website uses Google Analytics, a web analytics service provided by Google Inc?
                            Google Analytics uses "cookies". (text files placed on your computer). To help the website analyze how the users
                            use the site. The information generated by cookie about use of the website (including your IP address) will be transferred
                            to and stored by Google on servers in the United States. Google uses this information to keep track of how you
                            use the website, to compile reports on website activity and internet usage. Google may provide this information to third
                            parties if Google is legally obliged to do so, or insofar as these third parties process this information on behalf of Google.
                            Google will not combine your your IP address with other data  held by Google.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection