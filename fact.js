var curfact;
function get_fact(factnum) {
    var facts = ["",
                 "Robots will one day destroy us all.",
                 "Iris recognition is pretty cool.",
                 "There really aren't enough facts here.",
                 "If you drink enough detergent, you will die."
                 ];
    if(!factnum || factnum < 0 || factnum > facts.length) {
        var factnum = Math.floor(1 + Math.random() * (facts.length - 1));
    }
    var fact = facts[factnum];
    curfact = factnum;
    return fact;
}
function nextfact(factnum) {
    $("#fact").html(get_fact(factnum));
    if(factnum) {
        window.location.replace("#" + curfact);
    } else {
        window.location="#" + curfact;
    }
} 
window.onhashchange = function() {
    var factnum = parseInt(window.location.hash.substring(1));
    if(factnum != curfact) {
        nextfact(factnum);
    }
}
$(document).ready(function () {
    var loc = window.location.hash.substring(1);
    nextfact(parseInt(loc));
});
