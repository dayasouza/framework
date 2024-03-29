<div class="col-md-8 mx-auto p-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL ?>/posts">Posts</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header bg-secondary text-white">
            Editar Post
        </div>

        <div class="card-body bg-light">

            <form name="cadastrar" method="POST" action="<?= URL ?>/posts/editar/<?= $dados['id'] ?>" class="mt-4">
                <div class="form-group">
                    <label for="titulo">Titulo: <sup class="text-danger">*</sup></label>
                    <input type="text" name="titulo" id="titulo" value="<?= $dados['titulo'] ?>" class="form-control   <?= $dados['titulo_erro'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $dados['titulo_erro'] ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="texto">Texto: <sup class="text-danger">*</sup></label>
                    <textarea name="texto" id="texto" cols="30" rows="5" class="form-control <?= $dados['texto_erro'] ? 'is-invalid' : '' ?>"><?= $dados['texto'] ?></textarea>
                    <div class="invalid-feedback">
                        <?= $dados['texto_erro'] ?>
                    </div>
                </div>

                <input type="submit" value="Editar Post" class="btn btn-success btn-block">

            </form>
        </div>
    </div>
</div>