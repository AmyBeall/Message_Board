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
          <h1><a href="/dashboards/board/<?=$user['id']?>">Message Board</a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
      </ul>
      <section class="top-bar-section">
        <ul class="right">
          <?php
                    if($this->session->userdata('level') === '9')
                      {echo "<li><a href='/dashboards/manage_users'>Dashboard</a></li>";}
          ?>   
          <li><a href="/dashboards/profile">Profile</a></li>
          <li><a href="/dashboards/index"> Log Off</a></li>
        </ul>
      </section>
    </nav>

    <div class="row">
      <div class="large-12 columns">
        <h4>Edit User <?=$user['id']?>:</h4> 
       </div>
    </div> 
    <div class="row">
      <div class="large-6 columns">
        <h3> Edit Information </h3>
          <form class="form" action="/dashboards/admin_update_user_info/<?=$user['id']?>" method='post'>
            <div class="row collapse prefix-radius">
              <div class="small-4 columns reg_form">
                <span class="prefix">Email Address</span>
              </div>
              <div class="small-8 columns">
                <input type="text" name="email" value="<?=$user['email_address']?>">
              </div>
            </div>
            <div class="row collapse prefix-radius">
              <div class="small-4 columns reg_form">
                <span class="prefix">User Name</span>
              </div>
              <div class="small-8 columns">
                <input type="text" name="user_name" value="<?=$user['user_name']?>">
              </div>
            </div>
            <div class="row collapse prefix-radius">
              <div class="small-4 columns reg_form">
                <span class="prefix">First Name</span>
              </div>
              <div class="small-8 columns">
                <input type="text" name="first_name" value="<?=$user['first_name']?>">
              </div>
            </div>
            <div class="row collapse prefix-radius">
              <div class="small-4 columns reg_form">
                <span class="prefix">Last Name</span>
              </div>
              <div class="small-8 columns">
                <input type="text" name="last_name" value="<?=$user['last_name']?>">
              </div>
            </div>
            <div class="row collapse prefix-radius">
              <div class="small-4 columns reg_form">
                <span class="prefix">User Level</span>
              </div>
              <div class="small-8 columns">
                <select name='level'><option value='admin'>Admin</option><option value='normal'>Normal</option></select>
              </div>
            </div>
            <input class="small button" type="submit" value="Save">
          </form>
      </div>
    </div> 
    
    <div class="row">
      <div class="large-6 columns">
        <h3> Change Password </h3>
          <form class="form" action="/dashboards/admin_update_password/<?=$user['id']?>" method='post'>
           <div class="row collapse prefix-radius">
              <div class="small-4 columns reg_form">
                <span class="prefix">Password</span>
              </div>
              <div class="small-8 columns">
                <input type='password' name='password'>
              </div>
            </div>
            <div class="row collapse prefix-radius">
              <div class="small-4 columns reg_form">
                <span class="prefix">Confirm Password</span>
              </div>
              <div class="small-8 columns">
                <input type='password' name='confirm'>
              </div>
            </div>
            <input class="small button" type="submit" value="Update Password">
          </form>
      </div>
    </div>

    <script src="../../assets/foundationUD/js/vendor/jquery.js"></script>
    <script src="../../assets/foundationUD/js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>

  </body>
</html>
</body>