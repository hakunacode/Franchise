<?php
require_once (dirname(__FILE__)."/../../module/Db.php");
/*
 * Created on Jun 18, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class AccountModel extends Db {

	public function __construct() {
		parent :: __construct();
	}

	public function __destruct() {
		parent :: __destruct();
	}

	public function get_system_account_list() {
		return $this->result("select * from user where status = 1 order by permission");
	}
	
	public function get_account_info($id) {
		return $this->result("select * from user where id=$id");
	}
	
	public function save_account($id, $account, $email, $password, $fullname, $permission) {
		if($id > 0) {
			$sql = "update user set account=\"$account\", email=\"$email\", password=\"$password\", fullname=\"$fullname\", permission=\"$permission\" where id='$id'";
			return $this->execute($sql);
		} else {
			$temp = $this->result("select case when max(id) is null then 1 else max(id) + 1 end from user");
			$newid = $temp[0][0];
			$sql = "insert into user values(\"$newid\", \"$account\", \"$email\", \"$password\", \"$permission\", \"$fullname\", 1);";
			return $this->execute($sql);
		}
	}
	
	function delete_account($id) {
		return $this->execute("update user set status = 2 where id=$id");
	}
}
