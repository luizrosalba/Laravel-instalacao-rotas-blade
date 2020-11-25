@extends('layout.base')

@section('titulo', 'Cadastro de usuario')

@section ('conteudo')
    <form action="{{route('salvar')}}" method="post">
        {{csrf_field()}}
        
        <div class="field">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" />
            @if($errors->has('nome'))
                @foreach($errors->get('nome') as $erro)
                    <strong class="erro">{{$erro}}</strong>
                @endforeach
            @endif
        </div>
        <div class="field">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" />
            @if($errors->has('email'))
                @foreach($errors->get('email') as $erro)
                    <strong class="erro">{{$erro}}</strong>
                @endforeach
            @endif
        </div>

        <div class="field">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" />
            @if($errors->has('senha'))
                @foreach($errors->get('senha') as $erro)
                    <strong class="erro">{{$erro}}</strong>
                @endforeach
            @endif

        </div>

        <div class="btn">
            <button type="submit">Submeter</button>
        </div>

    </form>
@endsection