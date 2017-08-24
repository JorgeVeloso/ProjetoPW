@extends('layout.principal')
@section('conteudo')

<h1>Editar</h1>

@if(count($errors)>0)
<div class="alert alert-danger">
    <ul>@foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach</ul>
        
    </div>
@endif
<form  action="atualizar" method="post">
<fieldset>

<!-- Form Name -->

 <input type="hidden"
    name="_token" value="{{ csrf_token() }}" />

     <input type="hidden"
    name="id" value="{{$predio->id}}" />

<div class="container-fluid">
    <section class="container">
    <div class="container-page">        
      <div class="col-md-6">
         <div class="form-group col-lg-12">
          <label>@lang('Descrição')</label>
          <input type="text" name="descricao" class="form-control" id="" value="{{$predio->descricao}}">
        </div>
        <button type="submit" class="btn-inverse btn-large btn-block">Editar</button>
      </div>
      </div>
    
     
    </div>
  </section>
</div>


</form>

@stop


 