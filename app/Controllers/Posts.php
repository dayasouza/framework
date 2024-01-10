<?php
class Posts extends Controller
{
    private $postModel;

    public function __construct()
    {
        if (!Sessao::usuarioLogado()) {
            URL::redirecionar('usuarios/login');
        }

        $this->postModel = $this->model('Post');
    }
    public function index()
    {
        $dados = [
            'posts' => $this-> postModel -> exibirPosts()
        ];
        $this->view('posts/index', $dados);
    }

    public function cadastrar()
    {

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) :
            $dados = [
                'titulo' => trim($formulario['titulo']),
                'texto' => trim($formulario['texto']),
                'titulo_erro' => '',
                'texto_erro' => '',
                'usuario_id' => $_SESSION['usuario_id']
                
            ];

            if (in_array("", $formulario)) :

                if (empty($formulario['titulo'])) :
                    $dados['titulo_erro'] = 'Preencha o campo titulo';
                endif;

                if (empty($formulario['texto'])) :
                    $dados['texto_erro'] = 'Preencha o campo texto';
                endif;
            else :

                if ($this->postModel->inserir($dados)) {
                    Sessao::mensagem('post', 'Post realizado com sucesso');
                    URL::redirecionar('posts');
                } else {
                    die("Erro publicar post");
                }

            endif;


        else :
            $dados = [
                'titulo' => '',
                'texto' => '',
                'titulo_erro' => '',
                'texto_erro' => '',
                'usuario_id' => '',
                'usuario_id_erro' => ''
            ];

        endif;


        $this->view('posts/cadastrar', $dados);
    }
}
