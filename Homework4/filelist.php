<?php
//ПХП КОД
include 'includes/connection.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Cистема регистраций</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">

                <li><a href="exit.php">Выход</a></li>
                <li><a href="list.php">Список пользователей</a></li>
                <li><a href="added.html">Добавление материала</a></li>
                <li><a href="filelist.php">Список файлов</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<?php
if (isset($_SESSION['user_id'])) {
    $user_query = $con->query("SELECT * FROM users ");
    $images_array = mysqli_fetch_all($user_query);

    $table = "
      <table class=\"table table-bordered\">
         <tr>
          <th>Название файла</th>
          <th>Фотография</th>
          <th>Действия</th>
        </tr>";

    foreach ($images_array as $item) {
        $image_name = $item[6];
        $image_url = "http://homeworkphp/MifirstRep/Homework4/photos/" . $image_name;
        $table .= "<tr>
          <td>$image_name</td>
          <td><img src=\"$image_url\"></td>
          <td>
            <a href=\"image_delete.php?id={$item[0]}\">Удалить аватарку пользователя</a>
          </td>
        </tr> ";

    }

    $table .= " </table>";
    echo $table;
} else {
    $table ="<div class=\"container\">
    <h1>Запретная зона, доступ только авторизированному пользователю</h1>
    <h2>Информация выводится из списка файлов</h2>
    

</div><!-- /.container -->";
}
?>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/main.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
