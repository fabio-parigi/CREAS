<?php

    class CargoSchema{

        /**********************************************
         * Atributos da Classe                        *
         **********************************************/

            private $idCargo;
            private $nome;
            private $descricao;

        /**********************************************
         * Construtor da classe                       *
         **********************************************/

            public function CargoSchema($idCargo ,$nome, $descricao){
				
				$this->idCargo	 = $idCargo;
                $this->nome 	 = $nome;
				$this->descricao = $descricao;
				
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
