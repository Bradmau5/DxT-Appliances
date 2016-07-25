<?php

/**
  * BookingController.php
  *
  * Handles all booking related routing.
**/

class BookingController extends Controller {

  /**
   * Construct this object by extending the basic Controller class. The parent::__construct thing is necessary to
   * put checkAuthentication in here to make an entire controller only usable for logged-in users (for sure not
   * needed in the LoginController).
   */
  public function __construct()
  {
    // this entire controller should only be visible/usable by logged in users, so we put authentication-check here
    Auth::checkAuthentication();
    parent::__construct();
  }

  public function startBooking(){
    $this->View->render('booking/startbooking');
  }

  public function createBooking(){
    $booking_successfull = BookingModel::createbooking(
      Session::get('user_name'),
      Request::post('postcode'),
      Request::post('door_number'),
      Request::post('description'),
      Request::post('model_number'),
      Request::post('machine_type')
    );
    if($booking_successfull){
      $this->View->render('login/showProfile');
    }
    else {
      BookingController::startBooking();
    }

  }

  public function showCancel(){
    $this->View->render('booking/cancelbooking');
  }

  public function cancelBooking(){
    $booking_cancelled = BookingModel::cancelbooking(
      Request::get('booking_number'),
      Request::post('cancel_reason')
    );

    if($booking_cancelled){
      $this->View->render('login/showProfile');
    }
    else{
      BookingController::showCancel();
    }
  }

  public function viewBookingStatus(){
    BookingModel::fetchbooking(
      Request::get('booking_number')
    );
  }

  public function viewBookingHistory(){
    BookingModel::fetchpreviousbookings(
      Request::get('user_name')
    );
  }

}

?>
