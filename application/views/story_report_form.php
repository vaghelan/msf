  	</div><!--END dashboard -->

	  <ul id="menu" class="fix">
			<li><?php echo anchor('scores', 'Report my scores'); ?></li>
	  		<li><?php echo anchor('teams', 'Build my team'); ?></li>
			<li class="active"><?php echo anchor('story_report', 'Report my story'); ?></li>
			<li><?php echo anchor('profile', 'Profile'); ?></li>
	  </ul>

</div><!--END h_wrap -->
<div id="base-url" style="display:none;"><?php echo base_url();?></div>


<div class="wrapper" id="report">
		<h2> My Report</h2>
	 <p>Please post your stories .... </p>
	  	  <label>Name:</label>
	  	  <input type="text" id="name" name="name" tabindex="1" value="" title="Name">
	  	  <br>
	  	  <label>Location:</label>
	  	  <input type="text" id="location" name="location" tabindex="2" value="" title="Location">
	  	  <br>
	  	  <label>Subject:</label>
				<input type="text" id="subject" name="subject" tabindex="3" value="" title="Subject">				
				<br>
		    <textarea id="post_mail" name="story" cols=100 rows=18 tabindex="4"></textarea>
		    <button class="b_btn" type="button" onclick="SendPost()">Post</button>
</div>    
   
   
<script type="text/javascript" src="<?php echo base_url();?>application/views/js/story_report.js"></script>   