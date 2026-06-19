<!DOCTYPE html>
<html>

<head>

    <title>Editar Receita</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

    <h2>Editar Receita</h2>

    <form method="POST" action="/receitas/{{ $receita->id }}">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nome</label>
            <input
                type="text"
                name="nome"
                value="{{ $receita->nome }}"
                class="form-control">
        </div>

        <div class="mb-3">
            <label>Descrição</label>
            <textarea
                name="descricao"
                class="form-control">{{ $receita->descricao }}</textarea>
        </div>

        <div class="mb-3">
            <label>Data</label>
            <input
                type="date"
                name="data_registro"
                value="{{ $receita->data_registro }}"
                class="form-control">
        </div>

        <div class="mb-3">
            <label>Custo</label>
            <input
                type="number"
                step="0.01"
                name="custo"
                value="{{ $receita->custo }}"
                class="form-control">
        </div>

        <div class="mb-3">
            <label>Tipo</label>
            <input
                type="text"
                name="tipo_receita"
                value="{{ $receita->tipo_receita }}"
                class="form-control">
        </div>

        <button class="btn btn-primary">
            Atualizar
        </button>

        <a href="/receitas" class="btn btn-secondary">
            Voltar
        </a>

    </form>

</div>

</body>
</html>