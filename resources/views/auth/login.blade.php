<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notifier | LOGIN</title>

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
<!-- old laravel auth template -->
{{-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

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
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>  --}}   

<!-- Notifier Auth template -->
<div class="container-fluid brand-section">
    <a href="{{ url('/') }}"><h2 class="text-center">Notifier</h2></a>
</div>

{{-- @if($activate_email)
  <div class="container-fluid alert alert-success">
    {{ $activate_email }}
  </div>
@endif --}}

<div class="col-md-6 col-md-offset-3 z-depth-3" id="authentication-wrapper">
    <h5 class="text-center">Sign in</h5>
    <hr>
    <form action="{{ url('/login') }}" method="post">

     {{ csrf_field() }}
        
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

        {{-- <div class="fb-login-button btn btn-flat" data-max-rows="1" data-size="large" data-show-faces="false" data-auto-logout-link="true"></div> --}}

        <button class="btn waves-effect waves-light" type="submit" name="action">Authenticate</button> <span style="margin-left:12em;">Not registered yet <a href="{{ url('/register') }}">Register here</a></span>
            
    </form>
    @if(count($errors->all()))
        <div class="card-panel deep-orange darken-4">
            @foreach($errors->all() as $error)
                <p style="color:white;">{{ $error }}</p>
            @endforeach    
        </div>
    @endif
</div>

<div id="fb-root"></div>
    <script>
/**
 * loading facebook SDK
 * @return {[type]} [description]
 */
  window.fbAsyncInit = function() {
    FB.init({
      status     : true,
      appId      : '1163234707092749',
      xfbml      : true,
      version    : 'v2.8'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
</body>
</html>


