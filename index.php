<html>
<head>
<title>Useless Facts</title>
</head>
<body>
<?php
function get_fact() {
    $facts = array("Robots will one day destroy us all.",
                   "Iris recognition is pretty cool.",
                   "e^i&pi; = -1",
                   "poop",
                   "math"
                  );
    return $facts[rand(0, count($facts) - 1)];
}

for($i = 0; $i < 5; $i++) {
    ?><p><?=get_fact()?></p><?php
}
?>
</body>
</html>
