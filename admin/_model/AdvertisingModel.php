<?php
require_once (dirname(__FILE__)."/../../module/Db.php");
require_once (dirname(__FILE__)."/../../module/function.php");
/*
 * Created on Jun 18, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class AdvertisingModel extends Db {

	public function __construct() {
		parent :: __construct();
	}

	public function __destruct() {
		parent :: __destruct();
	}

	function get_category_name($id) {
		$temp = $this->result("select name from categories where id=$id");
		return $temp[0][0];
	}

	function get_category_advertising_list($id) {
		return $this->result("SELECT distinct a.*, c.account  FROM advertising a, relation b, user c
								WHERE a.id = b.advertising_id and a.advertisor_id = c.id AND b.category_id = $id
								order by a.post_datetime");
	}
	
	function get_advertising_info($id) {
		return $this->result("select a.*, b.account from advertising a, user b where a.id=$id and a.advertisor_id = b.id");
	}

	function get_relation_list($id) {
		return $this->result("select * from relation where advertising_id=$id order by category_id");
	}
	
	function add_advertising($title, $comment, $filename, $categories, $id, $country, $location, $investment, $pass_flag, $status, $full_ad, $newly, $featured, $email) {
		// getting max id.... 
		$sql = "SELECT case when MAX(id) is null then 1 else MAX(id) + 1 end FROM advertising";
		$temp = $this->result($sql);
		$newid = $temp[0][0];

		// insert advertising .
		$sql = "INSERT INTO advertising values(\"$newid\", \"".htmlspecialchar($title)."\", \"".htmlspecialchar($comment)."\", \"$filename\", \"$pass_flag\", \"$status\", $id, \"".date("Y-m-d H:i:s")."\", \"$country\", \"$location\", \"$investment\", \"".htmlspecialchar($full_ad)."\", \"$newly\", \"$featured\", \"$email\")";
		if($this->execute($sql)) {
			// match the relations with categories.
			for ($i = 0; $i < count($categories); $i++) {
				$sql = "INSERT INTO relation VALUES($categories[$i], $newid)";
				$this->execute($sql);
			}
			return true;
		} else
			return false;
	}
	
	function update_advertising($id, $title, $desc, $filename,  $categories, $country, $location, $investment, $flag, $status, $full_ad, $advertisor_id, $newly, $featured, $email) {
		$sql = "update advertising set pass_flag = \"$flag\", status = \"$status\",
									title = \"".htmlspecialchar($title)."\", description = \"".htmlspecialchar($desc)."\",
									img=\"$filename\", country = \"$country\", 
									location = \"$location\", full_ads = \"".htmlspecialchar($full_ad)."\",
									advertisor_id = \"$advertisor_id\",
									newly = \"$newly\", feature = \"$featured\", email=\"$email\" where id=$id";
		if($this->execute($sql)) {
			$this->execute("delete from relation where advertising_id=$id");
			// match the relations with categories.
			for ($i = 0; $i < count($categories); $i++) {
				$sql = "INSERT INTO relation VALUES($categories[$i], $id)";
				$this->execute($sql);
			}
			return true;
		} else
			return false;
	}
	
	function get_advertisor_list() {
		return $this->result("select id, account, email from user where permission = 3 and status = 1 order by account");
	}
	
	function delete_advertising($id) {
		$this->execute("delete from advertising where id=$id");
		$this->execute("delete from relation where advertisor_id=$id");
	}
}
