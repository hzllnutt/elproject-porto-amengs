<?php

//tampilin semua data dari table user dan urutkan dari terbesar ke terkecil
$id = isset($_GET['id']) ? $_GET['id'] : '';
$query = mysqli_query($conn, "SELECT * FROM contacts WHERE id='$id'");
$row = mysqli_fetch_assoc($query);

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
        <div class="row mb-3">
          <div class="col-md-4">
            <label for="">Name</label>
            <input type="text" readonly class="form-control" value="<?php echo $row['name'] ?>">
          </div>
          <div class="col-md-4">
            <label for="">Email</label>
            <input type="text" readonly class="form-control" value="<?php echo $row['email'] ?>">
          </div>
          <div class="col-md-4">
            <label for="">Subject</label>
            <input type="text" readonly class="form-control" value="<?php echo $row['subject'] ?>">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label for="">Message</label>
            <textarea class="form-control" readonly><?php echo $row['message'] ?></textarea>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>