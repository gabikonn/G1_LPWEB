<?php
require_once 'config.php'; 
?>

<!DOCTYPE HTML>
<html land="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
   <title>SEPF</title>
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" />
 </head>

<body>

	<div class="container">
		<div class="entorno">

		<header class="masthead">
			<h1 class="muted">FARMÁCIA</h1>
			<nav class="navbar">
				<div class="navbar-inner">
					<div class="container">
						<ul class="nav">

							<li class="active"><a href="index.php"><span class="add-on"><i class="icon-home"></i></span> Página inicial</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</header>

		<?php	
		$produtos = new Cadastro();

		 if(isset($_POST['cadastrar'])):

			$produto  = $_POST['produto'];
			$preco = $_POST['preco'];
			$qntd = $_POST['qntd'];

			$produtos->setProduto($produto);
			$produtos->setPreco($preco);
			$produtos->setQntd($qntd);

			# Inserção
			if($produtos->insert()){
				echo "Inserido com sucesso!";
			}

		endif;
		?>

		<?php 
		if(isset($_POST['atualizar'])):

			$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
			$produto = $_POST['produto'];
			$preco = $_POST['preco'];
			$qntd = $_POST['qntd'];

			$produtos->setProduto($produto);
			$produtos->setPreco($preco);
			$produtos->setQntd($qntd);

			if($produtos->update($id)){
				header("Location: index.php");      				
				}

		endif;
		?>

		<?php
		if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'):

			$id = (int)$_GET['id'];
			if($produtos->delete($id)){
				echo "Deletado com sucesso!";
			}

		endif;
		?>

		<?php
		if(isset($_GET['acao']) && $_GET['acao'] == 'editar'){

			$id = (int)$_GET['id'];
			$resultado = $produtos->find($id);
		?>

		<form method="post" action="">
			<div class="input-prepend">
				<span class="add-on"><i class="icon-list-alt"></i></span>
				<input type="text" name="produto" value="<?php echo $resultado->produto; ?>" placeholder="Descrição do produto:" />
			</div>
			<div class="input-prepend">
				<span class="add-on"><i class="icon-shopping-cart"></i></span>
				<input type="text" name="preco" value="<?php echo $resultado->preco; ?>" placeholder="Preço R$:" />
			</div>
			<div class="input-prepend">
				<span class="add-on"><i class="icon-plus-sign"></i></span>
				<input type="number" name="qntd"value="<?php echo $resultado->qntd; ?>" placeholder="Quatidade:" />
			</div>
			<br />
			<input type="submit" name="atualizar" class="btn btn-primary" value="Atualizar cadastro">					
		</form>

		<?php }else{ ?>

		<form method="post" action="">
			<div class="input-prepend">
				<span class="add-on"><i class="icon-list-alt"></i></span>
				<input type="text" name="produto" placeholder="Descrição do produto:" />
			</div>
			<div class="input-prepend">
				<span class="add-on"><i class="icon-shopping-cart"></i></span>
				<input type="text" name="preco" placeholder="Preço R$:" />
			</div>
			<div class="input-prepend">
				<span class="add-on"><i class="icon-plus-sign"></i></span>
				<input type="number" name="qntd" placeholder="Quatidade:" />
			</div>
			<br />
			<input type="submit" name="cadastrar" class="btn btn-primary" value="Cadastrar produtos">					
		</form>

		<?php } ?>
		
		<table class="table table-hover">
			
			<thead>
				<tr>
					<th>#</th>
					<th>Descrição:</th>
					<th>Preço:</th>
					<th>Quantidade:</th>
					<th>Total:</th>
					<th>Ações:</th>
				</tr>
			</thead> 

			<?php foreach($produtos->findAll() as $key => $value): ?>

			<tbody>
				<tr> 
					<td><?php echo $value->id; ?></td>
					<td><?php echo $value->produto; ?></td>
					<td><?php echo $value->preco; ?></td>
					<td><?php echo $value->qntd; ?></td>
					<td><?php $total = floatval($value->preco) *  floatval($value->qntd);
							  echo $total = number_format($total, 2, ',','.') ?></td>
					<td>
						<?php echo "<a href='index.php?acao=editar&id=" . $value->id . "'>Editar</a>"; ?>
						<?php echo " | "; ?>
						<?php echo "<a href='index.php?acao=deletar&id=" . $value->id . "' onclick='return confirm(\"Deseja realmente fazer isso?\")'> Deletar</a>"; ?> 
					</td>
				</tr>
			</tbody>

			<?php endforeach; ?>
			
		</table>

	</div>
</div>


<script src="js/jQuery.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>