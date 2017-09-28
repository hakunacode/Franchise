<?php
require_once (dirname(__FILE__)."/../../module/Db.php");
/*
 * Created on Jun 18, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class HomeModel extends Db {

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
		return $this->result("SELECT a.*  FROM advertising a, relation b WHERE a.id = b.advertising_id AND b.category_id = $id");
	}
	
	function get_advertising_info($id) {
		return $this->result("select * from advertising where id=$id");
	}
	
	function get_wait_advertising_list() {
		$sql = "SELECT a.*, b.account FROM advertising a, user b WHERE a.advertisor_id = b.id AND a.pass_flag = 1;";
		return $this->result($sql);
	}

	function updateAdvertisingFlag($id, $flag) {
		return $this->execute("update advertising set pass_flag = '$flag' where id='$id'");
	}

	function updateAdvertisingStatus($id, $status) {
		return $this->execute("update advertising set status = '$status' where id='$id'");
	}

	function get_request_list() {
		$sql = "SELECT a.id, a.name, a.email, a.zipcode, b.name, a.state, a.city, c.name, a.street, e.investment_range, a.phonenumber, d.title, a.request_date, a.flag, a.ads_id
				FROM advertisor_requests a, country b, location c, advertising d, investment_range e
				WHERE a.country = b.id AND a.location = c.id and a.investment = e.id and a.ads_id=d.id
				ORDER BY a.request_date desc";
		return $this->result($sql);
	}

	function getRequestDetails($request_id) {
	//	$request_id = 1;
		$sql = "SELECT 'ID', id FROM advertisor_requests WHERE id=$request_id
				UNION 
				SELECT 'Name', NAME FROM advertisor_requests WHERE id=$request_id
				UNION 
				SELECT 'Email',email FROM advertisor_requests WHERE id=$request_id
				UNION 
				SELECT 'ZipCode',zipcode FROM advertisor_requests WHERE id=$request_id
				UNION 
				SELECT 'Country', (SELECT NAME FROM country WHERE id IN (SELECT country FROM advertisor_requests WHERE 		id=$request_id))
				UNION 
				SELECT 'State', state FROM advertisor_requests WHERE id=$request_id
				UNION 
				SELECT 'City', city FROM advertisor_requests WHERE id=$request_id
				UNION 
				SELECT 'Location', (SELECT NAME FROM location WHERE id IN (SELECT location FROM advertisor_requests WHERE id=$request_id))
				UNION 
				SELECT 'Street', street FROM advertisor_requests WHERE id=$request_id
				UNION 
				SELECT 'Phone Number', phonenumber FROM advertisor_requests WHERE id=$request_id
				UNION 
				SELECT 'Investment', (SELECT investment_range FROM investment_range WHERE id IN (SELECT investment FROM advertisor_requests WHERE id=$request_id))
				UNION 
				SELECT 'Date', request_date FROM advertisor_requests WHERE id=$request_id";
		return $this->result($sql);
	}
	
	function pending_advertising_list() {
		return $this->result("select a.id, a.title, c.name, d.name, a.post_datetime, b.account, a.status 
								from advertising a, user b, country c, location d
								where a.advertisor_id = b.id and a.country = c.id and a.location = d.id and a.status = 1");
	}
	
	function permit_advertising($id, $flag) {
		if($this->execute("update advertisor_requests set flag = $flag where id=$id")) {
			$temp = $this->result("select * from advertisor_requests where id=$id");
			$this->execute("delete from advertisor_requests where id=$id");
			return $this->execute("insert into advertisor_requests values('".$temp[0][0]."', '".$temp[0][1]."', '".$temp[0][2]."', '".$temp[0][3]."', '".$temp[0][4]."', '".$temp[0][5]."', '".$temp[0][6]."', '".$temp[0][7]."', '".$temp[0][8]."', '".$temp[0][9]."', '".$temp[0][10]."', '".$temp[0][11]."', 1, $id, 1);");
		} else
			return false;
	}
}