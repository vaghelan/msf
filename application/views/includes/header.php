<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
        <title>Scores Report!</title>

<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" media="screen" />

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>extjs/resources/css/ext-all.css"/>  

 <!--[if IE]>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style_ie.css" />
<![endif]-->


</head>
<body>

<div id="container">

<div class="h_wrap"> 

    <div class="dashboard fix">
    
	    <img src="http://7thgoswami.com/images/img.png"/>
	    	 <div class="logout"><?php echo anchor('login/logout', 'Log out'); ?></div>
   			 <h1><?php echo $current_event ?> </h1>    
<!--
Rank_ID My Score By Event  Team Score By Event  My Total Score  Team Total Score 
-->
	<ul class="dbord_info">
			<li class="username">
			   <?php echo $userdata->name ?></br>
         	   <div class="teamleader_box">My lead: <div id="teamleader"></div></div>
			   <div id="rank"></div> 
		</li>
        <li><h2 id="myscore_eventid">...</h2><em>My book score</em> </li> 
	    <li><h2 id="teamscore_eventid"> ...</h2><em>My team score</em> </li>
	    <li><h2 id="teammembers_eventid"> ...</h2><em>My team</em> </li>
<!--	    <li><h2 id="teamleader"> ...</h2><em>My Team Leader</em> </li> -->
	    
		<div class="invite_more"><?php echo anchor('teams', 'Invite more friends'); ?></div>
<!--
	    <li><h2 id="myscore_total"> ...</h2><em>my total score </em></li>
	    <li><h2 id="totalscore_total"> ...</h2><em>total</em></li>
-->
</ul>

    <script type="text/javascript" src="<?php echo base_url();?>extjs/adapter/ext/ext-base.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>extjs/ext-all.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>application/views/js/load_scores.js"></script>
