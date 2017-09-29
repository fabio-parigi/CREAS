<?php

    class SetorSchema {

        /**********************************************
         * Atributos da Classe                        *
         **********************************************/

            private $id;
            private $nome;
            private $instituicao;// ID da instituicao


        /**********************************************
         * Construtor da classe                       *
         **********************************************/

            public function SetorSchema($id,$nome,$instituicao){

                $this->id = $id;
                $this->nome = $nome;
                $this->instituicao = $instituicao; 

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
