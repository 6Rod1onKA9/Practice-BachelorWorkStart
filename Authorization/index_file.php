<!DOCTYPE html>
<html>
<head>
    <title>multi-user role-based-login-system</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" 
    crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
    crossorigin="anonymous"></script>
</head>
<body>
     <div class = "container d-flex justify-content-center align-items-center"
     style="min-height:100vh">
        <form class="border shadow p-3 rounded"
        action="php/check-login.php"
        method="post"
        style="width: 400px;">
        <h1 class="text-center p-3">LOGIN</h1>
        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?=$_GET['error']?>
            </div>
        <?php } ?>
  <div class="mb-3">
    <label for="user_name" 
            class="form-label">User name</label>
    <input type="text" 
           class="form-control" 
           name ="username"
           id="username">
  </div>

  <div class="mb-3">
    <label for="user_password" 
            class="form-label">Password</label>
    <input type="password" 
           name ="password"
           class="form-control" 
           id="password">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
     </div>
</body>
</html>
