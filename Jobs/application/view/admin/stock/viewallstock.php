<div class="container">
	<?php if (Session::userIsLoggedIn()) : ?>
	<h1>Admin Settings - All Stock</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
		<center>
			<p>
				<?php if ($this->invent) { ?>
			    	<label for="invent_input_item_quantity">Search: </label>
						<input id="invent_input_item_quantity" type="text" name="search_terms" required />

			    	<button onclick="myFunction()">Search</button><br/>
				<?php }else{} ?>
			</p>
		    <p>
		        <?php if ($this->invent) { ?>
                	<table style="width=100%" border="2px" border-style="solid" text-align="center" id="view_stock">
                    	<thead>
                       		<tr>
                       			<th>Item Code</th> <th>Item Name</th> <th>Item Description</th> <th>Item Make</th> <th>Item Cost</th> <th>Item Re-Sale</th> <th>Item Location</th> <th>Quantity Available</th>
                       		</tr>
                       	</thead>
                       	<tbody>
                       		<?php foreach($this->invent as $key => $value) {
                           		echo '<tr>';
                           		echo '<td>' . htmlentities($value->item_code) . '</td> <td>' . htmlentities($value->item_name) . '</td> <td>' . htmlentities($value->item_description) . '</td> <td>' . htmlentities($value->item_make) . '</td> <td>' . htmlentities($value->item_cost) . '</td> <td>' . htmlentities($value->item_resell) . '</td>';
                              echo '<td>' . htmlentities($value->item_location) . '</td>';
                              echo '<td>' . htmlentities($value->item_quant) . '</td>';
															echo '</tr>';
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
<script>
function myFunction() {
		var input = document.getElementById('invent_input_item_quantity').value;
    var $rowsNo = $('#view_stock tbody tr').filter(function () {
        return $.trim($('td:contains(' + input + ')'))
    }).toggle();
}
</script>
