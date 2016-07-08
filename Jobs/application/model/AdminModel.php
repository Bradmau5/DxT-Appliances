<?php

class AdminModel
{
	public static function getAllJobs()
	{
		$database = DatabaseFactory::getFactory()->getConnection();
	
        	$sql = "SELECT * FROM jobs";
       		$query = $database->prepare($sql);
        	$query->execute();

        	// fetchAll() is the PDO method that gets all result rows
        	return $query->fetchAll();
	}

	public static function getAccounts(){
		$database = DatabaseFactory::getFactory()->getConnection();

		$sql = "SELECT * FROM users WHERE user_account_type = '4'";
		$query = $database->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}

	public static function getAllUsers(){
		$database = DatabaseFactory::getFactory()->getConnection();

		$sql = "SELECT * FROM users";
		$query = $database->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}


	public static function getAllEngineers(){
		$database = DatabaseFactory::getFactory()->getConnection();

		$sql = "SELECT * FROM users WHERE user_engineer = 1";
		$query = $database->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}

	public static function sendInvoiceEmail($client_email, $jobsheet)
	{	
		$mail = new Mail;
		$mail_sent = $mail->sendMail($client_email, Text::get('EMAIL_INVOICE_FROM_EMAIL'), 
        	Text::get('EMAIL_INVOICE_FROM_NAME'), Text::get('EMAIL_INVOICE_SUBJECT'), $jobsheet);
	}

	public static function getAllStock()
	{
		$database = DatabaseFactory::getFactory()->getConnection();
	
        	$sql = "SELECT * FROM inventory";
       		$query = $database->prepare($sql);
        	$query->execute();

        	// fetchAll() is the PDO method that gets all result rows
        	return $query->fetchAll();
	}

	public static function getAllVehicles()
	{
		$database = DatabaseFactory::getFactory()->getConnection();
	
        	$sql = "SELECT * FROM vehicles AS v 
        			JOIN inventory AS i
        			ON v.v_id = i.item_location";
       		$query = $database->prepare($sql);
        	$query->execute();

        	// fetchAll() is the PDO method that gets all result rows
        	return $query->fetchAll();
	}

	public static function createStockLocation($v_type, $v_make, $v_model, $v_assigned, $v_reg, $v_mot, $v_tax)
    	{

        	$database = DatabaseFactory::getFactory()->getConnection();

        	$sql = "INSERT INTO vehicles (v_type, v_make, v_model, v_assigned, v_reg, v_mot, v_tax)
        	            VALUES(:v_type, :v_make, :v_model, :v_assigned, :v_reg, :v_mot, :v_tax)";
        	$query = $database->prepare($sql);
        	$query->execute(array(':v_type' => $v_type, ':v_make' => $v_make, ':v_model' => $v_model, ':v_assigned' => $v_assigned, ':v_reg' => $v_reg, ':v_mot' => $v_mot, ':v_tax' => $v_tax));

        	if ($query->rowCount() == 1) {
        		Session::add('feedback_positive', Text::get('FEEDBACK_VEHICLE_CREATED_SUCCESS'));
			return true;
        	}

        	// default return
       		Session::add('feedback_negative', Text::get('FEEDBACK_VEHICLE_CREATED_FAILED'));
        	return false;
    	}

	public static function stockMove($item_code, $item_quant_move, $item_name_move)
	{
		$database = DatabaseFactory::getFactory()->getConnection();
		
		$sql = "UPDATE inventory SET item_quant=item_quant+:item_quant WHERE item_code=:item_code LIMIT 1";
		$query = $database->prepare($sql);
		$result = $query->execute(array(':item_quant' => $item_quant, ':item_code' => $item_code));

		if ($result) {
			Session::add('feedback_positive', Text::get('FEEDBACK_STOCK_UPDATED_SUCCESS'));
			return true;
		}

		Session::add('feedback_negative', Text::get('FEEDBACK_STOCK_UPDATED_FAILED'));
		return false;

	}

	public static function assignJobs($jobs_id, $jobs_for)
	{
		foreach($jobs_id as $key => $job_id){
			$database = DatabaseFactory::getFactory()->getConnection();

			$sql = "UPDATE jobs SET job_for=:job_for WHERE job_id=:job_id LIMIT 1";
			$query = $database->prepare($sql);
			$query->execute(array(':job_for' => $jobs_for[$key], ':job_id' => $job_id));
			if ($query->rowCount() == 1) {
				$sqluser = 'SELECT * FROM users WHERE user_id = :user_id LIMIT 1';
				$queryuser = $database->prepare($sqluser);
				$queryuser->execute(array(':user_id' => $jobs_for[$key]));
				if($queryuser->rowCount() == 1){
					$resultuser = $queryuser->fetch(PDO::FETCH_ASSOC);
					$user_name_email = $resultuser['user_email'];
					$mail_sent = AdminModel::jobAssignEmail($user_name_email);

					Session::add('feedback_positive', 'Jobs Assigned.'); //. $job_id . ' for ' . $jobs_for[$key]);
				
					//Session::add('feedback_negative', 'Failed to send email.' . $jobs_for[$key]);
				}
				//Session::add('feedback_negative', 'Failed to find user.' . $jobs_for[$key]);
			}
			//Session::add('feedback_negative', 'Failed to update job.');
			//return true;
		}
		return true;
	}

	public static function jobAssignEmail($user_email){
	$body = Config::get('EMAIL_JOB_ASSIGNED1') . '

	' . Config::get("URL");
	
	$mail = new Mail;
	$mail_sent = $mail->sendMail($user_email, Config::get('EMAIL_JOB_ASSIGNED_FROM_EMAIL'), 
        	Config::get('EMAIL_JOB_ASSIGNED_FROM_NAME'), Config::get('EMAIL_JOB_ASSIGNED_SUBJECT'), $body
	);
    }

	public static function declineJob($job_id)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

		$sql1 = "SELECT * FROM jobs WHERE job_id = :job_id LIMIT 1";
		$query1 = $database->prepare($sql1);
		$query1->execute(array(':job_id' => $job_id));
			
		if($query1->rowCount() == 1){

			$result = $query1->fetch(PDO::FETCH_ASSOC);

			$job_for = $result['job_for'];
			$job_address_number = $result['job_address_number'];
			$job_address_street = $result['job_address_street'];
			$job_address_city = $result['job_address_city'];
			$job_address_postcode = $result['job_address_postcode'];

			$sqluser = "SELECT * FROM users WHERE user_id=:job_for LIMIT 1";
			$queryuser = $database->prepare($sqluser);
			$queryuser->execute(array(':job_for' => $job_for));

			if($queryuser->rowCount() == 1){

				$resultuser = $queryuser->fetch(PDO::FETCH_ASSOC);

				$user_email = $resultuser['user_email'];
				$user_fullname = $resultuser['user_fullname'];
					
				$mail_sent = AdminModel::jobDeclineEmail($user_email, $user_fullname, $job_address_number, $job_address_street, $job_address_city, $job_address_postcode);

				$sql = "UPDATE jobs SET job_for='0' WHERE job_id=:job_id LIMIT 1";
				$query = $database->prepare($sql);
				$query->execute(array(':job_id' => $job_id));

				if ($query->rowCount() == 1 && $mail_sent) {
					//Session::add('feedback_positive', 'Job Declined. ID:' . $job_id . '. User Name: ' . $user_fullname);
					return true;
				}
			}
			//Session::add('feedback_positive', 'Job Declined. ID:' . $job_id . '. User Name: ' . $job_for);
			return false;
		}
		Session::add('feedback_negative', 'Failed to decline job.');
		return false;
	}

	public static function jobDeclineEmail($user_email, $user_name, $job_address_number, $job_address_street, $job_address_city, $job_address_postcode){

		$body = 'Hello Admin,<br />
		<br />
		' . $user_name . ' has declined the following job.<br />
		<br />
		' . $job_address_number . ' ' . $job_address_street . ',<br />
		' . $job_address_city . ',<br />
		' . $job_address_postcode;

		$mail = new Mail;
		$mail_sent = $mail->sendMail('Bradley@dxtappliances.co.uk', $user_email, $user_name, 'Declined Job', $body);
		Session::add('feedback_positive', 'Sent job decline email.');
		return true;
    }


	public static function updateUser($user_id, $user_account_type)
	{
		$database = DatabaseFactory::getFactory()->getConnection();
		
		$sql = "UPDATE users SET user_account_type=:user_account_type WHERE user_id=:user_id LIMIT 1";
		$query = $database->prepare($sql);
		$result = $query->execute(array(':user_account_type' => $user_account_type, ':user_id' => $user_id));

		if ($result) {
			Session::add('feedback_positive', Text::get('FEEDBACK_USER_UPDATED_SUCCESS'));
			return true;
		}

		Session::add('feedback_negative', Text::get('FEEDBACK_USER_UPDATED_FAILED'));
		return false;
	}

	public static function deleteUser($user_id)
	{
		$database = DatabaseFactory::getFactory()->getConnection();
		
		$sql = "UPDATE users SET user_deleted = 1 WHERE user_id=:user_id LIMIT 1";
		$query = $database->prepare($sql);
		$result = $query->execute(array(':user_id' => $user_id));

		if ($result) {
			Session::add('feedback_positive', Text::get('FEEDBACK_USER_UPDATED_SUCCESS'));
			return true;
		}

		Session::add('feedback_negative', Text::get('FEEDBACK_USER_UPDATED_FAILED'));
		return false;
	}
	
	public static function addItemToStock($item_code, $item_name, $item_description, $item_make, $item_cost, $item_resell, $item_location, $item_quant)
	{
		$database = DatabaseFactory::getFactory()->getConnection();
		
		$sql = "INSERT INTO inventory (item_code, item_name, item_description, item_make, item_cost, item_resell, item_location, item_quant)
			VALUES (:item_code, :item_name, :item_description, :item_make, :item_cost, :item_resell, :item_location, :item_quant)";

		$query = $database->prepare($sql);
		$query->execute(array(':item_code' => $item_code, ':item_name' => $item_name, ':item_description' => $item_description, ':item_make' => $item_make, ':item_cost' => $item_cost, ':item_resell' => $item_resell, ':item_location' => $item_location, ':item_quant' => $item_quant));

		if ($query->rowCount() == 1)
		{
			Session::add('feedback_positive', Text::get('FEEDBACK_ITEM_ADDED_TO_STOCK_SUCCESS'));
			return true;
		}

		Session::add('feedback_negative', Text::get('FEEDBACK_ITEM_ADDED_TO_STOCK_FAILED'));
		return false;
	}

	public static function removeFromStock($item_code)
	{
		$database = DatabaseFactory::getFactory()->getConnection();
		
		$sql = "DELETE * FROM inventory WHERE item_code = :item_code";

		$query = $database->prepare($sql);
		$query->execute(array(':item_code' => $item_code));

		if ($query->rowCount() == 1)
		{
			Session::add('feedback_positive', Text::get('FEEDBACK_ITEM_ADDED_TO_STOCK_SUCCESS'));
			return true;
		}

		Session::add('feedback_negative', Text::get('FEEDBACK_ITEM_ADDED_TO_STOCK_FAILED'));
		return false;
	}

	public static function search($search_terms){
		$database = DatabaseFactory::getFactory()->getConnection();

		$sql = "SELECT * FROM inventory WHERE item_code LIKE :search_terms OR item_name LIKE :search_terms ORDER BY item_name";

		$query = $database->prepare($sql);
		$query->execute(array(':search_terms' => '%' . $search_terms . '%'));

		$result = $query->fetchAll();		

		if ($result)
		{
			echo '<table>';
			echo '<thead>';
			echo '<th>Item Code</th> <th>Item Name</th>';
			echo '</thead>';
			echo '<tbody>';
			foreach ($result as $val) {
				echo '<tr>';
				echo '<td>' . $val->item_code . '</td> <td>' . $val->item_name . '</td>';
				echo '</tr>';
			}
			echo '</tbody>';
			echo '</table>';
			
			return true;
		}
		
		return false;
	}

	public static function createJob($job_name, $job_address_number, $job_address_street, $job_address_city, $job_address_postcode, $job_tel, $job_fi, $job_mt, $job_fault, $job_date, $job_time, $job_keys, $job_account, $job_account_name)
    {

        $database = DatabaseFactory::getFactory()->getConnection();

		$myDateTime = DateTime::createFromFormat('Y-m-d', $job_date);
		$newDateString = $myDateTime->format('d-m-Y');

        $sql = "INSERT INTO jobs (job_name, job_address_number, job_address_street, job_address_city, job_address_postcode, job_tel, job_fi, job_mt, job_fault, job_date, job_time, job_keys, job_account, job_account_name)
                    VALUES(:job_name, :job_address_number, :job_address_street, :job_address_city, :job_address_postcode, :job_tel, :job_fi, :job_mt, :job_fault, :job_date, :job_time, :job_keys, :job_account, :job_account_name)";
        $query = $database->prepare($sql);
        $query->execute(array(':job_name' => $job_name, ':job_address_number' => $job_address_number, ':job_address_street' => $job_address_street, ':job_address_city' => $job_address_city, ':job_address_postcode' => $job_address_postcode, ':job_tel' => $job_tel, ':job_fi' => $job_fi, ':job_account' => $job_account, ':job_account_name' => $job_account_name, ':job_mt' => $job_mt, ':job_fault' => $job_fault, ':job_date' => $newDateString, ':job_time' => $job_time, ':job_keys' => $job_keys));

        if ($query->rowCount() == 1) {
        	Session::add('feedback_positive', Text::get('FEEDBACK_JOB_CREATED_SUCCESS'));
            return true;
        }

        // default return
        Session::add('feedback_negative', Text::get('FEEDBACK_JOB_CREATED_FAILED'));
        return false;
    }
}