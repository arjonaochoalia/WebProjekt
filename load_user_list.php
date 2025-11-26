<?php
require 'db_connection.php'; // database connection

// 1. Fetch data from database
$sql = "SELECT user_id, username, first_name, last_name, email, user_role FROM users";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">User ID</th>
                <th scope="col">Username</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">User Role</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // 2. Loop through results and output table rows
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td scope="row"><?php echo htmlspecialchars($row["user_id"]); ?></td>

                    <td><?php echo htmlspecialchars($row["username"]); ?></td>
                    <td><?php echo htmlspecialchars($row["first_name"]); ?></td>
                    <td><?php echo htmlspecialchars($row["last_name"]); ?></td>
                    <td><?php echo htmlspecialchars($row["email"]); ?></td>
                    <td><?php echo htmlspecialchars($row["user_role"]); ?></td>
                </tr>
            <?php
            } // End of the while loop
            ?>
        </tbody>
    </table>
<?php
} else {
    // 3. Output if no results found
    echo "0 results";
}

// 4. Close the database connection
if (isset($conn)) {
    $conn->close();
}

?>