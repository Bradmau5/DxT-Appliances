<div class="container">
	<?php if (Session::userIsLoggedIn()) : ?>
	<h1>Admin Settings - Send an Invoice</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
		<center>
			<div class="top_block jobsheetame" style="background: #666666">
				<div class="content">
					<b>Name: </b><?php echo htmlentities($this->jobs->job_name); ?>
					<br />
				</div>
			</div>
			<div class="top_block jobsheetaddress" style="background: #737373">
				<div class="content">
					<b>Address: </b><br />
					<?php echo nl2br($this->jobs->job_address); ?>
					<br />
				</div>
			</div>
			<div class="top_block jobsheetfi" style="background: #666666">
				<div class="content">
					<b>F/I: </b><?php echo '' . htmlentities($this->jobs->job_fi) . ''; ?>
					<br />
				</div>
			</div>
			<div class="top_block jobsheetmt" style="background: #737373">
				<div class="content">
					<b>Machine Type: </b><?php echo htmlentities($this->jobs->job_mt); ?>
					<br />
				</div>
			</div>
			<div class="top_block jobsheetfault" style="background: #666666">
				<div class="content">
					<b>Fault: </b><?php echo htmlentities($this->jobs->job_fault); ?>
					<br />
				</div>
			</div>
			<div class="top_block jobsheettel" style="background: #737373">
				<div class="content">
					<b>Contact Number: </b><?php echo htmlentities($this->jobs->job_tel); ?>
					<br />
				</div>
			</div>
			<div class="top_block jobsheetcomments" style="background: #666666">
				<div class="content">
					<b>Comments: </b><br />
					<?php echo nl2br($this->jobs->job_comment); ?>
					<br />
				</div>
			</div>
		</center>
    </div>
	<?php endif; ?>
</div>