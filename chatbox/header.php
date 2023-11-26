<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Do | Chatting</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/fontawesome.min.css"
  integrity="sha512-siarrzI1u3pCqFG2LEzi87McrBmq6Tp7juVsdmGY1Dr8Saw+ZBAzDzrGwX3vgxX1NkioYNCFOVC0GpDPss10zQ=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
  integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="dist/css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <h4><a class="navbar-brand" href="http://localhost/chatbox/index.php" >Do<span style="color:blue; font-size:30px;">Chatting</span></a></h4>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                    
                    <a class="nav-link" href="http://localhost/chatbox/index.php"> <i class="fa fa-home"></i>  Home</a>
                    </li>
                    <li class="nav-item1">
                    
                    <a class="nav-link" href="#">   Contact us</a>
                    </li>
                    <li class="nav-item2">
                    
                    <a class="nav-link" href="#">  Aboutn us</a>
                    </li>
                    <li class="nav-item2">
                    
                    <a class="nav-link" href="#"><i class="fa fa-search"></i> Search</a>
                    </li>
                    <li class="nav-item">
                        <?php
                        session_start();

                        if (isset($_SESSION['user_id'])) {
                            echo '<div>';
                            echo '<span>Welcome, ' . $_SESSION['name'] . '!  </span>';
                            echo '<a href="..add/logout.php" class="btn btn-danger">Logout</a>';
                            echo '</div>';
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JavaScript Library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>