<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">


</head>
<body class="container">
  <form action="index.php" method="POST" class="form-signin" style="width:5">
    <h1 class="h3 mb-4 font-weight-normal">Search</h1>
    <label for="path" class="sr-only">Full path</label>
    <input type="text" id="path" class="form-control" placeholder="Path" name="path" required autofocus>
    <button class="btn btn-lg btn-primary btn-block mb-4 " type="submit">Search</button>
  </form>

 
  
<?php
  function showTree(string $folder): void

  {
    if (!is_dir($folder)) {
      echo "Folder not found";
      return;
    }
    /* Получаем полный список файлов и каталогов внутри $folder */
    $files = scandir($folder);
    $size = $filesize;



    foreach($files as $file as $filesize) {
      /* Отбрасываем текущий и родительский каталог */
      if ($file == '.' || $file == '..') {
          continue;
      }
      $fullFilePath = $folder . '/' . $file  . '/' . $filesize; //Получаем полный путь к файлу


      /* Если это директория */
      if (is_dir($fullFilePath)) {

          showTree($fullFilePath , $filesize);
      }
      /* Если это файл, то просто выводим название файла */
      else {
        echo "
        <tr>
        
      <th scope='row' >1</th>
      <td>$folder</td>
      <td>$file</td>
      <td>$size</td>
    </tr>
        ";
      }
    }
  }

  if (isset($_POST['path'])) { ?>
    <table class="table">
    <thead class="thead-dark">
      <tr>
      <th scope="col">#</th>
      <th scope="col">Путь</th>
      <th scope="col">Файл</th>
          <th scope="col">Размер</th>
      </tr>
    </thead>
  <tbody>

  <?php
   showTree($_POST['path']);
   ?>
     </tbody>
     </table>
   <?php
}
  
?>
  

</body>
</html>

    
