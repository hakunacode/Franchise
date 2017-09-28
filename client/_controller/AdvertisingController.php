<?php
require_once (dirname(__FILE__)."/../_model/AdvertisingModel.php");
require_once (dirname(__FILE__)."/../../module/ControllerCore.php");
require_once (dirname(__FILE__)."/../../module/function.php");
/*
 * Created on Jun 18, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class AdvertisingController extends ControllerCore {

	var $_model = null;

	public function __construct() {
		parent :: __construct("client");
		$this->_model = new AdvertisingModel();
	}

	public function __destruct() {
		parent :: __destruct();
	}

	public function home($id) {	
		echo "<div id=\"main_body\">";
		$this->subheader();
		//$this->submenu($id);
		echo "<br>";
		$this->category_advertising($id);
		echo "</div>";
	}
	
	function subheader() {
		echo "<div id='subbanner'>
				<div id='banner_title'>Accounting and Financial Franchise Opportunities</div>
				<div id='banner_description'>Our franchise directory lists America�s top financial and accounting franchises. Profit from a multi-billion dollar industry by investing in any of the following accounting and financial franchises. Fill out the form below to receive for more information. This is an exciting field to work in.</div>
			</div>";
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

	function category_htmlarea($category_id, $id) {
		echo "<table style=\"width:100%\">";
		echo "<tr><td valign=\"top\" width=\"250px\">";
		$this->categories(true);
		echo "</td>";
		echo "<td valign=\"top\">";
		echo "<table style=\"width:100%\"><tr><td>";
		$this->edit($id);
		echo "</td></tr></table></td></tr></table>";
	}
	
	public function categories($list = false) {
		$categories = $this->_model->get_categories();
		
		echo "<table style=\"width:100%\" border=0>" .
			"<tr><td colspan=\"10\"><h3>Browse Categories</h3></td></tr>".
			"<tr><td valign=\"top\"><ul>";
			
		for($i = 0; $i < count($categories); $i ++) {
			if($i != 0 && $i % 10 == 0 && !$list)
				echo "</ul></td><td valign=\"top\"><ul>";
			echo "<li>";
			$this->href("category$i", $categories[$i][1], "#", "category_link('".$categories[$i][0]."')");
			echo "</li>";
		}
		echo "</td></tr></table>";
	}

	function category_advertising($category_id) {
		echo "<table style=\"width:100%\">";
		echo "<tr><td valign=\"top\" width=\"250px\">";
		$this->categories(true);
		echo "</td>";
		echo "<td valign=\"top\">";
		echo "<table style=\"width:100%\"><tr><td>";
		$this->advertising_list($category_id);
		echo "</td></tr></table></td></tr></table>";
		
	}
	
	public function advertising_list($id) {
		$result = $this->_model->get_category_advertising_list($id);
		
		if(count($result) > 0) {
			echo "<div>Advertising list of the ";
			echo $this->_model->get_category_name($id)."</div>";
			echo "<table border=0 style='padding:10px; width:100%'>";
			echo "<tr>";
			for($i = 0; $i < count($result); $i ++) {
				echo "<td valign='top'>";
				if($i != 0 && $i % 3 == 0)
					echo "</tr><tr><td valign=\"top\">";
				echo $this->advertising($result[$i][0], $result[$i][1], $result[$i][2], $result[$i][3], $result[$i][10], $result[$i][14]);
			}
			echo "</tr></table>";
		} else {
			echo "<div><br><h6>Data not found</h6></div>";
		}
	}
	
	public function advertising($id, $title, $desc, $img, $cash, $email) {
		$html = "<div id=\"advertising\">";
//		$html .= "<div id=\"ads_img\"><a href=\"javascript:request('$id')\"><img src=\"../../../include/img/request.png\"></a></div>"; 

		if($img != "")
			$html .= "<div id=\"ads_img\"><img src=\"../../../upload/advertising/banner/$img\" style=\"width:130px; height:60px\"></div>"; 
		$html .= "<div id=\"ads_title\">".(strlen($title) > 15 ? substr($title, 0, 15)."..." : $title)."</div>"; 
		$html .= "<div id=\"ads_desc\">".(strlen($desc) > 67 ? substr($desc, 0, 67)."..." : $desc)."</div><br>"; 
		$html .= "<div id=\"ads_desc\"><b>Minimum Cash Required</b>: <div style='padding-top:5px'>$".$cash."</div></div>"; 
		//if($email != "")
			//$html .= "<div id=\"ads_request\">$email</div>"; 
		//$html .= "<span id=\"ads_request\" style='width:60px'>".$this->href("request", "request", "javascript:request('$id')", "", "style=\"font-size:11px\"", true)."</span>";
		//$html .= "<span id=\"ads_more\" style='width:70px'>".$this->href("more", "more..", "javascript:request('$id')", "", "style=\"font-size:11px\"", true)."</span>"; 
		$html .= "<div><a href=\"javascript:request('$id')\"><img src=\"../../../include/img/read_more.gif\" style='width:120px; cursor:pointer'></a></div>"; 
		$html .= "</div>";
		
		return $html;
	}
	
	function new_ads($category_id, $id) {
		
		echo "<table style=\"width:100%\">";
		echo "<tr><td valign=\"top\" width=\"250px\">";
		$this->categories(true);
		echo "</td>";
		echo "<td valign=\"top\">";
		echo "<table style=\"width:100%\"><tr><td>";
		$this->edit($id, $category_id);
		echo "</td></tr></table></td></tr></table>";
	}

	function edit($id, $category_id) {
		echo"<div id='message'></div>";
		echo "<p><h3>New </h3></p>
		<form id='addCat_form' method='post' enctype='multipart/form-data' action='add_advertising.php' target='_actionpage'>
		<input type='hidden' name='category_id' value='$category_id'>
		<table style='width:100%; font-size:12px'>
			<tr>
				<td>Title</td>
				<td>".$this->text("title", "",  "style='width:350px'", true)."</td>
			</tr>
			<tr>
				<td valign='top'>Content</td>
				<td>".$this->textarea("comment", $value = "", "500px", "100px", "", true)."</td>
			</tr>
			<tr>
				<td>banner</td>
				<td>".$this->file("banner", "", "style='width:150px'", true)."</td>
			</tr>
			
		</table> <br>";
					
		$categories = $this->_model->get_categories();
		
		echo "<table style=\"width:100%; font-size:12px\">" .
			"<tr><td colspan=\"10\"><h6>Select the categories.</h6></td></tr>".
			"<tr><td valign=\"top\">";
			
		for($i = 0; $i < count($categories); $i ++) {
			
			if($i != 0 && $i % 15 == 0)
				echo "</td><td valign=\"top\">";
				
			if ($category_id!=0 && $category_id == $categories[$i][0])
				$this->checkboxes("categories$i", "categories[]", $categories[$i][1], $categories[$i][0], true);
			else 
				$this->checkboxes("categories$i", "categories[]", $categories[$i][1], $categories[$i][0], false);
			echo "<br>";
		}
		echo "</td></tr><tr style='height:40px'>
				<td>".$this->submit("Submit", "", "", "submit", true)."&nbsp;&nbsp;"
					.$this->button("Cancel", "", "", "cancel", true)."</td>
			</tr></table>";
		
		echo"</form>";
		
		echo"
			<script type='text/javascript'>
				jQuery(function($){
					$('.banner').fileUploader();
				});
			</script>";
		echo"<iframe name='_actionpage' style='border:0; width:0; height:0'></iframe>";
	}
	
	function request_form($id) {
		echo "<table style='width:100%'>
			<tr><td valign='top'>";
		$this->categories(true);
		echo "</td>";
		echo "<td valign='top' align='center'><br>";
		$this->detailsAds($id);
		echo "<br><br>";
		echo "<table id='request_form' width='600px' style='font-size:12px'>
				<tr><td colspan='2'><h3>Express request! Fast track to more information...</h3></td></tr>
				<tr><td colspan='2'><div id='message'></div></td></tr>
				<tr><td colspan='2' class='subtitle'>Contact Information</td></tr>
				<tr><td width='150px' align='left' style='padding:2px;'><label>Full Name</label></td><td><input type='text' id='request_name' name='request_name' style='width:200px'></td></tr>
				<tr><td align='left' style='padding:2px;'><label>Email Address</label></td><td><input type='text' id='request_email' name='email' style='width:200px'></td></tr>
				<tr><td align='left' style='padding:2px;'><label>Telephone Number</label></td><td><input type='text' id='request_phone' name='phone' style='width:200px'></td></tr>
				<tr><td colspan='2' class='subtitle'>Mailing Information</td></tr>
				<tr><td align='left' style='padding:2px;'><label>Street</label></td><td><input type='text' id='request_street' name='street' style='width:200px'></td></tr>
				<tr><td align='left' style='padding:2px;'><label>City</label></td><td><input type='text' id='request_city' name='city' style='width:200px'></td></tr>
				<tr><td align='left' style='padding:2px;'><label>State</label></td><td><input type='text' id='request_state' name='state' style='width:200px'></td></tr>
				<tr><td align='left' style='padding:0 0 0 2px;'><label>Zip/Postal Code</label></td><td><input type='text' id='request_zipcode' name='zipcode' style='width:200px'></td></tr>
				<tr><td align='left' style='padding:2px;'><label>Country</label></td><td>
					<select id='request_country' style='width:200px'>";
				$country = $this->_model->get_country_list();
				for($i = 0; $i < count($country); $i ++) {
					echo "<option value='".$country[$i][0]."'>".$country[$i][1]."</option>";
				}
				echo "</location></td></tr>
				<tr><td colspan='2' class='subtitle'>Investment Interest</td></tr>
				<tr><td align='left' style='padding:2px;'><label>Desired Investment</label></td>
					<td>
						<select id='request_investment' name='request_investment' style='width:200px'>
							<option value='0'>--</option>";
					$investment_range = $this->_model->get_investment_range();
						for($i = 0; $i < count($investment_range); $i ++) {
							echo "<option value='".$investment_range[$i][0]."'>".$investment_range[$i][1]."</option>";
						}
					echo "</select>
					</td></tr>
				<tr><td align='left' style='padding:2px;'><label>Desired Location</label></td><td>
					<select id='request_location' style='width:200px'>";
				$location = $this->_model->get_location_list();
				for($i = 0; $i < count($location); $i ++) {
					echo "<option value='".$location[$i][0]."'>".$location[$i][1]."</option>";
				}
				echo "</location></td></tr>
				<tr><td colspan='2' style='padding:5px'><p>This is not an offer to sale a franchise, all potential buyers should seek exert consultation when researching and buying a franchise or business opportunity. </p>
					
					<p>Please read our <a href='#' onclick=\"menu_click('terms_conditions')\">terms and conditions</a> for full details.</p>
							
				<tr><td></td><td>";
					$this->button("Submit", "", "", "request_submit");
					$this->button("Cancel", "", "", "request_cancel");
			echo "</td></tr>
			</table>	
			<input type='hidden' id='ad_id'value=''>";
		echo "</td></tr></table>";
	}
	
	function detailsAds($id) {
		$info = $this->_model->get_advertising_info($id);
		echo "<table style='width:100%; width:550px;'>";
		echo "<tr><td><h4>".$info[0][0]."</h4></td></tr>";
		echo "<tr><td>".htmlentity($info[0][1])."</td></tr>";
		echo "</table>";
	}

}
