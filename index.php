
<?php 
require_once 'db/database.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $tugas =$conn-> real_escape_string($_POST['input_task']);
    $query= sprintf("INSERT INTO tasks (task) VALUES ('$tugas')");
    $result=mysqli_query($conn, $query);
    if($result){
        echo "<script>Tugas Berhasil ditambah, Laksanakan yaaa..</script>";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }else{
        echo 'gagal';
    }
}

if(isset($_GET['status'], $_GET['id'])){
    $id= $conn->real_escape_string($_GET['id']);
    $status= $conn->real_escape_string($_GET['status']);    
    $result=mysqli_query($conn, "UPDATE tasks SET status = '$status' WHERE id = '$id'");
}

if(isset($_GET['delete_id'])){
    $id= $conn->real_escape_string($_GET['delete_id']);
    mysqli_query($conn, "DELETE FROM tasks WHERE id = '$id'");
}

$result = mysqli_query($conn, "SELECT * FROM tasks ORDER BY id desc");
$tasks = [];
while ($row = $result->fetch_assoc()) {
    $tasks[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>web todo list Ripan</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <div class="custom-container">

        <div class="row bg-hijau">
            <div class="col-sm-12">
                <h1 class="text-center teks-ungu">To Do List</h1>
            </div>
        </div>
        <hr>
        <form action="" method="POST">
            <div class="mb-3">
                <h4>BUAT TUGAS</h4>
                <input type="text" class="form-control" name="input_task" id="" aria-describedby="helpId" placeholder="" />
                <small id="helpId" class="form-text text-muted">Tambahkan List tugas yang ingin dikerjakan.</small>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>

        </form>
        <div class="mt-4">
            <h3>#DAFTAR TUGAS#</h3>
            <hr>
            <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tugas</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tasks as $task): ?>
                            <tr>
                                <td><?= $task['id'] ?></td>
                                <td><?= htmlspecialchars($task['task']) ?></td>
                                <td>
                                    <?= $task['status'] ? 'Selesai' : 'Belum Selesai'?>
                                    <input type="checkbox" class="form-check-input" 
                                           <?= $task['status'] ? 'checked' : '' ?>
                                           onclick="window.location.href='?status=<?= $task['status'] ? 0 : 1 ?>&id=<?= $task['id'] ?>'">
                                </td>
                                <td>
                                    <a href="?delete_id=<?= $task['id'] ?>" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        </div>
    </div>


</body>

</html>
