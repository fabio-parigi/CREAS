<?php

    /**********************************************
     * Include Modelos de Banco de Dados          *
     **********************************************/

        include_once '../modelo/UsuarioSchema.php';

    /**********************************************
     * U.Q.M. = UserQueryMethods                  *
     **********************************************/

    class UQM {

        /**********************************************
         * Construtor da classe                       *
         **********************************************/
                    
            public function UQM() {
                
            }

        /**********************************************
         * Funcionalidades ligadas ao Banco de Dados  *
         **********************************************/

            /**********************************************
             * Métodos de Adicionar                       *
             **********************************************/

                public function AdicionarUsuario(&$usuario, &$Banco) {
                    
                    $chave = $this->EncriptaSenha($usuario->get('senha'));

                    $query = "  INSERT INTO tb_usuario (id_usuario, login, senha) 
                                VALUES (NULL, '".$usuario->get('login')."', '".$chave.")";

                    return $Banco->QueryThis($query);
                }

            /**********************************************
             * Método de Alterar                          *
             **********************************************/

            public function DeletarUsuario($idUsuario, &$Banco) {

                $query = "DELETE FROM tb_usuario WHERE id_usuario = ".$idUsuario."";

                return $Banco->QueryThis($query);
            }

            /**********************************************
             * Métodos de Busca                           *
             **********************************************/

                public function BuscarUsuario(&$Banco, $colunas, $statement){

                    $query = "SELECT ".$colunas." FROM tb_usuario ".$statement.";";
                    return $Banco->getThisQuery($query);
                    
                }
            
            /**********************************************
             * Método de Deletar                          *
             **********************************************/

                public function AlterarUsuario(&$usuario, &$Banco) {
                    
        			$chave = $this->EncriptaSenha($usuario->get('senha'));

                    $query = "  UPDATE  tb_usuario
                                SET     login           = '".$usuario->get('login')."', 
                                        senha           = '".$chave."'
                                                 
                                WHERE   id_usuario       = ".$usuario->get('idUsuario').";";

                    return $Banco->QueryThis($query);
                }

                public function AlterarUsuarioSSenha(&$usuario, &$Banco) {

                    $query = "  UPDATE  tb_usuario
                                SET     login           = '".$usuario->get('login')."'
                                        
                                WHERE   id_usuario       = ".$usuario->get('idUsuario').";";

                    return $Banco->QueryThis($query);
                }
            
            /**********************************************
             * Alternativos                               *
             **********************************************/

                public function EncriptaSenha($Senha){

                    $chave = md5("zX5@#asdko2".$Senha."a2$!CSad^1W\E");
                    $chave = md5("a2$!CSad^1W\E".$chave."zX5@#asdko2");
                    $chave = md5($chave."C#4v3!0K4");
                    $chave = md5($chave);

                    return $chave;
                }
            
                public function AutenticaUsuario(&$usuario, &$Banco) {

                    $chave = $this->EncriptaSenha($usuario->get('senha'));
                    
                    $query = "SELECT * FROM tb_usuario WHERE login ='".$usuario->get('login')."'AND senha ='".$chave."';";
                    
                    $resultado = $Banco->getThisQuery($query); // fetch assoc é como se fosse um dataset no C#

                    if($linha = $resultado->fetch_assoc()){
                        
                        $usuario->set('idUsuario', $linha['id_usuario']);
                        $usuario->set('privilegio', $linha['privilegio']);

                        $resultado->close();

                        return TRUE;

                    }else if($resultado->num_rows == 0){

                        $resultado->close();
                        
                        return FALSE;

                    }else{

                        throw new Exception("Dados inconsistentes. Usuários iguais.", 1);

                    }
                }
    }
?>