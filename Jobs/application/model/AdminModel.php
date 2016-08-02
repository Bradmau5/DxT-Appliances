<?php

	class AdminModel
	{
		public static function getAllVehicles()
		{
			$database = DatabaseFactory::getFactory()->getConnection();

	    $sql = "SELECT * FROM vehicles AS v
	        		JOIN BDL_Stock AS i
	        		ON v.v_id = i.Stock_Location";
	    $query = $database->prepare($sql);
	  	$query->execute();

	  	// fetchAll() is the PDO method that gets all result rows
	    return $query->fetchAll();
		}
	}

?>
