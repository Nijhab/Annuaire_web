<?php

require_once "connection.php";

if(isset($_REQUEST['update_id']))
{
	try
	{
		$code = $_REQUEST['update_id']; //obtenir la mise à jour de la liste_article à travers "$id" variable
		$select_stmt = $db->prepare('SELECT * FROM Article WHERE code =:code');
		$select_stmt->bindParam(':code',$code);
		$select_stmt->execute(); 
		$row = $select_stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
	}
	catch(PDOException $e)
	{
		$e->getMessage();
	}
	
}

if(isset($_REQUEST['btn_update']))
{
	
	$libelle	= $_REQUEST['libelle'];	
	$quantite	= $_REQUEST['quantite'];
	$prixUnitaire	= $_REQUEST['prixUnitaire'];
	$provenance	= $_REQUEST['provenance'];
		
	if(empty($libelle)){
		$errorMsg="Svp entrez libellé";
	}
	else if(empty($quantite)){
		$errorMsg="Svp entrez la quantité";
	}	
	else if(empty($prixUnitaire)){
		$errorMsg="Svp entrez la prix";
	}
	else if(empty($provenance)){
		$errorMsg="Svp entrez le lieu de provenance";
	}
	else
	{
		try
		{
			if(!isset($errorMsg))
			{
				$update_stmt=$db->prepare('UPDATE Article SET libelle=:libelle, quantite=:quantite, prixUnitaire=:prixUnitaire, provenance=:provenance WHERE code=:code'); //sql update query
				$update_stmt->bindParam(':libelle',$libelle);
				$update_stmt->bindParam(':quantite',$quantite);
				$update_stmt->bindParam(':prixUnitaire',$prixUnitaire);
				$update_stmt->bindParam(':provenance',$provenance);
				$update_stmt->bindParam(':code',$code);
				 
				if($update_stmt->execute())
				{
					$updateMsg="Mise à jour avec succès.......";	//message de mise à jour
					header("refresh:3;liste_article.php");	//refresh 3 second and redirect to liste_article.php page
				}
			}	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}	
	}	
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
	
	
	
	<div class="wrapper">
	
	<div class="container">
			
		<div class="col-lg-12">
		
		<?php
		if(isset($errorMsg))
		{
			?>
            <div class="alert alert-danger">
            	<strong>WRONG ! <?php echo $errorMsg; ?></strong>
            </div>
            <?php
		}
		if(isset($updateMsg)){
		?>
			<div class="alert alert-success">
				<strong>UPDATE ! <?php echo $updateMsg; ?></strong>
			</div>
        <?php
		}
		?>   
			<center><h2>Modifier</h2></center>
			<center><form method="post" class="form-horizontal">
					
				<div class="form-group mb-3">
				<label class="col-sm-3 control-label" style=" text-align: left;" >LIBELLE</label>
				<div class="col-sm-6">
				<input type="text" name="libelle" class="form-control" value="<?php echo $libelle; ?>">
				</div>
				</div>
					
				<div class="form-group mb-3" >
				<label class="col-sm-3 control-label" style=" text-align: left;">QUANTITE</label>
				<div class="col-sm-6">
				<input type="text" name="quantite" class="form-control" value="<?php echo $quantite; ?>">
				</div>
				</div>

				<div class="form-group mb-3">
				<label class="col-sm-3 control-label" style=" text-align: left;">PRIX UNITAIRE</label>
				<div class="col-sm-6">
				<input type="text" name="prixUnitaire" class="form-control" value="<?php echo $prixUnitaire; ?>">
				</div>
				</div>

				<div class="form-group mb-3">
				<label class="col-sm-3 control-label" style=" text-align: left;">PROVENANCE</label>
				<div class="col-sm-6">
				<input type="text" name="provenance" class="form-control" value="<?php echo $provenance; ?>">
				</div>
				</div>

				<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9 m-t-15">
					<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
Mettre à jour
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
    
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Voulez vous vraiment modifier cette donnée?
      </div>
      <div class="modal-footer">
	   <button  class="btn btn-success" type="submit"  name="btn_update" class="btn btn-danger " >Valider</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button> 
      </div>
    </div>
  </div>
</div>
		<a href="liste_article.php" class="btn btn-danger">Supprimer</a>
		</div>
		</div>
			</form>
			
		</div>
		
	</div>
			
	</div>
			<br>							
	<?php include 'pied.php';?>
    <?php include 'script.php';?>								
	</body>
</html>