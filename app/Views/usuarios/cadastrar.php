<div class="col-xl-4 col-md-6 mx-auto p-5">
    <div class="card">
        <div class="card-header">
            Cadastre-se
        </div>
        <div class="card-body">
            <p class="card-text"><small class="text-muted">Preencha o formulário abaixo para fazer seu cadastro</small></p>

            <form action="<?= URL ?>/usuarios/cadastrar" name="cadastrar" method="POST">
                <div class="form-group">
                    <label for="nome">Nome: <sup class="text-danger">*</sup> </label>
                    <input type="text" class="form-control" name="nome" id="nome" value="<?= $dados['nome'] ?>">
                </div>
                <div class="form-group">
                    <label for="email">E-mail: <sup class="text-danger">*</sup> </label>
                    <input type="email" class="form-control" name="email" id="email" value="<?= $dados['email'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha: <sup class="text-danger">*</sup> </label>
                    <input type="password" class="form-control" name="senha" id="senha" value="<?= $dados['senha'] ?>"required>
                </div>
                <div class="form-group">
                    <label for="confirmar_senha">Confirme a senha: <sup class="text-danger">*</sup> </label>
                    <input type="password" class="form-control" name="confirmar_senha" id="confirmar_senha" value="<?= $dados['confirmar_senha'] ?>"required>
                </div>

                <div class="row">
                    <div class="col">
                        <input type="submit" value="Cadastrar" class="btn btn-info btn-block">
                    </div>
                    <div class="col">
                        <a href="#">Você tem uma conta? Faça o login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>