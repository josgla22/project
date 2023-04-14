<?php
include('template.php');
$content = <<<END
<div class="wrapper">
    <div class="centered">
        <h1>Health Dashboard</h1><br><br>
        <p>Information om hemsidan blablabla</p>
        <button>Get Started</button>
    </div>
</div>
END;
echo $navigation;
echo $content;
include('footer.php');
?>