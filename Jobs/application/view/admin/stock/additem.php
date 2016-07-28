<div class="container">
	<?php if (Session::userIsLoggedIn()) : ?>
	<h1>Admin Settings - Add Item</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
		<center>
		    <p>
		        <form method="post" action="<?php echo Config::get('URL');?>admin/addanitem">
		        	<label for="invent_input_itemid">Item Code: </label>
		        	<input id="invent_input_itemid" type="text" name="item_code" required /><br />

              <label for="invent_input_item_name">Item Name: </label>
		        	<input id="invent_input_item_name" type="text" name="item_name" required /><br />

              <label for="invent_input_item_description">Item Description: </label>
		        	<input id="invent_input_item_description" type="text" name="item_description" required /><br />

              <label for="invent_input_item_make">Item Make: </label>
		        	<input id="invent_input_item_make" type="text" name="item_make" required /><br />

              <label for="invent_input_item_cost">Item Cost: </label>
		        	<input id="invent_input_item_cost" type="text" name="item_cost" required /><br />

              <label for="invent_input_item_resell">Item Resell: </label>
		        	<input id="invent_input_item_resell" type="text" name="item_resell" required /><br />

		        	<input type="submit" value="Add Item" />
		        </form><br/>
	        </p>
		</center>
    </div>
	<?php endif; ?>
</div>
