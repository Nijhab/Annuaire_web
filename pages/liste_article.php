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
                           <h3><a href="add.php"><span class="glyphicon glyphicon-plus"></span> Ajouter un article</a></h3>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
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
                                            <td><?php echo $row['code']; ?></td>
                                            <td><?php echo $row['libelle']; ?></td>
											<td><?php echo $row['quantite']; ?></td>
                                            <td><?php echo $row['prixUnitaire']; ?></td>
                                            <td><?php echo $row['provenance']; ?></td>
                                            <td><a href="edit.php?update_id=<?php echo $row['code']; ?>" class="btn btn-warning">Modifier</a></td>
                                            <td><a href="?delete_id=<?php echo $row['code']; ?>" class="btn btn-danger">Supprimer</a></td>
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
  <button class="btn btn-primary me-md-2" type="button">Imprimer</button>
    </div>
    </div>
    <br>
      <?php include 'pied.php';?>
      <?php include 'script.php';?>								
	</body>
</html>