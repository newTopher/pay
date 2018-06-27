@extends('front.layouts.master')

@section('content')


    <!-- page-intro start-->
<!-- ================ -->
<div class="page-intro">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><i class="fa fa-home pr-10"></i><a href="/">首页</a></li>
                    <li class="active">资金变动明细列表</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- page-intro end -->

<!-- main-container start -->
<!-- ================ -->
<section class="main-container">

    <div class="container">
        <div class="row">

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-md-12">

                <!-- page-title start -->
                <!-- ================ -->

                <!-- page-title end -->

                <!-- tabs start -->
                <div class="tabs-style-2">
                    <table class="table cart table-hover table-striped">
                        <thead>
                        <tr>
                            <th>变动原因及详情 </th>
                            <th>创建时间 </th>
                            <th>变动前余额 </th>
                            <th>变动后余额 </th>
                            <th class="amount">变动金额 </th>
                        </tr>
                        </thead>
                        @if($moneyList)
                        <tbody>
                            @foreach($moneyList as $key=>$val)
                                <tr class="order-data" id="{{$val->id}}">
                                    <td>{{\Illuminate\Support\Facades\Config::get('global.money_change_type')[$val->type]}}</td>
                                    <td>{{date("Y-m-d H:i:s",$val->ctime)}}</td>
                                    <td>{{number_format($val->before_money,2)}}</td>
                                    <td>{{number_format($val->after_money,2)}}</td>
                                    <td>{{number_format($val->money,2)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        @else
                            <tbody>
                            <tr><td colspan="5">暂无订单数据</td></tr>
                            </tbody>
                        @endif
                    </table>
                    <!-- pagination start -->
                    {!! $moneyList->links() !!}
                    <!-- pagination end -->
                </div>
            </div>
            <!-- main end -->
        </div>
    </div>
</section>

@stop