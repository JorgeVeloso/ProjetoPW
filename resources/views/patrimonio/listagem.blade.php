@extends('layout.principal')
@section('conteudo')

@if(empty($patrimonio))
<div class="alert alert-danger">
    <h3> Você não tem nenhum usuarios cadastrado. </h3>
</div>
@else

<h2>Bens Permanentes - Cadastrados</h2> <br>

<form method="get" action="/patrimonio/pesquisar">
    <div class="form-group col-lg-3">
        <input type="text" name="texto" class="form-control" placeholder="Pesquisar..." />
    </div>
    <select name="filtro" class="form-group">
        <option value="descricao">Nome</option>
        <option value="numeropatrimonio">Número Patrimônio</option>
        <!--<option value="marca">Marca</option>-->
        <option value="numeronotafiscal">Nota Fiscal</option>
        <option value="numeropantigo">Número Patrimônio Antigo</option>
        <option value="numeropregao">Número Pregão</option>
    </select>
    <button type="submit"
            <span class="btn-sm btn-success glyphicon glyphicon-search"></span>
    </button>
    @can('criar-global')
    <a href="{{action('PatrimonioController@prepararAdicionar')}}" class="btn-sm btn-success  glyphicon glyphicon-plus" > Novo <br/></a>
    @endcan
</form>



<div class="dropdown" style="margin-left: 86%">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ordenar por
        <span class="caret"></span></button>
    <ul class="dropdown-menu col-md-2 col-md-offset-2">
        <li><a href="{{action('PatrimonioController@ordemAlfabetica')}}">Nome</a></li>
        <li><a href="{{action('PatrimonioController@ordemNumeroPatrimonio')}}">Número Patrimônio</a></li>
    </ul>
</div>

<table class="tini table table table-hover table-striped table-bordered" id="patrimonio-table"  >
    <thead class="thead-inverse">
    <td><b>@lang('ID')</b></td>
    <td><b>@lang('Nome')</b></td>
    <td><b>@lang('Número Patrimônio')</b></td>
    <td><b>@lang('Marca')</b></td>
    
    <td class="col-lg-1 text-center"><b>@lang('Detalhes')</b></td>
    <td class="col-lg-1 text-center"><b>@lang('Editar')</b></td>
    <td class="col-lg-1 text-center"><b>@lang('Empréstimo/Devolução')</b></td>
    <td class="col-lg-1 text-center"><b>@lang('Descarte')</b></td>

</thead>

@foreach ($patrimonio as $p)
<tbody>
    <tr >
        <td> {{$p -> id}} </td>
        <td> {{$p -> descricao}}  </td>
        <td> {{$p -> numeropatrimonio}} </td>
        <td> {{$p -> marca -> descricao}}</td>
        
        <td class="text-center"> @can('visualizar-global')<a href="{{action('PatrimonioController@visualizar', $p->id)}}"><span class="glyphicon glyphicon-list-alt"></span></a> @endcan</td> 
        <td class="text-center"> @can('editar-global') <a href="{{action('PatrimonioController@editar', $p->id)}}"><span class="glyphicon glyphicon-pencil"></span></a> @endcan </td>
        @if($p->status->last()['descricao'] == 'Indisponível' or $p->status->last()['descricao'] == 'Em Manutenção')        
        <td class="text-center"> <a href="{{action('PatrimonioController@prepararDevolucao', $p->id)}}"><span class="glyphicon glyphicon-transfer"></span></a> </td>
        @else
        <td class="text-center"> <a href="{{action('PatrimonioController@prepararTransferir', $p->id)}}"><span class="glyphicon glyphicon-transfer"></span></a> </td>
        @endif       
        <td class="text-center"> @can('remover-global') <a onclick="return confirm('Você está prestes a descartar um Bem Permante. Deseja realmente fazer isto?')" href="{{action('PatrimonioController@prepararDescarte', $p->id)}}"> <span class="glyphicon glyphicon-trash"></span></a> @endcan</td>
        
    </tr>
    @endforeach
</tbody>
</table>
{{ $patrimonio->appends(Request::except('page'))->links() }}
<!--{{$patrimonio->links()}}-->
@endif

@if(old('descricao'))
<div class="alert alert-success">
    <strong>Sucesso !</strong>O {{ old('descricao')}} foi adicionado.
</div>
@endif

@stop
