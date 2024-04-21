
function selectGroup(group) {
    var groupName = group.innerText;
    document.getElementById("groupName").innerText = groupName;
    loadChatMessages(group);
}


function selectFriend(friend) {
    // Implementasikan logika pemilihan teman di sini
    var friendName = friend.innerText;
    document.getElementById("groupName").innerText = friendName;
}


function sendMessage() {
    var message = document.getElementById("messageInput").value;
    var selectedGroup = document.getElementById("groupName").innerText;

    // Kirim pesan ke server menggunakan AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "send_message.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Respon dari server
            var response = xhr.responseText;
            // Tampilkan respon atau lakukan tindakan lain jika diperlukan
            console.log(response);
            // Setelah pesan dikirim, kosongkan nilai input
            document.getElementById("messageInput").value = "";
            // Muat kembali pesan untuk grup yang dipilih
            loadChatMessages(document.getElementById("groupName"));
        }
    };
    xhr.send("group=" + selectedGroup + "&message=" + message);
}



// Fungsi untuk memuat pesan secara berkala
function loadChatMessages(selectedItem) {
    var selectedGroup = selectedItem.innerText;

    // Kirim permintaan AJAX ke skrip PHP untuk mengambil pesan dari grup yang dipilih
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "get_messages.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Respon dari server (data pesan dalam format JSON)
            var response = xhr.responseText;
            var messages = JSON.parse(response);

            // Menampilkan pesan-pesan dalam area obrolan
            var chatMessages = document.getElementById("chatMessages");
            chatMessages.innerHTML = ""; // Kosongkan area obrolan sebelum menampilkan pesan baru
            messages.forEach(function (msg) {
                var messageDiv = document.createElement("div");
                messageDiv.className = "message";
                messageDiv.innerHTML = "<strong>" + msg.sender + "</strong>: " + msg.message + " <span>(" + msg.timestamp + ")</span>";
                chatMessages.appendChild(messageDiv);
            });
        }
    };
    xhr.send("group=" + selectedGroup);
}

// Memuat pesan secara otomatis setiap beberapa detik (misalnya, setiap 5 detik)
setInterval(function() {
    loadChatMessages(document.getElementById("groupName"));
}, 2000); // 5000 milliseconds = 5 detik

