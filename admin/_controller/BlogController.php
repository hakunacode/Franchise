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
		parent :: __construct("admin");
		$this->_model = new BlogModel();
	}

	public function __destruct() {
		parent :: __destruct();
	}

	public function home() {
		echo "<div id=\"main_body\">";
		$this->submenu();
		$this->blog_list();
		echo "</div>";
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

		echo "<div style=\"text-align:left; padding-left:10px; padding-top:25px\"><div style='float:left'><h3>The blog list</h3></div>";
		echo "<div style='float:left; padding-left:20px'>";
		if($_SESSION["islogin"])
			echo $this->button("new", "", "newblog(0)", "new");
		echo "</div>";
		echo "</div><br>";
		if (count($blogs) > 0) {
?>
			<table style="border-collapse: collapse; width:800px; font-size:12px;">
<?php

			for ($i = 0; $i < count($blogs); $i ++) {
?>
				<tr height="25px">
					<td style="border-bottom: 1px solid #ff9900"><li><h6>Posted on 
						<?php echo date("d F Y H:i:s", strtotime($blogs[$i][4]));?>
						by <font style="font-size:13px"><?php echo $blogs[$i][3]?></font></h6></li>
					</td>
					<td align="right" style="border-bottom: 1px solid #ff9900">
						<?php echo $this->href("comment$i", "comment(".$blogs[$i][5].")", "#", "view(".$blogs[$i][0].", '".$blogs[$i][1]."')")?>&nbsp;&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2" style="padding-top:3px">
						<div class="blog_title" wrap style='padding:5px 0px 10px 0px'><?php echo $blogs[$i][1]?></div>
					<?php echo $blogs[$i][2]?></td>
				</tr>
<?php

			}
?>
			</table>
<?php

		} else {
			echo "<br><div style=\"text-align:left; padding-left:10px\"><h6>Data not found</h6></div>";
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
		<input type='hidden' name='contents' id='contents'>
		<p align="center">
			<h2>Blog edit</h2>
			<div id="message"></div>
			<table style="width:600px; font-size:12px" align="center">
			<tr>
				<td width="100px">Title</td>
				<td><?php $this->text("title", "", "style='width:100%'");?></td>
			</tr>
			<tr>
				<td valign="top"></td>
				<td><iframe id='_htmlcontent' name='_htmlcontent' src='../../../include/htmlarea/htmlarea.html' frameborder='0' framespacing='0' framepadding='0' scrolling='no' width='600px' height='360px'></iframe>
					<div id='htmlcontent' name='htmlcontent' style='display:none'></div>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><?php $this->button("Submit", "", "add_post()", "submit");?>
					<?php $this->button("Cancel", "", "back()", "cancel");?></td>
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
				<td><?php $this->button("post", "", "", "post");?> <?php $this->button("cancel", "", "", "cancel");?></td>
			</tr>
		</table>
<?php

					}
				}