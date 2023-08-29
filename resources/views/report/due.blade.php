@extends('include.master')


@section('title','Inventory | Due-Report')


@section('page-title','Due Report')


@section('content')




<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					
					Informe de pagos pendientes
					
				</h2>

			<h2 class="pull-right">
					
			<a href="{{ url('print-report') }}?type={{ $type }}&start_date={{ $start_date }}&end_date={{ $end_date }}&category_id={{ $category_id }}&product_id={{ $product_id }}&stock_id={{ $stock_id }}&vendor_id={{ $vendor_id }}&customer_id={{ $customer_id }}&user_id={{ $user_id }}" target="_blank" type="button" class="btn bg-teal btn-circle waves-effect waves-circle waves-float">
                               <i class="material-icons">print</i>
                                     </a>
					
			</h2>
			</div>


			<div class="body">

				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<td colspan="4" style="border: none !important;">
									<h3 style="text-align: center;">{{ $company->name }}</h3>
								</td>

							</tr>		

							<tr style="border: none !important;">
								<td colspan="4" style="border: none !important;">
									<p style="text-align: center;">{{ $company->address }} <br>
										 {{ $company->phone }}</p></td>

							</tr>  			

							<tr style="border: none !important;">
								<td colspan="4" style="border: none !important;"><p style="text-align: center;font-weight: bold;">Due Report from {{ date('j M Y',strtotime($start_date)) }} To {{ date('j M Y',strtotime($end_date)) }}</p></td>

							</tr>
							<tr>
								
								<th>Cliente</th>
								<th>Importe total</th>
								<th>Importe pagado</th>
								<th>Importe debido</th>
							</tr>
						</thead>
						

						<tbody>
							<?php
							$total_amount = 0;
							$total_paid  = 0;
							$total_discount  = 0;
							?>
							@foreach($data as $value)

							<?php 
							$total_amount += $value->total_amount;
							$total_paid += $value->paid_amount;
							?>
							<tr>

								<td>{{ $value->customer->customer_name }}</td>
								<td>{{ '$ '.round($value->total_amount,2)}}</td>
								<td>{{ '$ '.round($value->paid_amount,2) }}</td>
								<td>{{'$ '.round(($value->total_amount - $value->paid_amount),2) }}</td>
							</tr>
							@endforeach

							<tr>
								<th  style="text-align: right;">Total =</th>
								<th >{{ '$ '.round($total_amount,2) }}</th>
								<th >{{ '$ '.round($total_paid,2) }}</th>
								<th >{{ '$ '.round($total_amount-$total_paid,2) }}</th>
							</tr>

							
						</tbody>
					</table>
				</div>
				

			</div>


		</div>
	</div>
</div>




@endsection

