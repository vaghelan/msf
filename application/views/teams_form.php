  	</div><!--END dashboard -->

	  <ul id="menu" class="fix">
			<li><?php echo anchor('scores', 'Report my scores'); ?></li>
	  		<li class="active"><?php echo anchor('teams', 'Build my team'); ?></li>
			<li><?php echo anchor('story_report', 'Report my story'); ?></li>
			<li><?php echo anchor('profile', 'Profile'); ?></li>
	  </ul>

</div><!--END h_wrap -->
<div id="base-url" style="display:none;"><?php echo base_url();?></div>


<div class="wrapper" id="team">
<h2>Invite your friends to join your team</h2> 
<p>You can invite your friends, family members or anyone you like, to build your team. Here is an easy way to do it by just emailing them. List all the email ids that you want to invite, separated by commas, and write your encouraging message in the next box. You can also invite via Facebook. <b>Everyone who accepts your invitation using a unique URL from invite,  will be a part of your transcendental book distribution network.</b></p>

<div class="ivite_box fix">
		<h3>Invite by email</h3>
  		<label for="email_list">Invite email addresses:</label>  
		<textarea cols="30" rows="3" value="" name="email_list" id="email_list">Type a list of invitee email addresses...</textarea>

 		<label for="message">Personalize your invitation:</label>  		
   		<textarea cols="55" rows="3"  name="message" type="text" id="message" value="Invite">Enter your message</textarea>
		<button class="b_btn" type="button" onclick="SendInvite()">Send invites</button>
</div>


<div class="invite_options fix">		

	<div class="more_url">or send this link to friends: <span><?php echo $invite_url; ?></span></div>
	<a class="facebook" target="_blank" onclick="window.open (this.href, 'child', 'height=400,width=520'); return false" title="Share on Facebook" href="http://www.facebook.com/sharer.php?u=<?php echo $invite_url; ?>&t=Bhaktivinod Thakur International Festival of 1,008 Book Distributors">Invite by Facebook</a>

</div>




<hr>
    <h2>My network</h2> 

    <div id="teams-form" style="width:90%;margin-left:auto;margin-right:auto;"></div>
    <script type="text/javascript" src="<?php echo base_url();?>application/views/js/team.js"></script>
    
</div>