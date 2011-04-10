<?php
$allfacts = array("1" =>
    array("Robots will one day destroy us all.", "robots", "Scientists believe that robots will, one day, destroy us all. It's simple science. <a href='http://science'>http://science</a>"),
    array("Iris recognition is pretty cool.", "eyes", "[insert iris recognition stuff from google here]."),
    array("There really aren't enough facts here.", "meta", "It'd be great if I were less lazy than I am."),
    array("If you drink enough detergent, you will die.", "death", "How much is enough? This warrants an experiment!"),
);
$numfacts = 1;
$factid = array_rand($allfacts);
if(isset($_REQUEST['facts'])) {
    $numfacts = (int)$_REQUEST['facts'];
    $numfacts = min(max($numfacts, 1), 10);
}
if(isset($_REQUEST['factid'])) {
    $factid = (int)$_REQUEST['factid'];
    if(!array_key_exists($factid, $allfacts)) {
        $factid = array_rand($allfacts);
    }
}

$facts = array();
for($i = 0; $i < $numfacts; $i++) {
    // TODO: handle dupes in some way
    $facts[$factid] = $allfacts[$factid];
    $factid = array_rand($allfacts);
}

echo json_encode($facts);

?>
