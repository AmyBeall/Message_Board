<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  </head>
  <style>
  .navbar{
    padding-right: 65px;
    padding-left: 50px;
 	 }
  	.right{
      float:right;
    }
    .container h4{
      display:inline-block;
      margin-top: auto;
    }
    .container a{
      margin-top: auto;
    }
    .container h4, a{
      padding:10px;
    }
	body { 
      padding: 70px; 
    }
    .form input{
    	display:block;
    }
    tbody tr:nth-child(odd)
    {
   		background-color: #ccc;
	}
  </style>
  <body>
  

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <h4> Test App</h4>
        <a href="/dashboards/display_users">Dashboard</a>
        <a href="/dashboards/profile">Profile</a>
        <a class="right" href="/dashboards/index"> Log Off</a>
      </div>
    </nav>
    <table class="table">
    	<thead>
    		<tr>
    			<th>ID</th>
    			<th>Name</th>
    			<th>Email</th>
    			<th>Created At</th>
    			<th>User Level</th>
    		</tr>	
    	</thead>
    	<tbody>
    			<?php
    			foreach($all_users as $user)
    			{
    				?>
    				<tr>
    				<td><?=$user['id']?></td>
    				<td><a href="/dashboards/board/<?=$user['id']?>"><?=$user['first_name']?> <?=$user['last_name']?></a></td>
    				<td><?=$user['email_address']?></td>
    				<td><?=$user['time']?></td>
    				<td><?php if($user['user_level'] == 9){echo "Admin";}else{echo "Normal";}?></td>
    				</tr>
    				<?php    			
    			}
    			?>
    		
    	</tbody>	
  	</table>
</body>