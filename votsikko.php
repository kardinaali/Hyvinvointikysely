<?php
function votsikko($kysde) 
{
global ${'kysymys'.$kysde}, $kieli;
$vo = "<div class='kysymyslohko'><span class='kaannos'>" . ${'kysymys'.$kysde}[$kieli] . "</span><br><span class='suomi'>"
 . ${'kysymys'.$kysde}[0] . "</span><br><table class='osa'>";
return $vo;
}

?>