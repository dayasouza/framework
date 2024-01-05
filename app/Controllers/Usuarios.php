<?php

class Usuarios extends Controller
{

    public function cadastrar()
    {

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) :
            $dados = [
                'nome' => trim($formulario['nome']),
                'email' => trim($formulario['email']),
                'senha' => trim($formulario['senha']),
                'confirmar_senha' => trim($formulario['confirmar_senha']),
                'nome_erro' => '',
                'email_erro' => '',
                'senha_erro' => '',
                'confirmar_senha_erro' => ''
            ];

            if (in_array("", $formulario)) :

                if (empty($formulario['nome'])) :
                    $dados['nome_erro'] = 'Preencha o campo nome';
                endif;

                if (empty($formulario['email'])) :
                    $dados['email_erro'] = 'Preencha o campo e-mail';
                endif;

                if (empty($formulario['senha'])) :
                    $dados['senha_erro'] = 'Preencha o campo senha';
                endif;

                if (empty($formulario['confirma_senha'])) :
                    $dados['confirmar_senha_erro'] = 'Confirme a Senha';
                endif;
            else :
                if (strlen($formulario['senha']) < 6) :
                    $dados['senha_erro'] = 'A senha deve ter no minimo 6 caracteres';

                elseif ($formulario['senha'] != $formulario['confirmar_senha']) :
                    $dados['confirmar_senha_erro'] = 'As senhas são diferentes';

                elseif (strlen($formulario['confirmar_senha']) <6):
                    $dados['confirmar_senha_erro'] = 'A senha deve ter no minimo 6 caracteres';

                elseif (!preg_match('/^[A-Za-zÀ-ú\s]+$/', $formulario['nome'])) :
                    $dados['nome_erro'] = 'O campo nome não deve conter números';

                elseif(!filter_var ($formulario['email'], FILTER_VALIDATE_EMAIL)):
                    $dados['email_erro'] = 'Digite um endereço de e-mail válido';

                else:
                    echo 'Pode cadastrar os dados<hr>';
                endif;

            endif;

            var_dump($formulario);
        else :
            $dados = [
                'nome' => '',
                'email' => '',
                'senha' => '',
                'confirmar_senha' => '',
                'nome_erro' => '',
                'email_erro' => '',
                'senha_erro' => '',
                'confirmar_senha_erro' => ''
            ];

        endif;


        $this->view('usuarios/cadastrar', $dados);
    }
}
