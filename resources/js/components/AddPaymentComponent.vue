<template>
	<div>
		<div class="row justify-content-center"  v-for="r in rows" >

			<div class="col-sm-12">
				<div class="form-group">
					<label class="col-sm-5"> chosissez la modalite : </label>
					<select class="col-sm-5 browser-default custom-select" name="modalite" data-size="" data-style="select-with-transition" title="Modalite" @change="modalite($event.target.value)" required >
						<option selected hidden value>Modalite</option>
						<option value="Module"> Par Module</option>
						<option value="Annee"> Par Année </option>
					</select>
				</div>
			</div>
			<div class="col-sm-12"  v-if="ParTranche">
				<div class="form-group">
					<label class="col-sm-5"> Combien de tranche  : </label>
					<select class="col-sm-5 browser-default custom-select"  data-size="" data-style="select-with-transition" title="Modalite" @change="makeTranche($event.target.value)" required>
						<option selected hidden value>Tranche</option>
						<option v-for="index in 9" :key="index" :value="index"> {{index}}</option>
					</select>
				</div>
			</div>

			<div v-if="ParModule">
				<table class="table table-striped table-no-bordered table-hover" id="datatables" >

					<thead class="text-primary">
						<tr> 
							<th>Module</th>
							<th  class="text-center">Montant A Payer</th>
							<th>Mode de paiement </th>
							<th  class="text-center">Date</th>
							<th> Paye</th>

						</tr>
					</thead>
					<tbody>
						<tr v-for="r in length">
							<td> {{ r }} </td>
							<td> 
								<div :class="'form-group'">
									<div class="col-auto">
										<div class="input-group mb-2">
											<input type="number" class="form-control" 
											:value="r==1 ? (Math.round(prix/3)+100) : Math.round(prix/3)" name="montant[]" id="inlineFormInputGroup" placeholder="Montant">
											<div class="input-group-prepend">
												<div class="input-group-text">€</div>
											</div>

										</div>
										<span v-if="r==1" class="text-info">inclus les frais du frouniture(Les livres)</span>
									</div>
								</div>
							</td>

							<td :class="'form-group'">
								<select class="browser-default custom-select" name="mode_paiement[]" data-size="" data-style="select-with-transition" title="Mode de Paiment" required>
									<option value="None" selected >None</option>
									<option value="Espece"> Espèce </option>
									<option value="Par carte"> Par carte </option>
									<option value="Virement"> Virement </option>
								</select>
							</td>
							<td :class="'form-group'"><input type="date" class="form-control" name="date_reg[]" required> </td>
							<td>
								<div class="form-check">
									<label class="form-check-label" id="check">
										<input class="form-check-input" type="checkbox" :value="r" name="etat[]">
										<span class="form-check-sign">
											<span class="check"></span>
										</span>
									</label>
								</div>
							</td>
						</tr>

					</tbody>
				</table>
			</div>
			<div v-if="ParAnnee">
				<table class="table table-striped table-no-bordered table-hover" id="datatables" >

					<thead class="text-primary">
						<tr> 
							<th>Tranche</th>
							<th class="text-center">Montant</th>
							<th>Mode de paiement</th>
							<th  class="text-center">Date</th>
							<th>Payé</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="r in tranche" >
							<td> {{ r }} </td>
							<td> 
								<div :class="'form-group'">
									<div class="col-auto">
										<div class="input-group mb-2">
											<input type="number" class="form-control" name="montant[]" :value="Math.round(prix/(tranche.length))"  id="inlineFormInputGroup" placeholder="Montant">
											<div class="input-group-prepend">
												<div class="input-group-text">€</div>
											</div>

										</div>
									</div>
								</div>
								
							</td>

							<td class="form-group">
								<select class="browser-default custom-select " name="mode_paiement[]" data-size="" data-style="select-with-transition" title="Mode de Paiment" required>
									<option value="None" selected >None</option>
									<option value="Espece"> Espece </option>
									<option value="Cheque"> Par carte </option>
									<option value="Virement"> Virement </option>
								</select>
							</td>
							<td class="form-group"><input type="date" class="form-control" name="date_reg[]" required> </td>
							<td>
								<div class="form-check">
									<label class="form-check-label">
										<input class="form-check-input" type="checkbox"   name="etat[]" :value="r" :id="r">
										<span class="form-check-sign">
											<span class="check"></span>
										</span>
									</label>
								</div>
							</td>
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
			ParTranche : false,
			tranche : [],
			tranches :'',
			check:'',
			prix:'',
			test:false,
			ParModule:false,
			ParAnnee :false,
		}
	},
	mounted() {
		//console.log(this.length)
		//console.log('here'+this.rows.length)
		this.validation('#myforme');

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
		modalite(e)
		{

			//console.log(e)
			if (e=='Module') {
				this.ParModule=true
				this.ParAnnee=false
				this.ParTranche=false
			}
			else if (e=='Annee') 
			{
				this.ParModule=false
				this.ParTranche=true				
			}
			axios.get('/getSessionNiveau')
			.then(({data})=>{
				this.prix=data
				//console.log('prix :' + data)

			})
		},
		setChck(v,id)
		{
			this.test=$('#'+id).val()
			//console.log(this.test)
			if (this.test=='0') {
				//console.log('hola')
				$( "#"+id ).val('1');
			}
			else
			{
				$( "#"+id ).val('0');
			}
			
			
		},
		makeTranche(e)
		{
			this.tranche=[]
			for (var i = 1; i <= e; i++) {
				this.tranche.push(i)
			}
			this.ParAnnee=true
		},
		validation(id)
		{
			$(id).validate({
				highlight: function(element) {
					$(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
					$(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
				},
				success: function(element) {
					$(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
					$(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
				},
				errorPlacement: function(error, element) {
					$(element).closest('.form-group').append(error);
				},
			});
		}

	}
}
</script>
