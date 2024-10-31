<?php
	//Add CSS file for form formatting
	$plugin_directory_name =  plugin_basename(dirname(__FILE__)); 
	wp_enqueue_style( 'myavm_style', plugin_dir_url(dirname(__FILE__)).$plugin_directory_name.'/css/bootstrap.min.css' );
?>

<div class="col-lg-12">	
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<h4 class="page-header">MyAvm Script code paste below</h4>
		<form id="myAvmForm" class="form" method="POST">
			<!-- some inputs here ... -->
			<?php wp_nonce_field( 'ob_custom_onboard_myavm_display', 'custom_onboard_myavm_display_field' ); ?>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
				<div class="form-group">
					<label>Enter address 1</label>
					<input type="text" placeholder="Enter address 1" name="avm_address1" class="form-control" id="avm_address1" value="<?php echo $avm_address1; ?>"/>
					<em id="avm_address1_err"></em>
					<em>Eg : 90 Broad St. Suite 2001</em>
				</div>	
			</div>	
			
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
				<div class="form-group">
					<label>Enter address 2</label>
					<input type="text" placeholder="Enter address 2" name="avm_address2" class="form-control" id="avm_address2" value="<?php echo $avm_address2; ?>"/>
					<em id="avm_address2_err"></em>
					<em>Eg : New York, NY </em>
				</div>	
			</div>	
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">		
				<div class="form-group">
					<label>Enter zipcode</label>
					<input type="text" placeholder="Enter zip code" name="avm_zip" class="form-control" id="avm_zip" value="<?php echo $avm_zip; ?>"/>
					<em id="avm_zip_err"></em>
				</div>	
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">		
				<div class="form-group">
					<label>Enter Email</label>
					<input type="email" placeholder="Enter email" name="avm_email" class="form-control" id="avm_email" value="<?php echo $avm_email; ?>"/>
					<em id="avm_email_err1"></em>
				</div>	
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">		
						
				<div class="form-group">
					<label>Nav widget script</label>
					<textarea name="avm_text" placeholder="Copy your myavm script" class="form-control" id="avm_text"><?php echo $value; ?></textarea>
					<em id="avm_text_err"></em>
				</div>	
				
				<div class="form-group">
					<input type="button" value="Save" id="publishAvm" class="btn btn-success">
				</div>	
			</div>	
			
		</form>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<h4 class="page-header">Copy your shortcode</h4>	
		<label>&nbsp;</label>
		<figure class="highlight"><pre><code class="codeS language-html" data-lang="html" id="copy_avm">[onboard-myavm address1="<?php echo $avm_address1; ?>" address2="<?php echo $avm_address2; ?>" zip="<?php echo $avm_zip; ?>" email="<?php echo $avm_email; ?>"]</code></pre></figure>
		<button onclick="return copy_myavm('copy_avm');" id="copybtn" class="pull-right btn btn-success">Copy</button>
	
	</div>
</div>