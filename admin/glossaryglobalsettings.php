<?php
if (! defined ( 'WPINC' )) {
	exit ( 'Please do not access our files directly.' );
}


function glossarysettingsfree()
{
	?>
<div class="wrap tooltipsaddonclass">
<div id="icon-options-general" class="icon32"><br></div>
<h2>Member Directory Settings</h2>
</div>
<?php
if (isset($_POST['toolstipsCustomizedsubmit']))
{
	check_admin_referer('fucwpexpertglobalsettings');
    //!!! 7.7.7
    $glossaryIndexPageTermFontSize = sanitize_text_field($_POST['glossaryIndexPageTermFontSize']);
    $glossaryIndexPageTermFontSize = str_ireplace("px","",$glossaryIndexPageTermFontSize);
    // end 7.7.7
    
    /*
    //!!! 1.5.1
    if (isset($_POST['hidezeronumberitem']))
    {
        $hidezeronumberitem = sanitize_text_field($_POST['hidezeronumberitem']);
        update_option("hidezeronumberitem", $hidezeronumberitem);
    }
    */
    
	if (isset($_POST['tooltipsGlossaryIndexPage']))
	{
		check_admin_referer('fucwpexpertglobalsettings');
	    //7.8.7
	    $filtertooltipsGlossaryIndexPage = sanitize_text_field($_POST['tooltipsGlossaryIndexPage']);
	    update_option("tooltipsGlossaryIndexPage",$filtertooltipsGlossaryIndexPage);
		// update_option("tooltipsGlossaryIndexPage",$_POST['tooltipsGlossaryIndexPage']);
		flush_rewrite_rules();
	}

	if (isset($_POST['enabGlossaryIndexPage']))
	{
		check_admin_referer('fucwpexpertglobalsettings');
	    //7.8.7
	    $filterenabGlossaryIndexPage = sanitize_text_field($_POST['enabGlossaryIndexPage']);
	    update_option("enabGlossaryIndexPage",$filterenabGlossaryIndexPage);
		// update_option("enabGlossaryIndexPage",$_POST['enabGlossaryIndexPage']);
	}

	if (isset($_POST['enableLanguageForGlossary']))
	{
		check_admin_referer('fucwpexpertglobalsettings');
	    //7.8.7
	    $filterenableLanguageForGlossary = sanitize_text_field($_POST['enableLanguageForGlossary']);
	    update_option("enableLanguageForGlossary",$filterenableLanguageForGlossary);
		// update_option("enableLanguageForGlossary",$_POST['enableLanguageForGlossary']);
	}


	if (isset($_POST['memberdirectorysignificantdigitalsuperscripts']))
	{
		check_admin_referer('fucwpexpertglobalsettings');
	    //7.8.7 
	    $filtermemberdirectorysignificantdigitalsuperscripts = sanitize_text_field($_POST['memberdirectorysignificantdigitalsuperscripts']);
	    update_option('memberdirectorysignificantdigitalsuperscripts',$filtermemberdirectorysignificantdigitalsuperscripts);
	    
		// update_option('memberdirectorysignificantdigitalsuperscripts',$_POST['memberdirectorysignificantdigitalsuperscripts']);
	}


	if (isset($_POST['showImageinglossary']))
	{
		check_admin_referer('fucwpexpertglobalsettings');
	    //7.8.7
	    $filtershowImageinglossary = sanitize_text_field($_POST['showImageinglossary']);
	    update_option("showImageinglossary",$filtershowImageinglossary);
		// update_option("showImageinglossary",$_POST['showImageinglossary']);
	}
	$showImageinglossary = get_option("showImageinglossary");
	if (empty($showImageinglossary)) $showImageinglossary = 'YES';	

	if (isset($_POST['enableTooltipsForGlossaryPage']))
	{
		check_admin_referer('fucwpexpertglobalsettings');
		$enableTooltipsForGlossaryPage = sanitize_text_field($_POST['enableTooltipsForGlossaryPage']);
		update_option("enableTooltipsForGlossaryPage",$enableTooltipsForGlossaryPage);
	}
	
	if (isset($_POST['enableGlossarySearchable']))
	{
		check_admin_referer('fucwpexpertglobalsettings');
		$enableGlossarySearchable = sanitize_text_field($_POST['enableGlossarySearchable']);
		//7.8.7
		update_option("enableGlossarySearchable",$enableGlossarySearchable);
		// update_option("enableGlossarySearchable",$_POST['enableGlossarySearchable']);
	}
	
	//7.3.1
	if (isset($_POST['glossaryNumbersOrNot']))
	{
		check_admin_referer('fucwpexpertglobalsettings');
		//update_option("glossaryNumbersOrNot",$_POST['glossaryNumbersOrNot']);
		$glossaryNumbersOrNot = sanitize_text_field($_POST['glossaryNumbersOrNot']);
		update_option("glossaryNumbersOrNot",$glossaryNumbersOrNot);
	}	
	
	//7.3.9
	if (isset($_POST['glossaryExcerptOrContentSelect']))
	{
		check_admin_referer('fucwpexpertglobalsettings');
		//update_option("glossaryExcerptOrContentSelect",$_POST['glossaryExcerptOrContentSelect']);
		$glossaryExcerptOrContentSelect = sanitize_text_field($_POST['glossaryExcerptOrContentSelect']);
		update_option("glossaryExcerptOrContentSelect",$glossaryExcerptOrContentSelect);
	}
	
	//!!!start 7.5.1
	if (isset($_POST['bulkremoveuseridfrommemberdirectory']))
	{
		check_admin_referer('fucwpexpertglobalsettings');
		$bulkremoveuseridfrommemberdirectory = sanitize_text_field($_POST['bulkremoveuseridfrommemberdirectory']);
		update_option("bulkremoveuseridfrommemberdirectory",$bulkremoveuseridfrommemberdirectory);
	}
	$bulkremoveuseridfrommemberdirectory = get_option("bulkremoveuseridfrommemberdirectory");
	//!!!end 7.5.1

	//!!!7.6.5
	if (isset($_POST['glossaryNavItemFontSize']))
	{
		check_admin_referer('fucwpexpertglobalsettings');
		$glossaryNavItemFontSize = sanitize_text_field($_POST['glossaryNavItemFontSize']);
		$glossaryNavItemFontSize = str_ireplace("px","",$glossaryNavItemFontSize);
		if (!(empty($glossaryNavItemFontSize)))
		{
			update_option("glossaryNavItemFontSize",$glossaryNavItemFontSize);
		}		
	}
	//!!!7.6.5
	//!!!7.8.1
	if (isset($_POST['hidecountnumberitem']))
	{
		check_admin_referer('fucwpexpertglobalsettings');
	    $hidecountnumberitem = sanitize_text_field($_POST['hidecountnumberitem']);
	    update_option("hidecountnumberitem", $hidecountnumberitem);
	}
	//end 7.8.1
	//!!! 7.7.7
	if (!(empty($glossaryIndexPageTermFontSize)))
	{
	    update_option("glossaryIndexPageTermFontSize",$glossaryIndexPageTermFontSize);
	}
	// end 7.7.7
	
	$messageBarFormember_directory_freeProString =  __( 'Changes saved', 'wordpress-tooltips' );
	messageBarFormember_directory_free($messageBarFormember_directory_freeProString);
}
	$enabGlossaryIndexPage =  get_option("enabGlossaryIndexPage");
	$tooltipsGlossaryIndexPage = get_option('tooltipsGlossaryIndexPage');

	$enableLanguageForGlossary = get_option("enableLanguageForGlossary");
	$enableTooltipsForGlossaryPage = get_option("enableTooltipsForGlossaryPage");
	$showImageinglossary = get_option("showImageinglossary");
	$enableGlossarySearchable =	get_option("enableGlossarySearchable");
	$glossaryExcerptOrContentSelect = get_option("glossaryExcerptOrContentSelect");
	
	if (empty($enableGlossarySearchable)) $enableGlossarySearchable = 'yes';
	$bulkremoveuseridfrommemberdirectory = get_option('bulkremoveuseridfrommemberdirectory'); // !!! 7.5.1

	$glossaryNavItemFontSize = get_option("glossaryNavItemFontSize"); //7.7.7
	$glossaryIndexPageTermFontSize = get_option("glossaryIndexPageTermFontSize");  //7.7.7
	
	// 7.3.1
	$glossaryNumbersOrNot =  get_option("glossaryNumbersOrNot");
	$hidecountnumberitem = get_option("hidecountnumberitem"); // !!! 7.8.1
	/*
	//!!!1.5.1
	$hidezeronumberitem = get_option('hidezeronumberitem');
	*/
?>
		<div class="wrap">
			<div id="dashboard-widgets-wrap">
			    <div id="dashboard-widgets" class="metabox-holder">
					<div id="post-body">
						<div id="dashboard-widgets-main-content">
							<div class="postbox-container" style="width:90%;">
								<div class="postbox">
									<div class="inside" style='padding-left:5px;'>
										<form class="toolstipsform" name="toolstipsform" action="" method="POST">
<?php
	//2.1.9
	wp_nonce_field ( 'fucwpexpertglobalsettings' );
?>
										<table id="toolstipstable" width="100%">
	
<?php //!!! start 7.6.5 ?>
										<tr>
										<td style='width:25%'>
										<?php
											echo __( 'Nav Bar font size, all items: ', 'wordpress-tooltips' );
										?>
										</td>
										<td style='width:25%'>
										<?php 
										/*
										 * 7.9.3
										 * <input type="text" id="glossaryNavItemFontSize" name="glossaryNavItemFontSize" value="<?php echo $glossaryNavItemFontSize;  ?>" required placeholder="<?php echo __( 'for example:14', 'wordpress-tooltips' ) ?>">
										 */
										?>
										<input type="text" id="glossaryNavItemFontSize" name="glossaryNavItemFontSize" value="<?php echo esc_attr($glossaryNavItemFontSize);  ?>" required placeholder="<?php echo __( 'for example:14', 'wordpress-tooltips' ) ?>">
										</td>
										
<?php //7.7.7 ?>
										<td style='width:25%'>
										<?php
											echo __( 'Member Directory Term Font Size: ', 'wordpress-tooltips' );
										?>
										</td>
										<td style='width:25%'>
										<?php 
										/*
										 * 7.9.3
										 * <input type="text" id="glossaryIndexPageTermFontSize" name="glossaryIndexPageTermFontSize" value="<?php echo $glossaryIndexPageTermFontSize;  ?>" required placeholder="<?php echo __( 'for example:14', 'wordpress-tooltips' ) ?>">
										 * 
										 */
										?>
										<input type="text" id="glossaryIndexPageTermFontSize" name="glossaryIndexPageTermFontSize" value="<?php echo esc_attr($glossaryIndexPageTermFontSize);  ?>" required placeholder="<?php echo __( 'for example:14', 'wordpress-tooltips' ) ?>">
										</td>
										</tr>
																				
										<tr style="text-align:left;">
										<td style='width:25%'>
										<?php
											echo __( 'Hide count number of member directoryitems?: ', 'wordpress-tooltips' );
										?>
										</td>
										<td style='width:25%'>
										<select id="hidecountnumberitem" name="hidecountnumberitem" style="width:98%;">
										<option id="hidecountnumberitemOption" value="no"  <?php if ($hidecountnumberitem == 'no') echo "selected";   ?>> <?php echo __('NO', "wordpress-tooltips") ?> </option>
										<option id="hidecountnumberitemOption" value="yes" <?php if ($hidecountnumberitem == 'yes') echo "selected";   ?>>  <?php echo __('YES', "wordpress-tooltips") ?> </option>
										</select>
										</td>
										
										
										<td style='width:25%'>
										<?php
											echo __( 'Significant Display of Digital Superscripts on Navigation Bar: ', 'wordpress-tooltips' );
											$memberdirectorysignificantdigitalsuperscripts = get_option('memberdirectorysignificantdigitalsuperscripts');
										?>
										</td>
										<td style='width:25%'>
										<select id="memberdirectorysignificantdigitalsuperscripts" name="memberdirectorysignificantdigitalsuperscripts" style="width:98%;">
										<option id="optionsignificantdigitalsuperscripts" value="yes"  <?php if ($memberdirectorysignificantdigitalsuperscripts == 'yes') echo "selected";   ?>> <?php echo __('YES', "wordpress-tooltips") ?> </option>
										<option id="optionsignificantdigitalsuperscripts" value="no" <?php if ($memberdirectorysignificantdigitalsuperscripts == 'no') echo "selected";   ?>>  <?php echo __('NO', "wordpress-tooltips") ?> </option>
										</select>
										</td>
										</tr>

<?php // 7.2.1 ?>
	
<?php //!!! end 7.6.5 ?>

										</table>
										<br />
										<input type="submit" class="button-primary" id="toolstipsCustomizedsubmit" name="toolstipsCustomizedsubmit" value=" <?php echo __( 'Save Changes', 'wordpress-tooltips' ) ?> ">
										</form>
										
										<br />
									</div>
								</div>
							</div>
						</div>
					</div>
		    	</div>
			</div>
		</div>
		<div style="clear:both"></div>
		<br />
		<a class=""  target="_blank" href="https://paypal.me/sunpayment">
		<span>
		Buy me a coffee 								
		</span>
		</a>
		?
		<span style="margin-right:20px;">
		Thank you :)
		</span>
<?php
}

