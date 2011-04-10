<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fax Machine</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <script src="jquery.js"></script>
    <script src="fact.js"></script>
</head>
<body>
<div class="outer">
    <div class="fact">
        <p id="fact"></p>
        <p style="display:none" id="morefact"></p>
        <span id="tags">&nbsp;</span><span id="tell"><a href="javascript:void(0)" onclick="javascript:tellmemore(true)">tell me more...</a></span>
        <div style="clear:both;"></div>
    </div>
    <button id="next" type="button" onclick="get_fact()">Next fact</button>
</div>
</body>
</html>
