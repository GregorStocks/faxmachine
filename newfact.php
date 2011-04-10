<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Fact</title>
</head>
<body>
<?php if(isset($_REQUEST['fact'])) { ?>
    <p>Okay. <?=$_REQUEST['fact']?></p>
    <?php
    require_once("config.php");
    $mysqli = get_connection();
    if(!$mysqli) {
        die('DATABASE FAILURE OF SOME SORT');
    }
    if($stmt = $mysqli->prepare("INSERT INTO fact (fact, tag, more) VALUES (?, ?, ?)")) {
        $stmt->bind_param("sss", $_REQUEST['fact'], $_REQUEST['tag'], $_REQUEST['more']);
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
} ?>
<form name="form" method="post" action="<?=$_SERVER['PHP_SELF']?>">
<p>Fact: <input type="text" name="fact" size=80 /></p>
<p>Tag: <input type="text" name="tag" /></p>
<p>More: <textarea rows=4 cols=80 name="more"></textarea></p>
<p><input type="submit" /></p>
</form>
</body>
</html>
