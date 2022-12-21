@extends('layouts._admin.base')

@section('content')

    <article>
    <div id="page_control">
    	<div class="col2">

        </div>
        <div class="col1">
          <a href="{{url('dnradmin/sales-rep')}}"> Sales Rep</a> &raquo;
        	Commission
        </div>

    </div>

   <h2><?=date('Y')?> Year to Date Commissions: ${{ number_format($cart{1}['TotalCommission'],2) }}</h2>

    <br style="clear:both;" />

    {!! Form::open(array('url' => '/dnradmin/sales-rep/', 'method' => 'post', 'id' => 'pageform', 'files' => true)) !!}


    <table id="page_manager">
      <thead>
        <tr class="headers">
          <th width="250" data-sort="int"> <span class="id">Month</span> </div> </th>
          <th width="250" data-sort="string"><span class="id">User Account</span></th>
          <th width="250" data-sort="string"><span class="id">Items Sold</span> </th>
          <th width="250" data-sort="string"><span class="id">Sales</span> </th>
          <th width="250" data-sort="string"><span class="id">Commission</span></th>
        </tr>
      </thead>

      <tbody id="Searchresult">
             @foreach($cart as $carts)
                        <tr>
                           <td>{{$carts['month']}}</td>
                           <td>{{$carts['userAccount']}}</td>
                           <td>{{$carts['iTemsSold']}}</td>
                           <td>${{number_format($carts['Sales'], 2)}}</td>
                           <td>${{number_format($carts['Commission'], 2)}}</td>
                        </tr>
             @endforeach

      </tbody>

    </table>


     {!! Form::close() !!}
  </article>


@stop

@section('headercodes')
  {!! Html::style('_admin/assets/css/pagination.css') !!}
@stop

@section('extracodes')


    {!! Html::script('_admin/assets/js/cufon_avantgarde.js') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js') !!}


@stop
