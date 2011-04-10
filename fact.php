<?php
$allfacts = array("1" => "Robots will one day destroy us all.",
                  "Iris recognition is pretty cool.",
                  "There really aren't enough facts here.",
                  "If you drink enough detergent, you will die."
);
$numfacts = 1;
$factid = array_rand($allfacts);
if(isset($_REQUEST['facts'])) {
    $numfacts = (int)$_REQUEST['facts'];
    $numfacts = min(max($numfacts, 1), 10);
}
if(isset($_REQUEST['factid'])) {
    $factid = (int)$_REQUEST['factid'];
    if(!in_array($factid, $allfacts, True)) {
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
