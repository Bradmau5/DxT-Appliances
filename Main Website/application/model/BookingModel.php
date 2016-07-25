<?php

/**
  * BookingModel.php
  *
  * BookingModel handles all booking related functions.
**/

  public static function createbooking($username, $postcode, $doornumber, $description, $modenumber, $machinetype){
    if(empty($doornumber) OR empty($postcode) OR empty($description) OR empty($modelnumber) OR empty($machinetype)){
      Session::add('feedback_negative', echo 'You missed a field. Please ensure all fields are filled in.');
      return false;
    }

    $database = DatabaseFactory::getFactory->getConnection();

    $sql = "INSERT INTO bookings (user_name, postcode, doornumber, description, modelnumber, machinetype)
            VALUES (:username, :postcode, :doornumber, :description, :modelnumber, :machinetype)";

    $query = $database->prepare($sql);
    $query->execute(array(':username' => $username,
                          ':postcode' => $postcode,
                          ':doornumber' => $doornumber,
                          ':description' => $description,
                          ':modelnumber' => $modelnumber,
                          ':machinetype' => $machinetype));

    $count =  $query->rowCount();
    if ($count == 1) {
    	return true;
    }

    return false;
  }

  public static function cancelbooking($booking_id, $reason){
    if(empty($reason)){
      Session::add('feedback_negative', echo 'Please provide a cancellation reason.');
      return false;
    }

    $database = DatabaseFactory::getFactory->getConnection();

    $sql = "DELETE FROM bookings WHERE booking_id = :booking_id";

    $query = $database->prepare($sql);
    $query->execute(array(':booking_id' => $booking_id));

    $sqlr = "SELECT booking_id FROM bookings WHERE booking_id = :booking_id";

    $queryr = $database->prepare($sqlr);
    $queryr->execute(array(':booking_id' => $booking_id));

    $countr = $queryr->rowCount();

    if ($countr == 0){
      return true;
    }

    return false;
  }

?>
