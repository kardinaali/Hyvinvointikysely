<?php
print "
function leavePage()
	{
	var painike = confirm('" . $oletkovarma[$kieli] . "');
	if ( painike == true )
		{
		location.href='index.php';
		}
	};
</script>";
?>