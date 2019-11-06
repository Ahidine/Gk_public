<template>
	<div class="col-md-12 ml-auto mr-auto">
	<table class="table" id="datatables" style="width:100% !important">
			<thead class="text-primary">
				<tr> 
					<th>Groupe</th>
					<th>Centre </th>
					<th>Niveau</th>
					<th>Capacité</th>
					<th>Nb Inscrit</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="g in Groupes">
					<td class="text-center">{{ g.nom_groupe }}</td>
					<td class="text-center">{{ g.centre.nom }}</td>
					<td v-if="g.niveau " class="text-center">{{ g.niveau.type }}</td>
					<td v-else class="text-center">-</td>
					<td class="text-center">{{ g.capacite}}</td>
					<td class="text-center">{{ g.eleves_count}}</td>
					<td class="td-actions text-center">
						<form  method="post" @submit.prevent="Suppsubmit(g)">
							<a rel="tooltip" class="btn btn-success btn-link edit" :href="'Groupe/'+g.id+'/edit'" data-original-title="" title="">
								<i class="material-icons">edit</i>
								<div class="ripple-container"></div>
							</a>
							<a rel="tooltip" class="btn btn-rose btn-link" href="#" data-original-title="" title="Details" v-on:click="getEmploisByGroupe(g.id)" data-toggle="modal" data-target=".bd-example-modal-lg" >
								<i class="fa fa-calendar" ></i>
							</a>

							<button type="submit" class="btn btn-danger btn-link" data-original-title="" title="supprimer" >
								<i class="material-icons">close</i>
								<div class="ripple-container"></div>
							</button>
						</form>


					</td>
				</tr>

			</tbody>
		</table>






		<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="" >
						<div class="card-header card-header-tabs card-header-rose">
							<div class="nav-tabs-navigation">
								<div class="nav-tabs-wrapper">
									<button  type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
										<i class="material-icons" >clear</i>
									</button>

									<ul class="nav nav-tabs" data-tabs="tabs">
										<li class="nav-item text-center" style="width:50%; " >
											<a class="nav-link active" href="#profile" data-toggle="tab">
												<i class="fa fa-search-plus fa-2x" aria-hidden="true"></i> Plannig de l'année
												<div class="ripple-container"></div>
											</a>
										</li>
										<li class="nav-item text-center" style="width:50%; ">
											<a class="nav-link"  href="#messages" data-toggle="tab">
												<i class="fa fa-search-minus fa-2x"></i> Emplois du temps
												<div class="ripple-container"></div>
											</a>
										</li>
									</ul>

								</div>
							</div>
						</div>
						<div class="card-body" >
							<div class="tab-content">
								<div class="tab-pane active" id="profile">
									<div class="row justify-content-center">
										<div class="col-md-10 ml-auto mr-auto">
											<div class="card ">
												<div class="card-header card-header-rose card-header-text">
													<div class="card-text">
														<h4 class="card-title">Planning de l'année</h4>
													</div>
												</div>
												<div class="card-body ">
													<table class="table" >
														<thead class="text-primary">
															<tr> 
																<th>Trimestre</th>
																<th>Du</th>
																<th>A</th>
																<th>Module</th>
															</tr>
														</thead>
														<tbody>
															<tr v-for="t in Etude">
																<td >{{ t.trimestre.nom }}</td>
																<td >{{ t.trimestre.date_debut}}</td>
																<td >{{ t.trimestre.date_fin}}</td>
																<td >{{ t.module.nom_module}}</td> 
															</tr>

														</tbody>
													</table>


												</div>
											</div>
										</div>

									</div> 

								</div>
								<div class="tab-pane" id="messages">


									<div class="row justify-content-center">
										<div class="col-md-10 ml-auto mr-auto">
											<div class="card ">
												<div class="card-header card-header-rose card-header-text">
													<div class="card-text">
														<h4 class="card-title">Emplois du temps</h4>
													</div>
												</div>
												<div class="card-body ">
													<div class="row" style="margin-top:20px;">
														<div class="col-sm-4">
															<select class="browser-default custom-select"  @change="onChangeTrimestre($event.target.value)" name="trimestre">
																<option :value="t.trimestre_id" v-for="t in trimestre">{{ t.trimestre.nom }}</option>
															</select>
														</div>
														<div class="col-sm-4 text-center">
															<input width="100%" readonly class="form-control text-center" v-model="date_debut"> 
														</div>
														<div class="col-sm-4 text-center">
															<input width="100%" readonly class="form-control text-center" v-model="date_fin"> 
														</div>

													</div> 

													<table class="table" >
														<thead class="text-primary">
															<tr> 
																<th>Jour</th>
																<th>Du</th>
																<th>A</th>
																<th>Professeur</th>
																<th>Salle</th>
															</tr>
														</thead>
														<tbody>
															<tr v-for="e in Emplois">
																<td >{{ e.jour.jour }}</td>
																<td >{{ e.heure_debut}}</td>
																<td >{{ e.heure_fin}}</td>
																<td >{{ e.prof.employe.nom}}</td> 
																<td >{{ e.salle.num}}</td> 
															</tr>

														</tbody>
													</table>
												</div>
											</div>
										</div>

									</div> 
								</div>

							</div>
						</div>
					</div>	


				</div>
			</div>


		</div>	
	</div>
</template>
<script >
export default {
	props: ['groupes'],
	data()
	{
		return {
			Groupes:this.groupes,
			Emplois:[],
			Etude:[],
			trimestre:[],
			date_debut: '',
			date_fin :'',
			groupe: '',
		}
	},
	mounted() {






	},
	methods:
	{
		Suppsubmit(id) {
			//console.log(id)
			if (confirm('vous etes sur de supprimer ce groupe?'))
			{

				axios.delete('/Groupe/'+id.id)
				.then(resp=>{
					this.Groupes.splice(this.Groupes.indexOf(id),1)
					$.notify({
						icon: "error",
						message: " le groupe  "+id.nom_groupe+" est supprimé"
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
			}
			else
			{
				//console.log('non'+id)
			}


		},

		getPlanning(id) {


		},
		getEmploisByGroupe(id)
		{
			this.groupe=id
			axios.get('/getEmploisTempsByGroupe/'+id)
			.then(({data})=>{
				this.Emplois=data.emplois
				this.trimestre=data.trimestre
				this.date_debut=data.trimestre[0].trimestre.date_debut
				this.date_fin=data.trimestre[0].trimestre.date_fin
			})
			axios.get('/getPlanningByGroupe/'+id)
			.then(({data})=>{
				this.Etude=data
			})
		},
		onChangeTrimestre(t)
		{
			axios.get('/getEmploisByTrimestreByGroupe/'+t+'/'+this.groupe)
			.then(({data})=>{
				this.Emplois = data.emplois
				this.date_debut=data.trimestre.date_debut
				this.date_fin=data.trimestre.date_fin
				//this.date_fin=data.date_fin
			//	this.show=false


		})	

		},


	}
}	
</script>