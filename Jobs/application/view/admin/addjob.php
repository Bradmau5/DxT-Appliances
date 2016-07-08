<div class="container">
	<?php if (Session::userIsLoggedIn()) : ?>
	<h1>Add a new job</h1>
	<div class="box">
	<div class="jobform">
		<?php $this->renderFeedbackMessages(); ?>
		<p>
        <form method="post" action="<?php echo Config::get('URL');?>admin/create" style="width: 60%;">
	<label for="login_input_jobaccount">Is this an account job? </label>
        <select name="job_account">
            <option  value="0">No</option>
            <option value="1">Yes</option>
	</select><br/>

	<label for="login_input_jobaccountname">Account: </label>
	<select name="job_account_name">
	    <option value="None">None</option>
	<?php
		if($this->users){			
			foreach($this->users as $key=>$value){
				echo '<option value="' . $value->user_name . '">' . $value->user_name . '</option>';
			}
		} else {}
	?>
	</select><br />
        <label for="login_input_jobname">Job Name: </label>
        <input id="login_input_jobname" type="text" name="job_name" required /><br/>

        <label for="login_input_jobaddressnumber">Address: </label>
        <input name="job_address_number" placeholder="House Number" type="number" /><br />
    	<input class="postcode" name="postcode"  placeholder="Postcode" /><br />
	<input name="custom_field"  placeholder="Street" /><br />
    	<input name="address3"  placeholder="City" /><br />

	<label for="login_input_jobtel">Contact Number: </label>
        <input id="login_input_jobtel" type="text" name="job_tel" required /><br/>

        <label for="login_input_jobfi">F/I: </label>
        <input id="login_input_jobfi" type="text" name="job_fi" required /><br/>

	<label for="login_input_jobmt">Machine Type: </label>
        <select name="job_mt">
            <option value="Washing Machine">Washing Machine</option>
            <option value="Dishwasher">Dishwasher</option>
            <option value="Oven">Oven</option>
	    <option value="Hob">Hob</option>
	    <option value="Washer Dryer">Washer Dryer</option>
	    <option value="Tumble Dryer">Tumble Dryer</option>
	    <option value="Glass Washer">Glass Washer</option>
	    <option value="Fridge">Fridge</option>
	    <option value="Freezer">Freezer</option>
	    <option value="Fridge Freezer">Fridge Freezer</option>
        </select><br/>        

        <label for="login_input_jobfault">Fault: </label>
        <input id="login_input_jobfault" type="text" name="job_fault" required /><br/>

        <label for="login_input_jobdate">Date: </label>
        <input id="login_input_jobdate" type="date" name="job_date" required /><br/>

        <label for="login_input_jobtime">Time: </label>
        <input id="login_input_jobtime" type="time" name="job_time" required /><br/>

        <label for="login_input_jobkeys">Keys Needed?: </label>
        <input id="login_input_jobkeys" type="text" name="job_keys" required /><br/>

        <input type="submit" value="Add Job" style="text-align:center;" />
        </form><br/>

		</p>
	</div>
	</div>
	<?php endif; ?>
</div>