<?php

    /**********************************************
     * Include Modelos de Banco de Dados          *
     **********************************************/

        include_once '../modelo/CargoSchema.php';

    /**********************************************
     * C.Q.M. = CargoQueryMethods                 *
     **********************************************/
	
    class CQM {

        /**********************************************
         * Construtor da classe                       *
         **********************************************/
        
            public function CQM() {
                
            }

        /**********************************************
         * Funcionalidades ligadas ao Banco de Dados  *
         **********************************************/

            /**********************************************
             * Métodos de Adicionar                       *
             **********************************************/

                public function AdicionarCargo(&$cargo, &$Banco) {
                    
                    $query = "INSERT INTO cargo(idCargo, nome, nivel) VALUES (NULL,'".$cargo->get('nome')."',".$cargo->get('nivel').")";

                    return $Banco->QueryThis($query);
                }

            /**********************************************
             * Método de Alterar                          *
             **********************************************/

                public function AlterarCargo(&$cargo, &$Banco) {
                    
                    $query = "  UPDATE cargo SET 
                                    nome = '".$cargo->get('nome')."', 
                                    nivel = ".$cargo->get('nivel')." 
                                WHERE 
                                    idCargo = ".$cargo->get('idCargo')."";

                    $banco->QueryThis($query);
                }

            /**********************************************
             * Métodos de Busca                           *
             **********************************************/

                public function BuscarCargo(&$Banco, $colunas, $statement){

                    $query = "SELECT ".$colunas." FROM cargo ".$statement.";";

                    return $Banco->getThisQuery($query);
                    
                }

            /**********************************************
             * Métodos de Editar                           *
             **********************************************/

                public function EditarCargo(&$Banco, $query){
                    
                    return $Banco->getThisQuery($query);
                    
                }
            /**********************************************
             * Método de Deletar                          *
             **********************************************/
            
                public function DeletarCargo($idCargo, &$Banco) {

                    $query = "DELETE FROM cargo WHERE idCargo = ".$idCargo."";

                    return $Banco->QueryThis($query);
                }
    }
?>