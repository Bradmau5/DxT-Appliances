<div class="container">
	<?php if (Session::userIsLoggedIn()) : ?>
    <h1>Admin Settings - Delete a Job</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
        <p>
	<center>
                <?php if ($this->jobs) { ?>
                <table style="width=100%" border="1px">
                    <thead>
                        <tr>
                            <th hidden>Job ID</th> <th>Name</th> <th>Address</th> <th>Contact</th> <th>F/I</th> <th>Machine Type</th> <th>Fault</th> <th>Date Booked</th> <th>Time</th> <th>Keys Needed?</th> <th>Completed?</th>
                        </tr>
                    </thead>
                     <tbody>
                        

                        <?php foreach($this->jobs as $key => $value) { 
                            echo '<tr>';
                            echo '<td hidden>' . htmlentities($value->job_id) . '</td> <td>' . htmlentities($value->job_name) . '</td> <td>' . htmlentities($value->job_address) . '</td> <td>' . htmlentities($value->job_tel) . '</td> <td>' . htmlentities($value->job_fi) . '</td> <td>' . htmlentities($value->job_mt) . '</td> <td>' . htmlentities($value->job_fault) . '</td> <td>' . htmlentities($value->job_date) . '</td> <td>' . htmlentities($value->job_time) . '</td> <td>' . htmlentities($value->job_keys) . '</td> <td>' . htmlentities($value->job_done) . '</td> <td>'; 
				if(htmlentities($value->job_for) == 3){echo "Brad";}
				elseif(htmlentities($value->job_for) == 4){echo "Tim";}
				elseif(htmlentities($value->job_for) == 6){echo "Jack";}
				elseif(htmlentites($value->job_for) == 7){echo "Sunny";}
			    echo '</td>';
                            echo '<td><a href=' . Config::get("URL") . "dashboard/delete/" . $value->job_id . '><img src="../../css/images/delete.png" width="30" height="30"></a></td>';
                            echo '</tr>';
                        } ?>
                </table>
                <input type="submit" name="save_changes" value="Save Changes" />
                <?php } else { ?>
                    <div>No jobs yet.</div>
                <?php } ?>
            </center>
        </p>
    </div>
	<?php endif; ?>
</div>
