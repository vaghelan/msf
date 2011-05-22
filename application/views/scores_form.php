  	</div><!--END dashboard -->

	  <ul id="menu" class="fix">
			<li class="active"><?php echo anchor('scores', 'Report my scores'); ?></li>
	  		<li><?php echo anchor('teams', 'Build my team'); ?></li>
			<li><?php echo anchor('story_report', 'Report my story'); ?></li>
			<li><?php echo anchor('profile', 'Profile'); ?></li>
	  </ul>

</div><!--END h_wrap -->
<div id="base-url" style="display:none;"><?php echo base_url();?></div>

<div id="scores-form"></div>
<script type="text/javascript" src="<?php echo base_url();?>application/views/js/scores_ext_js.js"></script>