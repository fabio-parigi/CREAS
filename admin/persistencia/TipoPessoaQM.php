<?php

    /**********************************************
     * Include Modelos de Banco de Dados          *
     **********************************************/

        include_once '../modelo/TipoPessoaSchema.php';

    /**********************************************
     * U.Q.M. = UserQueryMethods                  *
     **********************************************/

    class TipoPessoaQM {

        /**********************************************
         * Construtor da classe                       *
         **********************************************/
                    
            public function TipoPessoaQM() {
                
            }

        /**********************************************
         * Funcionalidades ligadas ao Banco de Dados  *
         **********************************************/

            /**********************************************
             * Métodos de Adicionar                       *
             **********************************************/

			
                public function AdicionarTipoPessoa(&$NovoTipo, &$Banco) {
                    
                    $query = "INSERT INTO tb_tipo_pessoa(id_tipo_pessoa, nome_tipo_pessoa) VALUES (NULL,'".$NovoTipo->get('nomeTipoPessoa')."')";

                    return $Banco->QueryThis($query);
                }

	        /**********************************************
	 		 * Método de Deletar						  *
	 		 **********************************************/
			 		
				public function DeletarTipoPessoa($idTipoPessoa, &$Banco) {

					$query = "DELETE FROM tb_tipo_pessoa WHERE id_tipo_pessoa = ".$idTipoPessoa.";";

					return $Banco->QueryThis($query);
				}
			
	
            /**********************************************
             * Método de Alterar                          *
             **********************************************/
			
                public function AlterarTipoPessoa(&$tipoPessoa, &$Banco){

                    $query = "UPDATE  tb_tipo_pessoa
                                SET     nome_tipo_pessoa	= '".$tipoPessoa->get('nomeTipoPessoa')."'
                                        
                                WHERE   id_tipo_pessoa   	= ".$tipoPessoa->get('idTipoPessoa').";";

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
			
				
			    public function BuscarTipoPessoa(&$Banco, $colunas, $statement){

                    $query = "SELECT ".$colunas." FROM tb_tipo_pessoa ".$statement.";";
                    return $Banco->getThisQuery($query);
                    
                }
				

				
            /**********************************************
             * Método de Deletar                          *
             **********************************************/
			/*
                public function AlterarUsuario(&$usuario, &$Banco) {
                    
        			$chave = $this->EncriptaSenha($usuario->get('senha'));

                    $query = "  UPDATE  usuario
                                SET     login           = '".$usuario->get('login')."', 
                                        senha           = '".$chave."'
                                                 
                                WHERE   idUsuario       = ".$usuario->get('idUsuario').";";

                    return $Banco->QueryThis($query);
                }

                public function AlterarUsuarioSSenha(&$usuario, &$Banco) {

                    $query = "  UPDATE  usuario
                                SET     login           = '".$usuario->get('login')."'
                                        
                                WHERE   idUsuario       = ".$usuario->get('idUsuario').";";

                    return $Banco->QueryThis($query);
                }
            */
            
    }
?>