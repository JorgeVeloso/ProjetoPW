@extends('layout.principal')
@section('conteudo')

@if(empty($departamentos))
<div class="alert alert-danger">
    Você não tem nenhum Departamento cadastrado.
</div>
@else

<h1>Departamentos Cadastrados</h1>

<table class="tini table table table-hover table-striped table-bordered" id="marca-table"  >
    <thead class = "thead-inverse" >
    <td>ID</td>
    <td>Departamento</td>
    <td class="text-center">  Editar</td>
</thead>

</thead>
 
@foreach ($departamentos as $d)
<tbody>
    <tr >
        <td> {{$d -> id}} </td>
        <td> {{$d-> departamento}}  </td>
        <td class="text-center"> <a href="{{action('DepartamentoController@muda', $d->id)}}"><span class="glyphicon glyphicon-pencil"></span></a> </td>
              </tr>
    @endforeach
</tbody>
</table>

@endif

@if(old('descricao'))
<div class="alert alert-success">
    <strong>Sucesso !</strong>O {{ old('departamento')}} foi adicionado.
</div>
@endif



@stop

