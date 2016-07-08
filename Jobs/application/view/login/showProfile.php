<div class="container">
	<?php if (Session::userIsLoggedIn()) : ?>
    <h1>LoginController/showProfile</h1>

    <div class="box">
        <h2>Your profile</h2>

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <div>Your username: <?= $this->user_name; ?></div>
        <div>Your email: <?= $this->user_email; ?></div>
        <div>Your avatar image:
            <?php if (Config::get('USE_GRAVATAR')) { ?>
                Your gravatar pic (on gravatar.com): <img src='<?= $this->user_gravatar_image_url; ?>' />
            <?php } else { ?>
                Your avatar pic (saved locally): <img src='<?= $this->user_avatar_file; ?>' />
            <?php } ?>
        </div>
        <div>Your account type is: <?php if($this->user_account_type == 3){
			echo "Administrator";
		}
		else if($this->user_account_type == 2){
			echo "Engineer";
		}
		else if($this->user_account_type == 1){
			echo "Office Staff";
		} else {
			echo "Contract Customer";
		}
	 ?></div>
    </div>
	<?php endif; ?>
</div>
