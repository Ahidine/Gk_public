<template>
	<div>
		<div class="row">
			<label class="col-sm-2 col-form-label">Nom du groupe</label>
			<div class="col-sm-10">
				<div class="form-group">
					<input name="nom_groupe" type="text" class="form-control" required>
				</div>
			</div>
		</div>

		<div class="row">
			<label class="col-sm-2 col-form-label">Centre</label>
			<div class="col-sm-10">
				<div class="form-group">
					<select  class="selectpicker"  name="centre" tyle="display:inline-block"  data-style="select-with-transition" title="" data-size="100"    required>
						<option value="" selected hidden>Selectionner</option>

						<option v-for="c in Centres"  :value="c.id" >{{ c.nom }}</option>

					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<label class="col-sm-2 col-form-label">Niveau</label>
			<div class="col-sm-10">
				<div class="form-group">
					<select  class="selectpicker"  name="niveau" tyle="display:inline-block" data-style="select-with-transition" title="" data-size="100" required @change="onChangeNiveau($event.target.value)"   >
						<option value="" selected hidden>Selectionner</option>

						<option v-for="n in Niveaux" :value="n.id" >{{ n.type }}</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<label class="col-sm-2 col-form-label">Capacité</label>
			<div class="col-sm-10">
				<div class="form-group">
					<input name="capacite" type="number" v-model="capacite" class="form-control" required>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 ml-auto mr-auto">
				<div class="card">
					<div class="card-header card-header-icon card-header-rose">
						<div class="card-icon">
							<i class="material-icons">assignment</i>
						</div>
						<h4 class="card-title ">Affectation des modules


						</h4>
						<br>
							<button  type="button" class="btn btn-sm btn-danger " data-toggle="modal" data-target=".bd-DeleteTrimestre-modal" >Supprimer un trimestre</button>
							<button  type="button" class="btn btn-sm btn-success float-right" data-toggle="modal" data-target=".bd-AddTrimestre-modal" >Ajouter un Trimestre</button>

							
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Trimestre</th>
										<th>date_début</th>
										<th>date_fin</th>
										<th>Module</th>
									</tr>
								</thead>
								<tbody>

									<tr v-for="r in 3">
										<td>
											<select  class="custom-select custom-select"  name="trimestre[]" @change="onChangeTrimestre($event.target.value,r)"   required>
												<option value="" selected hidden>Trimestre !</option>

												<option v-for="t in Trimestres"  :value="t.id" >{{ t.nom }}</option>

											</select> 
										</td>

										<td :class="'rowD'+r"></td>
										<td :class="'rowF'+r"></td>										


										<td>
											<div class="form-group" >

												<select  :class="'custom-select custom-select-sm Trim'+r"  name="modules[]" title="Choose Model"  required @change="makeModules($event.target.value,'Trim'+r)">
													<option value="" selected hidden>Selectionner</option>

													<option v-for="m in Modules"  :value="m.id" >
													{{ m.nom_module }}</option>

												</select> 

											</div>      
										</td>
									</tr>



								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade bd-AddTrimestre-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="card card-signup card-plain">
						<div class="modal-header">
							<div class="card-header card-header-primary text-center">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
									<i class="material-icons">clear</i>
								</button>
								<div class="card-title">
									<h4 >l'ajout d'un nouveau trimestre </h4>
									
								</div>

							</div>
						</div>
						<div class="modal-body">
							<div class="card-body">

								<div class="row justify-content-center">
									<div class="col-md-12">

										<form method="post"  @submit.prevent="AddTrimestre">
											<div class="row">
												<div class="form-group col-md-10 ml-auto mr-auto" >
													<label for="nom" class="bmd-label-floating">Nom</label>
													<input type="text"  class="form-control" id="nom" v-model="form.nom">
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-md-10 ml-auto mr-auto">
													<div class="card ">
														<div class="card-header card-header-rose card-header-text">
															<div class="card-icon">
																<i class="material-icons">today</i>
															</div>
															<h4 class="card-title">Date début</h4>
														</div>
														<div class="card-body ">
															<div class="form-group ">
																<input type="date" name="date" data-date-format='Y-MM-DD' v-model="form.date_debut" class="form-control text-center" >
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-10 ml-auto mr-auto">
													<div class="row">
														<label class="col-sm-3 col-form-label label-checkbox">Dacalage :</label>
														<div class="col-sm-9 checkbox-radios">
															<div class="form-check form-check-inline">
																<label class="form-check-label">
																	<input class="form-check-input" @change="vider()" name="radio" type="radio" v-model="decalage"  value="1"> Avec
																	<span class="form-check-sign">
																		<span class="check"></span>
																	</span>
																</label>
															</div>
															<div class="form-check form-check-inline">
																<label class="form-check-label">
																	<input class="form-check-input" @change="vider()"name="radio" type="radio" v-model="decalage" value="0"> Sans
																	<span class="form-check-sign">
																		<span class="check"></span>
																	</span>
																</label>
															</div>
														</div>
													</div>
													<div class="row"v-if="decalage==1" style="margin-top: 20px;">
														<label class="col-sm-3 col-form-label">Combien :</label>
														<div class="col-sm-4">
															<div class="form-group ">
																<input type="number" v-model="dec" class="form-control text-center"> 
															</div>
														</div>
														<div class="col-sm-5">
															<div class="form-group text-left ">
																<b> <i>semaines</i> </b>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row" style="margin-top: 20px;">
												<div class="col-md-10 ml-auto mr-auto">
													<div class="text-center">
														<button type="button" class="btn btn-success " v-on:click="makeDate(form.date_debut,dec)">Calculer</button>
													</div>
												</div>
											</div>

											<div class="row" style="margin-top: 20px;">
												<div class="col-md-10 ml-auto mr-auto">
													<div class="card ">
														<div class="card-header card-header-rose card-header-text">
															<div class="card-icon">
																<i class="material-icons">today</i>
															</div>
															<h4 class="card-title">Date fin</h4>
														</div>
														<div class="card-body ">
															<div class="form-group ">
																<input type="date"  data-date-format='Y-MM-DD' :value="form.date_fin" class="form-control text-center" >
															</div>
														</div>
													</div>
												</div>
											</div>



											<div class="col-md-4 float-right">
												<button style="width: 100%;" type="submit" class="btn btn-fill btn-rose">Add</button>
											</div>

										</form>

									</div>
								</div>

							</div>
						</div>
						<div class="modal-footer justify-content-start">
							<button data-dismiss="modal"   class=" close btn btn-primary mt-4 btn-lg">Cancel</button>
						</div>
					</div>
				</div>
			</div>


		</div>

		<div class="modal fade bd-DeleteTrimestre-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="card card-signup card-plain">
						<div class="modal-header">
							<div class="card-header card-header-danger text-center">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
									<i class="material-icons">clear</i>
								</button>
								<div class="card-title">
									<h4 >Suppression d'un trimestre </h4>
									
								</div>

							</div>
						</div>
						<div class="modal-body">
							<div class="card-body">

								<div class="row justify-content-center">
									<table class="table" id="datatables">
										<thead class="text-primary">
											<tr>
												<th>Trimestre</th>
												<th>date_début</th>
												<th>date_fin</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="t in Trimestres">
												<td>

													{{t.nom}}

												</td>
												<td>{{t.date_debut}}</td>
												<td>{{t.date_fin}}</td>
												<td>
													<form  method="post" @submit.prevent="SuppTrimestre(t)">
														<button type="submit" class="btn btn-danger btn-link" data-original-title="" title="supprimer" >
															<i class="material-icons">close</i>
															<div class="ripple-container"></div>
														</button>
													</form>


												</td>
											</tr>


										</tbody>
									</table>	
								</div>

							</div>
						</div>
						<div class="modal-footer justify-content-start">
							<button data-dismiss="modal"   class=" close btn btn-primary mt-4 btn-lg">Cancel</button>
						</div>
					</div>
				</div>
			</div>


		</div>

	</div>

</template>
<script>
export default {
	props: ['centres','modules','trimestres','niveaux'],
	data()
	{
		return {
			Centres:this.centres,
			Modules:this.modules,
			Trimestres:this.trimestres,
			Niveaux:this.niveaux,
			capacite:'',
			decalage:0,
			dec:0,
			date:'',
			next_date:'',
			strDate:'',
			madate:new Date(),
			form: {
				date_debut : '',
				date_fin : '',
				nom : '',
			}
		}
	},
	mounted() {
		
		this.validation('#myforme');
	},
	methods:
	{
		onChangeNiveau(e)
		{
			if(e=='1')
				this.capacite=11
			else if(e=='2')
				this.capacite=16
		},
		makeModules(e,trim)
		{
			//console.log(trim)
			if(trim=='Trim1')
			{
				if (parseInt(e)==this.Modules[this.Modules.length-1].id) 
				{
					$('.Trim2').val(this.Modules[0].id)	
					$('.Trim3').val(this.Modules[1].id)
				}
				else 
					if (parseInt(e)==this.Modules[this.Modules.length-2].id) 
					{
						$('.Trim2').val(this.Modules[this.Modules.length-1].id)	
						$('.Trim3').val(this.Modules[0].id)
					}
					else{
						$('.Trim2').val(parseInt(e)+1)	
						$('.Trim3').val(parseInt(e)+2)
					}
				}



			},
			chercher(cle) {
				for (var i = 0; i < this.Trimestres.length; i++) {
					if(this.Trimestres[i].id==cle)
						return this.Trimestres[i] 
				}
			},
			chercherModule(cle) {
				for (var i = 0; i < this.Modules.length; i++) {
					if(this.Modules[i].id==cle)
						return this.Modules[i] 
				}
			},
			onChangeTrimestre(t,r)
			{

				$('.rowD'+r).empty()
				$('.rowF'+r).empty()
				$('.rowD'+r).append(this.chercher(t).date_debut)
				$('.rowF'+r).append(this.chercher(t).date_fin)
			},


			makeDate(date,days)
			{
				axios.get('/calcateDate/'+btoa(date)+'/'+days)
				.then(({data})=>{
					this.form.date_fin=data
				})

			},
			AddTrimestre()
			{
				axios.post('/Trimestre',this.form)
				.then(({data})=>{
					$.notify({
						icon: "done",
						message: "Trimestre "+this.form.nom+" est bien ajoutée"
					}, {
						type: 'success',
						timer: 3000,
						placement: {
							from: 'top',
							align: 'right'
						}
					});
					this.Trimestres.push(data)
					$('.bd-AddTrimestre-modal').modal('hide')
					this.viderForm()

				})
			},
			viderForm()
			{
				this.form.nom=''
				this.form.date_fin=''
				this.form.date_debut=''
			},
			vider()
			{
				
				this.dec=0
			},
			SuppTrimestre(t)
			{

			//console.log(id)
			if (confirm('vous etes sur de supprimer ce trimestre ?'))
			{

				axios.delete('/Trimestre/'+t.id)
				.then(resp=>{
					this.Trimestres.splice(this.Trimestres.indexOf(t),1)
					$.notify({
						icon: "error",
						message: " le trimestre   "+t.nom +" est supprimé"
					}, {
						type: 'danger',
						timer: 3000,
						placement: {
							from: 'top',
							align: 'center'
						}
					});
					//window.location.reload()
					//console.log(resp)
				})
				.catch( error => {
					$.notify({
						icon: "error",
						message: "le trimestre "+t.nom+" déja affecté à un groupe merci de le désaffecter \n avant de le supprimé "
					}, {
						type: 'danger',
						timer: 3000,
						placement: {
							from: 'top',
							align: 'center'
						}
					});
				})
			}
			else
			{
				//console.log('non'+id)
			}


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