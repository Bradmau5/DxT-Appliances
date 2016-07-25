<div class="container">
  <div class="row">
    <h1 class="h1big col-lg-12 col-md-12 col-sm-12 pull-left">New Booking</h1>
  </div>

  <div class="box">
    <div class="h2shaded">Fill out the information below to submit a booking.</div>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <form action="<?php echo Config::get('URL'); ?>booking/createBooking" method="post">
      <label>Machine Type</label>
      <select name="machine_type" required>
        <option value="Washing Machine">Washing Machine</option>
        <option value="Dishwasher">Dishwasher</option>
        <option value="Oven">Oven</option>
        <option value="Hob">Hob</option>
        <option value="Washer Dryer">Washer Dryer</option>
        <option value="Tumble Dryer">Tumble Dryer</option>
        <option value="Glass Washer">Glass Washer</option>
        <option value="Fridge">Fridge</option>
        <option value="Freezer">Freezer</option>
        <option value="Fridge Freezer">Fridge Freezer</option>
      </select>

      <br />

      <label>Machine Model Number</label>
      <input type="text" name="machine_model" required />

      <br />

      <label>Description of Fault</label>
      <input type="textarea" name="description" required />

      <br />

      <label>Door Number</label>
      <input type="number" name="door_number" required />

      <br />

      <label>Postcode</label>
      <input type="text" name="postcode" required />

      <br />

      <input type="submit" value="Submit Booking" />
    </form>
  </div>
</div>
