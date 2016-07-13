<div class="container">
	<?php if (Session::userIsLoggedIn()) : ?>
		<div class="row">
    	<h1 class="h1big col-lg-12 col-md-12 col-sm-12 pull-left">Your Profile</h1>
		</div>

    <div class="box">
      <div class="h2shaded">Here you can see everything on your account.</div>

      <!-- echo out the system feedback (error and success messages) -->
      <?php $this->renderFeedbackMessages(); ?>
			<div>
				<img src='<?= $this->user_avatar_file; ?>' /><br />
				<a style="text-align: center;" href="<?php echo Config::get('URL'); ?>login/editAvatar"> [Change] </a><br />
			</div>
      <div>Your username: <?= $this->user_name; ?></div>
      <div>Your email: <?= $this->user_email; ?></div>
			<br />
    	<div><a href="#">View Previous Jobs</a></div>
			<br />
			<div><a href="<?php echo Config::get('URL'); ?>login/logout">Logout</a></div>
    </div>
	<?php endif; ?>
</div>
