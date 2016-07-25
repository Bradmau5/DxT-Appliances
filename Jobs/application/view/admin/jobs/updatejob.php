<div class="container">
	<?php if (Session::userIsLoggedIn()) : ?>
    <h1>Job Summary Page</h1>
    <div class="box">
        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
        <h3>Listed below are your current jobs</h3>
        <p>
            <center>
                <?php if ($this->jobs) { ?>
                <table style="width=100%" border="2px" border-style="solid">
                    <thead>
                        <tr>
                            <th hidden>Job ID</th> <th hidden>Job Account</th> <th hidden>Job Account Name</th> <th>Name</th> <th>Address</th> <th>Contact</th> <th>Date Booked</th> <th>Time</th> <th>Completed?</th> <th>Job Sheet</th> <th>Job Status</th> <th>Remove Job</th>
                        </tr>
                    </thead>
                     <tbody>
                        

                        <?php foreach($this->jobs as $key => $value) {
			if($value->job_deleted == 0){
                            echo '<tr>';
                            echo '<td hidden>' . htmlentities($value->job_id) . '</td> <td hidden>' . htmlentities($value->job_account) . '</td> <td hidden>' . htmlentities($value->job_account_name) . '</td> <td>' . htmlentities($value->job_name) . '</td> <td>' . htmlentities($value->job_address) . '</td> <td>' . htmlentities($value->job_tel) . '</td> <td>' . htmlentities($value->job_date) . '</td> <td>' . htmlentities($value->job_time) . '</td> <td>' . htmlentities($value->job_done) . '</td>';
                            echo '<td><a href=' . Config::get('URL') . 'dashboard/jobsheet/' . $value->job_id . '><img src="../../css/images/comment.png" width="30" height="30"></a></td>';
                            if($value->job_done == "No"){
                                echo '<td><a href=' . Config::get('URL') . 'dashboard/complete/' . $value->job_id . '><img src="../../css/images/cross.png" width="30" height="30"></a></td>';
                            }
                            else {
                                echo '<td><a href=' . Config::get('URL') . 'dashboard/incomplete/' . $value->job_id . '><img src="../../css/images/tick.gif" width="30" height="30"></a></td>';
                            }
                            echo '<td><a href=' . Config::get('URL') . 'dashboard/delete/' . $value->job_id . '><img src="../../css/images/delete.png" width="30" height="30"></a></td>';
                            echo '</tr>';
			}
                        } ?>
                </table>
                <?php } else { ?>
                    <div>No jobs yet.</div>
                <?php } ?>
            </center>
        <p>
    </div>
	<?php endif; ?>
</div>
