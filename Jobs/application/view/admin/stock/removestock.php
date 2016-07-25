<div class="container">
	<?php if (Session::userIsLoggedIn()) : ?>
	<h1>Admin Settings - Remove Stock</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
		<center>
		    <p>
		        <form method="post" action="<?php echo Config::get('URL');?>admin/stockupdateremove">
		        	<label for="invent_input_item">Select Item: </label>
		        	<select name="item_code" required>
		        		<?php
					        if($this->invent){           
					            foreach($this->invent as $key=>$value){
							if($value->item_quant >= 1){
					               		echo '<option value="' . htmlentities($value->item_code) . '">' . htmlentities($value->item_name) . ' (' . htmlentities($value->item_code) . ')</option>';
					            	}
						    }
					        } else {}
					    ?>
		        	</select><br/>	

		        	<label for="invent_input_itemamount">Enter amount of stock: </label>
		        	<input id="invent_input_itemamount" type="number" name="item_quant" required /><br />

		        	<input type="submit" value="Add Stock" />
		        </form><br/>
	        </p>
		</center>
    </div>
	<?php endif; ?>
</div>