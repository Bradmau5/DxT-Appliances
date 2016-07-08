<!doctype html>
<html>
<head>
    <!-- META -->
    <meta charset="utf-8">
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css" />
    <title><?php echo Config::get('TITLE'); ?></title>
    <script type='text/javascript' src='//code.jquery.com/jquery-1.9.1.js'></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.4/themes/black-tie/jquery-ui.css">
<script type="text/javascript">
$(window).load(function(){
(function($) {
	$.fn.searchPc = function(options) {

		var settings = $.extend({
	        address2: 'address2',
	        address3: 'address3'
		}, options);

		return this.each(function() {

			var $el = $(this);
			var $form = $el.closest('form');

			//insert the button on the form
			$('<a class="postCodeLookup">Search</a>').insertBefore($el);
			$('.postCodeLookup', $form).button({icons:{primary:'ui-icon-search'}});

			$form.on('click', '.postCodeLookup', function() {

				$.post('http://maps.googleapis.com/maps/api/geocode/json?address='+$el.val()+'&sensor=false', function(r) {
					var lat = r['results'][0]['geometry']['location']['lat'];
					var lng = r['results'][0]['geometry']['location']['lng'];
					$.post('http://maps.googleapis.com/maps/api/geocode/json?latlng='+lat+','+lng+'&sensor=false', function(address) {
                        $('input[name='+settings.address2+']').val(address['results'][0]['address_components'][1]['long_name']);
                        $('input[name='+settings.address3+']').val(address['results'][0]['address_components'][2]['long_name']);
					});
				});

			});

			

		});
	};
})(jQuery);


		$('input[name=postcode]').searchPc({
            address2: 'custom_field',
		});
});
</script>
</head>
<body>
    <!-- wrapper, to center website -->
    <div class="wrapper">

        <!-- logo -->
        <div class="logo"></div>

        <!-- navigation -->
        <ul class="navigation">
            <?php if (Session::userIsLoggedIn() && Session::get('user_account_type') >= 1 && Session::get('user_account_type') <= 3) { ?>
                <li <?php if (View::checkForActiveController($filename, "overview")) { echo ' class="active" '; } ?> >
                	<a href="<?php echo Config::get('URL'); ?>profile/index">Profiles</a>
            	</li>
		<li <?php if (View::checkForActiveController($filename, "dashboard")) { echo ' class="active" '; } ?> >		    
                    <a href="<?php echo Config::get('URL'); ?>dashboard/index">Jobs</a>
                </li>
                <li <?php if (View::checkForActiveController($filename, "note")) { echo ' class="active" '; } ?> >
                    <a href="<?php echo Config::get('URL'); ?>note/index">My Notes</a>
                </li>
		<?php if(Session::get('user_account_type') >= 1 || Session::get('user_account_type') <= 3){ ?>
		<li <?php if (View::checkForActiveController($filename, "admin")) { echo ' class="active" '; } ?> >
                    <a href="<?php echo Config::get('URL'); ?>admin/index">Administration</a>
                </li>
		<?php } ?>
            <?php } else if(!Session::userIsLoggedIn()) { ?>
                <!-- for not logged in users -->
                <li <?php if (View::checkForActiveControllerAndAction($filename, "login/index")) { echo ' class="active" '; } ?> >
                    <a href="<?php echo Config::get('URL'); ?>login/index">Login</a>
                </li>
            <?php } ?>
        </ul>

        <!-- my account -->
        <ul class="navigation right">
        <?php if (Session::userIsLoggedIn()) : ?>
            <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                <a href="<?php echo Config::get('URL'); ?>login/showprofile">My Account</a>
                <ul class="navigation-submenu">
                    <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>login/changeUserRole">Change account type</a>
                    </li>
                    <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>login/editAvatar">Edit your avatar</a>
                    </li>
                    <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>login/editusername">Edit my username</a>
                    </li>
                    <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>login/edituseremail">Edit my email</a>
                    </li>
                    <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
                        <a href="<?php echo Config::get('URL'); ?>login/logout">Logout</a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>
        </ul>