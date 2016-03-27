var day = "All";
var time = "All";
var course = "All";

var str = location.pathname.split("/");
if (str.length > 2) {
    day = str[1];
    time = str[2];
    course = str[3];
    var dropdowns = document.getElementsByClassName("dropdown");
    dropdowns[0].value = day;
    dropdowns[1].value = time;
    dropdowns[2].value = course;
}

function setData() {
    var dropdowns = document.getElementsByClassName("dropdown");
    
    console.log(dropdowns.length);
    
    if (dropdowns === null) {
        return;
    }
    
    if (dropdowns[0].selectedIndex !== -1) {
        day = dropdowns[0][dropdowns[0].selectedIndex].text;
    }
    if (dropdowns[1].selectedIndex !== -1) {
        time = dropdowns[1][dropdowns[1].selectedIndex].text;
    }
    if (dropdowns[2].selectedIndex !== -1) {
        course = dropdowns[2][dropdowns[2].selectedIndex].text;
    }
    
    console.log(day + " " + time + " " + course);
}

function search() {
    var url = location.protocol + "//" + location.host + "/" + day + "/" + time + "/" + course;
    window.location.href = url;
}