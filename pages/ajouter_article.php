<?php

require_once "connection.php";

if(isset($_REQUEST['btn_insert']))
{

	$libelle	= $_REQUEST['libelle'];	
	$quantite	= $_REQUEST['quantite'];
	$prixUnitaire	= $_REQUEST['prixUnitaire'];	
	$provenance	= $_REQUEST['provenance'];
		
	if(empty($libelle)){
		$errorMsg="Svp Entrez libelle";
	}
	else if(empty($quantite)){
		$errorMsg="Svp Entrez quantite";
	}
	else if(empty($prixUnitaire)){
		$errorMsg="Svp Entrez le prix";
	}
	else if(empty($provenance)){
		$errorMsg="Svp Entrez provenance";
	}
	else
	{
		try
		{
			if(!isset($errorMsg))
			{
				$insert_stmt=$db->prepare('INSERT INTO Article(libelle,quantite,prixUnitaire,provenance) VALUES(:libelle,:quantite,:prixUnitaire,:provenance)'); //sql insert query					
				$insert_stmt->bindParam('libelle',$libelle);
				$insert_stmt->bindParam(':quantite',$quantite); 
				$insert_stmt->bindParam(':prixUnitaire',$prixUnitaire);
				$insert_stmt->bindParam(':provenance',$provenance); 
					
				if($insert_stmt->execute())
				{
					$insertMsg="Données insérees avec succès........"; 
					header("refresh:3;liste_article.php"); 
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
		if(isset($insertMsg)){
		?>
			<div class="alert alert-success">
				<strong>SUCCESS ! <?php echo $insertMsg; ?></strong>
			</div>
        <?php
		}
		?>   
			<center><h2>Inserez article</h2></center>
	<center><form method="post" class="form-horizontal" style="justify-content-centrer">
					       
				<div class="col-sm-6 mb-3">
				<input type="text" name="libelle" class="form-control" placeholder="Entrez libelle" />
				</div>

				<div class="col-sm-6 mb-3">
				<input type="text" name="quantite" class="form-control" placeholder="Entrez quantite" />
				</div>

				<div class="col-sm-6 mb-3">
				<input type="number" name="prixUnitaire" class="form-control" placeholder="Prix unitaire" />
				</div>

				<div class="col-sm-6 mb-3">
				<input type="text" name="provenance" class="form-control" placeholder="Lieu de provenance" />
				</div>
				
				<div class="col-sm-offset-3 col-sm-9 m-t-15">
					<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
Insérer
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
    
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Voulez-vous vraiment inserez un article?
      </div>
      <div class="modal-footer">
	   <button  class="btn btn-success" type="submit"  name="btn_insert" class="btn btn-danger " value="Insérer" >Valider</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button> 
      </div>
    </div>
  </div>
</div>
		<a href="liste_article.php" class="btn btn-dark">Supprimer</a>
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