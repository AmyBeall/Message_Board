<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Message Board</title>
    <link rel="stylesheet" href="../../assets/foundationUD/css/foundation.css" />
    <link rel="stylesheet" href="../../assets/CSS/UD.css" />
    <script src="../../assets/foundationUD/js/vendor/modernizr.js"></script>
  </head>
  <body>

    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="/dashboards/index">Message Board</a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
      </ul>
      <section class="top-bar-section">
        <ul class="right">
          <li><a href="/dashboards/register"> Register </a></li>
        </ul>
      </section>
    </nav>

    <?php 
     if(isset($errors)) 
     {
      echo $errors;
     }
    ?>
    
    <div class="row">
      <div class="large-6 columns">
        <h3> Sign In</h3>
        <form class="form" action="/dashboards/login" method="post">
          <div class="row collapse prefix-radius">
              <div class="small-4 columns reg_form">
                <span class="prefix">Username</span>
              </div>
              <div class="small-8 columns">
                <input type='text' name='user_name' value='sShady'>
              </div>
            </div>
            <div class="row collapse prefix-radius">
              <div class="small-4 columns reg_form">
                <span class="prefix">Password</span>
              </div>
              <div class="small-8 columns">
                <input type='password' name='password' value='12345678'>
              </div>
            </div>
          <input class="small button" type="submit" value="submit">
        </form>
      </div>
    </div>
    <div class="row">
      <div class="large-6 columns">
         <a href="/dashboards/register"> Don't have an account? Register</a>
      </div>
    </div>  
    
    <script src="../../assets/foundationUD/js/vendor/jquery.js"></script>
    <script src="../../assets/foundationUD/js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
    
  </body>
</html>