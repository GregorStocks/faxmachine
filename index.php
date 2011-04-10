<!doctype html>
<html>
<head>
<title>Useless Facts</title>
<link rel="stylesheet" href="style.css" type="text/css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
function get_fact() {
    var facts = ["Robots will one day destroy us all.",
                 "Iris recognition is pretty cool.",
                 ];
    var fact = facts[Math.floor(Math.random() * facts.length)];
    return fact;
}
function nextfact() {
    $("#fact").html(get_fact());
} 
$(document).ready(function () {
    nextfact();
});
</script>
</head>
<body>
<div class="outer">
    <div class="fact"><p id="fact">
    </p></div>
    <button id="next" type="button" onclick="nextfact()">Next</button>
</div>
</body>
</html>
