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

            if (empty($formulario['nome'])) :
                $dados['nome_erro'] = 'Preencha o campo nome';
            endif;

            if (empty($formulario['email'])) :
                $dados['email_erro'] = 'Preencha o campo e-mail';
            endif;

            if (empty($formulario['senha'])) :
                $dados['senha_erro'] = 'Preencha o campo senha';
            elseif (strlen($formulario['senha']) < 6) :
                $dados['senha_erro'] = 'A senha deve ter no minimo 6 caracteres';
            endif;

            if (empty($formulario['confirmar_senha'])) :
                $dados['confirmar_senha_erro'] = 'Confirme a Senha';
            elseif (strlen($formulario['confirmar_senha']) < 6) :
                    $dados['confirmar_senha_erro'] = 'A senha deve ter no minimo 6 caracteres';
            else:
                if($formulario['senha'] != $formulario['confirmar_senha']):
                    $dados['confirmar_senha_erro'] = 'As senhas são diferentes';
                endif;
            endif;

            if(!in_array("", $formulario)):
                echo 'Pode realizar o cadastro';
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
