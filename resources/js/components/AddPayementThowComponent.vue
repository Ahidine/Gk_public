<template>
	<div>
		<div class="row justify-content-center"  v-for="r in rows" >
			<div class="col-sm-12">
				<h5 class="info-text"> Info de paiement </h5>
			</div>
			<div class="col-sm-7">
				<div class="form-group">
					<label>Montant</label>
					<input type="text" name="montant[]" class="form-control">
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<select class="browser-default custom-select" name="devise[]" data-size="" data-style="select-with-transition" title="Devise">
						<option >Devise !</option>
						<option value="€"> € </option>
						<option value="$"> $ </option>
						<option value="DH"> DH </option>
					</select>
				</div>
			</div>
			<div class="col-sm-10">
				<div class="form-group">
					<label>date de paiement</label>
					<input type="date" name="date_paiment[]" class="form-control">
				</div>
			</div>
			<div class="col-sm-5">
				<div class="form-group">
					<select class="browser-default custom-select" name="chance[]" data-size="" data-style="select-with-transition" title="Paquet">
						<option selected>Paquet</option>
						<option value="3"> 3 Modules</option>
						<option value="2"> 2 Modules </option>
						<option value="1"> 1 Modules </option>
					</select>
				</div>
			</div>

			<div class="col-sm-5">
				<div class="form-group">
					<select class="browser-default custom-select" name="mode_paiement[]" data-size="" data-style="select-with-transition" title="Mode de Paiment">
						<option selected>Mode de Paiement</option>
						<option value="Espece"> Espece </option>
						<option value="Cheque"> Cheque </option>
						<option value="Virement"> Virement </option>
					</select>
				</div>
			</div>
		</div>
		<div class="text-center">
			<a type="button"  class="btn btn-sm btn-primary " v-on:click="AddRow()">Add row
				<i class="material-icons">add</i>
			</a>

		</div>
	</div>


</template>
<script >
export default {
	data()
	{
		return {
			rows :[
			{},
			],

		}
	},
	mounted() {
		//console.log('here'+this.rows.length)
	},
	methods:
	{

		AddRow() {
			this.rows.push({})

			//console.log(this.rows)


		},
		RemoveRow(index) {
			this.rows.splice(this.rows.indexOf(index),1)
		},
	}
}

</script>


<template>
	<div>
		<div class="row justify-content-center"  v-for="r in rows" >
			<div class="col-sm-12">
				<h5 class="info-text"> Info de paiement </h5>
			</div>

			<div class="col-sm-12">
				<div class="form-group">
					<label class="col-sm-5"> chosissez la modalite : </label>
					<select class="col-sm-5 browser-default custom-select" name="chance[]" data-size="" data-style="select-with-transition" title="Modalite">
						<option selected>Modalite</option>
						<option value="1"> Par Module</option>
						<option value="2"> Par Annee </option>
					</select>
				</div>
			</div>
			<div>
				<table class="table table-striped table-no-bordered table-hover" id="datatables" >

					<thead class="text-primary">
						<tr> 
							<th>Module</th>
							<th>Montant</th>
							<th>Mode de paiement </th>
							<th>Date de paiement</th>

						</tr>
					</thead>
					<tbody>
						<tr v-for="r in length">
							<td> {{ r }} </td>
							<td class="row"> 
								<div class="col-sm-4">
								<input type="text" name="montant[]" :value="200" class="form-control"> 
								</div>
								<div class="col-sm-4">
								<select class="browser-default custom-select" name="devise[]" data-size="" data-style="select-with-transition" title="Devise">
									<option >Devise !</option>
									<option value="€" selected> € </option>
									<option value="$"> $ </option>
									<option value="DH"> DH </option>
								</select>
							</div>
							</td>

							<td>
								<select class="browser-default custom-select" name="mode_paiement[]" data-size="" data-style="select-with-transition" title="Mode de Paiment">
									<option selected>Mode de Paiement</option>
									<option value="Espece"> Cheque </option>
									<option value="Cheque"> Cheque </option>
									<option value="Virement"> Virement </option>
								</select>
							</td>
							<td> </td>
						</tr>

					</tbody>
				</table>
			</div>
		</div>

	</div>


</template>
<script >
export default {
	data()
	{
		return {
			rows :[
			{},
			],
			length :[1,2,3],

		}
	},
	mounted() {
		console.log(this.length)
		console.log('here'+this.rows.length)
	},
	methods:
	{

		AddRow() {
			this.rows.push({})

			console.log(this.rows)


		},
		RemoveRow(index) {
			this.rows.splice(this.rows.indexOf(index),1)
		},
	}
}

</script>