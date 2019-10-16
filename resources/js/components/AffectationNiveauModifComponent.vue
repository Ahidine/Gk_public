<template>

	<div>
		<div class="row">
			<!--div class="col-sm-4">
				<div class="form-group">

					<select id="model_select" style="display:inline-block" name="pays" data-style="select-with-transition" class="browser-default custom-select"  title=""  @change="onChange($event.target.value)"  >
						<option value="" selected hidden>Selectionner le pays</option>
						<option v-for="o in country" :value="o.id" >{{o.nom}}</option>						
					</select>

					<a class="btn btn-success btn-link add" data-toggle="modal" data-target="#addModulePays" > 
						<i class="material-icons"> add</i>
						Ajouter un nouveau pays
					</a>


				</div>
			</div-->
	

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
					<select  style="display:inline-block" name="ville" class="browser-default custom-select" data-style="select-with-transition" title="" id="centres" data-size="100" @change="onChangeCentres($event.target.value)" required>
						<option value="none"  selected hidden>Selectionnez le Centre</option>

						<option  v-for="c in centres" :value="c.id">{{ c.nom }}</option>
						


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
                  <th width="40%" >Centre</th>
                  <th width="30%" >Prix</th>
                  <th width="30%" >Devise</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="c in cible" >
                  <td width="30%"><input type="hidden" :value="c.id" name="centres[]">{{c.nom}} </td>
                  <td width="30%" > 
                  	<input v-if="typeof c.pivot !='undefined'" :value="c.pivot.prix" :class="'form-control cl'+c.id" type="numeric" name="prix[]"> 
                  	<input v-else :class="'form-control cl'+c.id" type="numeric" name="prix[]">
                  </td>
                 

                  <td width="30%" v-if="typeof c.pivot !='undefined'">
                   
                      <select style="display:block" name="devis[]" class="browser-default custom-select" data-style="select-with-transition" title="" data-size="100" required>
                        <option hidden selected >Devise</option>                   
                        <option  :selected="c.pivot.devise=='$' " value="$" >$</option>
                        <option  :selected="c.pivot.devise=='DH' " value="DH" >DH</option>
                        <option  :selected="c.pivot.devise=='€' " value="€" >€</option>
                      </select>
                    
                  </td>
                  <td width="30%" v-else>
                   
                      <select style="display:block" name="devis[]" class="browser-default custom-select" data-style="select-with-transition" title="" data-size="100" required>                  
                        <option  selected value="€" >€</option>
                        <option   value="$" >$</option>
                        <option   value="DH" >DH</option>
                      </select>
                    
                  </td>
                  <td> 
                  	<button type="button" class="btn btn-danger btn-link" data-original-title="" title="" v-on:click="Supp(c)">
                          <i class="material-icons">close</i>
                          <div class="ripple-container"></div>
                        </button></td>
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
	props: ['cent'],
	data()
	{
		return {
			villes : {},
			country : {},
			centres :{},
			indice : '',
			cible : this.cent,
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
				centres : {}
				this.centres= data			
				//console.log(this.centres)	

			})
		},
		onChangeCentres(e) {
		axios.get('/getCentres/'+e)
			.then(({data})=>{
				$("#centres").val("none");
				this.cible.push(data)	
				this.centres.shift(data.id)		
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
		Supp(id) {
			this.cible.splice(this.cible.indexOf(id),1)
			//console.log(this.cible)

			
		},
	}
}

</script>