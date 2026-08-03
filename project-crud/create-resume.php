<?php
session_start();
session_regenerate_id();

include 'config/koneksi.php';
if (!isset($_SESSION['NAME'])) {
    header("location:index.php");
    exit();
}

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
        header("location:resume.php?update=berhasil");
    } else {
        $insert = mysqli_query($conn, "INSERT INTO resume (title, subtitle, description, year_start, year_end) VALUES('$title','$subtitle','$description','$year_start','$year_end')");
        header("location:resume.php?tambah=berhasil");
    }
}
//tampilin semua data dari table user dan urutkan dari terbesar ke terkecil



// echo $_SESSION['NAME'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Kaiadmin - Bootstrap 5 Admin Dashboard</title>
    <meta
        content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
        name="viewport" />
    <?php
    include "inc/css.php";
    ?>

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php
        include "inc/sidebar.php";
        ?>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="index.html" class="logo">
                            <img
                                src="assets/img/kaiadmin/logo_light.svg"
                                alt="navbar brand"
                                class="navbar-brand"
                                height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <?php
                include "inc/navbar.php";
                ?>
                <!-- End Navbar -->
            </div>

            <div class="container">
                <div class="page-inner">
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
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                    <nav class="pull-left">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="http://www.themekita.com">
                                    ThemeKita
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Help </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Licenses </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright">
                        2024, made with <i class="fa fa-heart heart text-danger"></i> by
                        <a href="http://www.themekita.com">ThemeKita</a>
                    </div>
                    <div>
                        Distributed by
                        <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <?php
    include "inc/js.php";
    ?>
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
</body>

</html>