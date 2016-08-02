<?php

  /**
    * This is the job model that controls all functionality todo with jobs.
    */
  class JobModel
  {

    public static function sendInvoiceEmail($client_email, $jobsheet)
    {
      $mail = new Mail;
      $mail_sent = $mail->sendMail($client_email, Text::get('EMAIL_INVOICE_FROM_EMAIL'),
            Text::get('EMAIL_INVOICE_FROM_NAME'), Text::get('EMAIL_INVOICE_SUBJECT'), $jobsheet);
    }

    public static function getAllJobs()
  	{
  		$database = DatabaseFactory::getFactory()->getConnection();

      $sql = "SELECT * FROM BDL_Jobs";
      $query = $database->prepare($sql);
      $query->execute();

      // fetchAll() is the PDO method that gets all result rows
      return $query->fetchAll();
  	}

    public static function jobDeclineEmail($user_email, $user_name, $job_address, $job_postcode)
    {
      $database = DatabaseFactory::getFactory()->getConnection();

      $sql = "SELECT * FROM BDL_Users AS u
              JOIN BDL_UserRoles AS ur
              ON ur.User_Id = U.user_id
              WHERE ur.User_Role = 3";
      $query = $database->prepare($sql);
      $query->execute();

      $result = $query->fetchAll();

      if($query->rowCount() >= 1){
        foreach($result as $user){
          $body = 'Hello' . $user->user_name . ',<br /><br />'
          . $user_name .
          ' has declined the following job.<br /><br />'
          . $job_address .
          ',<br />'
          . $job_postcode;

          $mail = new Mail;
          $mail_sent = $mail->sendMail($user->user_email, $user_email, $user_name, 'Declined Job', $body);
        }
        Session::add('feedback_positive', 'Sent job decline email.');
        return true;
      }

      return false;
    }

    public static function assignJobs($jobs_id, $jobs_for)
    {
      foreach($jobs_id as $key => $job_id){
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE BDL_Jobs SET job_for=:job_for WHERE Id=:job_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':job_for' => $jobs_for[$key], ':job_id' => $job_id));
        if ($query->rowCount() == 1) {
          $sqluser = 'SELECT * FROM BDL_Users WHERE user_id = :user_id LIMIT 1';
          $queryuser = $database->prepare($sqluser);
          $queryuser->execute(array(':user_id' => $jobs_for[$key]));
          if($queryuser->rowCount() == 1){
            $resultuser = $queryuser->fetch(PDO::FETCH_ASSOC);
            $user_name_email = $resultuser['user_email'];
            $mail_sent = AdminModel::jobAssignEmail($user_name_email);

            Session::add('feedback_positive', 'Jobs Assigned.');
            return true;
          }
          return false;
        }
        return false;
      }
      return false;
    }

    public static function jobAssignEmail($user_email)
    {
      $body = Config::get('EMAIL_JOB_ASSIGNED1') . '<br />' . Config::get("URL");

      $mail = new Mail;
      $mail_sent = $mail->sendMail($user_email,
                                  Config::get('EMAIL_JOB_ASSIGNED_FROM_EMAIL'),
                                  Config::get('EMAIL_JOB_ASSIGNED_FROM_NAME'),
                                  Config::get('EMAIL_JOB_ASSIGNED_SUBJECT'),
                                  $body);
    }

    public static function declineJob($job_id)
    {
      $database = DatabaseFactory::getFactory()->getConnection();

      $sql1 = "SELECT * FROM BDL_Jobs WHERE Id = :job_id LIMIT 1";
      $query1 = $database->prepare($sql1);
      $query1->execute(array(':job_id' => $job_id));

      if($query1->rowCount() == 1){

        $result = $query1->fetch(PDO::FETCH_ASSOC);

        $job_for = $result['job_for'];
        $job_address = $result['job_address'];
        $job_postcode = $result['job_postcode'];

        $sqluser = "SELECT * FROM BDL_Users WHERE user_id=:job_for LIMIT 1";
        $queryuser = $database->prepare($sqluser);
        $queryuser->execute(array(':job_for' => $job_for));

        if($queryuser->rowCount() == 1){

          $resultuser = $queryuser->fetch(PDO::FETCH_ASSOC);

          $user_email = $resultuser['user_email'];
          $user_fullname = $resultuser['user_fullname'];

          $mail_sent = AdminModel::jobDeclineEmail($user_email,
                                                  $user_fullname,
                                                  $job_address,
                                                  $job_postcode);

          $sql = "UPDATE BDL_Jobs SET job_for = 'None' WHERE Id = :job_id LIMIT 1";
          $query = $database->prepare($sql);
          $query->execute(array(':job_id' => $job_id));

          if ($query->rowCount() == 1 && $mail_sent) {
            Session::add('feedback_positive', 'Job Declined.');
            return true;
          }
          return false;
        }
        return false;
      }
      Session::add('feedback_negative', 'Failed to decline job.');
      return false;
    }

    public static function createJob($job_name, $job_address, $job_postcode, $job_contactnumber, $job_fi, $job_mt, $job_fault, $job_date, $job_time, $job_keys, $job_for, $job_account, $job_account_name)
    {

        $database = DatabaseFactory::getFactory()->getConnection();

        $myDateTime = DateTime::createFromFormat('Y-m-d', $job_date);
        $newDateString = $myDateTime->format('d-m-Y');

        $sql = "INSERT INTO jobs (job_fi, job_mt, job_fault, job_date, job_time, job_keys, job_for, job_account, job_account_name)
                    VALUES(:job_fi, :job_mt, :job_fault, :job_date, :job_time, :job_keys, :job_for, :job_account, :job_account_name)";
        $query = $database->prepare($sql);
        $query->execute(array(':job_fi' => $job_fi,
                              ':job_account' => $job_account,
                              ':job_account_name' => $job_account_name,
                              ':job_mt' => $job_mt,
                              ':job_fault' => $job_fault,
                              ':job_date' => $newDateString,
                              ':job_time' => $job_time,
                              ':job_keys' => $job_keys,
                              ':job_for' => $job_for));

        $sqlCustomers = "INSERT INTO BDL_JobsCustomers (Customer_Name, Customer_Address, Customer_Postcode, Customer_ContactNumber)
                                                VALUES (:job_name, :job_address, job_postcode, job_contactnumber)";
        $customerQuery = $database->prepare($sqlCustomers);
        $customerQuery->execute(array(':job_name' => $job_name,
                                      ':job_address' => $job_address,
                                      ':job_postcode' => $job_postcode,
                                      ':job_contactnumber' => $job_contactnumber));

        if ($query->rowCount() == 1) {
          Session::add('feedback_positive', Text::get('FEEDBACK_JOB_CREATED_SUCCESS'));
          return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_JOB_CREATED_FAILED'));
        return false;
    }
    public static function deleteJob($job_id)
    {
        if (!$job_id) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE BDL_Jobs SET job_deleted = 1 WHERE Id = :job_id LIMIT 1";
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
?>
