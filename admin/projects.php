<?php

//tampilin semua data dari table projects dan urutkan dari terbesar ke terkecil
$query = mysqli_query($conn, "SELECT * FROM projects ORDER BY id DESC");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

//jika params delete ada 
if (isset($_GET['delete'])) {
  $delete = $_GET['delete'];

  $img = mysqli_query($conn, "SELECT image FROM projects WHERE id='$delete'");
  $rowImg = mysqli_fetch_assoc($img);
  if ($delete && !empty($rowImg['image'])) {
    $old_picture_path = "assets/img/" . $rowImg['image'];
    if (file_exists($old_picture_path)) {
      unlink($old_picture_path);
    }
  }

  $delete = mysqli_query($conn, "DELETE FROM projects WHERE id='$delete'");
  header("location:app.php?page=projects&hapus=berhasil");
}
// echo $_SESSION['NAME'];
?>
<div
  class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
  <div>
    <h3 class="fw-bold mb-3">Projects</h3>
  </div>
  <div class="ms-md-auto py-2 py-md-0">
    <!-- <a href="#" class="btn btn-label-info btn-round me-2">Manage</a> -->
    <a href="app.php?page=create-projects" class="btn btn-primary btn-round">Create New Projects</a>
  </div>
</div>
<div class="row">
  <div class="col-sm-6 col-md-12">
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Title</th>
              <th>Subtitle</th>
              <th>Image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($rows as $index => $row):  ?>
              <tr>
                <td><?php echo $index += 1 ?></td>
                <td><?php echo $row['title'] ?></td>
                <td><?php echo $row['subtitle'] ?></td>
                <td>
                  <img src="assets/img/<?php echo $row['image'] ?>" width="170" alt="">
                </td>
                <td>
                  <a class="btn btn-success btn-sm"
                    href="app.php?page=create-projects&edit=<?php echo $row['id'] ?>">Edit</a>

                  <a onclick="return confirm('Are You sure wanna delete this data?')"
                    class="btn btn-danger btn-sm"
                    href="app.php?page=projects&delete=<?php echo $row['id'] ?>">Delete</a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>

        </table>
      </div>
    </div>

  </div>
</div>