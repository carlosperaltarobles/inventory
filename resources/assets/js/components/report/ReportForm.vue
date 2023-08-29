<template>
	<div class="row">

		<div class="col-md-4">
			<div class="input-group">
				<div class="form-line">
					<select class="form-control select2" name="type" required="" v-model="report_type" v-select="report_type">
						<option :value="''">Elegir tipo de informe *</option>
						<option :value="'stock'">Informe de existencias</option>
						<option :value="'sell'">Informe de ventas</option>
						<option :value="'profit'">Informe de beneficios</option>
						<option :value="'due'">Informe de pagos pendientes</option>
						<option :value="'invoice'">Informe de facturación</option>
					</select>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="input-group">
				<div class="form-line">
					<vuejs-datepicker :required="true" :placeholder="'Fecha inicial *'" :name="'start_date'"
						:input-class="'form-control'"></vuejs-datepicker>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="input-group">
				<div class="form-line">
					<vuejs-datepicker :required="true" :placeholder="'Fecha final *'" :name="'end_date'"
						:input-class="'form-control'"></vuejs-datepicker>
				</div>
			</div>
		</div>


		<div class="col-md-4" v-if="!isEnable">
			<div class="input-group">
				<div class="form-line">
					<select class="form-control select2" name="category_id" v-model="category_id" v-select="category_id"
						v-on:change="findProduct">
						<option value="">Elegir categoria (opcional)</option>
						<option v-for="value in category" :value="value.id">{{ value.name }}</option>
					</select>
				</div>
			</div>
		</div>

		<div class="col-md-4" v-if="!isEnable">
			<div class="input-group">
				<div class="form-line">
					<select class="form-control select2" name="product_id" v-model="product_id" v-select="product_id"
						v-on:change="findStock">
						<option value="">Elegir producto (opcional)</option>
						<option v-for="pr in product" :value="pr.id">{{ pr.product_name }}</option>
					</select>
				</div>
			</div>
		</div>


		<div class="col-md-4" v-if="!isEnable">
			<div class="input-group">
				<div class="form-line">
					<select class="form-control select2" name="stock_id" v-model="chalan_id" v-select="chalan_id">
						<option value="">Elegir Comprobante (opcional)</option>
						<option v-for="ch in chalan" :value="ch.id">{{ ch.chalan_no }}</option>
					</select>
				</div>
			</div>
		</div>

		<div class="col-md-4" v-if="!isEnable">
			<div class="input-group">
				<div class="form-line">
					<select class="form-control select2" name="vendor_id">
						<option value="">Elegir Proveedor (opcional)</option>
						<option v-for="vn in vendor" :value="vn.id">{{ vn.name }}</option>
					</select>
				</div>
			</div>
		</div>


		<div class="col-md-4">
			<div class="input-group">
				<div class="form-line">
					<select class="form-control select2" name="customer_id">
						<option value="">Cliente (opcional)</option>
						<option v-for="cs in customer" :value="cs.id">{{ cs.customer_name }}</option>
					</select>
				</div>
			</div>
		</div>


		<div class="col-md-4">
			<div class="input-group">
				<div class="form-line">
					<select class="form-control select2" name="user_id">
						<option value="">Elegir existencias / vendedores (opcional)</option>
						<option v-for="us in user" :value="us.id">{{ us.name }}</option>
					</select>
				</div>
			</div>
		</div>


	</div>
</template>


<script>

import { EventBus } from '../../vue-asset';
import Datepicker from 'vuejs-datepicker';
import mixin from '../../mixin.js';

export default {
	props: ['category', 'user', 'customer', 'vendor'],
	components: {

		'vuejs-datepicker': Datepicker,

	},
	mixins: [mixin],

	data() {

		return {

			report_type: '',
			category_id: '',
			product_id: '',
			chalan_id: '',

			product: [],
			chalan: [],



		}

	},

	methods: {

		findProduct() {
			this.product = [];
			axios.get(base_url + 'category/product/' + this.category_id)
				.then(response => {

					this.product = response.data;

				})
		},


		findStock() {

			this.chalan = [];
			axios.get(base_url + 'chalan-list/chalan/' + this.product_id)
				.then(response => {

					this.chalan = response.data;

				})



		},



	},

	computed: {
		isEnable() {
			return this.report_type === 'invoice' || this.report_type === 'due';

		}
	}

}

</script>