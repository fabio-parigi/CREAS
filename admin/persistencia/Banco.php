<?php

	/**********************************************
    * Debug Mode			                      *
	**********************************************/
		
		$debug_mode=TRUE;
		
		if($debug_mode){
			error_reporting(E_ALL);			//Exibe mensagens de erro do PHP na tela
			ini_set('display_errors', 1); 
		}else{
			ini_set('display_errors', 0); 
		}
			


    class Banco {

        /**********************************************
         * Atributos da Classe                        *
         **********************************************/
            private $host   = "localhost";
            private $schema = "creas_db";
            private $user   = "root";
            private $pass   = "123!@#";
            private $mysqli = NULL;

        /**********************************************
         * Construtor da classe                       *
         **********************************************/

            public function Banco() {

            }

        /**********************************************
         * Funcionalidades ligadas ao Banco de Dados  *
         **********************************************/

            /**********************************************
             * Métodos de Conexão                         *
             **********************************************/

                public function Connect() {

                    $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->schema);
                }

                public function CloseConnection() {
                
                    $this->mysqli->close();
                }

                public function ExplodeConnection(){
                    
                    unset($this->mysqli);
                }

            /**********************************************
             * Métodos de Busca                           *
             **********************************************/

                public function QueryThis($query){
                    $this->Connect();

                    if($this->mysqli->query($query)){

                        $this->CloseConnection();
                        return  TRUE;

                    }else{

                        $this->CloseConnection();
                        return FALSE;

                    } 
                }
				
		public function QueryThisID($query){
                    $this->Connect();

                    if($this->mysqli->query($query)){
						$id = $this->mysqli->insert_id;
                        $this->CloseConnection();
                        return  $id;

                    }else{

                        $this->CloseConnection();
                        return FALSE;

                    } 
                }

                public function getThisQuery($query){
                    $this->Connect();

                    if($result = $this->mysqli->query($query)){
                        
                        $this->CloseConnection();
                        return $result;

                    }else{

                        $this->CloseConnection();
                        return FALSE;

                    }
                }

        /********************************************************************************************
         * Métodos 'get' e 'set' moldáveis.                                                         *
         * É possível pegar e setar o valor de qualquer variável apenas digitando o nome e o valor. *
         ********************************************************************************************/
        
            public function set($variavel, $valor){
                $this->$variavel = $valor;
            }
            public function get($variavel){
                return $this->$variavel;
            }
            
    }
?>
