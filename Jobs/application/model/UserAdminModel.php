<?php

  /**
    * This is the user administration model that controls all functionality todo with users.
    */

  class UserAdminModel
  {
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

  	public static function getAllEngineers()
  	{
  		$database = DatabaseFactory::getFactory()->getConnection();

  		$sql = "SELECT u.* FROM BDL_Users AS u
              JOIN BDL_UserRoles AS ur
              ON ur.User_Id = u.user_id
              WHERE ur.User_Role = '2'";
  		$query = $database->prepare($sql);
  		$query->execute();

      if($query->rowCount() >= 1)
      {
        return $query->fetchAll();
      }
      Session::add('feedback_negative', 'No engineers available.');
      return false;
  	}

    //Fix this function to work with BDL_UserRoles
    public static function updateUser($user_id, $user_account_type)
    {
      $database = DatabaseFactory::getFactory()->getConnection();

      $sql = "UPDATE BDL_Users SET user_account_type=:user_account_type WHERE user_id=:user_id LIMIT 1";
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

      $sql = "UPDATE BDL_Users SET user_deleted = 1 WHERE user_id=:user_id LIMIT 1";
      $query = $database->prepare($sql);
      $result = $query->execute(array(':user_id' => $user_id));

      if ($result) {
        Session::add('feedback_positive', Text::get('FEEDBACK_USER_UPDATED_SUCCESS'));
        return true;
      }

      Session::add('feedback_negative', Text::get('FEEDBACK_USER_UPDATED_FAILED'));
      return false;
    }
  }

?>
