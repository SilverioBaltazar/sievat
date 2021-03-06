@extends('sicinar.principal')

@section('title','Ver Programación de diligencias')

@section('links')
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('nombre')
    {{$nombre}}
@endsection

@section('usuario')
    {{$usuario}}
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Agenda de diligencias
                <small> Seleccionar para editar o programar nueva diligencia</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Menú</a></li>
                <li><a href="#">Agenda de diligencias </a></li>
                <li><a href="#">Programar diligencia  </a></li>         
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">

                        <div class="box-header" style="text-align:right;">
                            
                            {{ Form::open(['route' => 'buscarProgdil', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
                                <div class="form-group"> Periodo
                                    <!--{{ Form::text('fper', null, ['class' => 'form-control', 'placeholder' => 'Periodo','maxlength' => '10']) }}
                                    {!! Form::label('fper','IAP') !!} -->
                                    <!--<option value=""> --Seleccionar periodo-- </option> -->
                                    <select class="form-control m-bot15" name="fper" id="fper" class="form-control">
                                        <option value=""> </option> 
                                        @foreach($regperiodos as $periodo)
                                            <option value="{{$periodo->periodo_id}}">{{trim($periodo->periodo_desc)}}</option>
                                        @endforeach   
                                    </select>
                                </div>
                                <div class="form-group">Mes
                                    <!--{{ Form::text('fmes', null, ['class' => 'form-control', 'placeholder' => 'Mes','maxlength' => '10']) }}  -->
                                    <!--<option value=""> --Seleccionar periodo-- </option> -->
                                    <select class="form-control m-bot15" name="fmes" id="fmes" class="form-control">
                                        <option value=""> </option> 
                                        @foreach($regmeses as $mes)
                                            <option value="{{$mes->mes_id}}">{{trim($mes->mes_desc)}}</option>
                                        @endforeach   
                                    </select>
                                </div>                                
                                <div class="form-group">OSC
                                    <!--{{ Form::text('fosc', null, ['class' => 'form-control', 'placeholder' => 'IAP','maxlength' => '10']) }}-->
                                    <select class="form-control m-bot15" name="fiap" id="fiap" class="form-control">
                                        <option value=""> </option>
                                        @foreach($regosc as $osc)
                                            <option value="{{$osc->osc_id}}">{{substr($osc->osc_desc,1,20)}}</option>
                                        @endforeach   
                                    </select>
                                </div>
                                <!--
                                <div class="form-group">
                                    {{ Form::text('bio', null, ['class' => 'form-control', 'placeholder' => 'Concepto']) }}
                                </div>
                                -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">
                                    <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </div>
                                <div class="form-group">                           
                                   <a href="{{route('nuevoProgdil')}}"   class="btn btn-primary btn_xs" title="Programar  diligencia"><i class="fa fa-file-new-o"></i><span class="glyphicon glyphicon-plus"></span>Programar diligencia</a>
                                </div>                                
                            {{ Form::close() }} 
                        </div>

                        <div class="box-body">
                            <table id="tabla1" class="table table-hover table-striped">
                                <thead style="color: brown;" class="justify">
                                    <tr>
                                        <th style="text-align:center; vertical-align: middle;">Id.<br>Sistema</th>
                                        <th style="text-align:center; vertical-align: middle;">Oficio     </th>                                        
                                        <th style="text-align:center; vertical-align: middle;">Año        </th>
                                        <th style="text-align:center; vertical-align: middle;">Mes        </th>
                                        <th style="text-align:center; vertical-align: middle;">Día        </th>
                                        <th style="text-align:center; vertical-align: middle;">Hora       </th>

                                        <th style="text-align:left;   vertical-align: middle;">OSC        </th>
                                        <th style="text-align:left;   vertical-align: middle;">Domicilio  </th>
                                        <th style="text-align:left;   vertical-align: middle;">Objetivo   </th>                                        
                                        <th style="text-align:center; vertical-align: middle;">Edo.       </th>
                                        
                                        <th style="text-align:center; vertical-align: middle; width:100px;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($regprogdil as $program)
                                    <tr>
                                        <td style="font-size:10px; text-align:left; vertical-align: middle;">
                                            {{$program->visita_folio}}    
                                        </td>
                                        <td style="font-size:10px; text-align:left; vertical-align: middle;">
                                            {{$program->visita_oficio}}    
                                        </td>                                        
                                        <td style="font-size:10px; text-align:left; vertical-align: middle;">{{$program->periodo_id}}
                                        </td> 
                                        <td style="font-size:10px; text-align:center; vertical-align: middle;">  
                                            @foreach($regmeses as $mes)
                                                @if($mes->mes_id == $program->mes_id)
                                                    {{$mes->mes_desc}}
                                                    @break
                                                @endif
                                            @endforeach 
                                        </td>                    
                                        <td style="font-size:10px; text-align:center; vertical-align: middle;">
                                            @foreach($regdias as $dia)
                                                @if($dia->dia_id == $program->dia_id)
                                                    {{$dia->dia_desc}}
                                                    @break
                                                @endif
                                            @endforeach 
                                        </td>
                                        <td style="font-size:10px; text-align:center; vertical-align: middle;">
                                            @foreach($reghoras as $hora)
                                                @if($hora->hora_id == $program->hora_id)
                                                    {{$hora->hora_desc}}
                                                    @break
                                                @endif
                                            @endforeach 
                                        </td>

                                        <td style="font-size:10px; text-align:left; vertical-align: middle;">   
                                            @foreach($regosc as $osc)
                                                @if($osc->osc_id == $program->osc_id)
                                                    {{$osc->osc_desc}}
                                                    @break
                                                @endif
                                            @endforeach
                                        </td>                                        
                                        <td style="font-size:10px; text-align:left; vertical-align: middle;">{{Trim($program->visita_dom)}}</td>
                                        
                                        <td style="font-size:08px; text-align:left; vertical-align: middle;">
                                            {{Trim($program->visita_obj).' '.Trim($program->visita_obs3)}}
                                        </td>
                                        @switch($program->visita_edo)
                                        @case(0)  <!-- amarillo -->
                                            <td style="text-align:center;">
                                                 <img src="{{ asset('images/semaforo_amarillo.jpg') }}" width="15px" height="15px" title="En proceso" style="text-align:center;margin-right: 15px;vertical-align: middle;"/> 
                                            </td>
                                            @break
                                        @case(1)  <!-- cerrada -->
                                            <td style="text-align:center;">
                                                <img src="{{ asset('images/semaforo_verde.jpg') }}" width="15px" height="15px" title="Cerrada" style="text-align:center;margin-right: 15px;vertical-align: middle;"/>    
                                            </td>
                                            @break
                                        @case(2)
                                            <td style="text-align:center;">
                                                <img src="{{ asset('images/semaforo_rojo.jpg') }}" width="15px" height="15px" title="Cancelada" style="text-align:center;margin-right: 15px;vertical-align: middle;"/>
                                            </td>
                                            @break 
                                        @default 
                                            <td style="text-align:center;"> 
                                                <img src="{{ asset('images/semaforo_rojo.jpg') }}" width="15px" height="15px" title="Cancelada" style="text-align:center;margin-right: 15px;vertical-align: middle;"/> 
                                            </td>                                                                                  
                                        @endswitch
                                        
                                        <td style="text-align:center;">
                                            <a href="{{route('editarProgdil',$program->visita_folio)}}" class="btn badge-warning" title="Editar registro"><i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{route('borrarProgdil',$program->visita_folio)}}" class="btn badge-danger" title="Borrar registro de la agenda" onclick="return confirm('¿Seguro que desea borrar el registro de la agenda de diligencias programadas?')"><i class="fa fa-times"></i>
                                            </a>
                                            <a href="{{route('mandamientoPDF',$program->visita_folio)}}" class="btn btn-danger" title="Mandamiento escrito en formato PDF"><i class="fa fa-file-pdf-o"></i><small>PDF</small>
                                            </a>
                                        </td>                                                                          
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $regprogdil->appends(request()->input())->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('request')
@endsection

@section('javascrpt')
@endsection