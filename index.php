<?php
include ("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grup Chatting</title>
    <style>
        :root {
            --main-color: #654321; /* Brown */
            --accent-color: #770077; /* Purple */
            --selected-group-color: #a53e3e; /* Light gray */
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        nav {
            display: flex;
            justify-content: center;
            box-shadow: 2px 2px 2px #222;
            background-color: var(--main-color);
            color: #ac9783;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .groups {
            flex: 1;
            padding: 20px;
        }

        .groups h2 {
            color: var(--main-color);
            border-bottom: 2px solid var(--main-color);
            padding-bottom: 10px;
        }

        .groups ul {
            list-style-type: none;
            padding: 0;
        }

        .groups li {
            cursor: pointer;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        .selected-group {
            background-color: var(--selected-group-color);
        }

        .chat {
            flex: 2;
            padding: 10px;
        }

        #chatHeader {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid var(--main-color);
        }

        #groupName {
            color: var(--main-color);
        }

        #groupMembers {
            font-size: 14px;
            color: var(--accent-color);
        }

        #chatMessages {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid var(--main-color);
            padding: 10px;
            border-radius: 5px;
            background-color: #fff;
        }

        .message {
            margin-bottom: 10px;
        }

        #messageInputContainer {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        #messageInput {
            flex: 1;
            padding: 10px;
            border: 1px solid var(--main-color);
            border-radius: 5px;
            margin-right: 10px;
        }

        #sendMessageBtn {
            padding: 10px 20px;
            background-color: var(--accent-color);
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <nav>
        <h1>Group Chatting</h1>
    </nav>
    <div class="container"> 
        <div class="connection">
        <div class="groups">
            <h2>Daftar Grup</h2>
            <ul id="groupList">
                <?php
                $sql = "SELECT * FROM groups";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    // Output data dari setiap baris
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<li onclick=\"selectGroup(this)\">" . $row["group_name"] . "</li>";
                    }
                } else {
                    echo "0 results";
                }
                ?>
            </ul>
            
        </div>
        <div class="friend">
            <h2>Daftar Grup</h2>
            <ul id="groupList">
                <?php
                $sql = "SELECT * FROM users";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    // Output data dari setiap baris
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<li onclick=\"selectGroup(this)\">" . $row["username"] . "</li>";
                    }
                } else {
                    echo "0 results";
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
                <div class="message">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
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
