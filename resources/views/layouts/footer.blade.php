 {{-- Scripts --}}
    @if(!app()->environment() === 'local')

     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
          
     <!-- Latest compiled and minified JavaScript -->
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
     <script src="https://use.fontawesome.com/52f2593b64.js"></script>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    
    <script src="https://use.fontawesome.com/52f2593b64.js"></script>

    <script src="/js/vendor/vue.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    {{-- <script scr="/js/app.js"></script>
    {{-- <script scr="/js/helpers.js"></script> --}}
    <script src="/js/globals.js"></script>
    {{-- <script src="/js/app/home.js"></script> --}}
    <script src="/js/notifier.js"></script>  

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