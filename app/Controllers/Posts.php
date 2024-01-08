<?php 
class Posts extends Controller
{
    public function __construct()
    {
        if (!Sessao::usuarioLogado()) {
            URL::redirecionar('usuarios/login');
        }
    }
    public function index()
    {
        $this-> view('posts/index');
    }
}
?>