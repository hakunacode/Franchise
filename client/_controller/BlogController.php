<?php
require_once (dirname(__FILE__)."/../_model/BlogModel.php");

require_once (dirname(__FILE__)."/../../module/ControllerCore.php");
/*
 * Created on Jun 18, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class BlogController extends ControllerCore {

	var $_model = null;

	var $_timefactory = null;

	public function __construct() {
		parent :: __construct("client");
		$this->_model = new BlogModel();
	}

	public function __destruct() {
		parent :: __destruct();
	}

	public function home() {
		$this->subheader();
		echo "<div id=\"main_body\">";
		//$this->submenu();
		$this->blog_list();
		echo "</div>";
	}

	function subheader() {
		echo "<div id='subbanner'>
				<div id='banner_title'>Blog Hotspot for Franchise News ...</div>
				<div id='banner_description'>Here on the Franchise Everything franchise blog, we discuss all things helpful and interesting for prospective franchisees. Franchise industry news, unique franchise opportunities, franchise tips, trends & much more. If you want to know anything franchise related, post me a comment�</div>
			</div>";
	}

	public function submenu($title = "") {
		echo "<table style='width:100%'>
						<tr style=\"height:3px; background:maroon; font-size: 12px\">
						<td colspan=\"2\" style=\"padding-left: 10px; height: 30px;\"><img src=\"../../../include/img/icon_home.gif\"> ";
		$this->href("blog", "Blog", "#", "menu_click('blog')", "class='submenu'");
		if ($title != "") {
			echo "<span style=\"color:white\"> >> $title</span>";
		}

		echo "</td>
			</tr>
		<table>";
	}

	function blog_list() {
		$blogs = $this->_model->get_blog_list();

		echo "<div style=\"text-align:left; padding-left:10px; padding-top:25px\"><h3>The blog list</h3></div>";
		if (count($blogs) > 0) {
			echo "<table style='border-collapse: collapse; width:800px; font-size:12px;'>";

			for ($i = 0; $i < count($blogs); $i ++) {
				echo "<tr height='25px'>
					<td style='border-bottom: 1px solid #ff9900'><li><h6>Posted on ".$blogs[$i][4]." 
						by <font style='font-size:13px'>".str_replace("-", "/", $blogs[$i][3])."</font></h6></li>
					</td>
					<td align='right' style='border-bottom: 1px solid #ff9900'>";
						$this->href("comment$i", "comment(".$blogs[$i][5].")", "#", "view(".$blogs[$i][0].")");
						echo "&nbsp;&nbsp;</td>
				</tr>
				<tr>
					<td colspan='2' style='padding-top:3px'><div class='blog_title' wrap>".$blogs[$i][1]."</div>
					".$blogs[$i][2]."</td>
				</tr>";
			}
			echo "</table>";
		} else {
			echo "<br><div style='padding-left:10px; width:100%; text-align:left'><h6>Data not found.</h6></div>";
		}
	}

	function view($id) {
		$info = $this->_model->get_info($id);
?>
		<table style="border-collapse: collapse; width:800px; font-size:12px;">
			<tr height="50px" valign="bottom">
				<td style="border-bottom: 1px solid #ff9900"><li><h6>Posted on 
				<?php echo $info[0][4];?>
					by <font style="font-size:13px"><?php echo str_replace("-", "/", $info[0][3])?></font></h6></li>
				</td>
			</tr>
			<tr>
				<td style="padding-top:3px"><div class="blog_title" wrap><?php echo $info[0][1]?></div>
				<?php echo $info[0][2]?></td>
			</tr>
		</table><br>
<?php

		$this->blog_comment_list($id);
		$this->new_comment($id);
	}
	function edit($id) {
?>
		<p align="center">
			<h2>The title</h2>
			<div id="message"></div>
			<table style="width:600px; font-size:12px" align="center">
			<tr>
				<td width="100px">Title</td>
				<td><?php $this->text("title", "", "style='width:100%'");?></td>
			</tr>
			<tr>
				<td valign="top">Content</td>
				<td><?php $this->textarea("content", "", "100%", "200px");?></td>
			</tr>
			<tr>
				<td></td>
				<td><?php $this->button("Submit", "", "", "submit");?>
					<?php $this->button("Cancel", "", "", "cancel");?></td>
			</tr>
			</table>
		</p>
<?php
	}

	function blog_comment_list($id) {
		$comments = $this->_model->get_blog_comment_list($id);

		if (count($comments) > 0) {
			for ($i = 0; $i < count($comments); $i ++) {
?>				
				<div class="comment_list_row" style="width:700px">
					<table style="width:100%; font-size:12px;">
						<tr>
							<td width="100%" valign="top" style="padding-left:10px">
								<div style="float:left; padding:2px; border:1px solid #808080; width:40px">
									<img src="../../../include/img/comment_user.jpg">
								</div>
								<div style="float:left; padding-left:15px; width:600px">
									<h6 style="color:#ff992f; font-size:12px">Posted on <?php echo $comments[$i][4];?>&nbsp;
										by <?php echo $comments[$i][1]?>
										<span style='font-weight:normal; color:#808080'><?php echo "{".$comments[$i][2]."}"?></span>
									</h6>
									<div style="color:#202020"><?php echo $comments[$i][3]?></div>
								</div>	
							</td>
						</tr>
					</table>
				</div><br>
<?php

			}
		}
	}

	function new_comment($id) {
?>
		<table style="font-size:12px">
			<tr>
				<td width="150px" nowrap>Your name</td>
				<td><?php $this->text("name", "", "style='width:250px'");?></td>
			</tr>
			<tr>
				<td nowrap>Email address</td>
				<td><?php $this->text("email", "", "style='width:250px'");?></td>
			</tr>
			<tr>
				<td valign="top" nowrap>Comment</td>
				<td><?php $this->textarea("comment", "", "400px", "100px");?></td>
			</tr>
			<tr>
				<td nowrap></td>
				<td><?php $this->button("post", "", "add_comment()", "post");?>&nbsp;
					<?php $this->button("cancel", "", "back()", "cancel");?></td>
			</tr>
		</table>
<?php

					}
				}