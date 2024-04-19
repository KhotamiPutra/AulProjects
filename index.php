<?php
include("config.php");
session_start();

// Periksa apakah pengguna sudah masuk atau belum
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Query untuk mengambil ID pengguna berdasarkan nama pengguna
    $sql = "SELECT user_id FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['user_id'];

        // Query untuk mengambil daftar grup yang dimiliki oleh pengguna
        $sql_groups = "SELECT groups.group_name FROM group_members JOIN groups ON group_members.group_id = groups.group_id WHERE group_members.user_id = $user_id";
        $result_groups = mysqli_query($conn, $sql_groups);

        // Query untuk mengambil daftar teman dari pengguna
        $sql_friends = "SELECT users.username FROM friends JOIN users ON friends.user2_id = users.user_id WHERE friends.user1_id = $user_id";
        $result_friends = mysqli_query($conn, $sql_friends);
    } else {
        echo "User not found";
    }
} else {
    $username = "Guest"; // Atau sesuaikan dengan nilai default yang sesuai
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grup Chatting</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <h1>Group Chatting</h1>
        <p>Welcome, <?php echo $username; ?></p>
    </nav>
    <div class="container">
        <div class="connection">
            <div class="groups">
                <h2>Daftar Grup</h2>
                <ul id="groupList">
                    <?php
        if (mysqli_num_rows($result_groups) > 0) {
            // Output data dari setiap baris
            while ($row = mysqli_fetch_assoc($result_groups)) {
                echo "<li onclick=\"selectGroup(this)\">" . $row["group_name"] . "</li>";
            }
        } else {
            echo "Belum memiliki grup";
        }
        ?>
                </ul>
            </div>

            <div class="friend">
                <h2>Daftar Teman</h2>
                <ul id="friendList">
                    <?php
        if (mysqli_num_rows($result_friends) > 0) {
            // Output data dari setiap baris
            while ($row = mysqli_fetch_assoc($result_friends)) {
                echo "<li onclick=\"selectFriend(this)\">" . $row["username"] . "</li>";
            }
        } else {
            echo "Belum memiliki teman";
        }
        ?>
                </ul>
            </div>

        </div>
        <div class="chat">
            <div id="chatHeader">
                <h2 id="groupName">Pilih Grup</h2>
                <p id="groupMembers"></p>
            </div>
            <div id="chatMessages">
                <!-- Chat messages will be populated dynamically -->
                <div class="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                <div class="message">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat.</div>
            </div>
            <div id="messageInputContainer">
                <input type="text" id="messageInput" placeholder="Ketik pesan...">
                <button id="sendMessageBtn">Kirim</button>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script>
    function addFriend() {
        // Logic untuk menambahkan teman
        alert('Menambahkan teman...');
    }

    function addGroup() {
        // Logic untuk menambahkan grup
        alert('Menambahkan grup...');
    }
    </script>
</body>

</html>