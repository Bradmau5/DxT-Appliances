<?php
	class DashboardModel
	{
		public static function getAllJobs()
		{
			$database = DatabaseFactory::getFactory()->getConnection();

	    $sql = "SELECT * FROM BDL_Jobs WHERE job_for = :user_id ORDER BY job_date ASC, job_time ASC";
	    $query = $database->prepare($sql);
	  	$query->execute(array(':user_id' => Session::get('user_id')));

	    // fetchAll() is the PDO method that gets all result rows
	    return $query->fetchAll();
		}

		public static function getjob($job_id)
	  {
	  	$database = DatabaseFactory::getFactory()->getConnection();

	  	$sql = "SELECT * FROM BDL_Jobs WHERE Id = :job_id LIMIT 1";
	  	$query = $database->prepare($sql);
	  	$query->execute(array(':job_id' => $job_id));

	  	// fetch() is the PDO method that gets a single result
	  	return $query->fetch();
	  }

		public static function getAccounts()
		{
			$database = DatabaseFactory::getFactory()->getConnection();

			$sql = "SELECT u.* FROM BDL_UserRoles AS ur
			 				JOIN BDL_Users AS u
							ON u.user_id = ur.User_Id
							WHERE ur.User_Role = '4'";
			$query = $database->prepare($sql);
			$query->execute();

			return $query->fetchAll();
		}

		public static function getAllUsers()
		{
			$database = DatabaseFactory::getFactory()->getConnection();

			$sql = "SELECT * FROM BDL_Users";
			$query = $database->prepare($sql);
			$query->execute();

			return $query->fetchAll();
		}

	  public static function completionEmail($job_name, $user_name, $user_email, $job_comment, $job_address, $job_postcode, $job_fault)
		{
			$body = Config::get('EMAIL_JOB_COMPLETE1') . '<br /><br />
			' . $job_name . ', <br /><br />
			' . nl2br($job_address) . ',<br />
			' . $job_postcode . '<br /><br />

			<b>Fault: </b>' . $job_fault . '<br /><br />

			<b>Job Comments: </b><br />
			' . nl2br($job_comment) . '<br /><br />


			From <b>' . $user_name . '</b>';	// create instance of Mail class, try sending and check

			$database = DatabaseFactory::getFactory()->getConnection();

			$sql = "SELECT u.user_email FROM BDL_Users AS u
							JOIN BDL_UserRoles AS ur
							ON ur.User_Id = u.user_id
							WHERE ur.User_Role = '5'";
			$query = $database->prepare($sql);
			$query->execute();

			$result = $query->fetchAll();

			foreach($result as $email){
				$mail = new Mail;
				$mail_sent = $mail->sendMail($email, $user_email,
			        	$user_name, Config::get('EMAIL_JOB_COMPLETE_SUBJECT'), $body);
		  }
		}

		public static function jobAssignEmail($user_email)
		{
			$body = Config::get('EMAIL_JOB_ASSIGNED1') . '

			' . Config::get("URL");

			$mail = new Mail;
			$mail_sent = $mail->sendMail($user_email, Config::get('EMAIL_JOB_ASSIGNED_FROM_EMAIL'),
		        	Config::get('EMAIL_JOB_ASSIGNED_FROM_NAME'), Config::get('EMAIL_JOB_ASSIGNED_SUBJECT'), $body);
	  }

	  public static function markComplete($job_id)
	  {
	    $database = DatabaseFactory::getFactory()->getConnection();

	    $sql = "UPDATE BDL_Jobs SET job_done = 'Yes' WHERE Id = :job_id LIMIT 1";
	    $query = $database->prepare($sql);
	    $query->execute(array(':job_id' => $job_id));

	    if ($query->rowCount() == 1)
			{
				$sql1 = 'SELECT * FROM BDL_Jobs AS j
				 				JOIN BDL_JobsCustomers AS jc
								ON jc.Id = j.Jobs_CustomerNumber
								WHERE j.Id = :job_id';
				$query1 = $database->prepare($sql1);
				$query1->execute(array(':job_id' => $job_id));

				$result = $query1->fetch(PDO::FETCH_ASSOC);

				$job_for = $result['job_for'];

				$sqluser = 'SELECT * FROM BDL_Users WHERE user_id = :job_for';
				$queryuser = $database->prepare($sqluser);
				$queryuser->execute(array(':job_for' => $job_for));

				$resultuser = $queryuser->fetch(PDO::FETCH_ASSOC);

				$user_name_email = $resultuser['user_email'];
				$user_name = $resultuser['user_name'];
				$job_address = $result['Customer_Address'];
				$job_postcode = $result['Customer_Postcode'];
				$job_comments = $result['job_comment'];
				$job_fault = $result['job_fault'];
				$job_name = $result['Customer_Name'];

				$mail_sent = DashboardModel::completionEmail($job_name, $user_name, $user_name_email, $job_comments, $job_address, $job_postcode, $job_fault);

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

	    $sql = "UPDATE BDL_Jobs SET job_done = 'No' WHERE Id = :job_id LIMIT 1";
	    $query = $database->prepare($sql);
	    $query->execute(array(':job_id' => $job_id));

      if ($query->rowCount() == 1) {
	    	Session::add('feedback_positive', Text::get('FEEDBACK_JOB_EDITING_SUCCESS'));
	      return true;
	    }

	    Session::add('feedback_negative', Text::get('FEEDBACK_JOB_EDITING_FAILED'));
	    return false;
	  }

	  public static function updateJob($job_id, $job_comment)
	  {
	    if (!$job_id) {
	      return false;
	    }

	    $database = DatabaseFactory::getFactory()->getConnection();

	    $sql = "UPDATE BDL_Jobs SET job_comment = :job_comment WHERE Id = :job_id LIMIT 1";
	    $query = $database->prepare($sql);
			$query->execute(array(':job_id' => $job_id, ':job_comment' => $job_comment));

	  	if ($query->rowCount() == 1) {
	    	Session::add('feedback_positive', Text::get('FEEDBACK_JOB_EDITING_SUCCESS'));
	      return true;
	    }

	    Session::add('feedback_negative', Text::get('FEEDBACK_JOB_EDITING_FAILED'));
	    return false;
	  }
	}
?>
