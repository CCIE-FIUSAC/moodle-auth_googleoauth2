Google/Facebook/WindowsLive Oauth 2.0 Authentication Plugin
===========================================================

This plugin adds a Google/Facebook/Windows Live button on the front page (see the installation process on how to edit your login page).
The first time the user clicks on the button, a new account is created.

Plugin installation:
--------------------

> Step 4. is about adding some code in Moodle to display the authentication providers logos. It is a just an example.
It could actually be implemented anywhere (theme, block, alternative login page...). This step requires PHP and Moodle code knowledge.

1. add the plugin into /auth/googleoauth2/

2. in Moodle admin, enable the plugin (Admin block > Plugins > Auhtentication)

3. in the plugin settings, follow the instructions to your client ids + client secrets.

4. in your theme (most likely in login/index.html. Or in the login layout page if you theme has a specific login page, something like /theme/YOURTHEME/layout/login.php), add and edit the following little piece of ugly HTML/PHP code:

        <?php 
	        //get previous auth provider
	        $allauthproviders = optional_param('allauthproviders', false, PARAM_BOOL);
	        $cookiename = 'MOODLEGOOGLEOAUTH2_'.$CFG->sessioncookie;
	        if (empty($_COOKIE[$cookiename])) {
	            $authprovider = '';
	        } else {
	            $authprovider = $_COOKIE[$cookiename];
	        }
	    ?>
        <center> 
            <br/><br/><br/>
			<?php echo get_string('signinwithanaccount','auth_googleoauth2'); ?>
			<br/><br/>
            <div style="width:'1%'">
	            <?php
	            	$displayprovider = ((empty($authprovider) || $authprovider == 'google' || $allauthproviders) && get_config('auth/googleoauth2', 'googleclientid'));
	            	$providerdisplaystyle = $displayprovider?'display:inline-block;':'display:none;';
	            ?>
	            <div class="singinprovider" style="<?php echo $providerdisplaystyle; ?>">
					<a href="https://accounts.google.com/o/oauth2/auth?client_id=<?php echo get_config('auth/googleoauth2', 'googleclientid'); ?>&redirect_uri=<?php echo $CFG->wwwroot; ?>/auth/googleoauth2/google_redirect.php&scope=https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email&response_type=code">
						<img src="<?php echo $CFG->wwwroot ?>/theme/YOURTHEME/pix/GOOGLELOGO.jpg" />
					</a>
	            </div>
	            <?php 
	            	$displayprovider = ((empty($authprovider) || $authprovider == 'facebook' || $allauthproviders) && get_config('auth/googleoauth2', 'facebookclientid'));
	            	$providerdisplaystyle = $displayprovider?'display:inline-block;':'display:none;';
	            ?>
	            <div class="singinprovider" style="<?php echo $providerdisplaystyle; ?> padding-left: 20px;">
					<a href="https://www.facebook.com/dialog/oauth?client_id=<?php echo get_config('auth/googleoauth2', 'facebookclientid'); ?>&redirect_uri=<?php echo $CFG->wwwroot; ?>/auth/googleoauth2/facebook_redirect.php&scope=email&response_type=code">
						<img src="<?php echo $CFG->wwwroot ?>/theme/YOURTHEME/pix/FACEBOOKLOGO.png" />
					</a>
	            </div>
	            <?php 
	            	$displayprovider = ((empty($authprovider) || $authprovider == 'messenger' || $allauthproviders) && get_config('auth/googleoauth2', 'messengerclientid'));
	            	$providerdisplaystyle = $displayprovider?'display:inline-block;':'display:none;';
	            ?>
	            <div class="singinprovider" style="<?php echo $providerdisplaystyle; ?>">
					<a href="https://oauth.live.com/authorize?client_id=<?php echo get_config('auth/googleoauth2', 'messengerclientid'); ?>&redirect_uri=<?php echo $CFG->wwwroot; ?>/auth/googleoauth2/messenger_redirect.php&scope=wl.basic wl.emails wl.signin&response_type=code">
						<img src="<?php echo $CFG->wwwroot ?>/theme/YOURTHEME/pix/MESSENGERLOGO.jpg" />
					</a>
	            </div>
            </div>
            <?php if (!empty($authprovider)) { ?>
            	<br/><br/>
            	<div class="moreproviderlink">
                	<a href='<?php echo $CFG->wwwroot . (!empty($CFG->alternateloginurl) ? $CFG->alternateloginurl : '/login/index.php') . '?allauthproviders=true'; ?>' onclick="changecss('singinprovider','display','inline-block');">
						<?php echo get_string('moreproviderlink', 'auth_googleoauth2');?>
					</a>
            	</div>
            <?php } ?>
        </center>
        
    > More information about Moodle theme 2.0: http://docs.moodle.org/dev/Themes_2.0
    Basically, you want to look to your theme/config.php. Find in it what is the login layout file name. Then add this example code in this layout file.

5. (Recommended) Register on IPinfoDB for key: http://www.ipinfodb.com/register.php. Then enter the key in the plugin settings. Thus Moodle can pre-filled the city and the country of the user.

6. (Optional) Change the prefix of new users. By default they are name social_user_XXX.

FAQ and Support
---------------

Read the [Wiki](https://github.com/mouneyrac/auth_googleoauth2/wiki).
You are welcome to send Pull Request and to report [issues](https://github.com/mouneyrac/auth_googleoauth2/issues).