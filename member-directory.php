<?php
/*
 Plugin Name: Member Directory
 Plugin URI:  https://tooltips.org/member-directory
 Description: Member Directory,list all members on your site to help users contact each other more easier
 Version: 2.2.3
 Author: https://tooltips.org/
 Author URI: https://tooltips.org/
 Text Domain: member-directory
 License: GPLv3 or later
 */
/*  Copyright 2015 - 2024 Tomas Zhu
 This program comes with ABSOLUTELY NO WARRANTY;
 https://www.gnu.org/licenses/gpl-3.0.html
 https://www.gnu.org/licenses/quick-guide-gplv3.html
 */
if (!defined('ABSPATH'))
{
	exit;
}

require_once("rules/useroles.php");
require_once("admin/admin.php");


function member_directory_loader_scripts_free()
{
	wp_register_style( 'directorycss', plugin_dir_url( __FILE__ ).'asset/js/jdirectory/directory.css');
	wp_enqueue_style( 'directorycss' );
	
	wp_register_script( 'directoryjs', plugin_dir_url( __FILE__ ).'asset/js/jdirectory/jquery.directory.js', array('jquery'));
	wp_enqueue_script( 'directoryjs' );
}
add_action( 'wp_enqueue_scripts', 'member_directory_loader_scripts_free' );


function member_directory_shortcode_free($atts)
{
    global $table_prefix,$wpdb,$post;
    
	$member_user_role = '';
	$member_user_include = '';
	

	//2.1.3
    if (isset($atts['role'])) {
        $member_user_role = sanitize_text_field($atts['role']);
    }	

	//2.2.3
    if (isset($atts['include'])) {
        $member_user_include = sanitize_text_field($atts['include']);
    }	
	

    $return_content = '';
    $return_content .= '<div class="member_directory_table">';
    
    // before 2.1.3 $results = get_users();
	//2.1.3
	if (!(empty($member_user_role)))
	{
		$member_user_role_array = array('role' => $member_user_role);

		$results = get_users($member_user_role_array);

	}
        
	//2.2.3
	if (!(empty($member_user_include)))
	{
		$member_user_include_array = array('include' => $member_user_include);
		$results = get_users($member_user_include_array);
	}


	if ((empty($member_user_role)) && (empty($member_user_include)))
	{
		$results = get_users();
	}

    if ((!(empty($results))) && (is_array($results)) && (count($results) >0))
    {
        $m_single = array();
        foreach ($results as $single)
        {
            $user_allowed_listed = true;
            $memberDirectoryUserRoleSelect = get_option('memberDirectoryUserRoleSelect');
            if (empty($memberDirectoryUserRoleSelect))
            {
                
            }
            else
            {
                $user_allowed_listed = check_user_role_allowed_free($single);
                
                if ($user_allowed_listed == false)
                {
                    continue;
                }
                
                //2.0.5
                $check_user_exclude_free = check_user_exclude_free($single);
                if ($check_user_exclude_free == false)
                {
                    continue;
                }
                //2.0.5
                
            }
            
            $return_content .= '<div class="tooltips_list">';
            $return_content .= '<span class="tooltips_table_items">';
            $return_content .= '<div class="tooltips_table">';
            $return_content .= '<div class="tooltips_table_title">';
            $enabGlossaryIndexPage =  get_option("enabGlossaryIndexPage");
            
            $return_content .=	$single->display_name;
            $return_content .='</div>';
            $return_content .= '<div class="tooltips_table_content">';
            
            // old $m_content = $single->user_email;
            // 1.3.1
            $m_content = '';
            $m_content_user_email = $single->user_email;
            $m_content_user_bio_in_wp = get_the_author_meta('description',$single->ID);
            $m_content .= "<div class = 'member_content_user_email'>";
            $m_content .= $m_content_user_email;
            $m_content .= "</div>";
            $m_content .= "<div class = 'member_content_user_description'>";
            $m_content .= $m_content_user_bio_in_wp;
            $m_content .= "</div>";
            
            $return_content .=	$m_content;
            $return_content .='</div>';
            $return_content .='</div>';
            $return_content .='</span>';
            $return_content .='</div>';
        }
    }
    $return_content .= '</div>';
    
    return $return_content;
}
add_shortcode( 'member_directory', 'member_directory_shortcode_free',10 );





function member_directory_load_footer_js_free()
{
    global $post;
    
    $hidezeronumberitem = get_option('hidezeronumberitem');
    if (empty($hidezeronumberitem)) $hidezeronumberitem = 'no';
    
    ?>
<script type="text/javascript">
var inboxs = new Array();
inboxs['hidezeronumberitem'] = "yes";
//inboxs['hidezeronumberitem'] = "<?php echo esc_attr($hidezeronumberitem); ?>";

inboxs['selectors'] = '.tooltips_list > span';
<?php 
$glossarySelectedNavItemFontSize = get_option("glossarySelectedNavItemFontSize");
$glossaryNavItemFontSize = get_option("glossaryNavItemFontSize");
if (empty($glossaryNavItemFontSize))
{
	$glossaryNavItemFontSize = '12px';
}
else 
{
	$glossaryNavItemFontSize = $glossaryNavItemFontSize.'px';
}
?>
inboxs['navitemdefaultsize'] = '<?php echo esc_attr($glossaryNavItemFontSize); ?>';
//inboxs['navitemdefaultsize'] = '<?php echo esc_attr($glossaryNavItemFontSize); ?>'; 
inboxs['navitemselectedsize'] = '<?php echo esc_attr($glossarySelectedNavItemFontSize); ?>';
<?php 
//$glossaryNumbersOrNot = 'no';
$glossaryNumbersOrNot =  get_option("glossaryNumbersOrNot");
if (empty($glossaryNumbersOrNot))
{
    $glossaryNumbersOrNot = 'yes';
}
$glossaryNumbersOrNot = strtolower($glossaryNumbersOrNot);

//8.4.3
$choseLanguageForGlossary = get_option("enableLanguageForGlossary");
if (empty($choseLanguageForGlossary)) $choseLanguageForGlossary = 'en';

//end 8.4.3

if ($choseLanguageForGlossary == 'custom')
{
	$glossaryLanguageCustomNavLetters = 'a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z';
	?>
	inboxs['alphabetletters'] = "<?php echo esc_attr($glossaryLanguageCustomNavLetters); ?>";
	<?php
}
?>
//inboxs['number'] = "no";
inboxs['number'] = "<?php echo esc_attr($glossaryNumbersOrNot); ?>";
jQuery(document).ready(function () {
	jQuery('.member_directory_table').directory(inboxs);
	jQuery('.navitem').css('font-size','<?php echo esc_attr($glossaryNavItemFontSize); ?>');	
})
</script>
<?php
}
add_action('wp_footer','member_directory_load_footer_js_free');


function check_user_role_allowed_free($checkuser)
{
	$memberDirectoryUserRoleSelect = get_option('memberDirectoryUserRoleSelect');
	$saved_allowed_user_roles_in_member_directory = get_option('saved_allowed_user_roles_in_member_directory');
	
	//18.3.8
	if (empty($checkuser))
	{
	    return false;
	}
	
	if (empty($memberDirectoryUserRoleSelect))
	{
		return true;
	}
	else
	{
		if ('enableMemberDirectoryUserRolesOption' == $memberDirectoryUserRoleSelect)
		{
			$can_listed = false;
			
			$checking_user_roles = $checkuser->roles;
			
			
			
			
			if (empty($checking_user_roles))
			{
				return false ;
			}
			else 
			{
				foreach ($checking_user_roles as $checking_user_role)
				{
					if (in_array(strtolower($checking_user_role), $saved_allowed_user_roles_in_member_directory) )
					{
						
						$can_listed = true;
						
						
						
						return true;
					}
				}
			}
			
		}
		
		if ('disableMemberDirectoryUserRolesOption' == $memberDirectoryUserRoleSelect)
		{
			$can_listed = true;
			$checking_user_roles = $checkuser->roles;
			if (empty($checking_user_roles))
			{
				return false ;
			}
			else
			{
				foreach ($checking_user_roles as $checking_user_role)
				{
					if (in_array(strtolower($checking_user_role), $saved_allowed_user_roles_in_member_directory) )
					{
						$can_listed = false;
						return false;
					}
				}
			}
				
		}
		
		return $can_listed;
	}
	
	
}



function glossarysuperscriptsfree()
{
    $selectsignificantdigitalsuperscripts = get_option('memberdirectorysignificantdigitalsuperscripts');
    if ('no' == strtolower($selectsignificantdigitalsuperscripts))
    {
        ?>
<script type="text/javascript">
jQuery("document").ready(function()
		{
			jQuery('.tooltiplist_count').css('vertical-align','top');
		});
</script>
<?php 		
	}
	$hidecountnumberitem = get_option("hidecountnumberitem");
	if ('yes' == strtolower($hidecountnumberitem))
	{
	    
	    ?>
	<script type="text/javascript">
	jQuery("document").ready(function()
			{
				jQuery('.tooltiplist_count').css('display','none'); 
			});
	</script>
	<?php 		
	
	}
}
add_action('wp_footer','glossarysuperscriptsfree');


function loadMemberDirectoryStyleFree()
{
    $glossaryIndexPageTermFontSize = get_option("glossaryIndexPageTermFontSize"); //!!!
    if (!(empty($glossaryIndexPageTermFontSize)))
    {
        /*
         * 7.9.3
         * font-size: <?php echo $glossaryIndexPageTermFontSize.'px';  ?> !important;
         */
        ?>
						<style type="text/css">
							.tooltips_table_title 
							{
							font-size: <?php echo esc_attr($glossaryIndexPageTermFontSize).'px';  ?> !important;
							}
						</style>
					<?php 						
	}
}
add_action('wp_head', 'loadMemberDirectoryStyleFree');

//2.0.5
function check_user_exclude_free($checkuser)
{
    
    $bulkremoveuseridfrommemberdirectory = '';
    $bulkremoveuseridfrommemberdirectory = get_option('bulkremovetermfromglossarylist');
    
    
    if (!(empty($bulkremoveuseridfrommemberdirectory)))
    {
        $patterns = '';
        $replacements = '';
        $bulkremoveuseridfrommemberdirectory = trim($bulkremoveuseridfrommemberdirectory);
        $bulkremoveuseridfrommemberdirectoryarray = explode(',', $bulkremoveuseridfrommemberdirectory);
        
        if ((!(empty($bulkremoveuseridfrommemberdirectoryarray))) && (is_array($bulkremoveuseridfrommemberdirectoryarray)) && (count($bulkremoveuseridfrommemberdirectoryarray) > 0))
        {
            $bulkremoveuseridfrommemberdirectoryarray = array_filter($bulkremoveuseridfrommemberdirectoryarray);
        }
        
        if ((!(empty($bulkremoveuseridfrommemberdirectoryarray))) && (is_array($bulkremoveuseridfrommemberdirectoryarray)) && (count($bulkremoveuseridfrommemberdirectoryarray) > 0))
        {
            if (in_array($checkuser->data->ID, $bulkremoveuseridfrommemberdirectoryarray))
            {
                return false;
            }
        }
    }
    return true;
}

