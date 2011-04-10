var curfactid;
var knownfacts = {};
function get_fact(factid) {
    if(factid && factid in knownfacts) {
        window.location.replace("#" + curfactid);
        curfactid = factid;
        return knownfacts[factid];
    }
    // get a new fact, save its value, and return it, saving it as curfactid
    $.getJSON('fact.php?factid=' + factid, function(data) {
        for(var fact in data) {
            $("#fact").html(data[fact]);
            curfactid = fact;
            break;
        }
        window.location="#" + curfactid;
    });
}
window.onhashchange = function() {
    var factid = window.location.hash.substring(1);
    if(factid != curfactid) {
        get_fact(factid);
    }
}
$(document).ready(function () {
    get_fact(window.location.hash.substring(1));
});
