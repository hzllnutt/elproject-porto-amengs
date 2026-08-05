<?php

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$query = mysqli_query($conn, "SELECT * FROM resume WHERE id ='$id'");
$row = mysqli_fetch_assoc($query);

//jika tombol save di tekan 
if (isset($_POST['save'])) {
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $description = $_POST['description'];
    $year_start = $_POST['year_start'];
    $year_end = $_POST['year_end'];

    //masukkan ke dalam users sebutkan kolom di table user nilainya diambil dari user nginput
    if ($id) {
        //query update
        $update = mysqli_query($conn, "UPDATE resume SET title='$title', subtitle='$subtitle', description='$description,' year_start='$year_start', year_end='$year_end'  WHERE id='$id'");
        header("location:app.php?page=resume&update=berhasil");
    } else {
        $insert = mysqli_query($conn, "INSERT INTO resume (title, subtitle, description, year_start, year_end) VALUES('$title','$subtitle','$description','$year_start','$year_end')");
        header("location:app.php?page=resume&tambah=berhasil");
    }
}
//tampilin semua data dari table user dan urutkan dari terbesar ke terkecil



// echo $_SESSION['NAME'];
?>
<div
    class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
        <h3 class="fw-bold mb-3"><?php echo isset($_GET['edit']) ? 'Edit User' : 'Create New Resume' ?></h3>
    </div>

</div>
<div class="row">
    <div class="col-sm-6 col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
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
                            placeholder="Enter Subtitle" required
                            value="<?php echo ($id) ? $row['subtitle'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold">Description</label>
                        <textarea class="form-control" name="description" cols="30" rows="3"><?php echo ($id) ? $row['description'] : '' ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Year Start</label>
                        <select class="form-select" name="year_start" id="year_start"></select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Year End</label>
                        <select class="form-select" name="year_end" id="year_end"></select>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const year_start = document.getElementById("year_start");
        const year_end = document.getElementById("year_end");
        const year_old = 1920;
        const currentYear = new Date().getFullYear();

        const yearDataStart = "<?php echo ($id) ? $row['year_start'] : '' ?>";
        const yearDataEnd = "<?php echo ($id) ? $row['year_end'] : '' ?>";

        for (let year = currentYear; year >= year_old; year--) {
            const option = document.createElement("option");
            option.value = year;
            option.textContent = year;
            if (yearDataStart && yearDataStart == year) {
                option.selected = true;
            }
            year_start.appendChild(option);
        }
        for (let year = currentYear; year >= year_old; year--) {
            const option = document.createElement("option");
            option.value = year;
            option.textContent = year;
            if (yearDataEnd && yearDataEnd == year) {
                option.selected = true;
            }
            year_end.appendChild(option);
        }
    });
</script>