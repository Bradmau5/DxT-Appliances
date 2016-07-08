<div class="container">
	<?php if (Session::userIsLoggedIn()) : ?>
    <h1>Job Sheet</h1>

    <div class="box">
        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
	<?php

        if ($this->jobs) { ?>
                <br />

	<div class="center_block jobsheetmain" style="width: 300px;">
		<div class="content" style="color: #FFF;">
			<div class="top_block jobsheetname" style="background: #444242">
				<div class="content">
					<b>Name: </b><?php echo htmlentities($this->jobs->job_name); ?>
					<br />
				</div>
			</div>
			<div class="top_block jobsheetaddress" style="background: #605f5f">
				<div class="content">
					<b>Address: </b><br />
					<?php echo htmlentities($this->jobs->job_address_number) . ',<br />' . htmlentities($this->jobs->job_address_street) . ',<br />' . htmlentities($this->jobs->job_address_city) . ',<br />' . htmlentities($this->jobs->job_address_postcode); ?>
					<br />
				</div>
			</div>
			<div class="top_block jobsheetfi" style="background: #444242">
				<div class="content">
					<b>F/I: </b><?php echo htmlentities($this->jobs->job_fi); ?>
					<br />
				</div>
			</div>
			<div class="top_block jobsheetmt" style="background: #605f5f">
				<div class="content">
					<b>Machine Type: </b><?php echo htmlentities($this->jobs->job_mt); ?>
					<br />
				</div>
			</div>
			<div class="top_block jobsheetfault" style="background: #444242">
				<div class="content">
					<b>Fault: </b><?php echo htmlentities($this->jobs->job_fault); ?>
					<br />
				</div>
			</div>
			<div class="top_block jobsheettel" style="background: #605f5f">
				<div class="content">
					<b>Contact Number: </b><?php echo htmlentities($this->jobs->job_tel); ?>
					<br />
				</div>
			</div>
			<div class="top_block jobsheetcomments" style="background: #444242">
				<div class="content">
					<b>Comments: </b><br />
					<?php echo nl2br($this->jobs->job_comment); ?>
					<br />
				</div>
			</div>
			<div class="top_block jobsheetkeys" style="background: #605f5f">
				<div class="content">
					<b>Keys Needed?: </b><?php echo htmlentities($this->jobs->job_keys); ?>
					<br />
				</div>
			</div>
			<div class="top_block jobsheetcomments" style="background: #444242">
				<div class="content">
					<b>Account: </b><?php if($this->jobs->job_account == 1){ echo 'Yes'; } else { echo 'No'; } ?>
					<br />
				</div>
			</div>
		</div>
	</div>
	<br />
        <a href=<?php echo Config::get('URL') . "dashboard/edit/" . htmlentities($this->jobs->job_id); ?> >Add/Edit Comments</a>
        <?php } else { ?>
            <p>This job does not exist.</p>
        <?php } ?>
    </div>
	<?php endif; ?>
</div>
