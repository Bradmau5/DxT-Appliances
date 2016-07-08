<div class="container">
	<?php if (Session::userIsLoggedIn()) : ?>
    <h1>Edit Job Comments</h1>

    <div class="box">
        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <?php if ($this->jobs) { ?>
            <form method="post" action="<?php echo Config::get('URL'); ?>dashboard/editSave">
                <label>Change comments of job: </label>
                <!-- we use htmlentities() here to prevent user input with " etc. break the HTML -->
                <input type="hidden" name="job_id" value="<?php echo htmlentities($this->jobs->job_id); ?>" />
                <textarea name="job_comment" rows="10" cols="30">
<?php echo htmlentities($this->jobs->job_comment); ?>
</textarea><br />
                <input type="submit" value='Update' />
            </form>
        <?php } else { ?>
            <p>This job does not exist.</p>
        <?php } ?>
    </div>
	<?php endif; ?>
</div>
