<?php

class DashboardModel
{
	public static function getAllJobs()
	{
		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM jobs WHERE job_for = :user_id ORDER BY job_date ASC, job_time ASC LIMIT 20";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => Session::get('user_id')));

        // fetchAll() is the PDO method that gets all result rows
        return $query->fetchAll();
	}	

	public static function getjob($job_id)
    	{
       		$database = DatabaseFactory::getFactory()->getConnection();

        	$sql = "SELECT * FROM jobs WHERE job_id = :job_id LIMIT 1";
        	$query = $database->prepare($sql);
        	$query->execute(array(':job_id' => $job_id));

        	// fetch() is the PDO method that gets a single result
        	return $query->fetch();
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

    public static function completionEmail($job_name, $user_name, $user_email, $job_comment, $job_address_number, $job_address_street, $job_address_city, $job_address_postcode, $job_fault){
	$body = Config::get('EMAIL_JOB_COMPLETE1') . '<br /><br />
	' . $job_name . ', <br /><br />
	' . $job_address_number . ', 
	' . $job_address_street . ',<br />
	' . $job_address_city . ',<br />
	' . $job_address_postcode . '<br /><br />

	<b>Fault: </b>' . $job_fault . '<br /><br />
	
	<b>Job Comments: </b><br />
	' . nl2br($job_comment) . '<br /><br />


	From <b>' . $user_name . '</b>';	// create instance of Mail class, try sending and check
	$mail = new Mail;
	$mail_sent = $mail->sendMail("Bradley@dxtappliances.co.uk", $user_email, 
        	$user_name, Config::get('EMAIL_JOB_COMPLETE_SUBJECT'), $body
	);
    }

    public static function jobAssignEmail($user_email){
	$body = Config::get('EMAIL_JOB_ASSIGNED1') . '

	' . Config::get("URL");
	
	$mail = new Mail;
	$mail_sent = $mail->sendMail($user_email, Config::get('EMAIL_JOB_ASSIGNED_FROM_EMAIL'), 
        	Config::get('EMAIL_JOB_ASSIGNED_FROM_NAME'), Config::get('EMAIL_JOB_ASSIGNED_SUBJECT'), $body
	);
    }

    public static function markComplete($job_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE jobs SET job_done = 'Yes' WHERE job_id = :job_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':job_id' => $job_id));

        if ($query->rowCount() == 1) {

		$sql1 = 'SELECT * FROM jobs WHERE job_id = :job_id';
		$query1 = $database->prepare($sql1);
		$query1->execute(array(':job_id' => $job_id));
		
		$result = $query1->fetch(PDO::FETCH_ASSOC);

		$job_for = $result['job_for'];

		$sqluser = 'SELECT * FROM users WHERE user_id = :job_for';
		$queryuser = $database->prepare($sqluser);
		$queryuser->execute(array(':job_for' => $job_for));

		$resultuser = $queryuser->fetch(PDO::FETCH_ASSOC);

		$user_name_email = $resultuser['user_email'];
		$user_name = $resultuser['user_name'];
		$job_address_number = $result['job_address_number'];
		$job_address_street = $result['job_address_street'];
		$job_address_city = $result['job_address_city'];
		$job_address_postcode = $result['job_address_postcode'];
		$job_comments = $result['job_comment'];
		$job_fault = $result['job_fault'];
		$job_name = $result['job_name'];
		
		$mail_sent = DashboardModel::completionEmail($job_name, $user_name, $user_name_email, $job_comments, $job_address_number, $job_address_street, $job_address_city, $job_address_postcode, $job_fault);

		Session::add('feedback_positive', Text::get('FEEDBACK_JOB_COMPLETE_MAIL_SENDING_SUCCESSFUL'));
		return true;
	} else {
       		//Session::add('feedback_negative', Text::get('FEEDBACK_JOB_EDITING_FAILED'));
        	return false;
	}
    }

    public static function markIncomplete($job_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE jobs SET job_done = 'No' WHERE job_id = :job_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':job_id' => $job_id));

        if ($query->rowCount() == 1) {
            Session::add('feedback_positive', Text::get('FEEDBACK_JOB_EDITING_SUCCESS'));
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_JOB_EDITING_FAILED'));
        return false;
    }

    public static function createJob($job_name, $job_address_number, $job_address_street, $job_address_city, $job_address_postcode, $job_tel, $job_fi, $job_mt, $job_fault, $job_date, $job_time, $job_keys, $job_for, $job_account, $job_account_name)
    {

        $database = DatabaseFactory::getFactory()->getConnection();

	$myDateTime = DateTime::createFromFormat('Y-m-d', $job_date);
	$newDateString = $myDateTime->format('d-m-Y');

        $sql = "INSERT INTO jobs (job_name, job_address_number, job_address_street, job_address_city, job_address_postcode, job_tel, job_fi, job_mt, job_fault, job_date, job_time, job_keys, job_for, job_account, job_account_name)
                    VALUES(:job_name, :job_address_number, :job_address_street, :job_address_city, :job_address_postcode, :job_tel, :job_fi, :job_mt, :job_fault, :job_date, :job_time, :job_keys, :job_for, :job_account, :job_account_name)";
        $query = $database->prepare($sql);
        $query->execute(array(':job_name' => $job_name, ':job_address_number' => $job_address_number, ':job_address_street' => $job_address_street, ':job_address_city' => $job_address_city, ':job_address_postcode' => $job_address_postcode, ':job_tel' => $job_tel, ':job_fi' => $job_fi, ':job_account' => $job_account, ':job_account_name' => $job_account_name, ':job_mt' => $job_mt, ':job_fault' => $job_fault, ':job_date' => $newDateString, ':job_time' => $job_time, ':job_keys' => $job_keys, ':job_for' => $job_for));

        if ($query->rowCount() == 1) {
        	Session::add('feedback_positive', Text::get('FEEDBACK_JOB_CREATED_SUCCESS'));

		$sqluser = 'SELECT * FROM users WHERE user_id = :job_for';
		$queryuser = $database->prepare($sqluser);
		$queryuser->execute(array(':job_for' => $job_for));

		$resultuser = $queryuser->fetch(PDO::FETCH_ASSOC);

		$user_name_email = $resultuser['user_email'];

		$mail_sent = DashboardModel::jobAssignEmail($user_name_email);

            	return true;
        }

        // default return
        Session::add('feedback_negative', Text::get('FEEDBACK_JOB_CREATED_FAILED'));
        return false;
    }

    public static function updateJob($job_id, $job_comment)
    {
        if (!$job_id) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE jobs SET job_comment = :job_comment WHERE job_id = :job_id LIMIT 1";
        $query = $database->prepare($sql);
		$query->execute(array(':job_id' => $job_id, ':job_comment' => $job_comment));

        if ($query->rowCount() == 1) {
        	Session::add('feedback_positive', Text::get('FEEDBACK_JOB_EDITING_SUCCESS'));
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_JOB_EDITING_FAILED'));
        return false;
    }

    public static function deleteJob($job_id)
    {
        if (!$job_id) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE jobs SET job_deleted = 1 WHERE job_id = :job_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':job_id' => $job_id));

        if ($query->rowCount() == 1) {
            return true;
        }

        // default return
        Session::add('feedback_negative', Text::get('FEEDBACK_JOB_DELETION_FAILED'));
        return false;
    }
}