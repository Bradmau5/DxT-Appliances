<div class="container">
	<?php if (Session::userIsLoggedIn()) : ?>
    <h1>Job Administration - Assign Jobs</h1>
    <div class="box">
        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
        <h3>Listed below are jobs that need assigning</h3>
        <p>
            <center>
                <?php if ($this->jobs) { ?>
                <form method="post" action="<?php echo Config::get('URL');?>admin/jobassign">
                    <table style="width=100%" border="2px" border-style="solid" text-align="center">
                        <thead>
                            <tr>
                                <th hidden>Job ID</th> <th>Name</th> <th>Address</th> <th>Contact</th> <th>Date Booked</th> <th>Time</th> <th>Assign Job To?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($this->jobs as $key => $value){
                                    if($value->job_for == 'None'){
                                        echo '<tr>';
                                        echo '<td hidden><input type="hidden" name="job_id[]" value="' . htmlentities($value->Id) . '"/></td> <td>' .
                                        htmlentities($value->job_name) . '</td> <td>' .
                                        htmlentities($value->job_address) . ',<br />' .
                                        htmlentities($value->job_postcode) . '</td> <td>' .
                                        htmlentities($value->job_tel) . '</td> <td>' .
                                        htmlentities($value->job_date) . '</td> <td>' .
                                        htmlentities($value->job_time) . '</td>';
                                        echo '<td><select name="job_for[]">';
                                        echo '<option value="0">Unassigned</option>';
                                        foreach($this->engineers as $key => $engineers){
                                            echo '<option value="' . htmlentities($engineers->user_id) . '">' . htmlentities($engineers->user_name) . '</option>';
                                        }
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                    <br />
    		        <input type="submit" value="Assign Jobs" /><br />
		        </form>
                <?php } else { ?>
                    <div>No jobs yet.</div>
                <?php } ?>
            </center>
        <p>
    </div>
	<?php endif; ?>
</div>
