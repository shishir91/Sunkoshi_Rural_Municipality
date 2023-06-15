<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = trim($_POST['id']);

    $sql = "DELETE FROM personal WHERE id = $id";

    if ($conn->query($sql)) {
        header("location: dashindex.php?page=dcitizens");
        exit();
    }
} else {
    $id = trim($_GET['id']);
}

?>

<div class="row" align = "right">
    <div class="col-lg-8 col-sm-12">
        <form action="dashindex.php?page=p-delete>" method="POST">
            <h4>Are you sure you want to delete this data?</h4>
            <input type="hidden" name="id" id="" value="<?= $id; ?>">
            <input type="submit" class="btn btn-danger" value="Yes">
            <a href="dashindex.php?page=dcitizens" class="btn btn-success">No</a>
        </form>
    </div>
</div>