var curfactid;
var knownfacts = {};
function get_fact(factid) {
    if(factid && factid in knownfacts) {
        window.location.replace("#" + curfactid);
        curfactid = factid;
        return knownfacts[factid];
    }
    var url = 'fact.php?';
    if(factid) {
        url = url + "factid=" + factid;
    }
    // get a new fact, save its value, and return it, saving it as curfactid
    $.getJSON(url, function(data) {
        for(var fact in data) {
            $("#fact").html(data[fact][0]);
            var tag = data[fact][1];
            $("#tags").html("<a class='more' href='javascript:void(0)' onclick=\"javascript:more('" + tag + "')\">more " + tag + " facts</a> &nbsp; " +
                            "<a class='less' href='javascript:void(0)' onclick=\"javascript:less('" + tag + "')\">less " + tag + " facts</a>")
            curfactid = fact;
            $("#morefact").html(data[fact][2]);
            break;
        }
        window.location="#" + curfactid;
    });
}
function more(tag) {
    return false;
}
function less(tag) {
    return false;
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
