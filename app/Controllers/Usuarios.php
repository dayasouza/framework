<?php 

// Definição da classe Usuarios, que estende a classe Controller
class Usuarios extends Controller
{
    
    // Método para exibir a view de cadastro de usuários
    public function cadastrar()
    {
        // Chama o método 'view' da classe pai (Controller) para exibir a view 'usuarios/cadastrar'
        $this-> view('usuarios/cadastrar');
    }
}
?>