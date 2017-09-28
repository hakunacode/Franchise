<?php
require_once (dirname(__FILE__)."/../../module/Db.php");
require_once (dirname(__FILE__)."/../../module/function.php");
/*
 * Created on Jun 18, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class BlogModel extends Db {

	public function __construct() {
		parent :: __construct();
	}

	public function __destruct() {
		parent :: __destruct();
	}

	function get_blog_list($limit1 = 0, $limit2 = 5) {
		$sql = "SELECT a.id, a.title, a.content, c.account, a.post_date, COUNT(b.blog_id)
				FROM blog a LEFT JOIN blog_comment b ON a.id = b.blog_id, user c
				WHERE a.user_id = c.id
				GROUP BY a.id;";
		return $this->result($sql);
	}
	
	function get_info($id) {
		$sql = "SELECT a.id, a.title, a.content, c.account, a.post_date
				FROM blog a, user c
				WHERE a.user_id = c.id
					AND a.id = $id";
		return $this->result($sql);
	}
	
	function get_blog_comment_list($id) {
		return $this->result("select * from blog_comment where blog_id=$id order by post_date desc");
	}
	
	function add_blog_comment($id, $name, $email, $comment) {
		$sql = "insert into blog_comment values(\"$id\", \"".htmlspecialchar($name)."\", \"$email\", \"".htmlspecialchar($comment)."\", \"".date("Y-m-d H:i:s")."\");";
		return $this->execute($sql);
	}
	
	function post($title, $content, $userid, $post_datetime) {
		$sql = "insert into blog(title, content, user_id, post_date) values(\"".htmlspecialchar($title)."\", \"".htmlspecialchar($content)."\", \"$userid\", \"$post_datetime\");";
		return $this->execute($sql);
	}
}