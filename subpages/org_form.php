<?php
$hasError = false;
$orgnameError = $founameError =  $doeError = $emailError = $wardError = $toleError = $typeError = $phoneError = "";
$orgname = $founame = $doe = $email = $ward = $tole = $type = $phone = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    $orgname = trim($_POST['orgname']);
    $founame = trim($_POST['founame']);
    $doe = $_POST['doe'];
    $email = $_POST['email'];
    $ward = $_POST['ward'];
    $tole = $_POST['tole'];
    $type = isset($_POST['type']) ? $_POST['type'] : "";
    $phone = $_POST['phone'];

    if ($orgname == "") {
        $orgnameError = "Organization Name is required.";
    } else {
        $pattern = "/^[a-zA-Z-' ]*$/";
        if (!preg_match($pattern, $orgname)) {
            $orgnameError = "Invalid Name";
            $hasError = true;
        }
    }
    if ($founame == "") {
        $founameError = "Founder Name is required.";
    } else {
        $pattern = "/^[a-zA-Z-' ]*$/";
        if (!preg_match($pattern, $founame)) {
            $founameError = "Invalid Name";
            $hasError = true;
        }
    }
    if ($doe == "") {
        $doeError = "Date of Establish is required.";
        $hasError = true;
    }
    if ($email == "") {
        $emailError = "Email is required.";
        $hasError = true;
    } else {
        $valid = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$valid) {
            $emailError = "Invalid email address.";
            $hasError = true;
        }
    }
    if ($ward == "") {
        $wardError = "Ward No. is required.";
        $hasError = true;
    }
    if ($tole == "") {
        $toleError = "Tole is required.";
        $hasError = true;
    }
    if ($type == "") {
        $typeError = "Type is required.";
        $hasError = true;
    }
    if ($phone == "") {
        $phoneError = "Phone Number is required.";
        $hasError = true;
    }

    if (!$hasError) {

        // require "connection.php";

        $sql = "INSERT INTO organization
            (otype, orgname, founame, doe, phone, email, ward, tole)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            //bind variables
            $stmt->bind_param("ssssssss", $o_type, $o_oname, $o_fname, $o_doe, $o_phone, $o_email, $o_ward, $o_tole);

            //set parameters
            $o_type = $type;
            $o_oname = $orgname;
            $o_fname = $founame;
            $o_doe = $doe;
            $o_ward = $ward;
            $o_tole = $tole;
            $o_phone = $phone;
            $o_email = $email;

            if ($stmt->execute()) {
                echo "New Record Inserted Successfully";
                header("location: dashindex.php?page=dorg");
                exit();
            }

            $stmt->close();
        }
        $conn->close();
    }
}

?>

<div class="container">
    <h3>Organization Registration Form</h3>
    <div class="row">
        <div class="col-lg-6 col-md-9 col-sm-12">
            <form method="POST" action="dashindex.php?page=org_form">
                <div class="form-group">
                    <label for="type">Type of Organization*</label>
                    <br>
                    <label>
                        <input type="radio" name="type" value="Government" <?= $type == 'Government' ? 'checked' : ''; ?>> Government
                    </label>
                    <label>
                        <input type="radio" name="type" value="Private" <?= $type == 'Private' ? 'checked' : ''; ?>> Private
                    </label>
                    <label>
                        <input type="radio" name="type" value="Educational" <?= $type == 'Educational' ? 'checked' : ''; ?>> Educational
                    </label>
                    <label>
                        <input type="radio" name="type" value="Hospital" <?= $type == 'Hospital' ? 'checked' : ''; ?>> Hospital
                    </label>
                    <br>
                    <span class="text-danger"><?php echo $typeError ?></span>
                </div>
                <div class="form-group">
                    <label for="org_name">Organization Full Name*</label>
                    <input type="text" name="orgname" id="orgname" class="form-control" value="<?= $orgname ?>">
                    <span class="text-danger"><?php echo $orgnameError ?></span>
                </div>
                <div class="form-group">
                    <label for="fou_name">Founder Full Name*</label>
                    <input type="text" name="founame" id="founame" class="form-control" value="<?= $founame ?>">
                    <span class="text-danger"><?php echo $founameError ?></span>
                </div>
                <div class="form-group col-lg-4">
                    <label for="doe">Date of Establish*</label>
                    <input type="date" name="doe" id="doe" class="form-control" value="<?= $doe ?>">
                    <span class="text-danger"><?php echo $doeError ?></span>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number*</label>
                    <input type="text" name="phone" class="form-control" id="phone" value="<?= $phone ?>">
                    <span class="text-danger"><?php echo $phoneError ?></span>
                </div>
                <div class="form-group">
                    <label for="email">Email*</label>
                    <input type="email" name="email" class="form-control" id="email" value="<?= $email ?>">
                    <span class="text-danger"><?php echo $emailError ?></span>
                </div>
                <hr>
                <b><u>Address*</u></b>
                <div class="form-group">
                    <label for="last_name">Ward No.*</label>
                    <input type="number" name="ward" class="form-control" id="ward" value="<?= $ward ?>">
                    <span class="text-danger"><?= $wardError ?></span>
                </div>
                <div class="form-group">
                    <label for="last_name">Tole*</label>
                    <input type="text" name="tole" class="form-control" id="tole" value="<?= $tole ?>">
                    <span class="text-danger"><?= $toleError ?></span>
                </div>
                <hr>
                <div class="form-group pt-2">
                    <input type="submit" name="" id="" class="btn btn-primary" value="Register">
                </div>
            </form>
        </div>
    </div>
</div>