<template>

	<div>
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group">

					<select id="model_select" style="display:inline-block" name="pays" data-style="select-with-transition" class="browser-default custom-select"  title=""  @change="onChange($event.target.value)"  required>
						<option value="" selected hidden>Selectionnez le pays</option>
						<option v-for="o in country" :value="o.id" >{{o.nom}}</option>						
					</select>

					<a class="btn btn-success btn-link add" data-toggle="modal" data-target="#addModulePays" > 
						<i class="material-icons"> add</i>
						Ajouter un nouveau pays
					</a>


				</div>
			</div>


			<div class="col-sm-4" v-if="villes.length">
				<div class="form-group">
					<select id="ville"  style="display:inline-block" name="ville" class="browser-default custom-select" data-style="select-with-transition" title="" data-size="100" @change="onChangeVille($event.target.value)" required>
						<option value="noneville" selected hidden>Selectionnez la ville</option>

						<option  v-for="v in villes" :value="v.id">{{ v.nom }}</option>
						


					</select>

					<a class="btn btn-success btn-link add" data-toggle="modal" data-target="#addModuleVille" > 
						<i class="material-icons"> add</i>
						Ajouter une nouvelle ville
					</a>
				</div>
			</div>
			<div class="col-sm-4" v-if="centres.length">
				<div class="form-group">
					<select  style="display:inline-block" name="centre" class="browser-default custom-select" data-style="select-with-transition" title="" id="centres" data-size="100" 
					@change="onChangeCentres($event.target.value)" required>
					<option value="noneCentre"  selected hidden>Selectionnez le Centre</option>

					<option  v-for="c in centres" :value="c.id">{{ c.nom }}</option>



				</select>
			</div>
		</div>
		<div class="col-sm-offset-2 col-sm-4" v-if="niveaux.length">
			<div class="form-group">
				<select  style="display:inline-block" name="niveau[]" class="browser-default custom-select" data-style="select-with-transition" title="" id="niveau" data-size="100" @change="onChangeNiveau($event.target.value)" required>
					<option value="noneNiveau"  selected hidden>Selectionnez le Niveau</option>

					<option  v-for="n in niveaux" :value="n.id">{{ n.type }}</option>



				</select>
			</div>
		</div>
		<div class="col-sm-4" v-if="groupes.length">
			<div class="form-group">
				<select  style="display:inline-block"  class="browser-default custom-select" data-style="select-with-transition" title="" id="groupe" data-size="100" @change="onChangeGroupe($event.target.value)" required>
					<option value="noneGroupe"  selected hidden>Selectionner le groupe</option>

					<option  v-for="g in groupes" :value="g.id">{{ g.nom_groupe }}</option>



				</select>
			</div>
		</div>

	</div>

	

	<div class="row">
		<div class="col-md-12 ">
			<div class="table-responsive container" >
				<table id="datatables" class="table table-striped">
					<thead>
						<tr>
							<th width="20%" >Groupe</th>
							<th width="20%" >Jour</th>
							<th width="20%" >Du </th>
							<th width="20%" > A </th>
							<th width="10%" > Salle </th>
							<th width="10%" > Action </th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="c in cible" >
							<td width="20%"><input type="hidden" :value="c.id" name="groupes[]">{{c.nom_groupe}} </td>
							<td width="20%">

								<select style="display:block" name="jours[]" class="browser-default custom-select" data-style="select-with-transition" title="" data-size="100" required>
									<option  selected hidden>jours</option> 
									<option v-for="d in days" :value="d.id">{{d.jour}}</option>                 
								</select>

							</td>
							<td width="20%"> <input type="time" class="form-control timepicker"  name="heureD[]" required> </td>
							<td width="20%"> <input type="time" class="form-control timepicker"  name="heureF[]" required> </td>
							<td width="10%"> 
								<select style="display:block" name="salles[]" class="browser-default custom-select" data-style="select-with-transition" title="" data-size="100" required>
									<option  selected hidden>Salle !</option>  
									<option v-for="s in salles" :value="s.id">{{s.num}}-{{s.capacite}}</option>                 
								</select>
								<td width="10%"> X </td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>


			<div class="modal fade" id="addModuleVille" tabindex="-1" role="">
				<div class="modal-dialog modal-login" role="document">
					<div class="modal-content">
						<div class="card card-signup card-plain">
							<div class="modal-header">
								<div class="card-header card-header-primary text-center">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										<i class="material-icons">clear</i>
									</button>

									<h4 class="card-title">Ajouter une Ville</h4>
								</div>
							</div>
							<form class="form" method="post" @submit.prevent="submitVille">
								<div class="modal-body">

									<div class="card-body">
										<div class="form-group bmd-form-group">
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text"><i class="material-icons">book</i></div>
												</div>
												<input type="text" v-model="formVille.ville" class="form-control" placeholder="Nom de la ville ">
											</div>
										</div>


									</div>

								</div>
								<div class="modal-footer justify-content-center">
									<input type="submit" value="Add"  class="btn btn-primary btn-link btn-wd btn-lg"> 
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>		

		</div>
		<div class="modal fade" id="addModulePays" tabindex="-1" role="">
			<div class="modal-dialog modal-login" role="document">
				<div class="modal-content">
					<div class="card card-signup card-plain">
						<div class="modal-header">
							<div class="card-header card-header-primary text-center">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
									<i class="material-icons">clear</i>
								</button>

								<h4 class="card-title">Ajouter un nouveau pays</h4>
							</div>
						</div>
						<form class="form" method="post" @submit.prevent="submitPays">
							<div class="modal-body">

								<div class="card-body">

									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">book</i></div>
											</div>
											<input type="text" v-model="formPays.pays" class="form-control" placeholder="Nom du pays">
										</div>
									</div>
									<div class="form-group bmd-form-group">
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">book</i></div>
											</div>
											<input type="text" v-model="formPays.ville" class="form-control" placeholder="Nom de la ville ">
										</div>
									</div>


								</div>

							</div>
							<div class="modal-footer justify-content-center">
								<input type="submit" value="Add"  class="btn btn-primary btn-link btn-wd btn-lg"> 
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>	
	</div>

</template>
<script >
export default {
	props: ['jours','Salles'],
	data()
	{
		return {
			villes : {},
			country : {},
			centres :{},
			niveaux : {},
			groupes :{},
			cible : [],
			salles :this.Salles,
			days:this.jours,
			c:'',
			formPays: {
				pays: '',
				ville:'',		        			
			},
			formVille: {
				ville:'',
				pays_id:'',		        			
			},
			errorsPays: {},
			errorsVile: {},

		}
	},
	mounted() {
		axios.get('/getPays')
		.then(({data})=>{
			this.country = data
		})
	},
	methods:
	{

		onChange(e) {
			axios.get('/getVilles/'+e)
			.then(({data})=>{
				$("#ville").val("noneville");
				villes : {}
				centres :{}
				this.villes = data
				this.formVille.pays_id=e;
				

			})
		},
		onChangeVille(e) {
			axios.get('/getCentresByVille/'+e)
			.then(({data})=>{
				$("#centres").val("noneCentre");
				centres : {}
				this.centres= data			
				//console.log(this.centres)	

			})
		},
		onChangeCentres(e) {
			axios.get('/getNiveau/'+e)
			.then(({data})=>{
				$("#niveau").val("noneNiveau");
				niveaux : {}
				this.cible.shift()
				this.c=e
				this.niveaux= data
				//console.log(this.niveaux)		
			})		
		},
		onChangeNiveau(e) {
			axios.get('/getGroupeByThowID/'+this.c+'/'+e)
			.then(({data})=>{
				$("#groupe").val("noneGroupe");
				groupes: {}
				this.groupes = data	
				//console.log(this.data)	

			})		
		},
		onChangeGroupe(e) {
			axios.get('/getGroupe/'+e)
			.then(({data})=>{
				$("#groupe").val("noneGroupe");
				this.cible.push(data)	
				this.groupes.shift(data.id)		
				//console.log(this.data)	

			})		
		},
		submitPays() {
			axios.post('/pays',this.formPays)
			.then(({data})=>{
				//console.log(data)
				// window.location.reload()
				this.country.push(data)
				this.formPays = {}
				this.errorsPays={}
				$('#addModulePays').modal('hide')
			})
			.catch(error => {
				this.errorsPays=error.response.data.errors
			})
		},
		submitVille() {
			axios.post('/ville',this.formVille)
			.then(({data})=>{
				this.villes.push(data)
				this.formVille.ville =''
				this.errorsVile={}
				$('#addModuleVille').modal('hide')
			})
			.catch(error => {
				this.errorsVile=error.response.data.errors
			})
		},
	}
}

</script>