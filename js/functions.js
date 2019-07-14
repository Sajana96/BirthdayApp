document.querySelectorAll('#viewUserTbl tr')
    .forEach(e => e.addEventListener("click", function () {
        if (this.rowIndex > 0) {
            var userId = this.cells[0].innerHTML;
            var redirectUrl = "userprofile.php?userid=";
            window.location.href = redirectUrl.concat(userId);
        }
    }));


$(document).ready(function () {
    $("#btnshow").click(function () {

        $("#alluser").show();


    });
    $("#btnhide").click(function () {

        $("#alluser").hide();


    });


});


var typingTimer;
var doneTypingInterval = 800;

function startTime() {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(searchValue, doneTypingInterval);
}
function endTime() {
    clearTimeout(typingTimer);
}

function searchValue() {
    document.frmSearch.submit();
}

$("#flip").click(function () {
    $("#panel").slideToggle("slow");
});
