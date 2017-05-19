<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<??>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/intranet.ico" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>



    </head>
    <body style='font-family: Myriad pro,Arial,Helvetica,sans-serif; font-size: 73.1%;'>
        <div class="main_container">
            <div class="main_wrapper">
            <div class="content_wrapper">
                <div class="top"></div>
                <!--Top Area Start-->
                <div class="header_content">
                    
                    <div class="logo"  >
                        <? include_component('homepage', 'logos') ?>
                    </div>                    
                    
                </div>                        
                
                <!--Top Area End-->


                <!--Header Start-->
               
                <div class="header_foot">
                </div>


                <!--Header End-->


                <!--Content Area Start-->

                <div class="main_content" >
                    <div class="centerlogin" align="center">
                        <?php echo $sf_content ?>                            
                    </div>


                    <!--Center Column End End-->

                    <!--right Column Start-->

                    
                </div>

                <!--Content Area End-->

                <div class="footer">


                    <div class="copyright">
                        <div>Copyright &#169;. Todos los derechos reservados.<br /></div>
                        colsys@<?= $_SERVER["SERVER_ADDR"] ?>
                        <br />
                    </div>

                </div>

            </div>


             </div>       
        </div>      
    </body>
</html>
<?/*?>
 

<!DOCTYPE html>
<html lang="en">
  <!--<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <!--<link href="../../dist/css/bootstrap.min.css" rel="stylesheet">-->

    <!-- Custom styles for this template -->
    <!--<link href="signin.css" rel="stylesheet">-->

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!--<script src="../../assets/js/ie-emulation-modes-warning.js"></script>-->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]
  </head>-->
   
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #eee;
          }

          .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
          }
          .form-signin .form-signin-heading,
          .form-signin .checkbox {
            margin-bottom: 10px;
          }
          .form-signin .checkbox {
            font-weight: normal;
          }
          .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
               -moz-box-sizing: border-box;
                    box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
          }
          .form-signin .form-control:focus {
            z-index: 2;
          }
          .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
          }
          .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
          }
        
    </style>
    
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    

        <button class="btn btn-default" data-toggle="modal" data-target="#loginModal">Login</button>
        <div class=container" id="loginModal" tabindex="" role="" aria-labelledby="" aria-hidden="">
            <div class="">
                <div class="">
                    <div class="">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Login</h4>
                    </div>

                    <div class="container">
                        <!-- The form is placed inside the body of modal -->
                        <form id="loginForm" method="post"class="form-signin" role="form">
                            <!--<div class="form-group">
                                <label class="col-md-3 control-label">Username</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="username" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Password</label>
                                <div class="col-md-5">
                                    <input type="password" class="form-control" name="password" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-5 col-md-offset-3">
                                    <button type="submit" class="btn btn-default">Login</button>
                                </div>
                            </div>-->
                            <h2 class="form-signin-heading">Please sign in</h2>
                            <input type="email" class="form-control" placeholder="Email address" required autofocus>
                            <input type="password" class="form-control" placeholder="Password" required>
                            <div class="checkbox">
                              <label>
                                <input type="checkbox" value="remember-me"> Remember me
                              </label>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>    
    <script src="js/bootstrap/bootstrapValidator.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script>
    



    $(document).ready(function() {
        $('#loginForm').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                username: {
                    validators: {
                        notEmpty: {
                            message: 'The username is required'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required'
                        }
                    }
                }
            }
        });
    });




    
    </script>
  </body>
</html>
<?*/?>