<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>

<body class="container">
	<form action="index.php" method="POST" class="form-signin" style="width:5">
		<h1 class="h3 mb-5 font-weight-normal">Search</h1>
   		<label for="path" class="sr-only">Full path</label>
  		<input type="text" id="path" class="form-control" placeholder="Path" name="path" required autofocus>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Search</button>
 	</form>

 	<?php
     function showTree(string $folder, int &$number, array &$array): void
     {
        if (!is_dir($folder)) {
            echo "Folder not found";
            return;
        }
        $files = scandir($folder);

        foreach ($files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }

            $fullFilePath = $folder . '/' . $file; 
            if (is_dir($fullFilePath)) {       
                showTree($fullFilePath, $number); /* С помощью рекурсии выводим содержимое полученной директории */
                continue;
            }
            $number++;
            $size = filesize($fullFilePath);
            $item = [
                'number' => $number,
                'folder' => $folder,
                'file' => $file,
                'size' => $size
            ];
            $array[] = $item;
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
            $array = [];
   			showTree($_POST['path'], $number, $array);

            // var_dump($array);
            ?>

  			</tbody>
		</table> <?php
	} ?>
</body>
</html>

