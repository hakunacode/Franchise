<?php
require_once (dirname(__FILE__)."/../_model/HomeModel.php");
require_once (dirname(__FILE__)."/../../module/ControllerCore.php");
require_once (dirname(__FILE__)."/../../module/function.php");

/*
 * Created on Jun 18, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class HomeController extends ControllerCore {

	var $_model = null;

	public function __construct() {
		parent :: __construct("client");
		$this->_model = new HomeModel();
	}

	public function __destruct() {
		parent :: __destruct();
	}

	public function home() {
		$this->subheader();
		echo "<div id=\"main_body\">";
		//$this->submenu();
		echo "<br>";
		$this->categories();
		echo "<br>";
		echo "<table border=0 style='width:100%'><tr><td valign='top' width='700px'>";
		$this->recent_advertising();
		echo "<br>";
		$this->golden_ads_slider();
		echo "</td><td valign='top'><br><br>";
		$this->golden_banner();
		echo "</td></tr></table>";
		echo "</div>";
	}

	function subheader() {
		echo "<div id='subbanner'>
				<div id='banner_title'>FranchiseEverything.com - Directory of Franchises, Businesses, and other Opportunities</div>
				<div id='banner_description'>Franchise Everything welcomes you to our new franchise directery!!! Looking to find a franchise, look no further!!  All information in here is provided for you to browse and submit for information at no cost.  Looking to advertise your franchise.   Click the contact us button at the bottom of the page for the most options and best rates in the business.</div>
			</div>";
	}

	public function submenu($category_id = 0) {
		echo "<table style='width:100%'>
				<tr style=\"height:3px; background:maroon; font-size: 12px\">
				<td colspan=\"2\" style=\"padding-left: 10px; height: 30px;\"><img src=\"../../../include/img/icon_home.gif\"> ";
			$this->href("home", "Home", "", "", "class='submenu'");
			if($category_id > 0) {
				echo "<span style=\"color:white\"> >> ".$this->_model->get_category_name($category_id)."</span>";
			}
				
			echo "</td>
			</tr>
		<table>";
	}
	
	public function categories($list = false) {
		$categories = $this->_model->get_categories();
		
		echo "<table style=\"width:100%\" border=0>" .
			"<tr><td colspan=\"10\"><h3>Browse Categories</h3></td></tr>".
			"<tr><td colspan=\"10\" style='color:#5FBD47; font-size:12px'>Choose your best franchise opportunity from our industry categories...</td></tr>".
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
	
	function recent_advertising() {
		$result = $this->_model->get_recent_advertising_list();
		echo "<div class='golden_ads_title_bg'>New Franchises and Business Opportunities</div>";
		echo "<div id='liquid2' class='liquid'>
				<span class='previous'></span>
				<div class='wrapper'>
					<ul>";
			for($i = 0; $i < count($result); $i ++) {
				echo "<li>".$this->advertising($result[$i][0], $result[$i][1], $result[$i][4], $result[$i][2], $result[$i][5], $result[$i][3], $result[$i][6])."</li>";
			}
					echo "</ul>
				</div>
				<span class='next'></span>
			</div>";
		echo "<script>
				$(document).ready(function() {
					$('#liquid2').liquidcarousel({height:250, duration:1000, hidearrows:false});
				});
			</script>";
	}
	
	function golden_ads_slider() {
		$result = $this->_model->get_golden_ads_banner();
		echo "<div class='golden_ads_title_bg'>Featured opportunities from our Franchise Gallery</div>";
		echo "<div id='liquid1' class='liquid'>
				<span class='previous'></span>
				<div class='wrapper'>
					<ul>";
			for($i = 0; $i < count($result); $i ++) {
				echo "<li>".$this->advertising($result[$i][0], $result[$i][1], $result[$i][4], $result[$i][2], $result[$i][5], $result[$i][3], $result[$i][6])."</li>";
			}
					echo "</ul>
				</div>
				<span class='next'></span>
			</div>";
		echo "<script>
				$(document).ready(function() {
					$('#liquid1').liquidcarousel({height:250, duration:1000, hidearrows:false});
				});
			</script>";
	}

	public function advertising($id, $title, $desc, $img, $cash, $category_id, $email) {
		$html = "<div class='liquid_advertisment'>";
		
		if($img != "")
			$html .= "<div id=\"\"><img src=\"../../../upload/advertising/banner/$img\" style=\"width:130px; height:60px; border:1px solid #222222\"></div>"; 
		$html .= "<div class=\"title\">".(strlen($title) > 15 ? substr($title, 0, 15)."..." : $title)."</div>"; 
		$html .= "<div class=\"desc\" style=\"padding-bottom:5px\">".htmlentity(strlen($desc) > 67 ? substr($desc, 0, 67)."..." : $desc)."</div>"; 
		$html .= "<div class=\"cash\" style=\"padding-bottom:5px\"><b>Minimum Cash Required</b>: $".$cash."</div>"; 
		//$html .= "<div class=\"cash\" style='color:#808080'>$email</div>"; 
		$html .= "<div id=\"\">".$this->href("more", "more...", "#", "more($id, $category_id)", "style=\"font-size:11px\"", true)."</div>"; 
		$html .= "</div>";
		
		return $html;
	}
	
	function golden_banner() {
		$result = $this->_model->get_golden_ads_banner();
		if(count($result) > 0) {
			for($i = 0; $i < count($result); $i ++) {
				$this->href("banner$i", "<div><img src='../../../upload/advertising/banner/".$result[$i][2]."' title='".$result[$i][1]."' style='border:1px solid #808080; width:130px; height:60px'></div></br>", "#", "more('".$result[$i][0]."', '".$result[$i][3]."')");
			}
		}
	}
	
	function private_client() {
		echo "<div id='subbanner'>
				<div id='banner_title'>Franchise Everything - Privacy Policy</div>
				<div id='banner_description'>Find a franchise to suit you in our directory, which contains listings of opportunities divided by industry, investment and location. Read expert tips on buying a franchise business in our information center and research news and articles about the latest developments in this thriving industry.</div>
			</div>";
		echo "<table border='0' style='width:100%'><tr><td width='250px' valign='top'>";
		$this->categories(true);
		echo "</td>";
		echo "<td valign='top'><br><br>";
		$this->private_policy();
		echo "</td>";
		echo "</tr>";
		echo "</table>";
	}
	
	function contact_client() {
		echo "<div id='subbanner'>
				<div id='banner_title'>About Franchis Everything</div>
				<div id='banner_description'>As one of the leading portals of franchise and business opportunities, Franchise Everything is regarded as a high-quality, efficient company in promoting new franchises and targeting new entrepreneurs worldwide. Please read our company profile to know why we are a leading company in this market.</div>
			</div>";
		echo "<table border='0' style='width:100%'><tr><td width='250px' valign='top'>";
		$this->categories(true);
		echo "</td>";
		echo "<td valign='top'><br><br>";
		$this->contact_us();
		echo "</td>";
		echo "</tr>";
		echo "</table>";
	}

	function terms_client() {
		echo "<div id='subbanner'>
				<div id='banner_title'>Franchise Everything: Terms and Conditions</div>
				<div id='banner_description'>Find a franchise to suit you in our directory, which contains listings of opportunities divided by industry, investment and location. Read expert tips on buying a franchise business in our information center and research news and articles about the latest developments in this thriving industry.</div>
			</div>";
		echo "<table border='0' style='width:100%'><tr><td width='250px' valign='top'>";
		$this->categories(true);
		echo "</td>";
		echo "<td valign='top'><br><br>";
		$this->terms_condition();
		echo "</td>";
		echo "</tr>";
		echo "</table>";
	}
}