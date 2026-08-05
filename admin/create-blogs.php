<?php

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$query = mysqli_query($conn, "SELECT * FROM blogs WHERE id ='$id'");
$row = mysqli_fetch_assoc($query);

//jika tombol save di tekan 
if (isset($_POST['save'])) {
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $image = $_FILES['image'];


    if ($image['error'] == 0) {
        $filename = uniqid() . "_" . basename($image['name']);
        $filepath = "assets/img/" . $filename;

        if ($id && !empty($row['image'])) {
            $old_picture_path = "assets/img/" . $row['image'];
            if (file_exists($old_picture_path)) {
                unlink($old_picture_path);
            }
        }
        move_uploaded_file($image['tmp_name'], $filepath);


        //masukkan ke dalam users sebutkan kolom di table user nilainya diambil dari user nginput
        if ($id) {
            //query update
            $update = mysqli_query($conn, "UPDATE blogs SET title='$title', subtitle='$subtitle' WHERE id='$id'");
            header("location:app.php?page=blogs&update=berhasil");
        } else {
            $insert = mysqli_query($conn, "INSERT INTO blogs (title, subtitle, image) VALUES ('$title','$subtitle', '$filename')");
            header("location:app.php?page=blogs&tambah=berhasil");
        }
    } else {
        //query update
        $update = mysqli_query($conn, "UPDATE blogs SET title='$title', subtitle='$subtitle' WHERE id='$id'");
        header("location:app.php?page=blogs&update=berhasil");
    }
}
//tampilin semua data dari table user dan urutkan dari terbesar ke terkecil



// echo $_SESSION['NAME'];
?>
<div
    class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
        <h3 class="fw-bold mb-3"><?php echo isset($_GET['edit']) ? 'Edit Blogs' : 'Create New Blogs' ?></h3>
    </div>

</div>
<div class="row">
    <div class="col-sm-6 col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold">Title</label>
                        <input type="text"
                            class="form-control" name="title"
                            placeholder="Enter Title" required
                            value="<?php echo ($id) ? $row['title'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold">Subtitle</label>
                        <input type="text"
                            class="form-control" name="subtitle"
                            placeholder="Enter Subtitle"
                            value="<?php echo ($id) ? $row['subtitle'] : '' ?>">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label fw-bold">Image</label>
                        <input type="file"
                            class="form-control" name="image"
                            value="<?php echo ($id) ? $row['image'] : '' ?>">
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