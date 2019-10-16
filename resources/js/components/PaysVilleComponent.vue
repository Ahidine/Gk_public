<template>
	<div>
		<!--div class="row">
			<label class="col-sm-2 col-form-label">Pays</label>
			<div class="col-sm-10">
				<div class="form-group">

					<select id="model_select" style="display:inline-block" name="pays" data-style="select-with-transition" class="browser-default custom-select"  title=""  @change="onChange($event.target.value)"  required>
						<option value="" selected hidden>Selectionner le pays</option>
						<option v-for="o in country" :value="o.id" >{{o.nom}}</option>
						
					</select>

					<a class="btn btn-success btn-link add" data-toggle="modal" data-target="#addModulePays" > 
						<i class="material-icons"> add</i>
						Ajouter un nouveau pays
					</a>


				</div>
			</div>
		</div-->
		<div class="row" v-if="villes.length">
			<label class="col-sm-2 col-form-label">Ville</label>
			<div class="col-sm-10">
				<div class="form-group">
					<select  style="display:inline-block" name="ville" class="browser-default custom-select" data-style="select-with-transition" title="" data-size="100" required>
						<option value="" selected hidden>Selectionner la ville</option>

						<option  v-for="v in villes" :value="v.id">{{ v.nom }}</option>
						


					</select>

					<a class="btn btn-success btn-link add" data-toggle="modal" data-target="#addModuleVille" > 
						<i class="material-icons"> add</i>
						Ajouter une nouvelle ville
					</a>
				</div>
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

								<h4 class="card-title">Ajouter une nouvelle ville</h4>
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

</template>
<script >
export default {
	data()
	{
		return {
			villes : {},
			country : {},
			formPays: {
        	   		pays: '',
        	   		ville:'',		        			
        			},
			formVille: {
        	   		ville:'',
        	   		pays:'Belgique',		        			
        			},
        	errorsPays: {},
        	errorsVile: {},

		}
	},
	mounted() {
		axios.get('/getVilleBelgique')
		.then(({data})=>{
			this.villes = data
			
			
		})
	},
	methods:
	{
		test() {
			//console.log('testtestetst')
		},
	/*	onChange(e) {
			axios.get('/getVilles/'+e)
			.then(({data})=>{
				villes : {}
				this.villes = data
				this.formVille.pays_id=e;
				

			})
		},
		submitPays() {
			axios.post('/pays',this.formPays)
			.then(({data})=>{
				console.log(data)
				// window.location.reload()
				this.country.push(data)
				this.formPays = {}
				this.errorsPays={}
			$('#addModulePays').modal('hide')
			})
			.catch(error => {
				this.errorsPays=error.response.data.errors
			})
		},*/
		submitVille() {
			axios.post('/ville',this.formVille)
			.then(({data})=>{
				this.villes.push(data)
				this.formVille.ville =''
				this.errorsVile={}
				$('#addModuleVille').modal('hide')
				$.notify({
					icon: "done",
					message: "la ville "+ data.nom+" est bien ajoutée  ",
				}, {
					type: 'success',
					timer: 3000,
					placement: {
						from: 'top',
						align: 'right'
					}
				});
			})
			.catch(error => {
				this.errorsVile=error.response.data.errors
			})
		},
	}
}

</script>