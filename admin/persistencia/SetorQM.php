<?php

    /**********************************************
     * Include Modelos de Banco de Dados          *
     **********************************************/

        include_once '../modelo/SetorSchema.php';
		

    /**********************************************
     * Q.M. = QueryMethods                 		  *
     **********************************************/

    class SetorQM {

        /**********************************************
         * Construtor da classe                       *
         **********************************************/
                    
            public function SetorQM() {
                
            }

        /**********************************************
         * Funcionalidades ligadas ao Banco de Dados  *
         **********************************************/

            /**********************************************
             * Métodos de Adicionar                       *
             **********************************************/

                public function AdicionarSetor(&$Novo, &$Banco) {
                    
                    $query = "  INSERT INTO tb_setor (id_setor, nome, id_instituicao) 
                                VALUES (NULL, '".$Novo->get('nome')."','".$Novo->get('instituicao')."');";

                    return $Banco->QueryThis($query);
                }

            /**********************************************
             * Método de Alterar                          *
             **********************************************/

               public function AlterarSetor(&$Setor, &$Banco){

                    $query = "UPDATE  tb_setor
                                SET     nome				= '".$Setor->get('nome')."',
										id_instituicao	 	=  ".$Setor->get('instituicao')."

								WHERE   id_setor   			= ".$Setor->get('id');

                    return $Banco->QueryThis($query);
                }
            
            /**********************************************
             * Métodos de Busca                           *
             **********************************************/

                public function BuscarSetor(&$Banco, $colunas, $statement){

                    $query = "SELECT ".$colunas." FROM tb_setor ".$statement.";";
                    return $Banco->getThisQuery($query);
                    
                }
            
            /**********************************************
             * Método de Deletar                          *
             **********************************************/

			 
			 	public function DeletarSetor($idSetor, &$Banco) {

					$query = "DELETE FROM tb_setor WHERE id_setor = ".$idSetor.";";

					return $Banco->QueryThis($query);

					
				}

    }
?>