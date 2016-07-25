    <div class="container">
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                  <!-- echo out the system feedback (error and success messages) -->
                    <?php $this->renderFeedbackMessages(); ?>
                    <hr>
                    <h2 class="intro-text text-center">Contact
                        <strong>dxt appliances</strong>
                    </h2>
                    <hr>
                </div>
                <div class="col-md-8">
               		 <iframe src="https://www.google.com/maps/d/embed?mid=zBDqYnpVY8zE.kGqybmicd014" width="100%" height="400" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                    <!-- Embedded Google Map using an iframe - to select your location find it on Google maps and paste the link as the iframe src. If you want to use the Google Maps API instead then have at it! -->
                </div>
                <div class="col-md-4">
                    <p>Phone:
                        <strong>07712 234 134</strong>
                    </p>
                    <p>Email:
                        <strong><a href="mailto:info@ss-web.co.uk">info@ss-web.co.uk</a></strong>
                    </p>
                    <p>Address:
                        <strong>Ravensbury Road,
                            <br>Orpington, Kent, BR5</strong>
                    </p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Contact
                        <strong>form</strong>
                    </h2>
                    <hr>
                    <p>Use the form below to contact us.<br />
                    If applicable please include the following details: Type of Machine, Make, Model and Age.</p>
                    <form method="post" action="<?php echo Config::get('URL');?>index/contactsend">
                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label>Name</label>
                                <input type="text" name="contact_name" class="form-control">
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Email Address</label>
                                <input type="email" name="contact_email" class="form-control">
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Phone Number</label>
                                <input type="tel" name="contact_phone" class="form-control">
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Post Code</label>
                                <input type="text" name="contact_postcode" class="form-control">
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-12">
                                <label>Message</label>
                                <textarea class="form-control" name="contact_message" rows="6"></textarea>
                            </div>
                            <div class="form-group col-lg-12">
                                <input type="hidden" name="save" value="contact">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->
