<?php
include('template.php');
include_once('accessLog.php');
$content = <<<END
<h1>Welcome to this website</h1>
<h2>Testing</h2>
<h3>Testing2</h3>
<p>
This is gonna be a webshop
</p>
END;
echo $navigation;
echo $content;
include('footer.php');
?>
