<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="_token" content="{{ csrf_token() }}">
        <title>Notifier - Intuitive Note writing software for your work</title>

            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
            <!-- backend stylesheet -->
            <link rel="stylesheet" href="/css/welcome.css">

          <link href="https://fonts.googleapis.com/css?family=Raleway:100i|Righteous|Secular+One&amp;subset=latin-ext" rel="stylesheet">
          <!-- Compiled and minified CSS -->
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

          {{-- <link rel="stylesheet" href="node_modules/csspin/csspin.css"> --}}

          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

          <!-- Compiled and minified JavaScript -->
          <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
                  
           <!-- Latest compiled and minified JavaScript -->
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
            <script src="https://use.fontawesome.com/52f2593b64.js"></script>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
    {{-- <div class="overlay">
        <div class="cp-spinner cp-skeleton"></div> 
    </div> --}}
        {{-- <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div> --}}

       <!-- session data container for sending a message -->
        <div class="container-fluid message_warning_container">
            @if(Session::has('send_successfull')) <p class="test-center">{{ Session::get('send_successfull') }}</p> @endif
            @if(Session::has('send_failed')) <p class="test-center">{{ Session::get('send_failed') }}</p> @endif
        </div>
            <!-- header -->
            <nav id="landing-header"r>
                <div class="nav-wrapper">
                    <a href="{{ url('/') }}" class="brand-logo">Notifier</a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="{{ url('/login') }}">SIGN IN</a></li>
                        <li><a href="{{ url('/register') }}">SIGN UP</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#send_message-modal">CONTACT</a></li>
                        {{-- <li><a href="{{  }}">CONTACT</a></li> --}}
                    </ul>
                </div>
            </nav>

        <!-- top section -->
        <div class="container-fluid" id="top">
            <div class="col-md-12 left">
                <h3 class="text-center">QUALITY NOTE WRITING SOFTWARE</h3>
                <p class="text-center">PERFECTLY CRAFTED FOR YOUR WORK IDEAS</p>
                <p class="text-center">POWERED BY THE LATEST TECHNOLOGIES</p>
            </div>
        </div>

        <!-- features section -->
        <div class="container-fluid" id="features">
            <div class="col-md-3 feature__idea">
                <div class="row">
                    <i class="fa fa-lightbulb-o"></i>
                </div>
                <div class="row">
                    <p class="text-center">Storing your ideas for your work</p>
                </div>
            </div>
            <div class="col-md-3 feature__school">
                <div class="row">
                    <i class="fa fa-graduation-cap"></i>
                </div>
                <div class="row">
                    <p class="text-center">Perfect for your future school projects</p>
                </div>
            </div>
            <div class="col-md-3 feature__devices">
                <div class="row">
                    <i class="fa fa-mobile"></i>
                </div>
                <div class="row">
                    <p class="text-center">Have your work integrated in every type of device, everywhere</p>
                </div>
            </div>
            <div class="col-md-3 feature__integrations">
                <div class="row">
                    <i class="fa fa-handshake-o"></i>
                </div>
                <div class="row">
                    <p class="text-center">have your work integrated with your favourite thrid party platform</p>
                </div>
            </div>

        </div>

        <!-- get-started section -->
        <div class="container-fluid" id="get-started">
            <div class="left col-md-6">
                <h2>WANT TO KEEP TRACK OF YOUR NOTES</h2>
                <h3>ARE YOU USING A THIRD PARTY SERVICE?, YOU CAN INTEGRATE YOUR WORK WITH A THIRD PARTY SERVICE</h4>

                <h5 class="get-started">SIGN UP HERE TO <a href="{{ url('register') }}"><strong>GET STARTED</strong></a></h5>
            </div>
            <div class="right col-md-6">
                
            </div>
            
        </div>
        <div class="container-fluid" id="footer">
            <p class="text-center">Notifier - <span>CVR - *********</span> - <span><a href="mailto:hello@notifier.com">hello@notifier.com</a></span></p>
        </div>

        <?php $form = new AdamWathan\Form\FormBuilder; ?>

        <div class="modal fade " id="send_message-modal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <!-- header content here -->
                <h4>Lets get in touch</h4>
              </div>
              <div class="modal-body">
                {!! $form->open()->action(route('welcome.send.message'))->method('POST')->class('message_form') !!}

                    {!! csrf_field() !!}

                    <div class="form-group col-md-6">
                        {!! $form->label('firstname') !!}
                        {!! $form->text('firstname', null)->class('form-control message_form__firstname')->placeholder('Enter your firstname here') !!}
                    </div>

                    <div class="form-group col-md-6">
                        {!! $form->label('lastname') !!}
                        {!! $form->text('lastname', null)->class('form-control message_form__lastname')->placeholder('Enter your lastname here') !!}
                    </div>

                    <div class="form-group">
                        {!! $form->label('email') !!}
                        {!! $form->text('email', null)->class('form-control message_form__email')->placeholder('Enter your email here') !!}
                    </div>

                    <div class="form-group">
                        {!! $form->label('message') !!}
                        {!! $form->textarea('body')->class('form-control message_form__message')->placeholder('Enter your message in this field.') !!}
                    </div>

                    <div class="form-group">
                        {!! $form->submit('Send')->class('btn btn-primary send-message-btn') !!}
                    </div>

                {!! $form->close() !!}
              </div>
            </div>
          </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
              
         <!-- Latest compiled and minified JavaScript -->
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
        <script src="https://use.fontawesome.com/52f2593b64.js"></script>
        <script src="/js/globals.js"></script>
        <script src="/js/welcome.js"></script>
    </body>
</html>
