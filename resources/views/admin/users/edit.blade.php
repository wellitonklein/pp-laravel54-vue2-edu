@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar usuário</h3>
            {!!
                form($form->add('edit','submit', [
                    'attr' => ['class' => 'btn btn-primary btn-block'],
                    'label' => Icon::create('floppy-disk')
                ]))
             !!}
        </div>
    </div>
@endsection