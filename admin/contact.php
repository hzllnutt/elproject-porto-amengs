<?php

//tampilin semua data dari table user dan urutkan dari terbesar ke terkecil
$query = mysqli_query($conn, "SELECT * FROM contacts ORDER BY id DESC");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

//jika params delete ada 
if (isset($_GET['delete'])) {
  $delete = $_GET['delete'];
  $delete = mysqli_query($conn, "DELETE FROM contacts WHERE id='$delete'");
  header("location:app.php?page=contact&hapus=berhasil");
}

// echo $_SESSION['NAME'];
?>
<div
  class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
  <div>
    <h3 class="fw-bold mb-3">Contact</h3>
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
              <th>Name</th>
              <th>Email</th>
              <th>Subject</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($rows as $index => $row):  ?>
              <tr>
                <td><?php echo $index += 1 ?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['subject'] ?></td>
                <td>
                  <a class="btn btn-success btn-sm"
                    href="app.php?page=contact-detail&id=<?php echo $row['id'] ?>">Detail</a>

                  <a onclick="return confirm('Are You sure wanna delete this data?')"
                    class="btn btn-danger btn-sm"
                    href="app.php?page=contact&delete=<?php echo $row['id'] ?>">Delete</a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>

        </table>
      </div>
    </div>

  </div>
</div>