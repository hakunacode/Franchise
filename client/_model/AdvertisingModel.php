<?php
require_once (dirname(__FILE__)."/../../module/Db.php");
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
		return $this->result("SELECT distinct a.*  FROM advertising a, relation b 
								WHERE a.id = b.advertising_id AND b.category_id = $id and a.pass_flag = 2 and a.status = 2");
	}
	
	function get_advertising_info($id) {
		return $this->result("select title, full_ads from advertising where id=$id");
	}
	
	function add_advertising($title, $comment, $filename, $categories, $id) {
		// getting max id.... 
		$sql = "SELECT case when MAX(id) is null then 1 else MAX(id) + 1 end FROM advertising";
		$temp = $this->result($sql);
		$id = $temp[0][0];
				
		// insert advertising .
		$sql = "INSERT INTO advertising values($id, '$title', '$comment', '$filename', 2, 2, $id, '".date("Y-m-d H:i:s")."')";
		$this->execute($sql);
		// match the relations with categories.
		for ($i = 0; $i < count($categories); $i++) {
			$sql = "INSERT INTO relation VALUES($categories[$i], $id)";
			$this->execute($sql);
		}
		return true;
	}

	function addRequest($id, $name, $email, $zip, $phone, $country, $location, $street, $city, $state, $investment) {
		$sql = "INSERT INTO advertisor_requests(ads_id,name,email,zipcode,country,state,city,location,street,phonenumber,investment,request_date,flag)
				VALUES($id, '$name', '$email', '$zip', '$country', '$state','$city', '$location', '$street','$phone','$investment', '".date("Y-m-d H:i:s")."', 2);";
		$this->execute($sql);
		$temp = $this->result("select id from advertisor_requests where id = (select max(id) from advertisor_requests where ads_id = $id)");
		return $temp[0][0];
	}
	
	function get_investment_range() {
		return $this->result("select * from investment_range order by id");
	}
	
	function get_ad_email_address($id) {
		$temp = $this->result("select email from advertising where id=$id");
		return $temp[0][0];
	}
	
	function getRequestDetails($request_id) {
		$sql = "SELECT 'ID', id FROM advertisor_requests WHERE id=$request_id
				UNION 
				SELECT 'Name', NAME FROM advertisor_requests WHERE id=$request_id
				UNION 
				SELECT 'Email', email FROM advertisor_requests WHERE id=$request_id
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
				SELECT 'Request Date', request_date FROM advertisor_requests WHERE id=$request_id";
		return $this->result($sql);
	}

	function get_ad_title($id) {
		$temp = $this->result("select title from advertising where id=$id");
		return $temp[0][0];
	}
	
}
