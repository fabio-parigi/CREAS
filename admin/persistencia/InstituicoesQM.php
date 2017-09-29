<?php

    /**********************************************
     * Include Modelos de Banco de Dados          *
     **********************************************/

        include_once '../modelo/InstituicaoSchema.php';
		

    /**********************************************
     * Q.M. = QueryMethods                 		  *
     **********************************************/

    class InstituicoesQM {

        /**********************************************
         * Construtor da classe                       *
         **********************************************/
                    
            public function InstituicoesQM() {
                
            }

        /**********************************************
         * Funcionalidades ligadas ao Banco de Dados  *
         **********************************************/

            /**********************************************
             * Métodos de Adicionar                       *
             **********************************************/

                public function AdicionarInstituicao(&$Novo, &$Banco) {
                    
                    $query = "  INSERT INTO tb_instituicao (id_instituicao, nome_instituicao, municipio, jurisdicao,uf) 
                                VALUES (NULL, '".$Novo->get('nome')."','".$Novo->get('municipio')."','".$Novo->get('jurisdicao')."','".$Novo->get('uf')."')";

                    return $Banco->QueryThis($query);
                }

            /**********************************************
             * Método de Alterar                          *
             **********************************************/

               public function AlterarInstituicao(&$Instituicao, &$Banco){

                    $query = "UPDATE  tb_instituicao
                                SET     nome_instituicao	= '".$Instituicao->get('nome')."',
										municipio	 		= '".$Instituicao->get('municipio')."',
										jurisdicao	 		= '".$Instituicao->get('jurisdicao')."',
										UF	 				= '".$Instituicao->get('uf')."'
                                        
                                WHERE   id_instituicao   	= ".$Instituicao->get('id');

                    return $Banco->QueryThis($query);
                }
            
            /**********************************************
             * Métodos de Busca                           *
             **********************************************/

                public function BuscarInstituicoes(&$Banco, $colunas, $statement){

                    $query = "SELECT ".$colunas." FROM tb_instituicao ".$statement.";";
                    return $Banco->getThisQuery($query);
                    
                }
            
            /**********************************************
             * Método de Deletar                          *
             **********************************************/

			 
			 	public function DeletarInstituicao($idInstituicao, &$Banco) {

					$query = "DELETE FROM tb_setor WHERE id_instituicao = ".$idInstituicao.";";

					if($Banco->QueryThis($query)){
						$query = "DELETE FROM tb_instituicao WHERE id_instituicao = ".$idInstituicao.";";
						
					return $Banco->QueryThis($query);
					}else
						return FALSE;

					
				}

    }
?>