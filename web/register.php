<?php include 'header.php'; 

if(isset($_SESSION['logged_in'])){
    header("Location: index.php");
}
?>

<div class="row justify-content-center">
    <div class="col-md-4 mt-4">
        <?php
        if (isset($_GET['msg'])) { ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?= $_GET['msg'] ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        <form action="process.php" method="post" class="border p-3 m-3">
            <div class="mb-3">
                <label for="">Firstname</label>
                <input type="text" name="fname" id="" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Lastname</label>
                <input type="text" name="lname" id="" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Email</label>
                <input type="email" name="email" id="" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Password</label>
                <input type="password" name="pass1" id="" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Confirm-Password</label>
                <input type="password" name="pass2" id="" class="form-control">
            </div>
            <div class="mb-3">
                <button class="btn btn-warning" name="registerUser">Register</button>
            </div>
        </form>
    </div>
</div>
</body>

</html>