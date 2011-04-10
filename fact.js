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
        url = url + "&factid=" + factid;
    }
    if(curfactid) {
        url = url + "&curfactid=" + curfactid;
    }
    // get a new fact, save its value, and return it, saving it as curfactid
    $.getJSON(url, function(data) {
        for(var fact in data) {
            $("#fact").html(data[fact][0]);
            var tag = data[fact][1];
            $("#tags").html("<a class='more' href='\"javascript:more('" + tag + "')\" onclick='return false'>more " + tag + "</a> &nbsp; " +
                            "<a class='less' href='\"javascript:less('" + tag + "')\" onclick='return false'>less " + tag + "</a>")
            curfactid = fact;
            break;
        }
        window.location="#" + curfactid;
    });
}
function more(tag) {
    return true;
}
function less(tag) {
    return true;
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
