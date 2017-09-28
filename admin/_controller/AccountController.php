<?php
require_once (dirname(__FILE__)."/../_model/AccountModel.php");
require_once (dirname(__FILE__)."/../../module/ControllerCore.php");
/*
 * Created on Jun 18, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class AccountController extends ControllerCore {

	var $_model = null;
	var $_permission = array(1=>"Administrator", 2=>"Broker", 3=>"Advertisor", 4=>"User");

	public function __construct() {
		parent :: __construct("admin");
		$this->_model = new AccountModel();
	}

	public function __destruct() {
		parent :: __destruct();
	}

	public function home() {
		echo "<div id=\"main_body\">";
		$this->submenu();
		$this->section();
		$this->userlist();
		echo "</div>";
	}

	public function submenu($category_id = 0) {
		echo "<table style='width:100%'>
				<tr style=\"height:3px; background:maroon; font-size: 12px\">
				<td colspan=\"2\" style=\"padding-left: 10px; height: 30px;\"><img src=\"../../../include/img/icon_home.gif\"> ";
			$this->href("account_link", "Account", "", "", "class='submenu'");
			echo "</td>
			</tr>
		<table>";
	}
	
	public function userlist() {
		echo "<table style='width:80%'>" .
			"<tr><td nowrap valign='top' width='140px'><h3>Account list.</h3></td>".
			"<td nowrap valign='top'>".$this->button("new..", "", "", "new_account", true)."</td>".
			"</tr></table>";
		echo "<script>
				$('#new_account').click(function() {
					$.post(
						'./edit.php',
						{
							id: 0
						},
						function(data) {
							show_dialog('Account information', data);
						}
					);
				});
			</script>";
		$result = $this->_model->get_system_account_list();
		
		echo "<table class='list' style='border-collapse:collapse; width:80%'>";
		echo "<tr class='listhead'>
				<td class='headcol'>no</td>
				<td class='headcol'>account</td>
				<td class='headcol'>email</td>
				<td class='headcol'>full name</td>
				<td class='headcol'>permission</td>
			</tr>";
		for($i = 0; $i < count($result); $i ++) {
			echo "<tr class='listrow'>
					<td class='listcol'>".($i + 1)."</td>
					<td class='listcol'><a id='edit$i'>".$result[$i][1]."</a></td>
					<td class='listcol'>".$result[$i][2]."</td>
					<td class='listcol'>".$result[$i][5]."</td>
					<td class='listcol'>".$this->_permission[$result[$i][4]]." 
						<script>
							$('#edit$i').click(function() {
								$.post(
									'./edit.php',
									{
										id: ".$result[$i][0]."
									},
									function(data) {
										show_dialog('Account information', data);
									}
								);
							});
						</script>
					</td>
				</tr>";
		}
		echo "</table>";
	}
	
	function edit($id) {
		$account = "";
		$email = "";
		$password = "";
		$fullname = "";
		$permission = 3;
		
		if($id > 0) {
			$info = $this->_model->get_account_info($id);
			$account = $info[0][1];
			$email = $info[0][2];
			$password = $info[0][3];
			$fullname = $info[0][5];
			$permission = $info[0][4];
		}
?>
		<p align='center'>
		<table width="500px" style="font-size:12px">
			<tr>
				<td valign="middle" width="80px">account</td>
				<td><?php $this->text("edit_account", $account, "style='width:350px'")?></td>
			</tr>
			<tr>
				<td valign="middle" width="80px">password</td>
				<td><?php $this->password("edit_password", $password, "style='width:350px'")?></td>
			</tr>
			<tr>
				<td valign="middle" width="80px">email</td>
				<td><?php $this->text("edit_email", $email, "style='width:350px'")?></td>
			</tr>
			<tr>
				<td valign="middle" width="80px">full name</td>
				<td><?php $this->text("edit_fullname", $fullname, "style='width:350px'")?></td>
			</tr>
			<tr>
				<td width="60px" nowrap>permission</td>
				<td>
					<select name="edit_permission" id="edit_permission">
<?php
					foreach($this->_permission as $key=>$text) {
						echo "<option value='$key' ".($key == $permission ? "selected" : "").">$text</option>";
					}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><?php $this->button($id > 0 ? "Update" : "Create", "", "", "update")?>&nbsp;
					<?php $id > 0 ? $this->button("Delete", "", "", "delete") : ""?></td>
			</tr>
		</table>
		</p>
		<input type="hidden" name="selid" value="<?php echo $id?>">
<?php
	}
}