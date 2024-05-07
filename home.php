<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
        }

        a {
            display: block;
            text-align: center;
            margin: 10px 0;
            text-decoration: none;
            color: #000;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th, td {
            padding: 10px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php
    session_start(); // starts the session
    if(!isset($_SESSION['user'])) { // checks if the user is not logged in
        header("location: index.php"); // redirects if user is not logged in
    }
    $user = $_SESSION['user']; // assigns user value
    ?> <center>
    <h2>Home Page</h2>
    <p>Hello <?php echo $user; ?>!</p> <!-- Display user name -->
    <a href="logout.php">Click here to logout</a>
    <br><br>
    <form action="add.php" method="POST">
        Add more to list: <input type="text" name="details" /> <br>
        Public post? <input type="checkbox" name="public[]" value="yes" /> <br>
        <input type="submit" value="Add to list"/>
    </form></center>
    <h2 align="center">My list</h2>
    <table>
        <tr>
            <th>Id</th>
            <th>Details</th>
            <th>Post Time</th>
            <th>Edit Time</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Public Post</th>
        </tr>
        <?php
        $servername = "localhost";
        $username_db = "root";
        $password_db = "";
        $db_name = "first_db";
        // Create connection
        $conn = mysqli_connect($servername, $username_db, $password_db, $db_name);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $query = mysqli_query($conn, "SELECT * FROM list_tbl"); // SQL Query
        while($row = mysqli_fetch_array($query)) { // Display all the rows from query
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['details']."</td>";
            echo "<td>".$row['date_posted']. "-". $row['time_posted']."</td>";
            echo "<td>".$row['date_edited']. "-". $row['time_edited']."</td>";
            echo "<td><span class='edit'><a href='edit.php?id=".$row['id']."'>edit</a></span></td>"; // Pass ID to edit.php
            echo "<td><span class='delete' onclick='myFunction(".$row['id'].")'>delete</span></td>"; // Pass ID to myFunction()
            echo "<td>".$row['public']."</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <script>
        function myFunction(id) {
            var r = confirm("Are you sure you want to delete this record?");
            if (r == true) {
                window.location.assign("delete.php?id=" + id);
            }
        }
    </script>
</body>
</html>
