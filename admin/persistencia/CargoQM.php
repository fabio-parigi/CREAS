<?php

    /**********************************************
     * Include Modelos de Banco de Dados          *
     **********************************************/

        include_once '../modelo/CargoSchema.php';
		

    /**********************************************
     * Q.M. = QueryMethods                 		  *
     **********************************************/

    class CargoQM {

        /**********************************************
         * Construtor da classe                       *
         **********************************************/
                    
            public function CargoQM() {
                
            }

        /**********************************************
         * Funcionalidades ligadas ao Banco de Dados  *
         **********************************************/

            /**********************************************
             * Métodos de Adicionar                       *
             **********************************************/

                public function AdicionarCargo(&$Novo, &$Banco) {
                    
                    $query = "  INSERT INTO tb_cargo (id_cargo, nome_cargo, descricao_cargo) 
                                VALUES (NULL, '".$Novo->get('nome')."','".$Novo->get('descricao')."');";

                    return $Banco->QueryThis($query);
                }

            /**********************************************
             * Método de Alterar                          *
             **********************************************/

               public function AlterarCargo(&$Cargo, &$Banco){

                    $query = "UPDATE  tb_cargo
                                SET     nome_cargo				= '".$Cargo->get('nome')."',
										descricao_cargo		 	= '".$Cargo->get('descricao')."'

								WHERE   id_cargo   			= ".$Cargo->get('idCargo').";";

                    return $Banco->QueryThis($query);
                }
				
            
            /**********************************************
             * Métodos de Busca                           *
             **********************************************/

                public function BuscarCargo(&$Banco, $colunas, $statement){

                    $query = "SELECT ".$colunas." FROM tb_cargo ".$statement.";";
                    return $Banco->getThisQuery($query);
                    
                }
            
            /**********************************************
             * Método de Deletar                          *
             **********************************************/

			 
			 	public function DeletarCargo($idCargo, &$Banco) {

					$query = "DELETE FROM tb_cargo WHERE id_cargo = ".$idCargo.";";

					return $Banco->QueryThis($query);

					
				}

    }
?>