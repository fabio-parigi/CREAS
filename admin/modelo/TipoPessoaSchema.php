<?php

    class TipoPessoaSchema{

        /**********************************************
         * Atributos da Classe                        *
         **********************************************/

            private $idTipoPessoa;
            private $nomeTipoPessoa;

        /**********************************************
         * Construtor da classe                       *
         **********************************************/

            public function TipoPessoaSchema($idTipoPessoa,$nomeTipoPessoa){
                
				$this->idTipoPessoa = $idTipoPessoa;
                $this->nomeTipoPessoa = $nomeTipoPessoa;

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
