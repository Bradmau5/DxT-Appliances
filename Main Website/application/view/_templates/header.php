<!doctype html>
<html>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="DxT Appliances Homepage. Welcome to DxT Appliances. The right choice for any of your kitchen appliances.">
    <meta name="author" content="Bradley Scott">
    <meta name="keywords" content="dxt, appliances, repairs, washing machine, washing, machine, dishwasher, oven, hob, tumble dryer, electric oven, sales, domestic appliances, domestic appliance repair, kitchen, kitchen appliance, kitchen appliance repair, bromley, orpington, dunton green, lewisham, grove park, woolwich, se12, se1, se2, se3, se4, se5, se6, se7, se8, se9, se10, se11, se13, se14, se15, se16, se17, se18, se19, se20, se21, se22, se23, se24, se25, br1, br2, br3, br4, br5, br6, br7, br8, E1, E2, E3, E14, E16, TN8, TN9, TN10, TN11, TN12, TN13, TN14, TN15, TN16">

    <title>DxT Appliances</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo Config::get('URL'); ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo Config::get('URL'); ?>css/business-casual.css" rel="stylesheet">
    <link href="<?php echo Config::get('URL'); ?>css/style.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Hind+Siliguri:400,700' rel='stylesheet' type='text/css'>
    <link href="<?php echo Config::get('URL'); ?>img/favicon.ico" rel="icon" type="image/png" >

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
    <!--<div id="top_bar">
        <div id="top_bar_content">
            <div class="col-lg-12">
                <a href="<?php echo Config::get('URL'); ?>index/quote">Get A Quote</a> | <a href="#"><img src="<?php echo Config::get('URL'); ?>img/facebook_icon.png" alt=""></a> | <a href="#"><img src="<?php echo Config::get('URL'); ?>img/twitter_icon.png" alt=""></a>
            </div>
        </div>
    </div>-->
    <div class="brand">DXT APPLIANCES</div>
    <div class="address-bar">100 Mayeswood Road | Grove Park, London, SE12 9RU | 020 8857 5821</div>

    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="index.html">DXT APPLIANCES</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="<?php echo Config::get('URL'); ?>index/index">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo Config::get('URL'); ?>index/services">Services</a>
                    </li>
                    <li>
                        <a href="https://www.yell.com/biz/dxt-appliances-ltd-london-7238090/#reviews">Reviews</a>
                    <li>
                        <a href="<?php echo Config::get('URL'); ?>index/about">About</a>
                    </li>
                    <li>
                        <a href="<?php echo Config::get('URL'); ?>index/contact">Contact</a>
                    </li>
                    <?php if(!Session::userIsLoggedIn()) { ?>
                        <!-- for not logged in users -->
                        <li <?php if (View::checkForActiveControllerAndAction($filename, "login/index")) { echo ' class="active" '; } ?> >
                            <a href="<?php echo Config::get('URL'); ?>login/index">Login/Register</a>
                        </li>
                    <?php } else { ?>
                        <li>
                          <a href="<?php echo Config::get('URL'); ?>login/showProfile">Your Profile</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
