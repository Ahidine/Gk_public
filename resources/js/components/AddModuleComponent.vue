<template>
	<div>
		<a class="btn btn-success btn-link add" data-toggle="modal" data-target="#addModule" > 
			<i class="material-icons"> add</i>
			Ajouter d'un nouveau module 
		</a>
		<div class="row" v-if="model.length">
			<table id="datatables" class="table table-striped col-md-10 ml-auto mr-auto">
				<thead>
					<tr>
						<th>X</th>
						<th>Nom du module</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="m in  model" >
						<td >
							<div class=" checkbox-radios" >
								<div class="form-check form-check-inline">      
									<label class="form-check-label ">

										<input class="form-check-input" name="module_id[]" type="checkbox" :value="m.id"> 
										<span class="form-check-sign">
											<span class="check"></span>
										</span>

									</label> 

								</div>
							</div>

						</td>
						<td >
							{{ m.nom_module }}

						</td>
						<td>				
							<button type="button" v-on:click="RemoveModule(m)" class="btn btn-danger btn-link"  title="Supprime" >
								<i class="material-icons">close</i>
								<div class="ripple-container"></div>
							</button></td>
						</tr>

					</tbody>
				</table>

			</div>




			<div class="modal fade" id="addModule" tabindex="-1" role="">
				<div class="modal-dialog modal-login" role="document">
					<div class="modal-content">
						<div class="card card-signup card-plain">
							<div class="modal-header">
								<div class="card-header card-header-primary text-center">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										<i class="material-icons">clear</i>
									</button>

									<h4 class="card-title">Ajouter d'un nouveau module</h4>
								</div>
							</div>
							<form class="form" method="post"   @submit.prevent="submitModule">
								<div class="modal-body">
									<div class="card-body">

										<div class="form-group bmd-form-group">
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text"><i class="material-icons">book</i></div>
												</div>
												<input type="text" v-model="formModule.module_nom" class="form-control" placeholder="Nom du Module">
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
		props: ['modules'],
		data()
		{
			return {
				model : this.modules,
				formModule: {
					module_nom:'',	        			
				},
				errors: {},

			}
		},
		mounted() {

		},
		methods:
		{

			submitModule() {
				axios.post('/Module',this.formModule)
				.then(({data})=>{
					$('#addModule').modal('hide')
					this.model.push(data)
					this.errorsVile={}
				})
				.catch(error => {
					this.errors=error.response.data.errors
				//console.log(error.response.data.errors)
			})
			},
			RemoveModule(row)
			{
			if (confirm('Vous êtes sûr de supprimer ce module ?'+row.id))
			{
				axios.delete('Module/'+row.id)
				.then(resp=>{
					//window.location.reload()
					this.model.splice(this.getElementByIndex(row),1);
					$.notify({
						icon: "error",
						message: " le module   "+row.nom_module+" est supprimé"
					}, {
						type: 'danger',
						timer: 3000,
						placement: {
							from: 'top',
							align: 'center'
						}
					});
					//console.log(resp)
				})
			}
			else
			{
				//console.log('non'+id)
			}
				
			},
			getElementByIndex(element)
			{
				const index= this.model.findIndex( 
					(elementCh) => {
						if(element==elementCh)
							return true;
					});
				return index;
			}

		}
	}
	</script>
