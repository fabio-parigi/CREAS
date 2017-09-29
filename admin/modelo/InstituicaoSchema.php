<?php

    class InstituicaoSchema {

        /**********************************************
         * Atributos da Classe                        *
         **********************************************/

            private $id;
            private $nome;
            private $jurisdicao;
			private $municipio;
			private $uf;
			


        /**********************************************
         * Construtor da classe                       *
         **********************************************/

            public function InstituicaoSchema($id,$nome,$jurisdicao,$municipio,$uf){

                $this->id = $id;
                $this->nome = $nome;
                $this->jurisdicao = $jurisdicao;
				$this->municipio = $municipio;
				$this->uf = $uf;
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
