<div class="container">
	<?php if (Session::userIsLoggedIn()) : ?>
	<h1>Admin Settings - Delete a User</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
		<center>
			<form method="post" action="<?php echo Config::get('URL');?>admin/userdelete">
		        	<label for="userupdate_input_user">Select a User: </label>
		        	<select name="user_id" required>
		        		<?php
					        if($this->users){           
					            foreach($this->users as $key=>$value){
					                echo '<option value="' . htmlentities($value->user_id) . '">' . htmlentities($value->user_name) . ' (Current Account Type: ' . htmlentities($value->user_account_type) . ')</option>';
					            }
					        } else {}
					    ?>
		        	</select><br/>

		        	<input type="submit" value="Delete User" />
		        </form><br/>
		</center>
    </div>
	<?php endif; ?>
</div>