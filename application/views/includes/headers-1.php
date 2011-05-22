<div class="h_wrap"> 

    <div class="dashboard fix">
    
	    <img src="http://7thgoswami.com/images/img.png"/>
	    	 <div class="logout"><?php echo anchor('login/logout', 'LogOut'); ?></div>
   			 <h1><?php echo $current_event ?> </h1>    
<!--
Rank_ID My Score By Event  Team Score By Event  My Total Score  Team Total Score 
-->
	<ul class="dbord_info">
			<li class="username"><?php echo $userdata->name ?>
			<div id="rank"></div> 
		</li>
        <li><h2 id="myscore_eventid">...</h2><em>my score</em> </li> 
	    <li><h2 id="teamscore_eventid"> ...</h2><em>my team score</em> </li>
	    <li><h2 id="myscore_total"> ...</h2><em>my total score </em></li>
	    <li><h2 id="totalscore_total"> ...</h2><em>total</em></li>
</ul>

    <script type="text/javascript" src="<?php echo base_url();?>extjs/adapter/ext/ext-base.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>extjs/ext-all.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>application/views/js/load_scores.js"></script>


<div id="prompt" class="transparent" style="display: none;">
<a onclick="javascript:document.getElementById('prompt').style.display = 'none';" href="#">Close</a>
	<p>Please go to My Profile Page and <b>update your passowrd</b></p>
</div>