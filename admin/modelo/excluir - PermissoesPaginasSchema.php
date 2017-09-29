<?php

    class PermissoesPaginasSchema{

        /**********************************************
         * Atributos da Classe                        *
         **********************************************/

            private $idPagina;
            private $nomePagina;
            private $path;
			private $logotipo;

        /**********************************************
         * Construtor da classe                       *
         **********************************************/

            public function PermissoesPaginasSchema($idPagina, $nomePagina, $path, $logotipo){

                $this->idPagina  = $idPagina;
                $this->nomePagina = $nomePagina;
				$this->path = $path;
				$this->logotipo = $logotipo;
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
