<!DOCTYPE html>
<html>

<head>

    <title>Nova Receita</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

    <h2>Nova Receita</h2>

    <form method="POST" action="/receitas">

        @csrf

        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control">
        </div>

        <div class="mb-3">
            <label>Descrição</label>
            <textarea name="descricao" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Data</label>
            <input type="date" name="data_registro" class="form-control">
        </div>

        <div class="mb-3">
            <label>Custo</label>
            <input type="number" step="0.01" name="custo" class="form-control">
        </div>

        <div class="mb-3">
            <label>Tipo</label>
            <input type="text" name="tipo_receita" class="form-control">
        </div>

        <button class="btn btn-success">
            Salvar
        </button>

        <a href="/receitas" class="btn btn-secondary">
            Voltar
        </a>

    </form>

</div>

</body>
</html>