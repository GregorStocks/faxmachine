<html>
<head>
<title>Useless Facts</title>
</head>
<body>
<?php
function get_fact() {
    return "Robots will one day destroy us all.";
}

for($i = 0; $i < 5; $i++) {
    ?><p><?=get_fact()?></p><?php
}
?>
</body>
</html>
