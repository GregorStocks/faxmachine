<?php

require_once("config.php");
$mysqli = get_connection();
if(!$mysqli) {
    die('DATABASE FAILURE OF SOME SORT');
}

// see if this fact exists anywhere
if(isset($_REQUEST['factid'])) {
    $factid = (int)$_REQUEST['factid'];
    if($stmt = $mysqli->prepare("SELECT (id, fact, tag, more) FROM fact WHERE id = ?")) {
        $stmt->bind_param("i", $factid);
        $stmt->execute();
        $stmt->bind_result($id, $fact, $tag, $more);
        $stmt->fetch();
        if($id) {
            echo json_encode(array($id => array($fact, $tag, $more)));
            $stmt->close();
            $mysqli->close();
            return;
        } else {
            die($mysqli->error);
        }
        $stmt->close();
    }
}

if(!($stmt = $mysqli->prepare("SELECT id, fact, tag, more FROM fact ORDER BY rand() LIMIT 0,1"))) {
    die($mysqli->error);
}
$stmt->execute();
$stmt->bind_result($id, $fact, $tag, $more);
$stmt->fetch();
if($id) {
    echo json_encode(array($id => array($fact, $tag, $more)));
}
$stmt->close();
$mysqli->close();

?>
