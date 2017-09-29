<?php

    /**********************************************
     * Include Modelos de Banco de Dados          *
     **********************************************/

        include_once '../modelo/EditaisBaixadosSchema.php';

    /**********************************************
     * E.B.Q.M. = EditaisBaixadosQueryMethods                *
     **********************************************/

    class EBQM {

        /**********************************************
         * Construtor da classe                       *
         **********************************************/
        
            public function EBQM() {
                
            }

        /**********************************************
         * Funcionalidades ligadas ao Banco de Dados  *
         **********************************************/

            /**********************************************
             * Métodos de Adicionar                       *
           

                public function AdicionarEditaisBaixados(&$edital, &$Banco) {
                    
                    $query = "INSERT INTO editasbaixados (nome,data,situacao) VALUES (".$edital->get('nome').",".$edital->get('data').",".$edital->get('situacao').")";

                    return $Banco->QueryThis($query);
                }
			**********************************************/
			
            /**********************************************
             * Métodos de Busca                           *
             **********************************************/

                public function BuscarEditaisBaixados(&$Banco){
                    
                   $query = "SELECT * FROM editaisbaixados"; 
                    
                    return $Banco->getThisQuery($query);
                    
                }
				
				
				
				
				
	

            /**********************************************
             * Método de Deletar - Não requisitado        *
             **********************************************/

    }
?>