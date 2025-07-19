<pre>
<?php
if (isset($_GET['rows'])) {
    $rows = $_GET['rows'];
    $cmd = "./Stargen $rows";
    print($cmd);
    system($cmd);
} else {
    print("Parameter rows not specified");
}


?>
</pre>