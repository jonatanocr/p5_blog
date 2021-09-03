function alertMsg(id, object) {
    var msg;
    if (object === 'post') {
        msg = 'this post'
    } else if (object === 'user') {
        msg = 'your account'
    } else if (object === 'comment') {
        msg = 'this comment'
    }
    if (confirm("Are you sure you want to delete " + msg + '?')) {
        var link = 'index.php?action=' + object + '-delete-';
        window.location.href = link + id;
    }
}

function passwords_match_check() {
    if (document.getElementById('password_input').value !=
        document.getElementById('password2_input').value) {
        document.getElementById('btn_submit').disabled = true;
        document.getElementById('alert_password').style.display = 'block';
    } else {
        document.getElementById('btn_submit').disabled = false;
        document.getElementById('alert_password').style.display = 'none';
    }
}