<?php

    /**********************************************
     * Include Modelos de Banco de Dados          *
     **********************************************/

       // include_once '../modelo/PessoaSchema.php';

    /**********************************************
     * U.Q.M. = UserQueryMethods                  *
     **********************************************/

    class PessoaQM {

        /**********************************************
         * Construtor da classe                       *
         **********************************************/
                    
            public function PessoaQM() {
                
            }

        /**********************************************
         * Funcionalidades ligadas ao Banco de Dados  *
         **********************************************/

            /**********************************************
             * Métodos de Adicionar                       *
             **********************************************/

			
                public function AdicionarPessoa(&$NovaPessoa, &$Banco) {
                    
                   // $query = "INSERT INTO tb_pessoa(id_tipo_pessoa, nome_tipo_pessoa) VALUES (NULL,'".$NovoTipo->get('nomeTipoPessoa')."')";
					$query=" ";
                    return $Banco->QueryThis($query);
                }

	        /**********************************************
	 		 * Método de Deletar						  *
	 		 **********************************************/
			 		
				public function DeletarPessoa($idPessoa, &$Banco) {

					$query = "DELETE FROM tb_pessoa WHERE id_tipo_pessoa = ".$idPessoa.";";

					return $Banco->QueryThis($query);
				}
			
	
            /**********************************************
             * Método de Alterar                          *
             **********************************************/
			
                public function AlterarPessoa(&$Pessoa, &$Banco){

                  //  $query = "UPDATE  tb_tipo_pessoa
                       //         SET     nome_tipo_pessoa	= '".$tipoPessoa->get('nomeTipoPessoa')."'
                        //                
                        //        WHERE   id_tipo_pessoa   	= ".$tipoPessoa->get('idTipoPessoa').";";
					$query=" ";
                    return $Banco->QueryThis($query);
                }
            
			
            /**********************************************
             * Métodos de Busca                           *
             **********************************************/
			/*
                public function BuscarUsuario(&$Banco, $colunas, $statement){

                    $query = "SELECT ".$colunas." FROM usuario ".$statement.";";
                    return $Banco->getThisQuery($query);
                    
                }
            */
			
				
			    public function BuscarPessoa(&$Banco, $colunas, $statement){

                    $query = "SELECT ".$colunas." FROM tb_pessoa ".$statement.";";
                    return $Banco->getThisQuery($query);
                    
                }
				

            
    }
?>