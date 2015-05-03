
function logout() {
    var logoutRequest = new XMLHttpRequest();
    logoutRequest.open('DELETE', 'index.php?resourceName=login', true);

    logoutRequest.onreadystatechange = function () {
        window.location.replace('index.php?resourceName=login');
    };

    logoutRequest.send();
}