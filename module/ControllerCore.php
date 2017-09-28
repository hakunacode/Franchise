<?php
require_once (dirname(__FILE__)."/../include/settings.php");
/*
 * Created on Jun 18, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class ControllerCore {

	var $_script = null;

	var $_css = null;

	function __construct($sub = "") {
		if(isset($_SESSION["islogin"])) {
			if ($sub == "admin" && $_SESSION["permission"] != 1) {
				$this->_e("required login as admin");
			} else if($sub == "advertisor" && $_SESSION["permission"] != 3) {
				$this->_e("required login as advertisor");
			}
		} else {
			if($sub != "client")
				$this->_e("required login");
		}

		$this->_script = array ("jquery-1.7.1.min.js", "function.js", 
								"jquery.js", "jquery.simplemodal.js","jquery.fileUploader.js",
								"jquery.upload.js", "jquery.liquidcarousel.js", "jquery.liquidcarousel.min.js",
								"jquery.liquidcarousel.pack.js", "jquery.shadow.js");
		$this->_css = array ("style.css", "dialog.css", "liquidcarousel.css");
	}

	function __destruct() {
	}

	function include_script() {
		for ($i = 0; $i < count($this->_script); $i ++) {
			echo "<script language=\"javascript\" src=\"../../../include/lib/".$this->_script[$i]."\"></script>\n";
		}
	}

	function include_css() {
		for ($i = 0; $i < count($this->_css); $i ++) {
			echo "<link rel=\"stylesheet\" href=\"../../../include/css/".$this->_css[$i]."\">\n";
		}
	}

	function _e($str) {
		echo "<center><p><div id='blank' style='padding:30px'>&nbsp;</div>";
		echo "<img src='../../../include/img/logo.gif' style='width:500px'><br>";
		echo "<table style='width:500px; padding:10px' cellspacing='5'>
				<tr style='border-bottom:1px solid #00ff'>
					<td style='border-bottom:2px solid green; font-weight:bold'>Limited URL access</td>
				</tr>
				<tr>
					<td style='color:#808080'>If you want to access this url, please...</td>
				</tr>
			</table>";
		echo "<a href='../../../login/login.php'>Sign in</a>";
		echo "</p></center>";
		exit;
	}
	
	function header() {
		//echo $_SERVER['HTTP_USER_AGENT'];
		echo "<html>\n"."<title>Franchise Everything</title>\n".
			"<meta content=\"This is a template site.\" name=\"description\">\n".
			"<meta content=\"anonymous\" name=\"author\">\n";

		$this->include_css();
		$this->include_script();

		echo "<body><form id='main_form' name='main_form' method='post' action=''>\n";
		echo "<center>\n<div id=\"main-container\">";
		echo "<table style='width:100%'>
			<tr height=\"50px\">
				<td width=\"\"><img src='../../../include/img/logo.gif' style='width:500px'></td>
				<td align=\"right\">".$this->menu()."</td>
			</tr></table>\n";
	}

	function menu() {
		$html = $this->href("menu_home", "Home", "#", "menu_click('home')", "", true)."&nbsp;&nbsp;";

		if(isset($_SESSION["permission"])) {
			if($_SESSION["permission"] == 1)
				$html .= $this->admin_menu();
			elseif($_SESSION["permission"] == 2)
				$html .= $this->advertisor_menu();
			else
				$html .= $this->advertisor_menu();
		} else {
			$html .= $this->client_menu();
		}
		
		return $html;
	}
	
	public function admin_menu() {
		return $this->href("menu_blog", "Blog", "#", "menu_click('blog')", "", true)."&nbsp;&nbsp;".
				$this->href("menu_account", "Account", "#", "menu_click('account')", "", true)."&nbsp;&nbsp;";
	}

	public function client_menu() {
		return $this->href("menu_blog", "Blog", "#", "menu_click('blog')", "", true)."&nbsp;&nbsp;";
	}

	public function advertisor_menu() {
		return $this->href("menu_blog", "Blog", "#", "menu_click('blog')", "", true)."&nbsp;&nbsp;";
	}
	
	public function slider() {
		return "";
	}

	function footer() {
		echo "</div>";
		echo "<div id='footer'>";
		$this->href("private_policy", "Privacy Policy", "#", "menu_click('private_policy')", "");
		echo " | ";
		$this->href("terms_conditions", "Terms and Conditions", "#", "menu_click('terms_conditions')", "");
		echo " | ";
		$this->href("contact", "Contact Us", "#", "menu_click('contact_us')", "");
		echo " | ";
		
		if(isset($_SESSION["islogin"]))
			$this->href("sign_out", "Sign out", "#", "menu_click('logout')", "");
		else
			$this->href("sign_in", "Sign in", "#", "menu_click('login')", "");

		echo "<div id='footer_copyright'>franchiseeverything.com &copy; 2012 All rights reserved.<br> 
		Publications on this website do not represent an offer to sell a franchise or business. <br>
		All buyers should obtain the appropriate documents and seek expert consultation before making any investmens. <br>
		Please see our <a href='#' onclick=\"menu_click('terms_conditions')\">terms and conditions</a> for information.<br></div>";
			
		echo "</div>";
		echo "</center>\n</form>\n<iframe name='_actionpage' style='width:0px; height:0px; border:0px'></iframe>\n</body>\n</html>\n";
	}

	function button($value, $property = "", $event = "", $id = "button1", $return = false) {
		$html = "<input type=\"button\" class=\"button\" name=\"$id\" id=\"$id\" value=\"$value\" onclick=\"$event\" $property>\n";
		if ($return)
			return $html;
		else
			echo $html;
	}

	function text($id, $value = "", $property = "", $return = false) {
		if ($return)
			return "<input type=\"text\" name=\"$id\" id=\"$id\" value=\"$value\" $property>\n";
		else
			echo "<input type=\"text\" name=\"$id\" id=\"$id\" value=\"$value\" $property>\n";
	}
	
	function password($id, $value = "", $property = "", $return = false) {
		if ($return)
			return "<input type=\"password\" name=\"$id\" id=\"$id\" value=\"$value\" $property>\n";
		else
			echo "<input type=\"password\" name=\"$id\" id=\"$id\" value=\"$value\" $property>\n";
	}
	
	function file($id, $value , $property = "", $return = false) {
		if ($return)
			return "<input type=\"file\" name=\"$id\" id=\"$id\" class=\"file\" value=\"$value\">";
		else
			echo "<input type=\"file\" name=\"$id\" id=\"$id\" class=\"file\" value=\"$value\">";
	}
	
	function textarea($id, $value = "", $width = "250px", $height = "70px", $property = "", $return = false) {
		if ($return)
			return "<textarea name=\"$id\" id=\"$id\" style=\"width:$width; height: $height; $property\">$value</textarea>\n";
		else
			echo "<textarea name=\"$id\" id=\"$id\" style=\"width:$width; height: $height; $property\">$value</textarea>\n";
	}

	function select($id, $entity, $value = null, $event = "", $property = "") {
		echo "<select id=\"$id\" name=\"$id\" $property>\n";

		foreach ($entity as $key => $text) {
			echo "<option value=\"$key\" ". ($value == $key ? "selected" : "").">$text</option>\n";
		}

		echo "</select>\n";
	}

	function radio($name, $entity = array (), $value = null, $event = "") {
		foreach ($entity as $key => $text) {
			echo "<input type=\"radio\" name=\"$name\" value=\"$key\" ". ($value == $key ? "checked" : "").">$text";
		}
	}

	function checbox($id, $key, $text, $value, $event = "") {
		echo "<input type=\"checkbox\" name=\"$id\" id=\"$id\" value=\"$key\" ". ($value == $key ? "checked" : "").">$text";
	}

	function href($id, $text, $href = "#", $event = "", $property = "", $return = false) {
		$html = "<a id=\"$id\" href=\"$href\" onclick=\"$event\" $property>$text</a>\n"; 
		if($return)
			return $html;
		else
			echo $html;
	}

	function checkboxes($id, $name, $text, $value, $checked, $return = false) {
		
		if ($checked)
			$html = "<input type='checkbox' checked id='$id' name='$name' value='$value'> <span>$text</span>";
		else 
			$html = "<input type='checkbox' id='$id' name='$name' value='$value'> <span>$text</span>";
		
		if ($return)
			return $html;
		else 
			echo $html;
	}

	function submit($value, $property = "", $event = "", $id = "button1", $return = false) {
		$html = "<input type=\"submit\" class=\"button\" name=\"$id\" id=\"$id\" value=\"$value\" $property>\n";
		if ($return)
			return $html;
		else
			echo $html;
	}
	
	public function section() {
		echo "<div id='' style=\"height:30px\"></div>";
	}
	
	public function dialog_container() {
		echo "<div id='content'>
			<div id='basic-modal-content'>
				<h3> </h3>
				<p> </p>
				<div id='basic-modal-body'></div>
			</div>
			<div style='display:none'>
				<img src='../include/img/x.png' alt='' />
			</div>
		</div>";
	}
	
	function private_policy() {
		echo "<p>You can view all of the content on our site without providing 
		personal information. However if you seek additional information on a 
		franchise or business opportunity, personal information will be 
		requested, including your name, email address and phone number. The 
		information you submit via our request form is then shared only with the
		 franchises or business opportunities that you have in your request 
		list. Franchise Everything does not share, sell, rent, or trade your 
		personal information with third parties for their promotional purposes, 
		unless authorized by you. Users who wish to correct personal information
		 can do so by resubmitting their lead(s) on the Contact Us form with the
		 correct details.</p>
		<h5>Blog Posts</h5>
		<p>Although Franchise Everything monitors Comments posted by the public on 
		our Blog, we assume no responsibility or liability arising from such 
		content. Any comments that contain any threatening, libelous, 
		defamatory, obscene, scandalous, inflammatory, pornographic, or profane 
		material will be promptly removed and will we will fully cooperate with 
		any law enforcement authorities or court order requesting or directing 
		us to disclose the identity of anyone posting any such information or 
		materials. Any personal identifiable information contained within a post
		 will be removed and the first name of the poster will be used in all 
		instances. However, you should be aware that any personally identifiable
		 information you submit to our Blog can be read, collected or used by 
		other users and could be used to send you unsolicited messages. 
		Franchise Everything is not responsible for any personally identifiable 
		information you choose to submit to our Blog.</p>
		<h5>Testimonials</h5>
		<p>We post customer testimonials on our web site which may contain 
		personally identifiable information such as the customer's name.&nbsp; 
		We do obtain the customer's consent prior to posting the testimonial to 
		post their name along with their testimonial.</p>
		<h5>Cookies</h5>
		<p>In order to provide you with a better user experience, we may collect
		 non-personal information from your computer using cookies. We use the 
		collected information for site administration, analytical and marketing 
		purposes. The cookies on this site are not tied to any personal 
		information.</p>
		<h5>Newsletter</h5>
		<p>You will be added to our newsletter mailing list only if you register
		 to receive it. We do not share your name or e-mail address with other 
		companies. If you wish to unsubscribe from our newsletter, you may opt 
		out by clicking on the �Unsubscribe� link in any of the email 
		newsletters.</p>
		<h5>Children's Privacy</h5>
		<p>Franchise Everything is intended to be used only by individuals age 18 
		and older. We do not knowingly collect any information from individuals 
		under the age of 18. If we are made aware of information collected from 
		an individual under the age of 18, we will remove their information from
		 our system as soon as possible.</p>
		<h5>Links to Other Sites</h5>
		<p>We may provide links to other companies and services from our site. 
		Once you leave our site and enter another site, you are subject to their
		 privacy policies. You should carefully review the company's privacy 
		policy before using that site.</p>
		<h5>Legal Disclaimer</h5>
		<p>We reserve the right to disclose your personally identifiable 
		information as required by law and when we believe that disclosure is 
		necessary to protect our rights and/or to comply with a judicial 
		proceeding, court order, or legal process served on our website.</p>
		<h5>Security Measures</h5>
		<p>We use a variety of security technologies and procedures to help 
		protect your personal information from unauthorized access, use or 
		disclosure. While no data transfer can be completely secure, we will 
		make reasonable efforts to secure all data that is transferred, stored 
		or processed.</p>
		<p>We recommend that you take every precaution to protect your personal 
		information when you are on the Internet. For example, use a secure 
		browser, change your passwords often, and select a strong password by 
		choosing a combination of numbers, letters and characters.</p>";
	}
	
	function contact_us() {
		echo "<ul>
				<li><h4>General Mail Box</h4>
					<span style='text-decoration:underline; font-size:12px; color:#404040'>Info@franchiseeverything.com</span></li><br><br>
				<li><h4>Darren Keathley - Sales/Website/Ads</h4>
					<span style='text-decoration:underline; font-size:12px; color:#404040'>darrenk@franchiseeverything.com</span><br>
					<span style='font-size:12px; color:#404040'>614-589-9619</span></li><br><br>
				<li><h4>Nate Zimmerman - Marketing/Sales/Billing</h4>
					<span style='text-decoration:underline; font-size:12px; color:#404040'>natez@franchiseeverything.com</span><br>
					<span style='font-size:12px; color:#404040'>570-713-9409</span></li><br><br>
			</ul>

			<p>If you are interested in advertising with us you can contact 
				Darren Keathley at 
			614-589-9619 or <span style='text-decoration:underline; font-size:12px; color:#404040'>darrenk@franchiseeverything.com</span></p>";
	}
	
	function terms_condition() {
		echo "<p>All contents of everything.com are Copyright &copy; Franchise Everything. All rights reserved. Any reproduction of any content is strictly prohibited.</p><br>

			<p>The publishers here at Franchise Everything reserve the right at their absolute discretion and at any time to refuse any advertising Submition.</p><br>
				
			<p>The views and opinions expressed in any document or image contained in, or linked to or from this site, do not necessarily state or reflect those at Franchise Everything.</p><br>
				
			<p>Franchise Everything was developed for the sole purpose of providing information and connections to other seeking to buy or sell a product, brand or other type of service. We are not offering any advice or endorsements with the information in this website . Franchise Everything, any of its employees or associates, does not assume any responsibility or liability for any actions of any listed company or subject matter contained herein, nor can we guarantee or assume liability for the accuracy, completeness or usefulness of any information from this server or any links. In no event shall Franchise Everything be liable for any indirect, special or consequential damages in connection with readers' or others' use of any content listed in Franchise Everything</p><br>
				
			<p>Franchise Everything will only put text or images on any of our websites on the explicit understanding that the client hold the copyright to all text and images.</p><br>
				
			<p>For any investment listed on Franchise Everything, it is up to the prospective buyer and user to thoroughly investigate any listing or company, obtain the appropriate disclosure documents and seek professional consultation prior to making any and all investment decisions.</p><br>
			
			<p>All buying and selling of franchise is done solebetween the prospective buyer and the selling company.  Franchise Everything only provides the connection between the two.  We are not an employee of any company nor do we represent any company or entity contianed in this site other than our own companies.</p>";
	}
}