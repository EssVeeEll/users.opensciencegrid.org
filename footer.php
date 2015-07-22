<?php

if (of_get_option('enable_aside_footer'))
{
	require_once ('footer/widgets.php');
}

require_once ('footer/foot.php');

?>

</div> <!-- boxed -->
</div> <!-- sb-site -->

<?php

if(of_get_option('enable_slidebar', 'true'))
{
    require_once ('footer/slidebar.php');
}

require_once ('footer/totop.php');
require_once ('footer/scripts.php');

?>

<?php wp_footer(); ?>

</body>

</html>