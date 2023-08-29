<!DOCTYPE html>
<html>
<head>
	<title>Informe de pagos pendientes</title>
	<link href="{{ url('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
</head>
<body>
   <div class="container">
   	 <div class="row">
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
   <script type="text/javascript">
   	 window.print();
   </script>
</body>
</html>