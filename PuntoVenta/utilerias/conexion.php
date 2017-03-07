<?php
class Conexion{
	public static $con = null;

	public function AbreConexion(){
		try{
            if($con == null) $con = new PDO('mysql:host=localhost;dbname=PuntoVenta', "root", "");
			return $con;
		}		
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	function CierraConexion(){
		try{
			$con = null;
		}
        catch(Exception $e){
			//echo $e->getMessage();
		}
		
	}


}
?>