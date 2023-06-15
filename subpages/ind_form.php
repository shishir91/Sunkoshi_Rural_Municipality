<?php
$hasError = false;
$indnameError = $ownnameError =  $doeError = $emailError = $wardError = $toleError = $typeError = $phoneError = "";
$indname = $ownname = $doe = $email = $ward = $tole = $type = $phone = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    $indname = trim($_POST['indname']);
    $ownname = trim($_POST['ownname']);
    $doe = $_POST['doe'];
    $email = $_POST['email'];
    $ward = $_POST['ward'];
    $tole = $_POST['tole'];
    $type = isset($_POST['type']) ? $_POST['type'] : "";
    $phone = $_POST['phone'];

    if ($indname == "") {
        $indnameError = "Organization Name is required.";
    } else {
        $pattern = "/^[a-zA-Z-' ]*$/";
        if (!preg_match($pattern, $indname)) {
            $indnameError = "Invalid Name";
            $hasError = true;
        }
    }
    if ($ownname == "") {
        $ownnameError = "Founder Name is required.";
    } else {
        $pattern = "/^[a-zA-Z-' ]*$/";
        if (!preg_match($pattern, $ownname)) {
            $ownnameError = "Invalid Name";
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

        $sql = "INSERT INTO industry
            (indname, ownname, doe, itype, phone, email, ward, tole)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            //bind variables
            $stmt->bind_param("ssssssss", $i_iname, $i_oname, $i_doe, $i_type, $i_phone, $i_email, $i_ward, $i_tole);

            //set parameters
            $i_iname = $indname;
            $i_oname = $ownname;
            $i_doe = $doe;
            $i_type = $type;
            $i_ward = $ward;
            $i_tole = $tole;
            $i_phone = $phone;
            $i_email = $email;

            if ($stmt->execute()) {
                echo "New Record Inserted Successfully";
                header("location: dashindex.php?page=dind");
                exit();
            }

            $stmt->close();
        }
        $conn->close();
    }
}

?>

<div class="container">
    <h3>Industry Registration Form</h3>
    <div class="row">
        <div class="col-lg-6 col-md-9 col-sm-12">
            <form method="POST" action="dashindex.php?page=ind_form">
                <div class="form-group">
                    <label for="org_name">Industry Full Name*</label>
                    <input type="text" name="indname" id="indname" class="form-control" value="<?= $indname ?>">
                    <span class="text-danger"><?php echo $indnameError ?></span>
                </div>
                <div class="form-group">
                    <label for="fou_name">Owner's Full Name*</label>
                    <input type="text" name="ownname" id="ownname" class="form-control" value="<?= $ownname ?>">
                    <span class="text-danger"><?php echo $ownnameError ?></span>
                </div>
                <div class="form-group col-lg-4">
                    <label for="doe">Date of Establish*</label>
                    <input type="date" name="doe" id="doe" class="form-control" value="<?= $doe ?>">
                    <span class="text-danger"><?php echo $doeError ?></span>
                </div>
                <div class="form-group">
                    <label for="type">Type of Industry*</label>
                    <br>
                    <label>
                        <input type="radio" name="type" value="Local Level - Mini" <?= $type == 'Local Level - Mini' ? 'checked' : ''; ?>> Local Level - Mini
                    </label>
                    <label>
                        <input type="radio" name="type" value="Local Level - Micro" <?= $type == 'Local Level - Micro' ? 'checked' : ''; ?>> Local Level - Micro
                    </label>
                    <br>
                    <span class="text-danger"><?php echo $typeError ?></span>
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