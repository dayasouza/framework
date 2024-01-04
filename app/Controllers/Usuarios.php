<?php 

// Definição da classe Usuarios, que estende a classe Controller
class Usuarios extends Controller
{
    
    // Método para exibir a view de cadastro de usuários
    public function cadastrar()
    {
        // Obtém os dados do formulário usando filter_input_array e aplica a filtragem
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         // Verifica se o formulário foi submetido
        if (isset($formulario)) {
            // Cria um array associativo com os dados do formulário, removendo espaços em branco desnecessários
            $dados = [
                'nome' => trim($formulario['nome']),
                'email' => trim($formulario['email']),
                'senha' => trim($formulario['senha']),
                'confirmar_senha' => trim($formulario['confirmar_senha'])
            ];
            // Exibe os dados do formulário para fins de depuração
            var_dump($formulario);
        } else {
            // Se o formulário não foi submetido, inicializa o array de dados com valores vazios
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