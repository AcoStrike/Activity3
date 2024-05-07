<!DOCTYPE html>
<html>
<head>
    <title>My first PHP Website</title>
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
    echo "<h2>My First PHP Website</h2>";
    ?>
    <a href="login.php"> Click here to login </a>
    <a href="register.php"> Click here to register </a>
    <h2 align="center">My list</h2>
    <table>
        <tr>
            <th>Id</th>
            <th>Details</th>
            <th>Post Time</th>
            <th>Edit Time</th>
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
        $query = mysqli_query($conn, "Select * from list_tbl"); // SQL Query

        while ($row = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['details'] . "</td>";
            echo "<td>" . $row['date_posted'] . "-" . $row['time_posted'] . "</td>";
            echo "<td>" . $row['date_edited'] . "-" . $row['time_edited'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
