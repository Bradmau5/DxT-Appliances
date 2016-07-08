<?php

class IndexModel

{

	public static function getQuote($name, $postcode, $type, $age, $phone, $email, $make)

	{

		$database = DatabaseFactory::getFactory()->getConnection();

			$sql = "INSERT INTO quotes (name, postcode, type, age, phone, email, make)
				VALUES (:name, :postcode, :type, :age, :phone, :email, :make)";
			$query = $database->prepare($sql);
			$query->execute(array(':postcode' => $postcode, ':name' => $name, ':type' => $type, ':age' => $age, ':phone' => $phone, ':email' => $email, ':make' => $make));

			if ($query->rowCount() == 1) {
				Redirect::to('index/quote2');
        		Session::add('feedback_positive', Text::get('FEEDBACK_VEHICLE_CREATED_SUCCESS'));
			return true;
        	}

	}



	public static function contactSend($name, $email, $phone, $postcode, $message)

	{

		$body = "You have a new email from " . $name . " (" . $email . "),<br /><br />
		" . "Their phone number is: " . $phone . " and their postcode is: " . $postcode . "<br />
		<br />
		" . "Their message is: <br /><br />" . nl2br($message) . "<br />
		<br />
		" . "You can reply to this person directly.";

		$mail = new Mail;
		$mail_sent = $mail->sendMail("info@dxtappliances.co.uk", $email, $name, "New Contact Form Submission", $body);

		$database = DatabaseFactory::getFactory()->getConnection();

		$sql = "INSERT INTO contact_details (email, name, postcode, phone, message)
			VALUES (:email, :name, :postcode, :phone, :message)";
		$query = $database->prepare($sql);
		$query->execute(array(':email' => $email, ':name' => $name, ':postcode' => $postcode, ':phone' => $phone, ':message' => $message));

		if($mail_sent && $query->rowCount() == 1){
			Session::add('feedback_positive', Text::get('CONTACT_POSITIVE'));
			return true;
		} else {
			Session::add('feedback_negative', Text::get('CONTACT_NEGATIVE'));
			return false;
		}

	}

}

?>