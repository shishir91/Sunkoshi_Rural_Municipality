<div class="container">
    <div class="row">
        <div class="">
            <h3>Organizations Lists</h3>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Organization Type</th>
                        <th scope="col">Organization Name</th>
                        <th scope="col">Founder Name</th>
                        <th scope="col">Date of Establish</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Edit/Delete</th>
                    </tr>
                </thead>
                <?php

                $sql = "SELECT * FROM organization";

                if ($result = $conn->query($sql)) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tbody>";
                            echo "<tr>";
                            echo "<th scope='row' >" . $row['o_id'] . "</th>";
                            echo "<td>" . $row['otype'] . "</td>";
                            echo "<td>" . $row['orgname'] . "</td>";
                            echo "<td>" . $row['founame'] . "</td>";
                            echo "<td>" . $row['doe'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . "Sunkoshi-" . $row['ward'] . " " . $row['tole'] . "</td>";
                            echo "<td>";
                            $id = $row['o_id'];
                            echo "<a href='dashindex.php?page=o-edit&o_id=" . $id . "' class='btn btn-success'>Edit</a>";
                            echo " ";
                            echo "<a href='dashindex.php?page=o-delete&o_id=" . $id . "' class='btn btn-danger'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                            echo "</tbody>";
                        }
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>