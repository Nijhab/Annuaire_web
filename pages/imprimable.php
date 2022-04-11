<?php
require_once "connection.php";
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
<body onload="window.print()">
<h1 style="font-family: Bahnschrift SemiCondensed; text-align: center;">LISTE DES ARTICLES</h1>
<div class="panel-body imprimable">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>LIBELLE</th>
											<th>QUANTITE</th>
                                            <th>PRIX UNITAIRE</th>
                                            <th>PROVENANCE</th>
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
                                        </tr>
                                    <?php
									}
									?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <?php include 'script.php';?>
                        </body>
</html>