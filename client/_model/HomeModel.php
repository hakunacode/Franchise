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

	function get_recent_advertising_list() {
		return $this->result("SELECT id, title, img, (SELECT MIN(category_id) FROM relation WHERE advertising_id = id), description, investment, email
				FROM advertising WHERE pass_flag=2 AND STATUS=2 and newly = 1");
	}
	
	function get_golden_ads_banner() {
		return $this->result("select a.id, a.title, a.img, (SELECT MIN(category_id) FROM relation WHERE advertising_id = a.id), a.description, a.investment, a.email
							from advertising a where a.pass_flag = 2 and a.status = 2 and a.feature = 1");
	}
}
