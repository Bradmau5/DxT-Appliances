<div class="container">
	<?php if (Session::userIsLoggedIn()) : ?>
    <h1>Admin Settings - Update User</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
        <center>
		<h3>1 = Normal User, 2 = Engineer, 3 = Administrator, 4 = Contract Account.</h3>
		    <p>
		        <form method="post" action="<?php echo Config::get('URL');?>admin/userupdate">
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

		        	<label for="userupdate_input_accounttype">Enter new account type: </label>
		        	<input id="userupdate_input_accounttype" type="number" name="user_account_type" required /><br />

		        	<input type="submit" value="Update User" />
		        </form><br/>
	        </p>
		</center>
    </div>
	<?php endif; ?>
</div>
