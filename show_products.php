<?php
include '../components/connection.php';

if (isset($_POST['show'])) {
    $query = "SELECT * FROM products";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        echo '<table class="table table-bordered alert-warning table-hover">';
        echo '<thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Picture</th>
                    <th>Actions</th>
                </tr>
              </thead>
              <tbody>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['Name'] . '</td>';
            echo '<td>' . $row['Description'] . '</td>';
            echo '<td>' . $row['Price'] . '</td>';
            echo '<td><img src="' . $row['Picture'] . '" alt="' . $row['Name'] . '" width="50"></td>';
            echo '<td>
                    <button class="btn btn-success edit" value="' . $row['Name'] . '">Edit</button> | 
                    <button class="btn btn-danger delete" value="' . $row['Name'] . '">Delete</button>
                  </td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo "No products found";
    }

    mysqli_close($con);
}
?>
