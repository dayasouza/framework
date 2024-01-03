<?php 
class Paginas extends Controller {

    public function index(){
        $dados = [
            'tituloPagina' => 'Página Inicial'
        ];
        // Chama a view e envia os dados para ela.
        $this->view('paginas/home', $dados);
    }

    public function sobre(){
        $dados = [
            'titulo' => 'Página Sobre nos'
        ];
        // Chama a view e envia os dados para ela.
        $this->view('paginas/sobre', $dados);
    }
}
