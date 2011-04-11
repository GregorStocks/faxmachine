var curfactid;
var knownfacts = {};
function set_fact(factid, fact) {
    $("#fact").html(fact[0]);
    curfactid = factid;
    $("#morefact").html(fact[2]);
    knownfacts[factid] = fact;
}
function get_fact(factid) {
    if(factid && factid in knownfacts) {
        set_fact(factid, knownfacts[factid]);
        window.location.replace("#" + factid);
        return;
    }
    var url = 'fact.php?';
    if(factid) {
        url = url + "factid=" + factid;
    }
    // get a new fact, save its value, and return it, saving it as curfactid
    $.getJSON(url, function(data) {
        for(var factid in data) {
            set_fact(factid, data[factid]);
            if(window.location.hash == "") {
                window.location.replace("#" + factid);
            } else {
                window.location="#" + factid;
            }
            return;
        }
    });
}
function tellmemore(more) {
    $("#tell").html('<a href="javascript:void(0)" onclick="javascript:tellmemore(' + !more + ')">tell me ' + (more ? "less!" : "more...") + '</a>');
    if(more) {
        $("#morefact").slideDown();
    } else {
        $("#morefact").slideUp();
    }
    return false;
}
window.onhashchange = function() {
    var factid = window.location.hash.substring(1);
    if(factid.length > 0 && factid != curfactid) {
        get_fact(factid);
    }
}
$(document).ready(function () {
    get_fact(window.location.hash.substring(1));
});
