<div class="container">
	<?php if (Session::userIsLoggedIn()) : ?>
	<h1>Admin Settings - Add New Vehicle</h1>
  <div class="box">

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>
		<p>
			<?php if ($this->engineers) : ?>
			<center>
        <form method="post" action="<?php echo Config::get('URL');?>admin/stocklocation">
					<label for="admin_input_vehicletype">Vehicle Type:</label>
        	<input id="admin_input_vehicletype" type="text" name="v_type" required /><br/>

					<label for="admin_input_vehiclemake">Vehicle Make:</label>
        	<input id="admin_input_vehiclemake" type="text" name="v_make" required /><br/>

        	<label for="admin_input_vehiclemodel">Vehicle Model:</label>
        	<input id="admin_input_vehiclemodel" type="text" name="v_model" required /><br/>

        	<label for="admin_input_vehicleassigned">Vehicle Assigned To:</label>
      		<select name="v_assigned" required>
            <?php
              foreach($this->engineers as $key => $value){
                echo '<option value="' . htmlentities($value->user_id) . '">' . htmlentities($value->user_name) . '</option>';
              }
            ?>
          </select><br />

        	<label for="admin_input_vehiclereg">Vehicle Reg No.:</label>
        	<input id="admin_input_vehiclereg" type="text" name="v_reg" required /><br/>

        	<label for="admin_input_vehiclemot">Vehicle MOT Expiry:</label>
        	<input id="admin_input_vehiclemot" type="date" name="v_mot" required /><br/>

        	<label for="admin_input_vehiclemodel">Vehicle Tax Expiry:</label>
        	<input id="admin_input_vehiclemodel" type="date" name="v_tax" required /><br/>

        	<input type="submit" value="Add Vehicle" />
        </form><br/>
      </center>
			<?php endif; ?>
    </p>
  </div>
	<?php endif; ?>
</div>
