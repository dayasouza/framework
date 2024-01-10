<div class="container py-5">
    <?= Sessao::mensagem('post') ?>
    <div class="card">
        <div class="card-header bg-info text-white">
            POSTAGENS
            <div class="float-right">
                <a href="<?= URL ?>/posts/cadastrar" class="btn btn-light">Escrever</a>
            </div>
        </div>
        <div class="card-body">
            <?php foreach ($dados['posts'] as $post) { ?>
                <div class="card my-2">
                    <div class="card-header">
                        <?= $post->titulo ?>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?= $post->texto ?></p>
                        <a href="#" class="btn btn-primary float-right">Ler mais</a>
                    </div>
                    <div class="card-footer text-muted">
                        Escrito por: <?= $post->nome ?> em <?= date('d/m/Y H:i', strtotime($post-> dataPost)) ?>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</div>