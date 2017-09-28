<?php
require_once (dirname(__FILE__)."/../include/settings.php");
/*
 * Created on Jun 18, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class Db {

	private $_db = null;

	public function __construct() {
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		
		if($mysqli->connect_error) {
			printf("You can't connect to DB server: %s\n", $mysqli->connect_error);
			exit;
		}
		
		$this->_db = $mysqli;
	}

	public function __destruct() {
		$this->_db->close();
	}

	public function execute($sql) {
		$this->_db->multi_query($sql);

		if ($this->_db->errno) {
			echo $sql;
			echo $this->_db->error;

			return false;
		} else
			return true;

	}

	public function result($sql, $blank = true) {
		$this->execute($sql);

		$array_data = array ();
		do {
			if ($objResult = $this->_db->use_result()) {
				$i = 0;
				while ($arrRow = $objResult->fetch_row()) {
					$j = 0;
					while (list ($iIndex, $strValue) = each($arrRow)) {
						if ($blank)
							$array_data[$i][$j] = $strValue == "" ? "&nbsp;" : $strValue;
						else
							$array_data[$i][$j] = $strValue;
						$j ++;
					}
					$i ++;
				}
				$objResult->close();
			}
		}
		while ($this->_db->more_results() && $this->_db->next_result());

		return $array_data;
	}

	public function get_categories() {
		$sql = "select * from categories order by name;";
		return $this->result($sql);
	}
	
	public function login($username, $password) {
		
		$temp = $this->result("select * from user where account='$username'");
		
		if(count($temp) > 0) {
			$temp = $this->result("select * from user where account='$username' and password='$password'");
			if(count($temp) > 0)
				return 1;
			else
				return -1;
		} else {
			return -2;
		}
	}
	
	function get_profile($username, $password) {
		return $this->result("select * from user where account='$username' and password='$password'");
	}
	
	function get_user_info($email) {
		return $this->result("select * from user where email = '$email'");
	}

	function get_location_list() {
		return $this->result("select * from location order by name;");
	}

	function get_country_list() {
		return $this->result("select * from country order by name;");
	}
}