<?php

class Usuarios extends Controller
{
    private $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = $this-> model('Usuario');
    }

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

                elseif (Valida::validarNome($formulario['nome'])):
                    $dados['nome_erro'] = 'O nome informado é invalido';

                elseif (Valida::validarEmail($formulario['email'])) :
                    $dados['email_erro'] = 'O e-mail informado é invalido';

                elseif($this->usuarioModel-> validarEmail($formulario['email'])):
                    $dados['email_erro'] = 'O e-mail informado já está cadastrado';

                else:
                    $dados['senha'] = password_hash($formulario['senha'], PASSWORD_DEFAULT);

                    if ($this->usuarioModel-> inserir($dados)) :
                        Sessao::mensagem('usuario', 'Cadastro realizado com sucesso');
                    else :
                        die("Erro ao armazenar usuario no banco de dados");
                    endif;
                endif;

            endif;

            
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

    public function login()
    {

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) :
            $dados = [
                'email' => trim($formulario['email']),
                'senha' => trim($formulario['senha']),
                'email_erro' => '',
                'senha_erro' => ''
            ];

            if (in_array("", $formulario)) :

                if (empty($formulario['email'])) :
                    $dados['email_erro'] = 'Preencha o campo e-mail';
                endif;

                if (empty($formulario['senha'])) :
                    $dados['senha_erro'] = 'Preencha o campo senha';
                endif;

            else :
                if (Valida::validarEmail($formulario['email'])) :
                    $dados['email_erro'] = 'O e-mail informado é invalido';
                else :
                   
                    $usuario = $this->usuarioModel->validarLogin($formulario['email'], $formulario['senha']);

                    if($usuario): 

                        $this-> criarSessaoUsuario($usuario);
                    else:
                        Sessao::mensagem('usuario', 'Usuario ou senha invalidos', 'alert alert-danger');
                    endif;

                endif;

            endif;

            var_dump($formulario);
        else :
            $dados = [
                'email' => '',
                'senha' => '',
                'email_erro' => '',
                'senha_erro' => ''
            ];

        endif;


        $this->view('usuarios/login', $dados);
    }

    private function criarSessaoUsuario($usuario)
    {
        $_SESSION['usuario_id'] = $usuario -> id;
        $_SESSION['usuario_nome'] = $usuario -> nome;
        $_SESSION['usuario_email'] = $usuario -> email;

    }

    public function sair()
    {
        unset($_SESSION['usuario_id']);
        unset($_SESSION['usuario_nome']);
        unset($_SESSION['usuario_email']);

        session_destroy();

        header('Location: ' . URL . '');
    }
}
