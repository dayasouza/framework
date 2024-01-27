<?php
class Posts extends Controller
{
    private $postModel;
    private $usuarioModel;

    public function __construct()
    {
        if (!Sessao::usuarioLogado()) {
            URL::redirecionar('usuarios/login');
        }

        $this->postModel = $this->model('Post');
        $this->usuarioModel = $this->model('Usuario');
    }
    public function index()
    {
        $dados = [
            'posts' => $this->postModel->exibirPosts()
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

    public function editar($id)
    {

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) :
            $dados = [
                'id' => $id,
                'titulo' => trim($formulario['titulo']),
                'texto' => trim($formulario['texto']),
                'titulo_erro' => '',
                'texto_erro' => '',


            ];

            if (in_array("", $formulario)) :

                if (empty($formulario['titulo'])) :
                    $dados['titulo_erro'] = 'Preencha o campo titulo';
                endif;

                if (empty($formulario['texto'])) :
                    $dados['texto_erro'] = 'Preencha o campo texto';
                endif;
            else :

                if ($this->postModel->atualizar($dados)) {
                    Sessao::mensagem('post', 'Post editado com sucesso');
                    URL::redirecionar('posts');
                } else {
                    die("Erro editar post");
                }

            endif;
        else :

            $post = $this->postModel->exibirPostPorId($id);

            if ($post->usuario_id != $_SESSION['usuario_id']) {
                Sessao::mensagem('post', 'Você não tem autorização para editar esse post', 'alert alert-danger');
                URL::redirecionar('posts');
            }

            $dados = [
                'id' => $post->id,
                'titulo' => $post->titulo,
                'texto' => $post->texto,
                'titulo_erro' => '',
                'texto_erro' => ''
            ];

        endif;

        var_dump($formulario);

        $this->view('posts/editar', $dados);
    }


    public function ver($id)
    {
        $post = $this->postModel->exibirPostPorId($id);
        $usuario = $this->usuarioModel->exibirUsuarioPorId($post->usuario_id);
        $dados = [
            'post' => $post,
            'usuario' => $usuario
        ];

        $this->view('posts/ver', $dados);
    }

    public function deletar($id)
    {
        if (!$this->checarAutorizacao($id)) {
            $id = filter_var($id, FILTER_VALIDATE_INT);
            $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);

            if ($id && $metodo == 'POST') {
                if ($this->postModel->destruir($id)) {
                    Sessao::mensagem('post', 'post deletado com sucesso!');
                    URL::redirecionar('posts');
                }
            } else {
                Sessao::mensagem('post', 'Você não tem autorização para deletar esse post', 'alert alert-danger');
                URL::redirecionar('posts');
            }
        } else {
            Sessao::mensagem('post', 'Você não tem autorização para deletar esse post', 'alert alert-danger');
            URL::redirecionar('posts');
        }
           
    }

    private function checarAutorizacao($id)
    {
        $post = $this-> postModel -> exibirPostPorId($id);

        if ($post -> usuario_id != $_SESSION['usuario_id']) {
            return true;
        } else {
            return false;
        }
    }
}
