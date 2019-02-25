@extends('layouts.app')

@section('content')

<?php 

$ciudades = App\Ciudades::all();

?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">ciudades</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/app/ciudades/create">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="nombre" class="col-md-4 control-label">Nombre Ciudad</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required autofocus>

                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

                <div class="panel-body">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <td>Ciudad</td>
                                <td>Departamento</td>
                                <td>Pais</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $ciudades as $ciudad )
                            <tr>
                                <td>{{ $ciudad }}</td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
