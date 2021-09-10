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
    var btn = document.getElementById("btn_submit");
    var alert = document.getElementById("alert_password");
    if (document.getElementById("password_input").value !==
        document.getElementById("password2_input").value) {
        btn.disabled = true;
        alert.style.display = "block";
    } else {
        btn.disabled = false;
        alert.style.display = "none";
    }
}