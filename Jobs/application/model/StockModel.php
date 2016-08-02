<?php

/**
  * This is the stock model that controls all functionality todo with stock control.
  */

class StockModel
{
  public static function getAllStock()
	{
		$database = DatabaseFactory::getFactory()->getConnection();

    $sql = "SELECT * FROM BDL_Stock";
    $query = $database->prepare($sql);
    $query->execute();

    return $query->fetchAll();
	}

  public static function lowStockEmail(){
    $database = DatabaseFactory::getFactory()->getConnection();

    $sql = "SELECT Stock_Code, Stock_Name, Stock_Quantity FROM BDL_Stock WHERE Stock_Quantity <= 2";
    $query = $database->prepare($sql);
    $query->execute();

    $result = $query->fetchAll();

    if($query->rowCount() >= 1)
    {
      $user_email = Session::get('user_email');
      $bodymain = '<table><thead><th>Item Code</th><th>Item Name</th><th>Quantity Left</th></thead><tbody>';
      $bodyend = '</tbody></table>';

      foreach($result as $val){
         $bodycontent .= '<tr> <td>' . $val->Stock_Code . '</td> <td>' . $val->Stock_NAame . '</td> <td>' . $val->Stock_Quantity . '</td> </tr>';
       }

      $body = Config::get('EMAIL_STOCK_CONTENT') . '<br /><br />' . $bodymain . $bodycontent . $bodyend;


      $mail = new Mail;
      $mail_sent = $mail->sendMail($user_email,
                                  Config::get('EMAIL_STOCK_FROM_EMAIL'),
                                  Config::get('EMAIL_STOCK_FROM_NAME'),
                                  Config::get('EMAIL_STOCK_SUBJECT'), $body);

      Session::add('feedback_positive', 'Low stock email sent.');
      return true;
    }
    Session::add('feedback_negative', 'All stock is above 2.');
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

  //Fix this function.
	public static function stockMove($item_code, $item_quant_move, $item_name_move)
	{
		$database = DatabaseFactory::getFactory()->getConnection();

		$sql = "UPDATE BDL_Stock SET item_quant += :item_quant WHERE item_code=:item_code LIMIT 1";
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

    $sql = "UPDATE BDL_Stock SET Stock_Quantity = Stock_Quantity + :item_quant WHERE Id = :item_id";
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

  public static function minusStock($item_id, $item_quant)
  {
    $database = DatabaseFactory::getFactory()->getConnection();

    $sql = "UPDATE BDL_Stock SET Stock_Quantity = Stock_Quantity - :item_quant WHERE Id = :item_id";
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

    $sql = "INSERT INTO BDL_Stock (Stock_Code, Stock_Name, Stock_Description, Stock_Make, Stock_Cost, Stock_Resell)
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

    $sql = "DELETE * FROM BDL_Stock WHERE Stock_Code = :item_code";
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
}

?>
