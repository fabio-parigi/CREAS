<?php

    /**********************************************
     * Include Modelos de Banco de Dados          *
     **********************************************/

        //include_once '../modelo/PermissoesPaginasSchema.php';

    /**********************************************
     * Permissoes-Pagina-Query-Methods            *
     **********************************************/

    class PermissoesPaginasQM {

        /**********************************************
         * Construtor da classe                       *
         **********************************************/
                    
            public function PermissoesPaginasQM() {
                
            }

        /**********************************************
         * Funcionalidades ligadas ao Banco de Dados  *
         **********************************************/

            /**********************************************
             * Métodos de Adicionar                       *
             **********************************************/

           /*     public function AdicionarUsuario(&$usuario, &$Banco) {
                    
                    $chave = $this->EncriptaSenha($usuario->get('senha'));

                    $query = "  INSERT INTO usuario (idUsuario, login, senha) 
                                VALUES (NULL, '".$usuario->get('login')."', '".$chave.")";

                    return $Banco->QueryThis($query);
                }
			*/
            /**********************************************
             * Método de Alterar                          *
             **********************************************/

          /*  public function DeletarUsuario($idUsuario, &$Banco) {

                $query = "DELETE FROM usuario WHERE idUsuario = ".$idUsuario."";

                return $Banco->QueryThis($query);
            }
		*/
            /**********************************************
             * Métodos de Busca                           *
             **********************************************/

             /*  public function BuscarUsuario(&$Banco, $colunas, $statement){

                    $query = "SELECT ".$colunas." FROM usuario ".$statement.";";
                    return $Banco->getThisQuery($query);
                    
                }
             */
			 
				public function ListarPermissoesPaginasUsuarios(&$Banco, $colunas, $statement){

                    $query = "SELECT ".$colunas." FROM tb_permissao ".$statement.";";
                    return $Banco->getThisQuery($query);
                }    
				
				public function ListarPaginas(&$Banco, $colunas, $statement){

                    $query = "SELECT ".$colunas." FROM tb_paginas ".$statement.";";
                    return $Banco->getThisQuery($query);
                }    
				 
				public function ListarSubitensPaginasUsuarios(&$Banco, $colunas, $statement){

					$query = "SELECT ".$colunas." FROM tb_paginas_subitens ".$statement.";";
                    return $Banco->getThisQuery($query);
				}
				 
				public function BuscarPermissaoSub(&$Banco, $colunas, $statement){

					$query = "SELECT ".$colunas." FROM tb_permissao_sub ".$statement.";";
                    return $Banco->getThisQuery($query);
				}

               
				
            /**********************************************
             * Método de Deletar                          *
             **********************************************/

              /*  public function AlterarUsuario(&$usuario, &$Banco) {
                    
        			$chave = $this->EncriptaSenha($usuario->get('senha'));

                    $query = "  UPDATE  usuario
                                SET     login           = '".$usuario->get('login')."', 
                                        senha           = '".$chave."'
                                                 
                                WHERE   idUsuario       = ".$usuario->get('idUsuario').";";

                    return $Banco->QueryThis($query);
                }
			  */

            



    }
?>