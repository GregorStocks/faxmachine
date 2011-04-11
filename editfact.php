<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Fact</title>
</head>
<body>
<?php
if(isset($_REQUEST['factid'])) {
    require_once("config.php");
    $mysqli = get_connection();
    if(!$mysqli) {
        die('DATABASE FAILURE OF SOME SORT');
    }
    if($stmt = $mysqli->prepare("SELECT fact, tag, more FROM fact WHERE id = ?")) {
        $stmt->bind_param("i", $_REQUEST['factid']);
        $stmt->execute();
        $stmt->bind_result($fact, $tag, $more);
        if($stmt->fetch()) {
            ?>
            <form name="form" method="post" action="<?= $_SERVER['PHP_SELF']?>">
            <input type="hidden" name="editfactid" value="<?= $_REQUEST['factid'] ?>"/>
            <p>Fact: <input type="text" name="fact" size=80 value="<?= htmlspecialchars($fact) ?>"/></p>
            <p>Tag: <input type="text" name="tag" value="<?= htmlspecialchars($tag) ?>"/></p>
            <p>More: <textarea rows=4 cols=80 name="more"><?= $more ?></textarea></p>
            <p><input type="submit" /></p>
            </form>
            <?php
        }
        $stmt->close();
    }
    $mysqli->close();
}else {
    require_once("config.php");
    $mysqli = get_connection();
    if(!$mysqli) {
        die('DATABASE FAILURE OF SOME SORT');
    }
    if(isset($_REQUEST['editfactid'])) {
        $id = $_REQUEST['editfactid'];
        $fact = $_REQUEST['fact'];
        $tag = $_REQUEST['tag'];
        $more = $_REQUEST['more'];
        if($stmt = $mysqli->prepare("UPDATE fact SET fact = ?, tag = ?, more = ? WHERE id = ?")) {
            $stmt->bind_param("sssi", $fact, $tag, $more, $id);
            $stmt->execute();
            $stmt->close();
        } else {
            echo $mysqli->error;
        }
    } else if(isset($_REQUEST['delete'])) {
        if($stmt = $mysqli->prepare("DELETE FROM fact WHERE id = ?")) {
            $stmt->bind_param("i", $_REQUEST['delete']);
            $stmt->execute();
            echo "<p>Fact deleted! (if it was a fact at all...)</p>";
            $stmt->close();
        } else {
            echo $mysqli->error;
        }
    }
    if($stmt = $mysqli->prepare("SELECT id, fact, tag, more FROM fact")) {
        $stmt->execute();
        $stmt->bind_result($id, $fact, $tag, $more);
        echo "<table>";
        while($stmt->fetch()) {
            ?>
            <tr>
                <td><a href="<?= $_SERVER['PHP_SELF'] . "?factid=" . $id ?>"><?= $fact ?></a></td>
                <td><?= $tag ?></td>
                <td><?= $more ?></td>
                <td><a href="<?= $_SERVER['PHP_SELF'] . "?delete=" . $id ?>">Delete</a></td>
            </tr>
            <?php
        }
        echo "</table>";
        $stmt->close();
    } else {
        echo $mysqli->error;
    }
    $mysqli->close();
} ?>
<p><a href="newfact.php">new fact</a></p>
</body>
</html>
