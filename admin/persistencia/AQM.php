<?php

    /**********************************************
     * Include Modelos de Banco de Dados          *
     **********************************************/

        include_once '../modelo/AvisosSchema.php';

    /**********************************************
     * R.Q.M. = AvisosQueryMethods                *
     **********************************************/

    class AQM {

        /**********************************************
         * Construtor da classe                       *
         **********************************************/
        
            public function AQM() {
                
            }

        /**********************************************
         * Funcionalidades ligadas ao Banco de Dados  *
         **********************************************/

            /**********************************************
             * Métodos de Adicionar                       *
             **********************************************/

                public function AlterarAvisos(&$Avisos, &$Banco) {
                    
                    $query =
                    
                    "UPDATE `avisos` SET `texto`       =   '".$Avisos->get('texto')."'
                    WHERE `idAvisos` = ".$Avisos->get('idAvisos')."";

                    return $Banco->QueryThis($query);
                }

            /**********************************************
             * Métodos de Busca                           *
             **********************************************/

                public function BuscarAvisos(&$Banco, $colunas){
                    
                    $query = "SELECT ".$colunas." FROM avisos WHERE idAvisos = 1";

                    return $Banco->getThisQuery($query);
                    
                }
    }
?>