<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<!--     <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png"> -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/cs-skin-elastic.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/style.css') }}" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>
<body class="bg-login-cmm">
    <div class="login-cmm">
        <div class="login-page2_bg">
            <div class="row p-0 m-0">
                <div class="col-lg-6 p-0">
                  <div class="img_bg">
                      <div class="heading">
                          Project Monitoring Information System
                          <p>Project Monitoring Information System (PMIS) is a web and mobile-based application for monitoring Information the physical, financial Progress of the Projects. It is very helpful to take critical decisions for a project in any organization.</p>
                      </div>
                      <div><img  src="{{ asset('backend/images/login_img.png') }}" class="img-responsive"></div>
                  </div>
                </div>
               <div class="col-lg-6">
                <div class="col-lg-10 login-box-outer">
                 <div class="login-box2">
                    <div class="logo">
                       <a href="#"><img src="{{ asset('backend/images/logo.png') }}"/>
                       </br>
                       <span>E Square System & Technologies Pvt. Ltd.</span>
                   </a>
                    </div>
                  
                       <div class="body">
                    <form method="POST" action="{{ route('login') }}">
                      @csrf
                                <div class="msg is-invalid">
                                <div class="error" style="color:#FF0000;margin-top:0px">
                                               </div>
                             Sign in to start your session
                                   @error('email')
                                    <p class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                    @enderror
                        </div>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <div class="form-line focused">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="email" required autofocus>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <div class="form-line"> 
                                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 clearfix p-0">
                                    <div class="text-right">
                                        <button class="btn bg-pink waves-effect" type="submit">SIGN IN</button>
                                    </div>
                                </div>
                                         </form>
                       </div>
                    
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/js/main.js') }}" />
    <script>
        //On focus event
        var $=jQuery.noConflict();
        $( document ).ready(function() {
            $('.form-control').focus(function () {
                $(this).parent().addClass('focused');
            });
        
            //On focusout event
            $('.form-control').focusout(function () {
                var $this = $(this);
                if ($this.parents('.form-group').hasClass('form-float')) {
                    if ($this.val() == '') { $this.parents('.form-line').removeClass('focused'); }
                }
                else {
                    $this.parents('.form-line').removeClass('focused');
                }
            });

            //On label click
            $('body').on('click', '.form-float .form-line .form-label', function () {
                $(this).parent().find('input').focus();
            });

            //Not blank form
            $('.form-control').each(function () {
                if ($(this).val() !== '') {
                    $(this).parents('.form-line').addClass('focused');
                }
            });
    });
    </script>
</body>
<style type="text/css">
.invalid-feedback {
    display:block;
}
</style>
</html>
