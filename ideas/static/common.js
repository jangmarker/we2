
function request(method, url, callback, data, headers) {
    var request = new XMLHttpRequest();
    request.open(method, url, true);

    request.onreadystatechange = callback;
    request.withCredentials = true;

    for (var headerName in headers) {
        if (headers.hasOwnProperty(headerName))
            request.setRequestHeader(headerName, headers[headerName])
    }

    request.send(JSON.stringify(data));
}


function logout() {
    request(
        'DELETE',
        'index.php?resourceName=login',
        function () {
            window.location.replace('index.php?resourceName=login');
        },
        null,
        {}
    );
}

function vote(ideaId, voteAmount) {
    request(
        'POST',
        'index.php?resourceName=votes',
        function () {
            //window.location.replace(window.location);
        },
        {'ideaId': ideaId, 'vote': voteAmount},
        {'Accept': 'text/json', 'Content-Type': 'text/json'}
    );
}