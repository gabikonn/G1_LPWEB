<?php

	require_once 'Crud.php';

class Cadastro extends Crud{

	protected $table = 'cadastro';
	private $produto;
	private $preco;
	private $qntd;

	public function setProduto($produto){
		$this->produto = $produto;
	}

	public function getProduto(){
		return $this->produto;
	}

		public function setPreco($preco){
		$this->preco = $preco;
	}

	public function getPreco(){
		return $this->preco;
	}
	
	public function setQntd($qntd){
		$this->qntd = $qntd;
	}

	public function getQntd(){
		return $this->qntd;
	}
	
	public function insert(){

		$sql  = "INSERT INTO $this->table (produto, preco, qntd) VALUES (:produto, :preco, :qntd)";
		$stmt = Banco::prepare($sql);
		$stmt->bindParam(':produto', $this->produto);
		$stmt->bindParam(':preco', $this->preco);
		$stmt->bindParam(':qntd', $this->qntd);
		return $stmt->execute(); 

	}

	public function update($id){

		$sql  = "UPDATE $this->table SET produto = :produto, preco = :preco, qntd = :qntd WHERE id = :id";
		$stmt = Banco::prepare($sql);
		$stmt->bindParam(':produto', $this->produto);
		$stmt->bindParam(':preco', $this->preco);
		$stmt->bindParam(':qntd', $this->qntd);
		$stmt->bindParam(':id', $id);
		return $stmt->execute();

	}


}