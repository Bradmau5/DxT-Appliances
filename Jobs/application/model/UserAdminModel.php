<?php

/**
  * This is the user administration model that controls all functionality todo with users.
  */

class UserAdminModel
{
  public static function getAccounts()
	{
		$database = DatabaseFactory::getFactory()->getConnection();

		$sql = "SELECT * FROM users WHERE user_account_type = '4'";
		$query = $database->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}

	public static function getAllUsers()
	{
		$database = DatabaseFactory::getFactory()->getConnection();

		$sql = "SELECT * FROM users";
		$query = $database->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}

	public static function getAllEngineers()
	{
		$database = DatabaseFactory::getFactory()->getConnection();

		$sql = "SELECT * FROM users WHERE user_engineer = 1";
		$query = $database->prepare($sql);
		$query->execute();

		return $query->fetchAll();
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
}

?>
