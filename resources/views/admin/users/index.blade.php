@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de usuários</h3>
            {!! Button::primary('Novo usuário')->asLinkTo(route('admin.users.create')) !!}
        </div>
        <div class="row">
            {!!
                Table::withContents($users->items())
            !!}
        </div>

        {!! $users->links() !!}
    </div>
@endsection