<div class="container">
	<?php if (Session::userIsLoggedIn()) : ?>
	<h1>Admin Settings - All Stock</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
		<center>
		    <p>
		        <?php if ($this->loc) { ?>
                	<table style="width=100%" border="2px" border-style="solid" text-align="center">
                    	<thead>
                       		<tr>
                       			<th>Item Code</th> <th>Item Name</th> <th>Item Description</th> <th>Item Make</th> <th>Item Cost</th> <th>Item Re-Sale</th> <th>Item Location</th> <th>Quantity Available</th> 
                       		</tr>
                       	</thead>
                       	<tbody>
                       		<?php foreach($this->loc as $key => $value) {
                           		echo '<tr>';
                           		echo '<td>' . htmlentities($value->item_code) . '</td> <td>' . htmlentities($value->item_name) . '</td> <td>' . htmlentities($value->item_description) . '</td> <td>' . htmlentities($value->item_make) . '</td> <td>' . htmlentities($value->item_cost) . '</td> <td>' . htmlentities($value->item_resell) . '</td>';
                              echo '<td>' . htmlentities($value->v_assigned) . '</td>'; 
                              echo '<td>' . htmlentities($value->item_quant) . '</td>';
                            } ?>
                        </tbody>
                    </table>
		        <?php } ?>
		        <br/>
	        </p>
		</center>
    </div>
    <?php endif; ?>
</div>