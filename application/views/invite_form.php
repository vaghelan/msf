	<ul id="menu" class="fix">
			<li><?php echo anchor('scores', 'Manage Scores'); ?></li>
			<li><?php echo anchor('invite/generate_invite', 'Invite'); ?></li>
	  		<li><?php echo anchor('teams', 'View Team'); ?></li>
	  		<li><?php echo anchor('login/logout', 'LogOut'); ?></li>
	</ul>
</div><!--END h_wrap -->
</br>
</br>

<form name="invite" method="post"  action="<?php echo base_url();?>/index.php/invite">
<textarea cols="50" rows="4" name="email_list"></textarea>
<input type="submit" value="Invite">
</form>


