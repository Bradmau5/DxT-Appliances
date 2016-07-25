<div class="container">
	<?php if (Session::userIsLoggedIn()) : ?>
	<h1>Admin Settings - Search Stock</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
		<center>
			<?php if ($this->invent) { ?>
				<form method="post" action="<?php echo Config::get('URL');?>admin/search">	
		        	<label for="invent_input_item_quantity">Search: </label>
					<input id="invent_input_item_quantity" type="text" name="search_terms" required />

		        	<input type="submit" value="Add Item to Inventory" />
		        </form><br/>
			<?php }else{} ?>
		</center>
    </div>
	<?php endif; ?>
</div>