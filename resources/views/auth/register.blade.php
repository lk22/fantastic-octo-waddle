<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notifier | REGISTER</title>

     <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

          <link href="https://fonts.googleapis.com/css?family=Raleway:100i|Righteous|Secular+One&amp;subset=latin-ext" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
          
   <!-- Latest compiled and minified JavaScript -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
    
<!-- Notifier Auth template -->
<div class="container-fluid brand-section">
   <a href="{{ url('/') }}"><h2 class="text-center">Notifier</h2></a>
</div>

<div class="col-md-6 col-md-offset-3 z-depth-3" id="authentication-wrapper">
    <h5 class="text-center">Sign up</h5>
    <hr>
    <form action="{{ url('/register') }}" method="post">

     {{ csrf_field() }}

        <div class="input-field">
            <i class="material-icons prefix"></i>
            <input type="text" name="name" id="icon_prefix" validate>
            <label for="icon-prefix">Full Name</label>
        </div>
        
        <div class="input-field">
            <i class="material-icons prefix"></i>
            <input type="email" name="email" id="icon_prefix" validate>
            <label for="icon-prefix">Email</label>
        </div>

        
         <div class="input-field">
            <i class="material-icons prefix"></i>
            <input type="password" id="icon_prefix" name="password" validate>
            <label for="icon-prefix">Password</label>
        </div>

         <div class="input-field">
            <i class="material-icons prefix"></i>
            <input type="password" id="icon_prefix" name="password_confirmation" validate>
            <label for="icon-prefix">Confirm Password</label>
        </div>

        <button class="btn waves-effect waves-light" type="submit" name="action">Register</button> <span style="margin-left:10em;">If you allready have an account <a href="{{ url('/login') }}">Login here</a></span>
            
    </form>
    @if(count($errors->all()))
        <div class="card-panel deep-orange darken-4">
            @foreach($errors->all() as $error)
                <p style="color:white;">{{ $error }}</p>
            @endforeach    
        </div>
    @endif
</div>
</body>
</html>
{{-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}


