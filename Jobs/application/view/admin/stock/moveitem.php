<div class="container">
	<?php if (Session::userIsLoggedIn()) : ?>
	<h1>Admin Settings - Move Stock</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
		<center>
		    <p>
		        <form method="post" action="<?php echo Config::get('URL');?>admin/movestock">
		        	<?php if ($this->stock && $this->engineers) { ?>
                		<table style="width=100%" border="2px" border-style="solid" text-align="center">
                    		<thead>
                        		<tr>
                        			<th>Item Code</th> <th>Item Name</th> <th>Quantity Available</th> <th>Quantity to Move</th> <th>Move To?</th>
                        		</tr>
                        	</thead>
                        	<tbody>
                        		<?php foreach($this->stock as $key => $value) {
                            		echo '<tr>';
                            		echo '<td>' . htmlentities($value->item_code) . '</td> <td>' . htmlentities($value->item_name) . '</td> <td>' . htmlentities($value->item_quant) . '</td>';
                            		echo '<td><input type="number" name="item_quant_move" /></td>';
                            		echo '<td><select name="item_move_name">';
                            		foreach($this->engineers as $key => $engineer) {
                            			echo '<option value="' . htmlentities($engineer->user_id) . '">' . htmlentities($engineer->user_fullname) . '</option>';
                            		}
                            		echo '</td>';
                            	} ?>
                            </tbody>
                        </table>

		        		<input type="submit" value="Move Stock" />
		        	<?php } ?>
		        </form><br/>
	        </p>
		</center>
    </div>
    <?php endif; ?>
</div>