<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Message Board</title>
    <link rel="stylesheet" href="../../assets/foundationUD/css/foundation.css" />
    <link rel="stylesheet" href="../../assets/CSS/UD.css" />
    <script src="./foundationUD/js/vendor/modernizr.js"></script>
  </head>
  <body>
<?php
function format_interval($interval) {
    $result = "";
    if ($interval->y) { $result .= $interval->format("%y years "); }
    if ($interval->m) { $result .= $interval->format("%m months "); }
    if ($interval->d) { $result .= $interval->format("%d days "); }
    if ($interval->h) { $result .= $interval->format("%h hours "); }
    if ($interval->i) { $result .= $interval->format("%i minutes "); }
    if ($interval->s) { $result .= $interval->format("%s seconds "); }
    return $result;
}
$now = new DateTime(date("Y-m-d H:i:s"));
?>
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
  	 
		    
		    
	<div class="off-canvas-wrap" data-offcanvas>
  		<div class="inner-wrap">
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
						{echo "<li><a href='/dashboards/manage_users/'>Dashboard</a></li>";}
?>        	
		          	<li><a href="/dashboards/profile">Profile</a></li>
		          	<li><a class="right-off-canvas-toggle hide-for-medium-up" href="right_menu"><span>View Users</span></a></li>
		         	<li><a href="/dashboards/index"> Log Off</a></li>
		        </ul>
		    </section>	 	
			<aside id="right_menu" class="right-off-canvas-menu">
	            <ul class="off-canvas-list">
	              	<li><label>Users</label></li>
<?php
					foreach($all_users as $user_name)
					{
?>
						<li><a class="user_name" href="/dashboards/board/<?=$user_name['id']?>"><?=$user_name['user_name']?></a></li>
<?php    			
					}
?>	              	
	            </ul>
		    </aside>
  			<a class="exit-off-canvas"></a>	
  		</nav>
	</div>
</div>

<div class="users show-for-medium-up">
	<ul class="side-nav">
		<li><a href="#"><label>View Users</label></a></li>
<?php
			foreach($all_users as $user_name)
				{
					if ($user_name['user_name'] == $user['user_name'])
					{
?>						
						<li class="hidden"><a href="/dashboards/board/<?=$user_name['id']?>"><?=$user_name['user_name']?></a></li>
<?php
					} else {
?>
						<li><a href="/dashboards/board/<?=$user_name['id']?>"><?=$user_name['user_name']?></a></li>
<?php    			
					}
				}
?>	  
	</ul>
</div>		    	
	
<?php 
		 if(isset($errors)) 
		 {
		  echo $errors;
		 }
?>
	    <div class="row">
	      <div class="large-12 medium-9 medium-offset-2 columns">
	    	<h2><?=$user['user_name'];?></h2>
	    	<p>Description: <?=$user['description'];?></p>
	    	<div class='add_message'>
				<h4> Leave a message for <?=$user['user_name'];?></h4> 
				<form action='/dashboards/message/<?=$user['id']?>' method='post'>
					<textarea class = 'message' name = 'message'></textarea><br>
					<input type = 'hidden' name = 'creator_id' value = '<?=$this->session->userdata('id')?>'>
					<input  class = 'small button' type = 'submit' value = 'Post a message!'>
				</form>
			</div>
	      </div>
	    </div>
	    <div class="row">
	      <div class="large-12 medium-9 medium-offset-2 columns">
	        <div class = 'display_message'>
<?php
			if($messages)
			{
				foreach($messages as $message)
				{
					$compare =  new DateTime($message['created_at']);
					$difference = $compare -> diff($now);
?>
					<p><a href="/dashboards/board/<?=$message['creator_id']?>"><?=$message['creator_name']?></a> <?=format_interval($difference)?> ago</p>
					<p class='each_message'><?=$message['message']?></p>	
						<div class="row">
							<div class="large-10 large-offset-1 medium-9 medium-offset-3 columns">
								<div class = 'display_comment'>
<?php
									foreach($comments as $comment)
									{
										$compare =  new DateTime($comment['created_at']);
										$difference = $compare -> diff($now);
			
										if($comment['id'] == $message['id'])
										{
?>
										<p><a href="/dashboards/board/<?=$comment['creator_id']?>"><?=$comment['creator_name']?></a> <?=format_interval($difference)?> ago</p>
										<p class='each_comment'><?=$comment['comment']?></p>
<?php
										}
									}		
?>	
									</div>
									<div class='add_comment'>
										<h4> Post a comment </h4> 
										<form  action='/dashboards/comment/<?=$user['id']?>' method='post'>
											<textarea class = 'comment' name = 'draft_comment'></textarea><br>
											<input type='hidden' name = 'message_id' value='<?=$message['id']?>'>
											<input type = 'hidden' name = 'creator_id' value = '<?=$this->session->userdata('id')?>'>
											<input type = 'hidden' name = 'comment' value = 'entered_comment'>
											<input class = 'small button' type = 'submit' value = 'Post a comment!'>
										</form>
									</div>
								</div>
							</div>
<?php
					}
				
				}
?>
			</div>	
	      </div>
	    </div> 
 
	<script src="../../assets/foundationUD/js/vendor/jquery.js"></script>
    <script src="../../assets/foundationUD/js/foundation.min.js"></script>
    <script>
      $(document).foundation({
      	offcanvas : {
	  		open_method: 'overlap', 
	    	close_on_click : true
 		}
      });
    </script>

  </body>
</html>