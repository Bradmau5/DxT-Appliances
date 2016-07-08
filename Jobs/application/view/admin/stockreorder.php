<div class="container">
	<?php if (Session::userIsLoggedIn()) : ?>
	<h1>Admin Settings - Stock for Re-Ordering</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
    	<center>
    		<?php if ($this->invent) { ?>
                <table style="width=100%" border="2px" border-style="solid">
                    <thead>
                        <tr>
                            <th>Item Code</th> <th>Item Name</th> <th>Item Description</th> <th>Item Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($this->invent as $key => $value) {
                            if($value->item_reorder != 0){
                                echo '<tr>';
                                echo '<td>' . htmlentities($value->item_code) . '</td> <td>' . htmlentities($value->item_name) . '</td> <td>' . htmlentities($value->item_description) . '</td> <td>' . htmlentities($value->item_quant) . '</td>';
                                echo '</tr>';
    			             } else {
                        ?>
                    </tbody>
                </table>
                        
                <?php }} ?>
                <div><h3>No stock needs re-ordering.</h3></div>
            <?php } ?>
    	</center>
    </div>
	<?php endif; ?>
</div>