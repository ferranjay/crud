<!-- Maak connectie met de database -->
<?php  include('db.php'); ?>


<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM info WHERE id=$id");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$name = $n['name'];
			$address = $n['address'];
		}
	}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:700" rel="stylesheet">
    <title>CRUD</title>
  </head>


  <body>

		<div class="image">
			<h1>CRUD</h1>
		</div>
		
		<h3>Create, Read, Update & Delete</h3>

<!-- Deze code geeft een bevestigingsbericht weer om de gebruiker te laten weten dat er een nieuw record in de database is aangemaakt. -->
    
    <?php if (isset($_SESSION['message'])): ?>
	    <div class="msg">
		    <?php 
			    echo $_SESSION['message']; 
			    unset($_SESSION['message']);
		    ?>
	    </div>
		<?php endif ?>
		
<!-- De databaserecords ophalen en deze op de pagina weergeven -->

    <?php $results = mysqli_query($db, "SELECT * FROM info"); ?>

    <table>
	    <thead>
		    <tr>
			    <th>NAME</th>
			    <th>ADDRESS</th>
			    <th colspan="2">ACTION</th>
		    </tr>
			</thead>

	<!-- Specifiek neerzetten van de information in de bijbehorende rows -->

	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['address']; ?></td>
			<td>
				<a href="index.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >EDIT</a>
			</td>
			<td>
				<a href="db.php?del=<?php echo $row['id']; ?>" class="del_btn">DELETE</a>
			</td>
		</tr>
    <?php } ?>
    </table>


    <form method="post" action="db.php" >
			<div class="input-group">
				<label>NAME</label>
				<input type="text" name="name" value="<?php echo $name; ?>">
			</div>
			<div class="input-group">
				<label>ADDRESS</label>
				<input type="text" name="address" value="<?php echo $address; ?>">
			</div>

    <!-- nieuw toegevoegd veld wat niet zichtbaar hoeft te zijn bij het updaten van de database-->
      <div class="input-group">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
      </div>
			<div class="input-group">
          <?php if ($update == true): ?>
	          <button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
              <?php else: ?>
	          <button class="btn" type="submit" name="save" >SAVE</button>
          <?php endif ?>
			</div>
		</form>

	
	</div>

  </body>
</html>