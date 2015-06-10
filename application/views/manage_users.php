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

     <?php
      if($this->session->userdata('error'))
      {
        echo $this->session->userdata('error');
        $this->session->unset_userdata('error');
      }
    ?>
    <div class="row">
      <div class="large-12 columns">
        <h2>Manage Users</h2>
        <a id="button1" class="btn btn-default" href='/dashboards/add_user'>Add New</a>
       </div>
    </div> 
    <div class="row show-for-medium-up">
      <div class="large-10 columns">
        <table>
        	<thead>
        		<tr>
        			<th>ID</th>
        			<th>User Name</th>
              <th>Name</th>
        			<th>Email</th>
        			<th>Created At</th>
        			<th>User Level</th>
        			<th>Action</th>
        		</tr>	
        	</thead>
        	<tbody>
<?php
        			foreach($all_users as $user)
              {
?>
        				<tr>
        				<td><?=$user['id']?></td>
        				<td><a href="/dashboards/board/<?=$user['id']?>"><?=$user['user_name']?></a></td>
                <td><?=$user['first_name']?> <?=$user['last_name']?></td>
        				<td><?=$user['email_address']?></td>
        				<td><?=$user['time']?></td>
        				<td><?php if($user['user_level'] == 9){echo "Admin";}else{echo "Normal";}?></td>
        				<td><a href="/dashboards/edit_users/<?=$user['id']?>">Edit</a> / <a href="/dashboards/delete_user/<?=$user['id']?>">Remove</a></td>    				
        				</tr>
<?php    			
        			}
?>
        	</tbody>	
      	</table>
        
      </div>
    </div>   
    <div class="row hide-for-medium-up">
<?php
      foreach($all_users as $user)
      {
?>        
        <table class="small-12 columns">
          <caption>User <?=$user['id']?></caption>
          <tr>
            <td scope="column">User Name</td>
            <td><a href="/dashboards/board/<?=$user['id']?>"><?=$user['user_name']?></a></td>
          </tr>
          <tr>
            <td scope="column">Name</td>
            <td><?=$user['first_name']?> <?=$user['last_name']?></td>
          </tr>
          <tr>
            <td scope="column">Email</td>
            <td><?=$user['email_address']?></td>
          </tr>
          <tr>
            <td scope="column">Created At</td>
            <td><?=$user['time']?></td>
          </tr>
          <tr>
            <td scope="column">User Level</td>
            <td><?php if($user['user_level'] == 9){echo "Admin";}else{echo "Normal";}?></td>
          </tr>
          <tr>
            <td scope="column">Action</td>
            <td><a href="/dashboards/edit_users/<?=$user['id']?>">Edit</a> / <a href="/dashboards/delete_user/<?=$user['id']?>">Remove</a></td>
          </tr>
        </table>
<?php         
      }
?>       
     </div>
    <script src="../../assets/foundationUD/js/vendor/jquery.js"></script>
    <script src="../../assets/foundationUD/js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>

  </body>
</html>
</body>