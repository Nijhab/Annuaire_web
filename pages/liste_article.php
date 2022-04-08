<?php

require_once "connection.php";
	
if(isset($_REQUEST['delete_id']))
{
	// selectionner la donnée de la base de donnée à supprimer 
	$code=$_REQUEST['delete_id'];	//obtenir delete_id et le deposer dans $id variable
		
	$select_stmt= $db->prepare('SELECT * FROM Article WHERE code =:code');
	$select_stmt->bindParam(':code',$code);
	$select_stmt->execute();
	$row=$select_stmt->fetch(PDO::FETCH_ASSOC);
		
	//supprimer une donnée de la base de donnée 
	$delete_stmt = $db->prepare('DELETE FROM Article WHERE code =:code');
	$delete_stmt->bindParam(':code',$code);
	$delete_stmt->execute();
		
	header("Location:liste_article.php");
}
	
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include 'style.php';?>
</head>
<body>
<?php include 'menu_page.php';?>  
      <h1 style="font-family: Algerian; text-align: center;">LISTE DES ARTICLES</h1>
	
	<div class="wrapper">
	
	<div class="container">
			
		<div class="col-lg-12">
			<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <h3><a href="add.php"><span class="glyphicon glyphicon-plus"></span> <button type="button" class="btn btn-outline-primary">Ajouter un article</button>
                            </a></h3>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body imprimable">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>LIBELLE</th>
											<th>QUANTITE</th>
                                            <th>PRIX UNITAIRE</th>
                                            <th>PROVENANCE</th>
                                            <th>MODIFIER</th>
                                            <th>SUPPRIMER</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$select_stmt=$db->prepare("SELECT * FROM Article");	
									$select_stmt->execute();
									while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
									{
									?>
                                        <tr>
                                            <td><?php echo $row['libelle']; ?></td>
											<td><?php echo $row['quantite']; ?></td>
                                            <td><?php echo $row['prixUnitaire']; ?></td>
                                            <td><?php echo $row['provenance']; ?></td>
                                            <td><a href="edit.php?update_id=<?php echo $row['code']; ?>" class="btn "> <img src="../image/edit2.jpg"  alt=""> </a></td>
                                            <td><a href="?delete_id=<?php echo $row['code']; ?>" class="btn "> <img src="../image/Delete2.jpg"  alt=""> </a></td>
                                        </tr>
                                    <?php
									}
									?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
				
		</div>
		
	</div>
			
	</div>
    <div class="container">
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
  <a href="imprimable.php">
  <button class="btn btn-primary me-md-2" type="button">Imprimer</button>
  </a>
    </div>
    </div>
    <br>
      <?php include 'pied.php';?>
      <?php include 'script.php';?>	
      
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>


	</body>
</html>