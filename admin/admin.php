<?php
if (!defined('ABSPATH'))
{
	exit;
}


function tomas_member_directory_menu_free()
{
	add_menu_page(__('Member Directory', 'member-directory'), __('Member Directory', 'member-directory'), 'manage_options', 'memberdirectoryrolesetting_free', 'memberdirectoryrolesetting_free');
	add_submenu_page('memberdirectoryrolesetting_free', __('User Roles', 'member-directory'), __('User Roles', 'member-directory'), 'manage_options', 'memberdirectoryrolesetting_free', 'memberdirectoryrolesetting_free');
	add_submenu_page('memberdirectoryrolesetting_free',__('Member Directory Setttings','member-directory'), __('Member Directory Setttings','member-directory'),"manage_options", 'glossarysettingsfree','memberdirectoryFreeGlossarySettings');
}


function memberdirectoryFreeGlossarySettings()
{
    require_once("glossaryglobalsettings.php");
    glossarysettingsfree();
}

add_action( 'admin_menu', 'tomas_member_directory_menu_free');

//---

function tomas_setting_panel_member_directory_free($title = '', $content = '')
{
    ?>
<div class="wrap">
	<div id="dashboard-widgets-wrap">
		<div id="dashboard-widgets" class="metabox-holder">
			<div id="post-body">
				<div id="dashboard-widgets-main-content">
					<div class="postbox-container" style="width: 90%;">
						<div class="postbox">					
							<h3 class='hndle' style='padding: 10px 0px; border-bottom: 0px solid #eee !important;'>
							<span>
								<?php	echo $title; 	?>
							</span>
							</h3>
						
							<div class="inside postbox" style='padding-top:10px; padding-left: 10px; ' >
								<?php echo $content; ?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div style="clear: both"></div>
<?php	
}

function setting_panel_member_directory_head_free($title)
{
	?>
		<div style='padding-top:20px; font-size:22px;'><?php echo $title; ?></div>
		<div style='clear:both'></div>
<?php 
}

function tooltipdirectorysetting_free()
{
    $title = 'Directory Global Settings';
    setting_panel_member_directory_head_free($title);
    
    if (isset($_POST['memberDirectoryUserRoleSubmit']))
    {
		check_admin_referer('fucwpexpertglobalsettings');
        messageBarFormember_directory_free('Change Saved');
    }
    
    if (isset($_POST['postDirectorySubmit']))
    {
		check_admin_referer('fucwpexpertglobalsettings');
        messageBarFormember_directory_free('Change Saved');
    }

    post_directory_panel_free();
    memberdirectoryrolesetting_free();
}

function memberdirectoryrolesetting_free()
{
	global $wpdb,$table_prefix;

	if (isset($_POST['memberDirectoryUserRoleSelect']))
	{
		//2.1.9 
		check_admin_referer('fucwpexpertglobalsettings');

	    $memberDirectoryUserRoleSelect = sanitize_text_field($_POST['memberDirectoryUserRoleSelect']);
		update_option('memberDirectoryUserRoleSelect',$memberDirectoryUserRoleSelect);
	}
	$memberDirectoryUserRoleSelect = get_option('memberDirectoryUserRoleSelect');

	//2.0.5
	if (isset($_POST['bulkremovetermfromglossarylist']))
	{
		// 2.1.9 
		check_admin_referer('fucwpexpertglobalsettings');

	    $bulkremovetermfromglossarylist = sanitize_text_field($_POST['bulkremovetermfromglossarylist']);
	    update_option("bulkremovetermfromglossarylist",$bulkremovetermfromglossarylist);
	}
	$bulkremovetermfromglossarylist = get_option("bulkremovetermfromglossarylist");
	//end 2.0.5
	
	$title = ' Enable / Disable Specific User Roles Show in User Member Directory';
	$content = '';
	
	$content .= '<form class="formmember_directory" name="formmember_directory" action="" method="POST">';

	//2.1.9
	$member_nonce_field = wp_nonce_field ( 'fucwpexpertglobalsettings','_wpnonce', true,false );
	$content .= $member_nonce_field;


	$content .= '<select name="memberDirectoryUserRoleSelect" id="memberDirectoryUserRoleSelect">';
	$memberDirectoryUserRoleSelect = get_option('memberDirectoryUserRoleSelect');
	if ($memberDirectoryUserRoleSelect == 'enableMemberDirectoryUserRolesOption')
	{
		$content .= '<OPTION value="enableMemberDirectoryUserRolesOption" SELECTED>Enable These User Roles in Member Directory </OPTION>';
	}
	else
	{
		$content .= '<OPTION value="enableMemberDirectoryUserRolesOption" >Enable These User Roles in Member Directory </OPTION>';
	}
	
	if ($memberDirectoryUserRoleSelect == 'disableMemberDirectoryUserRolesOption')
	{
		$content .= '<OPTION value="disableMemberDirectoryUserRolesOption" SELECTED>Disable These User Roles in Member Directory </OPTION>';
	}
	else 
	{
		$content .= '<OPTION value="disableMemberDirectoryUserRolesOption">Disable These User Roles in Member Directory </OPTION>';
	}
	
	$content .= '</select> ';

	$content .= '<br /> ';
	
	$content .= show_member_user_roles_free();	
	//2.0.5
	$content .= "<br /> ";
	$content .= "<br /> ";
	
	$bulkremoveuseridfrommemberdirectory = get_option('bulkremovetermfromglossarylist');
	$content .=  __( "Bulk remove user from member directory by user id: ", 'wordpress-tooltips' );
	$bulkremoveuseridfrommemberdirectoryexampe = __("for example: 3,22,58,126,583", "wordpress-tooltips");
	$bulkremoveuseridfrommemberdirectoryexampe = "for example: 3,22,58,126,583";
	$content .=  '<input type="text" id="bulkremovetermfromglossarylist" name="bulkremovetermfromglossarylist" value="'.esc_attr($bulkremoveuseridfrommemberdirectory) .'" placeholder=" '.$bulkremoveuseridfrommemberdirectoryexampe.' ">';
	//end 2.0.5
	
	
	$content .= '<div style="margin:12px 0px;"> ';
	$content .= '<input type="submit" class="button-primary" id="memberDirectoryUserRoleSubmit" name="memberDirectoryUserRoleSubmit" value=" Submit ">';
	$content .= '</div> '; 
	$content .= '</form>';
	
	$content .= "<div style='margin:12px 12px;'>";
	$content .= "please use shortcode: [member_directory]";
	$content .= "</div>";
	$content .= "<div style='margin:12px 12px;'>";
	$content .= "how to use: <a href='https://tooltips.org/how-to-create-a-member-directory-via-wordpress-tooltip/' target='_blank'>How to Create a Member Directory Via WordPress Tooltip?</a>";
	$content .= "</div>";
	tomas_setting_panel_member_directory_free($title, $content);
}

function post_directory_panel_free()
{
    if (isset($_POST['postDirectorySelect']))
    {
		//2.1.9
		check_admin_referer('fucwpexpertglobalsettings');

        $postDirectorySelect = sanitize_text_field($_POST['postDirectorySelect']);
        update_option('postDirectorySelect',$postDirectorySelect);
    }
    $postDirectorySelect = get_option('postDirectorySelect');
    
    $title = '  Enable / Disable WordPress Post Directory ?';
    $content = '';
    
    $content .= '<form class="formmember_directory" name="formmember_directory" action="" method="POST">';
	//2.1.9
	$member_nonce_field = wp_nonce_field ( 'fucwpexpertglobalsettings','_wpnonce', true,false );
	$content .= $member_nonce_field;    

    $content .= '<select name="postDirectorySelect" id="postDirectorySelect">';
    $postDirectorySelect = get_option('postDirectorySelect');
    if ($postDirectorySelect == 'postDirectorySelectOption')
    {
        $content .= '<OPTION value="enablepostDirectorySelectOption" SELECTED>Enable Wordpress Post Directory ?</OPTION>';
    }
    else
    {
        $content .= '<OPTION value="enablepostDirectorySelectOption" >Enable WordPress Post Directory ?</OPTION>';
    }
    
    if ($postDirectorySelect == 'disablepostDirectorySelectOption')
    {
        $content .= '<OPTION value="disablepostDirectorySelectOption" SELECTED>Disable WordPress Post Directory ?</OPTION>';
    }
    else
    {
        $content .= '<OPTION value="disablepostDirectorySelectOption">Disable WordPress Post Directory ?</OPTION>';
    }
    
    $content .= '</select> ';
    
    $content .= '<br /> '; //19.1.8
    $content .= '<div style="margin:12px 0px;"> '; //19.1.8
    $content .= '<input type="submit" class="button-primary" id="postDirectorySubmit" name="postDirectorySubmit" value=" Submit ">';
    $content .= '</div> '; //19.1.8
    $content .= '</form>';
    
    $content .= "<div style='margin:12px 12px;'>";
    $content .= "please use shortcode: [postdirectory]";
    $content .= "<p>";
    $content .= "this shortcode will display all posts in the directory";
    $content .= "</p>";
    $content .= "<p>";
    $content .= "or shortcode: [postdirectory catid='38,1']";
    $content .= "</p>";
    $content .= "<p>";
    $content .= "this shortcode only list posts of the  specified category";
    $content .= "</p>";
    $content .= "</div>";

    $content .= "<div style='margin:12px 12px;'>";
    $content .= "how to use: <a href='https://tooltips.org/how-to-create-a-wordpress-post-directory-quickly-supported-by-wordpress-tooltips-pro-plus-plugin-18-6-8/' target='_blank'>How to create a Wordpress post directory quickly?</a>";
    $content .= "</div>";
    tomas_setting_panel_member_directory_free($title, $content);
    
}


function messageBarFormember_directory_free($p_message)
{
    
    echo "<div id='message' class='updated fade'>";
    
    echo $p_message;
    
    echo "</div>";
    
}

