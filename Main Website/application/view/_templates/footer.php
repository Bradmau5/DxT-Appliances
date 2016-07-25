    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-5 text-center">
                    <p>Copyright &copy; SS-Web 2013-2016</p>
                </div>
                <div class="col-lg-2 text-center">
                    <p><a href="http://prtotpe-jobs.dxtappliances.co.uk">Job Login</a></p>
                </div>
                <div class="col-lg-5 text-center">
                    <p>Website created & managed by <a href="http://ss-web.co.uk">SS-Web.co.uk</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="<?php echo Config::get('URL'); ?>js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo Config::get('URL'); ?>js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src='//code.jquery.com/jquery-1.9.1.js'></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>

    <script>
        $(document).ready(function() {

            $(window).scroll(function () {
                //if you hard code, then use console
                //.log to determine when you want the
                //nav bar to stick.
                console.log($(window).scrollTop())
                if ($(window).scrollTop() > 0) {
                    $('#top_bar').addClass('topbar-fixed');
                    $('#top_bar_content').addClass('topbar-fixed')
                }
                if ($(window).scrollTop() < 1) {
                    $('#top_bar').removeClass('topbar-fixed');
                    $('#top_bar_content').removeClass('topbar-fixed')
                }
            });
        });
    </script>

    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-66075550-2', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
