<div class="container">
  <h1>Admin Settings</h1>
  <div class="box">

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages();?>
	  <?php if (Session::userIsLoggedIn() && (Session::get('user_account_type') == 1 || Session::get('user_account_type') == 3)) : ?>
	  <h3>User Administration</h3>
    <p>
  		<?php
  			echo "<li><a href=" . Config::get('URL') . 'admin/adduser/' . ">Add a New User</a></li>";
        echo "<li><a href=" . Config::get('URL') . 'admin/updateuser/' . ">Update a User</a></li>";
  			if (Session::get('user_account_type') == 3){
  				echo "<li><a href=" . Config::get('URL') . 'admin/deleteuser/' . ">Delete a User</a></li>";
  			}
  		?>
    </p>
  	<h3>Job Administration</h3>
    <p>
  		<?php
  			echo "<li><a href=" . Config::get('URL') . 'admin/addjob/' . ">Create new Job</a></li>";
  			echo "<li><a href=" . Config::get('URL') . 'admin/assignjob/' . ">Assign a Job</a></li>";
  			echo "<li><a href=" . Config::get('URL') . 'admin/sendinvoice/' . ">Send Invoice for Jobs</a></li>";
        echo "<li><a href=" . Config::get('URL') . 'admin/updatejob/' . ">Update a Job</a></li>";
  			if (Session::get('user_account_type') == 3) {
  				echo "<li><a href=" . Config::get('URL') . 'admin/deletejob/' . ">Delete a Job</a></li>";
  				echo "<li><a href=" . Config::get('URL') . 'admin/viewdeletedjobs/' . ">View Deleted Jobs</a></li>";
  			}
  		?>
    </p>
  	<h3>Inventory/Stock Administration</h3>
    <p>
  		<?php
  			echo "<li><a href=" . Config::get('URL') . 'admin/moveitem/' . ">Move Stock</a></li>";
  			echo "<li><a href=" . Config::get('URL') . 'admin/viewstock/' . ">View all Stock</a></li>";
        echo "<li><a href=" . Config::get('URL') . 'admin/stocklow/' . ">Low Stock</a></li>";
  			if (Session::get('user_account_type') == 3) {
  				echo "<li><a href=" . Config::get('URL') . 'admin/addstock/' . ">Add Stock</a></li>";
          echo "<li><a href=" . Config::get('URL') . 'admin/additem/' . ">Add Item</a></li>";
  				echo "<li><a href=" . Config::get('URL') . 'admin/removestock/' . ">Remove Stock</a></li>";
  				echo "<li><a href=" . Config::get('URL') . 'admin/stocksearch/' . ">Search Stock</a></li>";
          echo "<li><a href=" . Config::get('URL') . 'admin/stockreorder/' . ">Stock for Re-Ordering</a></li>";
  				echo "<li><a href=" . Config::get('URL') . 'admin/addstocklocation/' . ">Add New Vehicle</a></li>";
  			}
  		?>
    </p>
  	<?php endif; ?>
  </div>
</div>
