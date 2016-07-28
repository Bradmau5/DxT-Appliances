<?php

/**
  * This is the stock model that controls all functionality todo with stock control.
  */

class StockModel
{
  public static function getAllStock()
	{
		$database = DatabaseFactory::getFactory()->getConnection();

    $sql = "SELECT * FROM inventory";
    $query = $database->prepare($sql);
    $query->execute();

    return $query->fetchAll();
	}

  public static function lowStockEmail(){
    $database = DatabaseFactory::getFactory()->getConnection();

    $sql = "SELECT item_code, item_name, item_quant FROM inventory WHERE item_quant <= 2";
    $query = $database->prepare($sql);
    $query->execute();

    $result = $query->fetchAll();

    if($query->rowCount() >= 1)
    {
      $user_email = Session::get('user_email');

      $body = Config::get('EMAIL_STOCK_CONTENT')
      . foreach($result as $val){
        echo $val->item_code . ' - ' . $val->item_name . ' - ' . $val->item_quant . '<br />'
      };

      $mail = new Mail;
      $mail_sent = $mail->sendMail($user_email,
                                  Config::get('EMAIL_STOCK_FROM_EMAIL'),
                                  Config::get('EMAIL_STOCK_FROM_NAME'),
                                  Config::get('EMAIL_STOCK_SUBJECT'), $body);
      return true;
    }
    return false;
  }

  public static function createStockLocation($v_type, $v_make, $v_model, $v_assigned, $v_reg, $v_mot, $v_tax)
	{
  	$database = DatabaseFactory::getFactory()->getConnection();

    $sql = "INSERT INTO vehicles (v_type, v_make, v_model, v_assigned, v_reg, v_mot, v_tax)
                VALUES(:v_type, :v_make, :v_model, :v_assigned, :v_reg, :v_mot, :v_tax)";
    $query = $database->prepare($sql);
    $query->execute(array(':v_type' => $v_type,
                          ':v_make' => $v_make,
                          ':v_model' => $v_model,
                          ':v_assigned' => $v_assigned,
                          ':v_reg' => $v_reg,
                          ':v_mot' => $v_mot,
                          ':v_tax' => $v_tax));

    if ($query->rowCount() == 1)
    {
      Session::add('feedback_positive', Text::get('FEEDBACK_VEHICLE_CREATED_SUCCESS'));
			return true;
  	}

    Session::add('feedback_negative', Text::get('FEEDBACK_VEHICLE_CREATED_FAILED'));
    return false;
  }

	public static function stockMove($item_code, $item_quant_move, $item_name_move)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

		$sql = "UPDATE inventory SET item_quant += :item_quant WHERE item_code=:item_code LIMIT 1";
		$query = $database->prepare($sql);
		$result = $query->execute(array(':item_quant' => $item_quant, ':item_code' => $item_code));

		if ($result)
    {
			Session::add('feedback_positive', Text::get('FEEDBACK_STOCK_UPDATED_SUCCESS'));
			return true;
		}

		Session::add('feedback_negative', Text::get('FEEDBACK_STOCK_UPDATED_FAILED'));
		return false;
	}

  public static function stockUpdate($item_id, $item_quant)
  {
    $database = DatabaseFactory::getFactory()->getConnection();

    $sql = "UPDATE inventory SET item_quant += :item_quant
            WHERE item_id = :item_id";
    $query = $database->prepare($sql);
    $query->execute(array(':item_id' => $item_id, ':item_quant' => $item_quant));

    if ($query->rowCount() == 1)
    {
      Session::add('feedback_positive', Text::get('FEEDBACK_ITEM_ADDED_TO_STOCK_SUCCESS'));
      return true;
    }

    Session::add('feedback_negative', Text::get('FEEDBACK_ITEM_ADDED_TO_STOCK_FAILED'));
    return false;
  }

  public static function addItem($item_code, $item_name, $item_description, $item_make, $item_cost, $item_resell)
  {
    $database = DatabaseFactory::getFactory()->getConnection();

    $sql = "INSERT INTO inventory (item_code, item_name, item_description, item_make, item_cost, item_resell)
      VALUES (:item_code, :item_name, :item_description, :item_make, :item_cost, :item_resell)";
    $query = $database->prepare($sql);
    $query->execute(array(':item_code' => $item_code,
                          ':item_name' => $item_name,
                          ':item_description' => $item_description,
                          ':item_make' => $item_make,
                          ':item_cost' => $item_cost,
                          ':item_resell' => $item_resell));

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
}

?>
