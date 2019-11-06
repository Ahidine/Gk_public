<template>
	<div >

		<table id="datatables"  class="table  table-striped table-no-bordered table-hover" style="width:100% !important">
			<thead class="text-primary">
				<tr>
					<th style="width: 10 vw;">Nom</th>
					<th style="width: 10 vw;">Prénom</th>
					<th style="width: 20 vw;"> Centres</th>
					<th style="width: 10 vw;"> Ancienneté </th>
					<th style="width: 20 vw;">Nb de séances</th>
					<th style="width: 30 vw;" class="text-center"> Actions</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="p in prof">
					<td style="width: 10 vw;" class="text-center">
						{{ p.employe.nom }}
					</td>
					<td style="width: 10 vw;" class="text-center">
						{{ p.employe.prenom }}
					</td > 
					<td  style="width: 20 vw;" class="text-center">
						<select   class="browser-default custom-select text-center" data-size="7" data-style="select-with-transition"    >
							<option  v-for="c in p.employe.centre"  > {{c.nom}}</option>
						</select>
					</td> 
					<td style="width: 10 vw;" class="text-center"> {{ p.anciennete }}</td>
					<td style="width: 20 vw;" class="text-center">
						{{ p.nombreSeance }}
					</td>      

					<td style="width: 30 vw;" class="td-actions text-center " > 
						<form  method="post" @submit.prevent="Suppsubmit(p.id)">
							<a rel="tooltip" class="btn btn-info btn-link" href="#" data-original-title="" title="details" v-on:click="getProfInfo(p.id) " data-toggle="modal" data-target=".bd-info-modal">
								<i class="material-icons">person</i>

							</a>

							<a rel="tooltip"  :href="'Prof/'+p.id+'/edit' " class="btn btn-success btn-link edit" data-original-title="" title="modifier" >
								<i class="material-icons">edit</i>
								<div class="ripple-container"></div>
							</a>

							<a rel="tooltip" class="btn btn-rose btn-link" href="#" data-original-title="" title="Absences" data-toggle="modal" data-target=".bd-absence-modal" v-on:click="getProfAbsence(p.employe.id) ">
								<i class="fa fa-calendar" ></i>

							</a>
							<a rel="tooltip" class="btn  btn-link" href="#" v-on:click="getProfSalaire(p.id) " data-original-title="" title="historique salaire"  data-toggle="modal" data-target=".bd-salaire-modal">
								<i class="fa fa-money" ></i>

							</a>
							<a v-if="p.employe.path_Cv"  rel="tooltip"  v-on:click="getFile(p.employe.path_Cv)" class="btn btn-black btn-link" data-original-title="" title="CV" >
								<i class="fa fa-file-text-o" aria-hidden="true"></i>
								<div class="ripple-container"></div>
							</a>
							<button v-else type="button" rel="tooltip"  v-on:click="setName('Cv')" class="btn btn-black btn-link" data-toggle="modal" data-target="#exampleModal" data-original-title="" title="CV" >
								<i class="fa fa-file-text-o" aria-hidden="true"></i>
								<div class="ripple-container"></div>
							</button>
							<a v-if="p.employe.path_contrat" rel="tooltip"  v-on:click="getFile(p.employe.path_contrat)" class="btn btn-success btn-link" data-original-title="" title="Contrat" >
								<i class="fa fa-book" aria-hidden="true"></i>
								<div class="ripple-container"></div>
							</a>
							<button v-else type="button" rel="tooltip"  v-on:click="setName('Contrat')" class="btn btn-success btn-link" data-toggle="modal" data-target="#exampleModal" data-original-title="" title="Contrat" >
								<i class="fa fa-book" aria-hidden="true"></i>
								<div class="ripple-container"></div>
							</button>
							<a  v-if="p.employe.path_diplomes" rel="tooltip"  v-on:click="getFile(p.employe.path_diplomes)" class="btn btn-warning btn-link" data-original-title="" title="Diplomes" >
								<i class="fa fa-graduation-cap" aria-hidden="true"></i>
								<div class="ripple-container"></div>
							</a>
							<button v-else type="button" rel="tooltip"  v-on:click="setName('Diplomes')" class="btn btn-warning btn-link"  data-toggle="modal" data-target="#exampleModal" data-original-title="" title="Diplomes" >
								<i class="fa fa-graduation-cap" aria-hidden="true"></i>
								<div class="ripple-container"></div>
							</button>

							<a v-on:click="Suppsubmit(p.id)" class="btn btn-danger btn-link" data-original-title="" title="supprimer" >
								<i class="material-icons">close</i>
								<div class="ripple-container"></div>
							</a>


						</form>



					</td>
				</tr>
			</tbody>
		</table>




		<div class="modal fade bd-info-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog  modal-lg">
				<div class="modal-content">
					<div class="card card-signup card-plain">
						<div class="modal-header">
							<div class="card-header card-header-info text-center" style="margin-bottom: 0px !important;">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
									<i class="material-icons">clear</i>
								</button>

								<h4 class="card-title">Détails Personnel</h4>
							</div>
						</div>
						<div class="modal-body" style="padding-top: 0px !important;">
							<div class="card-body">

								<div class="col-md-12" v-if="Pr.employe" >
									<div class="card">
										<div class="card-header card-header-tabs " style="background:#006D80;">
											<div class="nav-tabs-navigation">
												<div class="nav-tabs-wrapper">
													<ul class="nav nav-tabs" data-tabs="tabs">
														<li class="nav-item" style="width:30%;" >
															<a class="nav-link active" href="#profile" data-toggle="tab">
																<i class="fa fa-address-card-o fa-2x" aria-hidden="true"></i> Infos Personnels 
																<div class="ripple-container"></div>
															</a>
														</li>
														<li class="nav-item" style="width:30%;">
															<a class="nav-link" href="#messages" data-toggle="tab">
																<i class="fa fa-university fa-2x" aria-hidden="true"></i> Info Professionnels
																<div class="ripple-container"></div>
															</a>
														</li>
														<li class="nav-item" style="width:30%;">
															<a class="nav-link" href="#settings" data-toggle="tab">
																<i class="fas fa-chalkboard-teacher fa-2x"></i> Info d'affectation
																<div class="ripple-container"></div>
															</a>
														</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="card-body">
											<div class="tab-content">
												<div class="tab-pane active" id="profile">
													<div class="col-md-12">
														<div class="row">
															<label class="col-sm-4 col-form-label">Nom </label>
															<div class="col-sm-8">
																<div class="form-group">
																	<input type="text" readonly  :value="Pr.employe.nom"class="form-control text-center">
																</div>
															</div>
														</div>
														<div class="row">
															<label class="col-sm-4 col-form-label">Pénom</label>
															<div class="col-sm-8">
																<div class="form-group">
																	<input type="text"readonly :value="Pr.employe.prenom"  class="text-center form-control">
																</div>
															</div>
														</div>
														<div class="row">
															<label class="col-sm-4 col-form-label">Sex</label>
															<div class="col-sm-8">
																<div class="form-group">
																	<input v-if="Pr.employe.nom.sex" readonly type="text"  value="Homme"  class="form-control text-center">
																	<input v-else type="text" readonly value="Femme"  class="form-control text-center">
																</div>
															</div>
														</div>
														<div class="row">
															<label class="col-sm-4 col-form-label">Date de naissance</label>
															<div class="col-sm-8">
																<div class="form-group">
																	<input type="text" readonly :value="Pr.employe.date_naissance" class="form-control text-center">
																</div>
															</div>
														</div>
														<div class="row">
															<label class="col-sm-4 col-form-label">Numéro mobile</label>
															<div class="col-sm-8">
																<div class="form-group">
																	<input type="text" readonly :value="Pr.employe.Tel_mobile" class="form-control text-center">
																</div>
															</div>
														</div>
														<div class="row">
															<label class="col-sm-4 col-form-label">Numéro fixe</label>
															<div class="col-sm-8">
																<div class="form-group">
																	<input type="text" readonly :value="Pr.employe.Tel_fixe" class="text-center form-control">
																</div>
															</div>
														</div>
														<div class="row">
															<label class="col-sm-4 col-form-label">Adresse</label>
															<div class="col-sm-8">
																<div class="form-group">
																	<input type="text" readonly :value="Pr.employe.adresse"class="text-center form-control">
																</div>
															</div>
														</div>
														<div class="row">
															<label class="col-sm-4 col-form-label">Email</label>
															<div class="col-sm-8">
																<div class="form-group">
																	<input type="text" readonly :value="Pr.employe.email"class="text-center form-control">
																</div>
															</div>
														</div>
														<div class="row">
															<label class="col-sm-4 col-form-label">Date d'affectation</label>
															<div class="col-sm-8">
																<div class="form-group">
																	<input type="text" readonly :value="Pr.employe.date_affectation"class="text-center form-control">
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="tab-pane" id="messages">

													<div class="row justify-content-center">
														<div class="col-md-12">
															<table class="table table-striped table-no-bordered table-hover">
																<thead class="text-primary">
																	<th>Diplome</th>
																	<th>Ecole</th>
																	<th>Spécialité </th>
																	<th>Date d'obtention </th>
																</thead>
																<tbody>
																	<tr v-for="d in Pr.diplomes">
																		<td>{{d.intitule}}</td>
																		<td>{{d.ecole}}</td>
																		<td>{{d.specialite}}</td>
																		<td>{{d.date_obtention}}</td>
																	</tr>


																</tbody>
															</table>

														</div>
													</div>
												</div>
												<div class="tab-pane" id="settings">

													<div class="row justify-content-center">
														<div class="col-md-12">
															<div class="row" >
																<div class="col-sm-4">
																	<select class="browser-default custom-select"  @change="onChangeTrimestre($event.target.value)" name="trimestre">
																		<option  :value="t.trimestre_id" v-for="t in trimestre">{{ t.trimestre.nom }}</option>
																	</select>
																</div>
																<div class="col-sm-4 text-center">
																	<input width="100vw" readonly class="form-control text-center" v-model="date_debut"> 
																</div>
																<div class="col-sm-4 text-center">
																	<input width="100vw" readonly class="form-control text-center" v-model="date_fin"> 
																</div>

															</div> 
															<table class="table table-striped table-no-bordered table-hover">
																<thead class="text-primary">
																	<th>Groupe</th>
																	<th>Module </th>
																	<th>Jour</th>
																	<th>Du </th>
																	<th> A </th>
																	<th> Salle </th>
																	<th> Centre </th>
																</thead>
																<tbody>
																	<tr v-for="e in emplois">
																		<td>{{e.groupe.nom_groupe}}</td>
																		<td>{{ e.module.nom_module }} </td>
																		<td>{{e.jour.jour}}</td>
																		<td>{{e.heure_debut}}</td>
																		<td>{{e.heure_fin}}</td>
																		<td>{{e.salle.num}}</td>
																		<td>{{e.centre.nom}}</td>
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
						<div class="modal-footer justify-content-right ">
							<button data-dismiss="modal"   class=" close btn btn-info btn-round mt-4 btn-lg">Annuler</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade bd-salaire-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="card card-signup card-plain">
						<div class="modal-header">
							<div class="card-header card-header-warning text-center">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
									<i class="material-icons">clear</i>
								</button>
								<div class="card-title">
									<h4 >historique de salaire </h4>
									<h5>{{Pr.nom}} {{Pr.prenom}}</h5>
								</div>

							</div>
						</div>
						<div class="modal-body">
							<div class="card-body">

								<div class="row justify-content-center">
									<div class="col-md-12">
										<div class="text-right">
											<select  class="browser-default custom-select"
											@change="getSalaireByYear($event.target.value,Pr.id)">
											<option   selected hidden>Année !</option>
											<option  v-for="y in years" :value="y" > {{y}}</option>
										</select>
									</div>
									<table class="table table-striped table-no-bordered table-hover">
										<thead class="text-primary">
											<th>Nombres de seances</th>
											<th>Salaire </th>
											<th>Date echéance</th>
											<th>Date de traitement </th>
										</thead>
										<tbody>
											<tr v-for="s in salaire">
												<td>{{s.NombreSeance}}</td>
												<td>{{s.prixParSeance * s.NombreSeance }}</td>
												<td>{{s.date_echeance}}</td>
												<td>{{s.date_traitement}}</td>
											</tr>


										</tbody>
									</table>

								</div>
							</div>

						</div>
					</div>
					<div class="modal-footer justify-content-right ">
						<button data-dismiss="modal"   class=" close btn btn-warning  mt-4 btn-lg">Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade bd-absence-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="card card-signup card-plain">
					<div class="modal-header">
						<div class="card-header card-header-warning text-center">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								<i class="material-icons">clear</i>
							</button>
							<div class="card-title">
								<h4 >L'absence de :  </h4>
								<h5>{{Pr.nom}} {{Pr.prenom}}</h5>
							</div>

						</div>
					</div>
					<div class="modal-body">
						<div class="card-body">

							<div class="row justify-content-center">
								<div class="col-md-12">
									<div class="text-right">
										<select  class="browser-default custom-select"
										@change="getProfAbsenceByYear($event.target.value,Pr.id)">
										<option   selected hidden>Année !</option>
										<option  v-for="y in years" :value="y" > {{y}}</option>
									</select>
								</div>
								<table class="table table-striped table-no-bordered table-hover">
									<thead class="text-primary">
										<th>date absence</th>
										<th>De </th>
										<th>A</th>
										<th>Motif</th>
									</thead>
									<tbody>
										<tr v-for="a in absence">
											<td>{{a.date}}</td>
											<td>{{a.heure_debut}}</td>
											<td>{{a.heure_fin}}</td>
											<td>{{a.motif}}</td>
										</tr>


									</tbody>
								</table>

							</div>
						</div>

					</div>
				</div>
				<div class="modal-footer justify-content-right ">
					<button data-dismiss="modal"   class=" close btn btn-warning  mt-4 btn-lg">Cancel</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body text-center" style="font-size:20px;" >
				Ce professeur n 'a pas {{ file }}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
</div>	







</template>
<script>
export default {
	props: ['professeur'],
	data()
	{
		return {
			prof :this.professeur,
			Pr :{},
			emplois:[],
			date_debut:'',
			date_fin:'',
			salaire :{},
			absence :{},
			trimestre: [],
			years: [],
			file:'',
		}
	},
	mounted() {
		for (var i = new Date().getFullYear() ; i >= new Date().getFullYear()-5; i--) {
			this.years.push(i)
		}
		//console.log('here'+this.years )

	},
	methods:
	{
		Suppsubmit(id) {
			if (confirm('vous etes sur de supprimer ce professeur?'))
			{
				axios.delete('/Prof/'+id)
				.then(resp=>{
					window.location.reload()
					//console.log(resp)
				})
			}
			else
			{
				//console.log('non'+id)
			}



		},

		getProfInfo(id) {

			axios.get('/Prof/'+id)
			.then(({data})=>{
				//console.log(data)
				this.Pr = data
				//console.log(this.Pr)
			})
			axios.get('/getEmploisByProf/'+id)
			.then(({data})=>{
				//console.log(data)
				this.emplois = data.emplois
				this.trimestre=data.trimestre
				if(data.trimestre.length>0)
				{
					this.date_debut=data.trimestre[0].trimestre.date_debut
					this.date_fin=data.trimestre[0].trimestre.date_fin					
				}
				else
				{
					this.date_debut=''
					this.date_fin=''
				}

				//console.log(this.Pr)
			})

		},
		getProfSalaire(id) {
			console.log(id)
			axios.get('/Prof/getSalaire/'+id)
			.then(({data})=>{
				//console.log(data)
				this.salaire = data.salaires
				this.Pr=data.Pr
			})

		},
		getProfAbsence(id) {
			//console.log(id)
			axios.get('/Employe/getAbsences/'+id)
			.then(({data})=>{
				//console.log(data)
				this.absence = data.absences
				this.Pr=data.emp
			})

		},
		getProfAbsenceByYear(year,prof_id) {
			axios.get('/Employe/getAbsencesByYear/'+prof_id+'/'+year)
			.then(({data})=>{
				//console.log(data)
				this.absence = data.absences
				this.Pr=data.emp
			})

		},
		getSalaireByYear(year,prof_id)
		{
			axios.get('/Prof/getSalaireByYear/'+prof_id+'/'+year)
			.then(({data})=>{
				//console.log(data)
				this.salaire = data.salaires
				this.Pr=data.Pr
			})
		},
		onChangeTrimestre(t)
		{
			axios.get('/getEmploisByTrimestreByProf/'+t+'/'+this.Pr.id)
			.then(({data})=>{
				this.emplois = data.emplois
				this.date_debut=data.trimestre.date_debut
				this.date_fin=data.trimestre.date_fin
				//this.date_fin=data.date_fin
			//	this.show=false


		})	

		},
		getFile(file)
		{
			window.location.href='Employe/getFile/'+btoa(file)
		},
		setName(name)
		{
			this.file=name;
		}
	}
}	
</script>