<template>
	<div>

        <div class="row">

          <div class="col-sm-2 checkbox-radios"  v-for="m in model">
            <div class="form-check form-check-inline">      
             <label class="form-check-label ">

              <input class="form-check-input" name="module_id[]" type="checkbox" :checked="mod_id.includes(m.id)" :value=" m.id"> {{ m.nom_module }}
              <span class="form-check-sign">
                <span class="check"></span>
              </span>

            </label> 

          </div>
        </div>

      </div>
	<a class="btn btn-success btn-link add" data-toggle="modal" data-target="#addModule" > 
		<i class="material-icons"> add</i>
		Ajouter un nouveau module 
	</a>



	<div class="modal fade" id="addModule" tabindex="-1" role="">
		<div class="modal-dialog modal-login" role="document">
			<div class="modal-content">
				<div class="card card-signup card-plain">
					<div class="modal-header">
						<div class="card-header card-header-primary text-center">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								<i class="material-icons">clear</i>
							</button>

							<h4 class="card-title">Ajouter un nouveau module</h4>
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
							<input type="submit" value="Ajouter"  class="btn btn-primary btn-link btn-wd btn-lg"> 
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
	props: ['modules','ids'],
	data()
	{
		return {
			model : this.modules,
			mod_id : this.ids,
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
	}
}
</script>