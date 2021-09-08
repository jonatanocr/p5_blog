function alertMsg(id, object) {
    var msg;
    if (object === "post" || object === "comment") {
        msg = "this " + object;
    } else if (object === "user") {
        msg = "your account";
    }
    if (confirm("Are you sure you want to delete " + msg + "?")) {
        var link = "index.php?action=" + object + "-delete-";
        window.location.href = link + id;
    }
}

function passwordsMatchCheck() {
    if (document.getElementById("password_input").value !==
        document.getElementById("password2_input").value) {
        document.getElementById("btn_submit").disabled = true;
        document.getElementById("alert_password").style.display = "block";
    } else {
        document.getElementById("btn_submit").disabled = false;
        document.getElementById("alert_password").style.display = "none";
    }
}