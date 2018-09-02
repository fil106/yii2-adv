function chatConnect() {

    var name = document.getElementById('chatName').value;
    var chatNotif = document.getElementById('chatNotif');

    if(name !== '') {

        chatNotif.textContent = '';

        var websocketPort = wsPort ? wsPort : 8080,
            conn = new WebSocket('ws://127.0.0.1:' + websocketPort),
            idMessages = 'chatMessages';

        conn.onopen = function(e) {
            console.log("Connection established! Your name - " + name);
        };

        conn.onmessage = function(e) {
            document.getElementById(idMessages).value = e.data + '\n' + document.getElementById(idMessages).value;
            console.log(e.data);
        };

        conn.onerror = function(e) {
            console.log("Connection fail!");
        };

    } else {
       chatNotif.textContent = 'Введите Ваше имя!';
    }
}