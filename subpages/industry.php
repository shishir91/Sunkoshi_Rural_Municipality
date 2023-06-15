<div class="container">
    <div class="row">
        <div class="">
            <h3>Industries Lists</h3>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Industry Name</th>
                        <th scope="col">Owner Name</th>
                        <th scope="col">Industry Type</th>
                        <th scope="col">Date of Establish</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <?php

                $sql = "SELECT * FROM industry";

                if ($result = $conn->query($sql)) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tbody>";
                            echo "<tr>";
                            echo "<th scope='row' >" . $row['i_id'] . "</th>";
                            echo "<td>" . $row['indname'] . "</td>";
                            echo "<td>" . $row['ownname'] . "</td>";
                            echo "<td>" . $row['itype'] . "</td>";
                            echo "<td>" . $row['doe'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . "Sunkoshi-" . $row['ward'] . " " . $row['tole'] . "</td>";
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