<?php
require_once (dirname(__FILE__)."/../_model/HomeModel.php");
require_once (dirname(__FILE__)."/../../module/ControllerCore.php");
/*
 * Created on Jun 18, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class HomeController extends ControllerCore {

	var $_model = null;

	public function __construct() {
		parent :: __construct("admin");
		$this->_model = new HomeModel();
	}

	public function __destruct() {
		parent :: __destruct();
	}

	public function home() {
		echo "<div id=\"main_body\">";
		$this->submenu();
		$this->categories();
		$this->section();
		$this->wait_advertising();
		echo "<br>";
		$this->pending_advertising();
		echo "<br>";
		$this->get_request_list();
		echo "</div>";
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
			"<tr><td colspan=\"10\" style='padding-left:10px;'><h3>Browse Categories</h3></td></tr>".
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
	
	public function wait_advertising() {
		$result = $this->_model->get_wait_advertising_list();
		echo "<div><div style='padding-left:10px; width:100%; text-align:left'><h3>Wait Advertising</h3></div>";
		
		if(count($result) > 0) {
			for($i = 0; $i < count($result); $i ++) {
?>				
				<div class="comment_list_row" style="width:750px">
					<table style="width:750px; font-size:12px;">
						<tr>
							<td width="50px" valign="top" style="padding-left:5px">
								<div style="padding:2px; border:1px solid #808080;">
									<img src='../../../upload/advertising/banner/<?php echo $result[$i][3]?>' style='width:80px; height:40px'>
								</div>
							</td>
							<td valign='top'>
								<div style="padding-left:15px; width:450px">
									<h6 style="color:#ff992f; font-size:12px">Posted on <?php echo $result[$i][7];?>&nbsp;
										by <?php echo $result[$i][15]?>
									</h6>
									<div id='ads_title'><?php echo $result[$i][1]?></div>
									<div style="color:#333333"><?php echo $result[$i][2]?></div>
								</div>	
							</td>
							<td valign='top'>
								<div>
									<select id="flag<?php echo $i?>" style='width:100px' onchange="flag(this, '<?php echo $result[$i][0]?>')">
										<option value='1' <?php echo ($result[$i][4] == 1 ? "selected" : "")?>>--</option>
										<option value='2' <?php echo ($result[$i][4] == 2 ? "selected" : "")?>>pass</option>
									</select><br>
								</div>
							</td>
						</tr>
					</table>
				</div><br>
<?php
			}
		} else {
			echo "<div style='padding-left:10px; width:100%; text-align:left'><h6>Data not found.</h6></div>";
		}
		echo "</div>";
	}

	function get_request_list() {
		$result = $this->_model->get_request_list();
		echo "<div style='padding-left:10px; width:100%; text-align:left'><h3>Request Advertising</h3></div>";
		
		if(count($result) > 0) {
			echo "<table class='list' style='border-collapse:collapse; width:100%; font-size:11px'>
				<tr class='listhead'>
					<td class='headcol'>&nbsp;</td>
					<td class='headcol'>Id</td>
					<td class='headcol'>Name</td>
					<td class='headcol'>Address</td>
					<td class='headcol'>Interest</td>
				</tr>";
						
				for($i = 0; $i < count($result); $i ++) {
					echo "<tr class='listrow' style='font-family:Courier New'>
						<td class='listcol'>&nbsp;</td>
						<td class='listcol'>";

						$this->href( "request_id", "#".$result[$i][0] ,  "#",  " jsRequestLink ('".$result[$i][0]."', '".$result[$i][14]."')" ) ;
						
						echo "<br>".date("d F Y", strtotime($result[$i][12]))."</td>
						<td class='listcol'>".$result[$i][1]."<br>".$result[$i][2]."<br>Phone: ".$result[$i][10]."</td>
						<td class='listcol'>".$result[$i][3]."<br>".$result[$i][4]."<br>".$result[$i][6]."</td>
						<td class='listcol'>Franchise: ".$result[$i][11]."<br>
								Investment: ".$result[$i][9]."<br>
								Location: ".$result[$i][7]."</td>
					</tr>";
				}
			echo "</table>";
		} else {
			echo "<div style='padding-left:10px; width:100%; text-align:left'><h6>Data not found.</h6></div>";
		}
	}

	public function request_home($id, $ad_id) {
		
		echo "<div id=\"main_body\">";
		$this->submenu($ad_id);
		$this->request_detail($id);
		echo "</div>";
	}
	
	function request_detail($id) {
		$result = $this->_model->getRequestDetails($id);
		echo "<h4> Details of ".$result[1][1]."</h4>";
		echo "<div id='message'></div>";
		echo "<table class='list' style='border-collapse:collapse; width:80%'>";
		echo "<tr class='listhead'>
				<td class='headcol'></td>
				<td class='headcol'></td>			
			</tr>";
		for($i = 0; $i < count($result); $i ++) {
			
			if  ($i == (count($result)-2) )
				echo "<tr class='listrow'>
					<td class='listcol'>".$result[$i][0]."</td>
					<td class='listcol'>".date("d F Y", strtotime($result[$i][1]))."</td>
				  </tr>";
			else
				echo "<tr class='listrow'>
					<td class='listcol'>".$result[$i][0]."</td>
					<td class='listcol'>".$result[$i][1]."</td>
				  </tr>";
		}
		
		echo "<tr><td>";
		$this->href("", "<< Back", "../home", "jsOnBack();");
		echo "</td><td></td><tr>";
		echo "</table>";
		
	}
	
	function pending_advertising() {
		$result = $this->_model->pending_advertising_list();
		echo "<div><div style='padding-left:10px; width:100%; text-align:left'><h3>Pending Advertising</h3></div>";
		if(count($result) > 0) {
			echo "<table class='list' style='width:100%'>
					<tr class='listhead'>
						<td class='headcol' width='10'>&nbsp;</td>
						<td class='headcol'>Id</td>
						<td class='headcol' width='200'>Title</td>
						<td class='headcol'>Country</td>
						<td class='headcol'>Location</td>
						<td class='headcol'>Post date</td>
						<td class='headcol'></td>
					</tr>";
			for($i = 0; $i < count($result); $i ++) {
				echo "<tr class='listrow' style='font-family:Courier New'>
						<td class='listcol' width='10'>&nbsp;</td>
						<td class='listcol'>#".$result[$i][0]."</td>
						<td class='listcol' width='200'>".$result[$i][1]."</td>
						<td class='listcol'>".$result[$i][2]."</td>
						<td class='listcol'>".$result[$i][3]."</td>
						<td class='listcol'>".date("d F Y", strtotime($result[$i][4]))." | ".$result[$i][5]."</td>
						<td class='listcol'>
							<select id=\"status$i\" style='width:100px' onchange=\"status(this, '".$result[$i][0]."')\">
								<option value='1' ".($result[$i][6] == 1 ? 'selected' : '').">--</option>
								<option value='2' ".($result[$i][6] == 2 ? 'selected' : '').">active</option>
							</select>
						</td>
					</tr>";
			}
			echo "</table>";
		} else
			echo "<div style='padding-left:10px; width:100%; text-align:left'><h6>Data not found.</h6></div>";
		echo "</div>";
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