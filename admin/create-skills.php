<?php

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$query = mysqli_query($conn, "SELECT * FROM skills WHERE id='$id'");
$row = mysqli_fetch_assoc($query);

//jika tombol save di tekan 
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $progress = $_POST['progress'];

    //masukkan ke dalam users sebutkan kolom di table user nilainya diambil dari user nginput
    if ($id) {
        //query update
        $update = mysqli_query($conn, "UPDATE skills SET name='$name', progress='$progress' WHERE id='$id'");
        header("location:app.php?page=skills&update=berhasil");
    } else {
        $insert = mysqli_query($conn, "INSERT INTO skills (name, progress) VALUES ('$name','$progress')");
        header("location:app.php?page=skills&tambah=berhasil");
        exit();
    }
}

?>
<div
    class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
        <h3 class="fw-bold mb-3"><?php echo isset($_GET['edit']) ? 'Edit Skills' : 'Create New Skills' ?></h3>
    </div>

</div>
<div class="row">
    <div class="col-sm-6 col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold">Name</label>
                        <input type="text"
                            class="form-control" name="name"
                            placeholder="Enter Name" required
                            value="<?php echo ($id) ? $row['name'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold">Progress</label>
                        <input type="number"
                            class="form-control" name="progress"
                            placeholder="Enter Progress" required
                            value="<?php echo ($id) ? $row['progress'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" name="save" type="submit">
                            Save
                        </button>

                    </div>
                </form>
            </div>
        </div>

    </div>
</div>