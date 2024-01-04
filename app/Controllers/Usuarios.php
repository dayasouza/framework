<?php 

// Definição da classe Usuarios, que estende a classe Controller
class Usuarios extends Controller
{
    
    // Método para exibir a view de cadastro de usuários
    public function cadastrar()
    {
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) {
            $dados = [
                'nome' => trim($formulario['nome']),
                'email' => trim($formulario['email']),
                'senha' => trim($formulario['senha']),
                'confirmar_senha' => trim($formulario['confirmar_senha'])
            ];
            var_dump($formulario);
        } else {
            $dados = [
                'nome' => '',
                'email' => '',
                'senha' => '',
                'confirmar_senha' => ''
            ];
        }
        // Chama o método 'view' da classe pai (Controller) para exibir a view 'usuarios/cadastrar'
        $this-> view('usuarios/cadastrar', $dados);
    }
}
?>