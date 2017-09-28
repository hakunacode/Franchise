<?php
require_once (dirname(__FILE__)."/../_model/AdvertisingModel.php");
require_once (dirname(__FILE__)."/../../module/ControllerCore.php");
/*
 * Created on Jun 18, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class AdvertisingController extends ControllerCore {

	var $_model = null;
	var $_flag = array(1=>"wait", 2=>"pass");
	var $_status = array(1=>"deactive", 2=>"active");

	public function __construct() {
		parent :: __construct("admin");
		$this->_model = new AdvertisingModel();
	}

	public function __destruct() {
		parent :: __destruct();
	}

	public function submenu($category_id = 0) {
		echo "<table style='width:100%'>
				<tr style=\"height:3px; background:maroon; font-size: 12px\">
				<td colspan=\"2\" style=\"padding-left: 10px; height: 30px;\"><img src=\"../../../include/img/icon_home.gif\"> ";
			$this->href("home", "Home", "../home/", "", "class='submenu'");
			if($category_id > 0) {
				echo "<span style=\"color:white\"> >> ".$this->_model->get_category_name($category_id)."</span>";
			}
				
			echo "</td>
			</tr>
		<table>";
	}

	public function home($id) {
		echo "<div id=\"main_body\">";
		$this->submenu($id);
		$this->category_advertising($id);
		echo "</div>";
	}
	
	function category_advertising($category_id) {
		$this->categories($category_id);

		$this->get_category_advertising_list($category_id);
	}
	
	public function categories($category_id) {
		$categories = $this->_model->get_categories();
		$this->section();
		echo "<table style='width:80%'>" .
			"<tr><td nowrap valign='top' width='200px'><h3>Browse Categories</h3></td>".
			"<td valign=\"top\" style='padding-left:20px'>";
		echo "<select id='category' onchange='change_category(this)'>";
		for($i = 0; $i < count($categories); $i ++) {
			echo "<option value='".$categories[$i][0]."' ".($category_id == $categories[$i][0] ? "selected" : "").">".$categories[$i][1]."</option>";
		}
		echo "</select></td><td>";
		echo $this->button("new ..", "", "", "add_ads");
		echo "</td></tr></table>";
	}
	
	public function get_category_advertising_list($category_id) {
		$result = $this->_model->get_category_advertising_list($category_id);
		
		echo "<table class='list' style='border-collapse:collapse; width:80%'>";
		echo "<tr class='listhead'>
				<td class='headcol'>no</td>
				<td class='headcol'>title</td>
				<td class='headcol' width='80px'>pass status</td>
				<td class='headcol' width='80px'>active status</td>
				<td class='headcol' width='200px'>post date</td>
			</tr>";
		for($i = 0; $i < count($result); $i ++) {
			echo "<tr class='listrow'>
					<td class='listcol'>".($i + 1)."</td>
					<td class='listcol'>".$result[$i][1]."</td>
					<td class='listcol'>".$this->_flag[$result[$i][4]]."</td>
					<td class='listcol'>".$this->_status[$result[$i][5]]."</td>
					<td class='listcol' style='color:808080' nowrap>".date("d F Y H:i:s", strtotime($result[$i][7]))." | ".$result[$i][15]." | 
						<a id='edit$i' onclick='edit(".$result[$i][0].")'>edit</a> | 
						<a id='delete$i' onclick='delete_ads(".$result[$i][0].")'>delete</a>
					</td>
				</tr>";
		}
		echo "</table>";
	}

	function new_edit($category_id, $id) {
		$title = "";
		$desc = "";
		$full_ad = "";
		$banner = "";
		$country = 0;
		$location = 0;
		$investment = "";
		$relation = array();
		$flag = 1;
		$status = 1;
		$advertisor_id = 0;
		$advertisor_name = "";
		$newly_listed = 0;
		$featured = 0;
		$email = "";
		
		if($id > 0) {
			$info = $this->_model->get_advertising_info($id);
			$relation = $this->_model->get_relation_list($id);
			$title = $info[0][1];
			$desc = $info[0][2];
			$full_ad = htmlentity($info[0][11]);
			$banner = $info[0][3];
			$country = $info[0][8];
			$location = $info[0][9];
			$investment = $info[0][10];
			$flag = $info[0][4];
			$status = $info[0][5];
			$advertisor_id = $info[0][6];
			$advertisor_name = $info[0][15];
			$newly_listed = $info[0][12];
			$featured = $info[0][13];
			$email = $info[0][14];
		}
		
		echo"<div id='message'></div>";
		echo "<p><h3>Advertising information</h3></p>
			<input type='hidden' name='category_id' value='$category_id'>
			<input type='hidden' name='ads_id' value='$id'>
			<input type='hidden' id='contents' name='contents' value=''>";
		echo "<table style='width:700px; font-size:12px'>
				<tr>
					<td>Title</td>
					<td>".$this->text("title", $title,  "style='width:350px'", true)."</td>
				</tr>
				<tr>
					<td valign='top'>Comment</td>
					<td>".$this->textarea("desc", $desc, "100%", "50px", "", true)."</td>
				</tr>
				<tr>
					<td valign='top'></td>
					<td><iframe id='_htmlcontent' name='_htmlcontent' src='../../../include/htmlarea/htmlarea.html' frameborder='0' framespacing='0' framepadding='0' scrolling='no' width='600px' height='360px'></iframe>
						<div id='htmlcontent' name='htmlcontent' style='display:none'>$full_ad</div>
					</td>
				</tr>
				<tr>
					<td>banner</td>
					<td>".$this->file("banner", "", "style='width:150px'", true)."
						<input type='hidden' name='filename' id='filename' value='$banner'>
						".($banner != "" ? "<br><a style='cursor:pointer' onclick='window.open(\"../../../upload/advertising/banner/$banner\")'>$banner</a>" : "")."</td>
				</tr>
				<tr>
					<td>Country</td>
					<td>
						<select name='country'><option>--</option>";
						$countries = $this->_model->get_country_list();
						for($i = 0; $i < count($countries); $i ++) {
							echo "<option value='".$countries[$i][0]."' ".($country == $countries[$i][0] ? "selected" : "").">".$countries[$i][1]."</option>";
						}
				echo "</select>
				</tr>
				<tr>
					<td>Location</td>
					<td>
						<select name='location'><option>--</option>";
						$locations = $this->_model->get_location_list();
						for($i = 0; $i < count($locations); $i ++) {
							echo "<option value='".$locations[$i][0]."' ".($location == $locations[$i][0] ? "selected" : "").">".$locations[$i][1]."</option>";
						}
				echo "</select>
					</td>
				</tr>
				<tr>
					<td>Minimum Cash Required</td>
					<td>".$this->text("investment", $investment,  "style='width:100px'", true)." $</td>
				</tr>";
				echo"<tr>
				<td valign=\"top\" nowrap>pass flag</td>
				<td>
					<select name=\"flag\" id=\"flag\">";
							echo "<option value='1' ".($flag == 1 ? "selected" : "").">--</option>";
							echo "<option value='2' ".($flag == 2 ? "selected" : "").">pass</option>";
						
					echo"</select>
				</td>
			</tr>
			<tr>
				<td valign=\"top\" nowrap>active status</td>
				<td>
					<select name=\"status\" id=\"status\">
						<option value='1' ";
						if ($status == 1 )
							  echo "selected >deactive</option>";
						else
							  echo "  >deactive</option>";
						echo"<option value='2' ";
						if ($status == 2 )
							  echo "selected >active</option>";
						else
							  echo "  >active</option>";
						
				echo"	</select>
				</td>
			</tr>
			<tr>
				<td valign=\"top\" nowrap>Advertisor</td>
				<td><div id='advertisor_link'>";
				$this->href("home", $advertisor_name == "" ? "new link" : $advertisor_name, "javascript:modify($advertisor_id)", "", "");
				echo "<input type='hidden' id='advertisor_id' name='advertisor_id' value='$advertisor_id'></div></td>
			</tr>
			<tr>
				<td valign=\"top\" nowrap></td>
				<td><input type='checkbox' name='newly' id='newly' value='1' ".($newly_listed == 1 ? "checked" : "")."> Newly listed</td>
			</tr>
			<tr>
				<td valign=\"top\" nowrap></td>
				<td><input type='checkbox' name='featured' id='featured' value='1' ".($featured == 1 ? "checked" : "")."> Featured Franchise</td>
			</tr>
			<tr>
				<td valign=\"center\" nowrap>Email Address</td>
				<td>".$this->text("email", $email,  "style='width:250px'", true)."</td>
			</tr>
		</table>";

		$categories = $this->_model->get_categories();
		
		echo "<table style=\"width:700px; font-size:12px\">" .
			"<tr><td colspan=\"10\"><h6>Select the categories.</h6></td></tr>".
			"<tr><td valign=\"top\" nowrap>";
				
			for($i = 0; $i < count($categories); $i ++) {
				
				if($i != 0 && $i % 10 == 0)
					echo "</td><td valign=\"top\" nowrap>";
					
				if ($category_id!=0 && $category_id == $categories[$i][0])
					$this->checkboxes("categories$i", "categories[]", $categories[$i][1], $categories[$i][0], true);
				else {
					$b = false;
					for($j = 0; $j < count($relation); $j ++) {
						if($relation[$j][0] == $categories[$i][0]) {
							$b = true;
							break;
						}
					}
					
					$this->checkboxes("categories$i", "categories[]", $categories[$i][1], $categories[$i][0], $b);
				}
				echo "<br>";
			}
			echo "</td></tr><tr style='height:40px'>
					<td>".$this->button("Submit", "", "add_ads()", "submit", true)."&nbsp;&nbsp;"
						.$this->button("Cancel", "", "back()", "cancel", true)."</td>
				</tr>
			</table>";
	}
	
	function select_advertisor($id) {
		$result = $this->_model->get_advertisor_list();
		echo "<table border=0 style='font-size:12px; color:#808080; width:500px' align='center'>";
		for($i = 0; $i < count($result); $i ++) {
			echo "<tr>";
			echo "<td nowrap>
					<input type='radio' name='advertisor' id='advertisor$i' value='".$result[$i][0]."' ".($id == $result[$i][0] ? "checked" : "").">";
			echo "</td>";
			echo "<td nowrap><label id='account$i'>".$result[$i][1]."</label></td>";
			echo "<td>".$result[$i][2]."</td>";
			echo "</tr>";
		}
		echo "<tr><td colspan='3' style='height:50px'>";
		$this->button("apply", "", "select_advertisor()", "select_advertisor");
		echo "</td></tr>";
		echo "</table>";
	}
}
