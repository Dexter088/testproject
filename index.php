<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>

<body class="container">
	<form action="index.php" method="POST" class="form-signin" style="width:5">
		<h1 class="h3 mb-4  font-weight-normal">Search</h1>
   		<label for="path" class="sr-only">Full path</label>
  		<input type="text" id="path" class="form-control" placeholder="Path" name="path" required autofocus>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Search</button>
 	</form>

 	<?php
 	function showTree(string $folder, int &$number): void {
        if (!is_dir($folder)) {
            echo "Folder not found";
            return;
        }
        // Получаем полный список файлов и каталогов внутри $folder
        $files = scandir($folder);

        foreach ($files as $file) {
            /* Отбрасываем текущий и родительский каталог */
            if ($file == '.' || $file == '..') {
                continue;
            }

            $fullFilePath = $folder . '/' . $file; //Получаем полный путь к файлу
            /* Если это директория */
            if (is_dir($fullFilePath)) {       
                showTree($fullFilePath, $number); /* С помощью рекурсии выводим содержимое полученной директории */
                continue;
            }
            $number++;
            $size = filesize($fullFilePath);
            echo "
                <tr>
                    <th scope='row'>$number</th>
                    <td>$folder</td>
                    <td>$file</td>
                    <td>$size</td>
                </tr>
            ";
        }
    }
    /* Запускаем функцию для текущего каталога */
    if (isset($_POST['path'])) { ?>
		<table class="table">
  			<thead class="thead-dark">
    			<tr>
      				<th scope="col">#</th>
      				<th scope="col">FullPath</th>
      				<th scope="col">File</th>
      				<th scope="col">Size</th>
    			</tr>
    		</thead>
  			
  			<tbody>

  			<?php
            $number = 0;
   			showTree($_POST['path'], $number);
			?>

  			</tbody>
		</table> <?php
	} ?>
</body>
</html>
		