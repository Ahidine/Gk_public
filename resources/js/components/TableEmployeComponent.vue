<template>
	<div>
		<table id="datatables" class="table table-striped table-no-bordered table-hover">
			<thead class="text-primary">
				<tr> 
					<th >Nom</th>
					<th >Prénom</th>
					<th >Sex</th>
					<th >Centres</th>
					<th >Fonction </th>
					<th >Date d'affectation </th>
					<th  class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="em in employes">
					<td   class="text-center">{{ em.nom }}</td>
					<td   class="text-center">{{ em.prenom }}</td>
					<td v-if="em.sex" class="text-center">
						Homme
					</td>
					<td width="10%" v-else class="text-center">
						Femme
					</td>
					<td   class="text-center">
						<select   class="browser-default custom-select text-center" data-size="7" data-style="select-with-transition"    >
							<option  v-for="c in em.centre"  > {{c.nom}}</option>
						</select>
					</td>
					<td   class="text-center">{{ em.fonction }}</td>
					<td   class="text-center">{{ em.date_affectation }}</td>
					<td  class="td-actions text-center">
						<form  method="post" @submit.prevent="Suppsubmit(em.id)">
							<a rel="tooltip" class="btn btn-info btn-link" href="#" data-original-title="" title="details personnel" v-on:click="getWorkerInfo(em.id) " data-toggle="modal" data-target=".bd-info-modal">
								<i class="material-icons">person</i>

							</a>
							<a rel="tooltip" class="btn btn-success btn-link edit" title="modifier" 
							v-bind:href="'/Employe/'+em.id+'/edit'">
							<i class="material-icons">edit</i>
							<div class="ripple-container"></div>
						</a>

						<a rel="tooltip" class="btn btn-rose btn-link" href="#" data-original-title="" title="Absences" data-toggle="modal" data-target=".bd-absence-modal" v-on:click="getWorkerAbsence(em.id) ">
							<i class="fa fa-calendar" ></i>
						</a>
						<a rel="tooltip" class="btn  btn-link" href="#" v-on:click="getWorkerSalaire(em.id) " data-original-title="" title="historique salaire"  data-toggle="modal" data-target=".bd-salaire-modal">
							<i class="fa fa-money" ></i>

						</a>

						<a v-if="em.path_Cv" rel="tooltip"  v-on:click="getFile(em.path_Cv)" class="btn btn-black btn-link" data-original-title="" title="CV" >
							<i class="fa fa-file-text-o" aria-hidden="true"></i>
							<div class="ripple-container"></div>
						</a>
						<button v-else type="button" rel="tooltip"  v-on:click="setName('Cv')" class="btn btn-black btn-link" data-toggle="modal" data-target="#exampleModal" data-original-title="" title="CV" >
							<i class="fa fa-file-text-o" aria-hidden="true"></i>
							<div class="ripple-container"></div>
						</button>
						<a v-if="em.path_contrat" rel="tooltip"  v-on:click="getFile(em.path_contrat)" class="btn btn-success btn-link" data-original-title="" title="Contrat" >
							<i class="fa fa-book" aria-hidden="true"></i>
							<div class="ripple-container"></div>
						</a>
						<button v-else type="button" rel="tooltip"  v-on:click="setName('Contrat')" class="btn btn-success btn-link" data-toggle="modal" data-target="#exampleModal" data-original-title="" title="Contrat" >
							<i class="fa fa-book" aria-hidden="true"></i>
							<div class="ripple-container"></div>
						</button>
						<a v-if="em.path_diplomes" rel="tooltip"  v-on:click="getFile(em.path_diplomes)" class="btn btn-warning btn-link" data-original-title="" title="Diplomes" >
							<i class="fa fa-graduation-cap" aria-hidden="true"></i>
							<div class="ripple-container"></div>
						</a>
						<button v-else type="button" rel="tooltip"  v-on:click="setName('Diplomes')" class="btn btn-warning btn-link"  data-toggle="modal" data-target="#exampleModal" data-original-title="" title="Diplomes" >
							<i class="fa fa-graduation-cap" aria-hidden="true"></i>
							<div class="ripple-container"></div>
						</button>
						<a  rel="tooltip" v-on:click="Suppsubmit(em)" class="btn btn-danger btn-link" data-original-title="" title="supprimer" >
							<i class="material-icons">close</i>
							<div class="ripple-container"></div>
						</a>


					</form>


				</td>
			</tr>

		</tbody>
	</table>



	<div class="modal fade bd-info-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="card card-signup card-plain">
					<div class="modal-header">
						<div class="card-header card-header-info text-center">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								<i class="material-icons">clear</i>
							</button>

							<h4 class="card-title">Détails Personnel</h4>
						</div>
					</div>
					<div class="modal-body">
						<div class="card-body">

							<div class="row justify-content-center">
								<div class="col-md-12">
									<div class="row">
										<label class="col-sm-4 col-form-label">Nom </label>
										<div class="col-sm-8">
											<div class="form-group">
												<input type="text" readonly  :value="salarie.nom"class="form-control text-center">
											</div>
										</div>
									</div>
									<div class="row">
										<label class="col-sm-4 col-form-label">Pénom</label>
										<div class="col-sm-8">
											<div class="form-group">
												<input type="text"readonly :value="salarie.prenom"  class="text-center form-control">
											</div>
										</div>
									</div>
									<div class="row">
										<label class="col-sm-4 col-form-label">Sex</label>
										<div class="col-sm-8">
											<div class="form-group">
												<input v-if="salarie.sex" readonly type="text"  value="Homme"  class="form-control text-center">
												<input v-else type="text" readonly value="Femme"  class="form-control text-center">
											</div>
										</div>
									</div>
									<div class="row">
										<label class="col-sm-4 col-form-label">Date de naissance</label>
										<div class="col-sm-8">
											<div class="form-group">
												<input type="text" readonly :value="salarie.date_naissance" class="form-control text-center">
											</div>
										</div>
									</div>
									<div class="row">
										<label class="col-sm-4 col-form-label">Numéro mobile</label>
										<div class="col-sm-8">
											<div class="form-group">
												<input type="text" readonly :value="salarie.Tel_mobile" class="form-control text-center">
											</div>
										</div>
									</div>
									<div class="row">
										<label class="col-sm-4 col-form-label">Numéro fixe</label>
										<div class="col-sm-8">
											<div class="form-group">
												<input type="text" readonly :value="salarie.Tel_fixe" class="text-center form-control">
											</div>
										</div>
									</div>
									<div class="row">
										<label class="col-sm-4 col-form-label">Adresse</label>
										<div class="col-sm-8">
											<div class="form-group">
												<input type="text" readonly :value="salarie.adresse"class="text-center form-control">
											</div>
										</div>
									</div>
									<div class="row">
										<label class="col-sm-4 col-form-label">Email</label>
										<div class="col-sm-8">
											<div class="form-group">
												<input type="text" readonly :value="salarie.email"
												class="text-center form-control">
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
								<h5>{{emp.nom}} {{emp.prenom}}</h5>
							</div>

						</div>
					</div>
					<div class="modal-body">
						<div class="card-body">

							<div class="row justify-content-center">
								<div class="col-md-12">
									<div class="text-right">
										<select  class="browser-default custom-select"
										@change="getEmployeSalaireByYear(emp.id,$event.target.value)">
										<option   selected hidden>Année !</option>
										<option  v-for="y in years" :value="y" > {{y}}</option>
									</select>
								</div>
								<table class="table table-striped table-no-bordered table-hover">
									<thead class="text-primary">
										<th>Salaire</th>
										<th>Date echéance</th>
										<th>Date de traitement </th>
									</thead>
									<tbody>
										<tr v-for="s in salaire">
											<td>{{s.salaire}}</td>
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
					<button data-dismiss="modal"   class=" close btn btn-warning  mt-4 btn-lg">Annuler</button>
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
							<h5>{{emp.nom}} {{emp.prenom}}</h5>
						</div>

					</div>
				</div>
				<div class="modal-body">
					<div class="card-body">

						<div class="row justify-content-center">
							<div class="col-md-12">
								<div class="text-right">
									<select  class="browser-default custom-select"
									@change="getEmployeAbsenceByYear(emp.id,$event.target.value)">
									<option   selected hidden>Année !</option>
									<option  v-for="y in years" :value="y" > {{y}}</option>
								</select>
							</div>
							<table class="table table-striped table-no-bordered table-hover">
								<thead class="text-primary">
									<th>Date d'absence</th>
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
				<button data-dismiss="modal"   class=" close btn btn-warning  mt-4 btn-lg">Annuler</button>
			</div>
		</div>
	</div>
</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body text-center" style="font-size:20px;" >
				Cet  employer n 'a pas {{ file }}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bd-modification-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="card card-signup card-plain">
				<div class="modal-header">
					<div class="card-header card-header-success text-center">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<i class="material-icons">clear</i>
						</button>

						<h4 class="card-title">Modification</h4>
					</div>
				</div>
				<form  method="post" @submit.prevent="submitChange(salarie.id)" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="card-body">

							<div class="row justify-content-center">
								<div class="col-md-12">
									<div class="row">
										<label class="col-sm-4 col-form-label">Nom </label>
										<div class="col-sm-4">
											<div class="form-group">
												<input type="text"  v-model="salarie.nom" class="form-control">
											</div>
										</div>
									</div>
									<div class="row">
										<label class="col-sm-4 col-form-label">Pénom</label>
										<div class="col-sm-4">
											<div class="form-group">
												<input type="text"  v-model="salarie.prenom"  class="form-control">
											</div>
										</div>
									</div>
									<div class="row">
										<label class="col-sm-4 col-form-label">Sex</label>
										<div class="col-sm-6">
											<div class="form-group">
												<select class="browser-default custom-select" data-size="3" data-style="select-with-transition" v-model="salarie.sex">

													<option :selected="salarie.sex" value="1" >Homme</option>
													<option :selected="!(salarie.sex)" value="0">Femme</option>							


												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<label class="col-sm-4 col-form-label">Fonction</label>
										<div class="col-sm-6">
											<div class="form-group">
												<select class="browser-default custom-select" data-size="3" data-style="select-with-transition"  @change="setFunction($event.target.value)">

													<option :selected="salarie.fonction=='Responsable'" value="Responsable" >Responsable</option>
													<option :selected="(salarie.fonction)=='Responsable_Commerciale'" value="Responsable_Commerciale">Responsable_Commerciale</option>
													<option :selected="(salarie.fonction=='Responsable_Pedagogique')" value="Responsable_Pedagogique">Responsable Pedagogique</option>							


												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<label class="col-sm-4 col-form-label">Type</label>
										<div class="col-sm-6">
											<div class="form-group">
												<select class="browser-default custom-select" data-size="3" data-style="select-with-transition" @change="setType($event.target.value)">

													<option :selected="salarie.Type=='Independant'" value="Independant" >Independant</option>
													<option :selected="(salarie.Type)=='Eleve Independant'" value="Eleve_Independant">Eleve Independant</option>
													<option :selected="(salarie.Type=='Employer')" value="Employer">Employer</option>							


												</select>
											</div>
										</div>
									</div>

									<div class="row">
										<label class="col-sm-4 col-form-label">Date de naissance</label>
										<div class="col-sm-4">
											<div class="form-group">
												<input type="text" v-model="salarie.date_naissance" class="form-control">
											</div>
										</div>
									</div>
									<div class="row">
										<label class="col-sm-4 col-form-label">Numéro mobile</label>
										<div class="col-sm-4">
											<div class="form-group">
												<input type="text" v-model="salarie.Tel_mobile" class="form-control">
											</div>
										</div>
									</div>
									<div class="row">
										<label class="col-sm-4 col-form-label">Numéro fixe</label>
										<div class="col-sm-4">
											<div class="form-group">
												<input type="text" v-model="salarie.Tel_fixe" class="form-control">
											</div>
										</div>
									</div>
									<div class="row">
										<label class="col-sm-4 col-form-label">Adresse</label>
										<div class="col-sm-4">
											<div class="form-group">
												<input type="text" v-model="salarie.adresse"class="form-control">
											</div>
										</div>
									</div>
									<div class="row">
										<label class="col-sm-4 col-form-label">Email</label>
										<div class="col-sm-4">
											<div class="form-group">
												<input type="email" v-model="salarie.email" class="form-control">
											</div>
										</div>
									</div>
									<div class="row">
										<label class="col-sm-4 col-form-label">Cv</label>
										<div class="col-sm-4">
											<div class="">
												<input type="file" name="cv" ref="file" v-on:change="setCv($event)"  >
											</div>
										</div>
									</div>
									<div class="row">
										<label class="col-sm-4 col-form-label">Contrat</label>
										<div class="col-sm-4">
											<div class="">
												<input type="file"  name="cv" ref="file" v-on:change="setContrat($event)" >
											</div>
										</div>
									</div>
									<div class="row">
										<label class="col-sm-4 col-form-label">Centre</label>
										<div class="col-sm-6">
											<div class="form-group">
												<select class="browser-default custom-select" data-size="3" data-style="select-with-transition"  v-model="salarie.centre_id">

													<option v-for="c in centres" :selected="salarie.centre_id == c.id" :value="c.id" >{{c.nom}}</option>

												</select>
											</div>
										</div>
									</div>
								</div>
							</div>


						</div>
					</div>
					<div class="modal-footer justify-content-right  text-white">
						<input  type="submit"  value="Valider" class="btn btn-success btn-round mt-4 btn-md">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>	







</template>
<script>
export default {
	props: ['employe'],
	data()
	{
		return {
			employes :this.employe,
			salarie :{},
			salaire :{},
			absence :{},
			centres :{},
			years: [],
			emp :{},
			file:'',
			formUpdate: {
				nom : '',
				prenom : '',
				date_naissance : '',
				date_affectation : '',
				adresse : '',
				Tel_mobile: '',
				Tel_fixe : '',
				sex : '',
			}
		}
	},
	mounted() {
		axios.get('/getAllCentres')
		.then(({data})=>{
			this.centres=data
		})
		for (var i = new Date().getFullYear() ; i >= new Date().getFullYear()-5; i--) {
			this.years.push(i)
		}
	},
	methods:
	{
		Suppsubmit(id) {
			if (confirm('Vous êtes sûr de supprimer cet employé ?'))
			{
				axios.delete('/Employe/'+id.id)
				.then(resp=>{
					//window.location.reload()
					this.employes.splice(this.employes.indexOf(id),1)
					$.notify({
						icon: "error",
						message: " l'employe  "+id.nom+" est supprimé"
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
		submitChange(id) {
			//console.log(this.salarie)
			let formData = new FormData();

			formData=this.salarie

			//console.log(formData)
			axios.put('/Employe/'+id,formData
				)
			.then(({data})=>{
				//window.location.reload()

			})
			.catch(error => {
				//console.log(error.response.data.errors)
			})

		},
		getWorkerInfo(id) {

			axios.get('/Employe/'+id)
			.then(({data})=>{
				//console.log(data)
				this.salarie = data
			})

		},
		getWorkerSalaire(id) {
			//console.log(id)
			axios.get('/Employe/getSalaire/'+id)
			.then(({data})=>{
				//console.log(data)
				this.salaire = data.salaires
				this.emp=data.emp
			})

		},
		getWorkerAbsence(id) {
			//console.log(id)
			axios.get('/Employe/getAbsences/'+id)
			.then(({data})=>{
				//console.log(data)
				this.absence = data.absences
				this.emp=data.emp
			})

		},

		getEmployeAbsenceByYear(id,year) {
			//console.log(id)
			axios.get('/Employe/getAbsencesByYear/'+id+'/'+year)
			.then(({data})=>{
				//console.log(data)
				this.absence = data.absences
				this.emp=data.emp
			})


		},
		getEmployeSalaireByYear(id,year) {
			//console.log(id)
			axios.get('/Employe/getSalaireByYear/'+id+'/'+year)
			.then(({data})=>{
				//console.log(data)
				this.salaire = data.salaires
				this.emp=data.emp
			})


		},
		getFile(file)
		{
			window.location.href='Employe/getFile/'+btoa(file)
		},
		setCv(cv)
		{
			//console.log(cv.target.files[0])
			this.salarie.path_Cv=cv.target.files[0]
		},
		setContrat(contrat)
		{
			//console.log(contrat)
			this.salarie.path_contrat=contrat.target.files[0]
		},
		setFunction(e)
		{
			this.salarie.fonction=e
		},
		setType(e)
		{
			//console.log(e)
			this.salarie.Type=e
		},
		setName(name)
		{
			this.file=name;
		}

	}
}	
</script>
