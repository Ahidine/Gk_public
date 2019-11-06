<template>
	<div>
		<div>
			<!--div class="card card-login card-hidden col-md-6 ml-auto mr-auto
			"  v-if="show" v-model="show">
			<div class="card-header card-header-rose text-center">
				<h4 class="card-title">Consultation d'absences des Employes </h4>
			</div>
			<div class="card-body ">
				<div class="input-group">

					<div class="col-md-12">
						<select  class="browser-default custom-select" style="display:inline-block" @change="getCentre($event.target.value)" v-model="ville" data-style="select-with-transition" title="" data-size="100" required   >
							<option value="" selected hidden>Selectionner la Ville</option>
							<option    v-for="v in city"    :value="v.id" >{{v.nom}}</option>
						</select>						
					</div>


					<div class="col-md-12" style="margin-top:20px;">
						<select  class="browser-default custom-select"  id="centre"  @change="onChangeCentre($event.target.value)" style="display:inline-block" data-style="select-with-transition" title="Centre" data-size="100" required >
							<option  selected hidden value>Selectionner le centre</option>
							<option    v-for="c in centres"    :value="c.id" >{{c.nom}}</option>
						</select>
					</div>


				</div>


			</div>
			<div class="card-footer justify-content-center">
				<button v-on:click="getListeAbsences()"  v-show="indice" class="btn btn-rose btn-link btn-lg">Lets Go</button>
			</div>
		</div-->
		<div> 
			<!--button  v-if="!show" v-on:click="show=true" class="btn btn-sm btn-rose float-right">Autre centre !</button-->
			<table  class="table" id="datatables">
				<thead class="text-primary">
					<tr> 
						<th width="20%">Nom</th>
						<th width="20%">Prénom</th>
						<th width="10%">Sex</th>
						<th width="20%">Centres</th>
						<th width="20%">Fonction </th>
						<th width="10%" >Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="em in Employes">
							<td width="20%" class="text-center">{{ em.nom }}</td>
							<td  width="20%" class="text-center">{{ em.prenom }}</td>
							<td width="10%" v-if="em.sex" class="text-center">
								Homme
							</td>
							<td  width="10%" v-else class="text-center">
								Homme
							</td>
							<td width="20%" class="text-center">
							<select   class="browser-default custom-select text-center" data-size="7" data-style="select-with-transition"    >
								<option  v-for="c in em.centre"  > {{c.nom}}</option>
							</select>

							</td>
							<td width="20%" class="text-center">{{ em.fonction }}</td>
							<td width="10%" class="td-actions text-center">
								<button type="button" v-on:click="getAbsencesEmploye(em.id)" rel="tooltip" data-toggle="modal" data-target=".bd-Absences-modal" class="btn btn-info btn-link" title="voir l'absences">
									<i class="material-icons">
										calendar_today
									</i>
								</button>
								<button type="button" class="btn btn-danger btn-link" data-original-title="" title="Ajouter absences" rel="tooltip" data-toggle="modal" data-target=".bd-AddAbsences-modal" 
								v-on:click="getEmploye(em)">
								<i class="material-icons">
									add_circle_outline
								</i>
								<div class="ripple-container"></div>
							</button>


						</td>
					</tr>

				</tbody>
			</table>

		</div>


		<div class="modal fade bd-AddAbsences-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="card card-signup card-plain">
						<div class="modal-header">
							<div class="card-header card-header-primary text-center">
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

										<form method="post"  @submit.prevent="AddAbsence(emp.id)">
											<div class="row">
												<div class="form-group col-md-10 ml-auto mr-auto" >
													<label for="libelle" class="bmd-label-floating">motif</label>
													<input type="text" name="libelle" class="form-control" id="libelle" v-model="form.motif">
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
															<h4 class="card-title">Date</h4>
														</div>
														<input type="hidden" name="type"  v-model="form.type=emp.fonction">
														<div class="card-body ">
															<div class="form-group ">
																<input type="date" name="date" data-date-format='Y-MM-DD' v-model="form.date" class="form-control text-center" >
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-10 ml-auto mr-auto">
													<div class="card ">
														<div class="card-header card-header-rose card-header-text">
															<div class="card-icon">
																<i class="material-icons">av_timer</i>
															</div>
															<h4 class="card-title">du</h4>
														</div>
														<div class="card-body ">
															<div class="form-group ">
																<input type="time"  class="form-control text-center" v-model="form.heure_debut">
															</div>
														</div>
													</div>
												</div>
											</div>

											<div class="row"> 
												<div class="col-md-10 ml-auto mr-auto">
													<div class="card ">
														<div class="card-header card-header-rose card-header-text">
															<div class="card-icon">
																<i class="material-icons">av_timer</i>
															</div>
															<h4 class="card-title"> A </h4>
														</div>
														<div class="card-body ">
															<div class="form-group ">
																<input type="time" class="form-control text-center" v-model="form.heure_fin">
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
		<div class="modal fade bd-Absences-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
									<div class="row">


										<div class="col-md-6">
											<select  class="browser-default custom-select"
											v-model="annee">
											<option   selected hidden>Année !</option>
											<option  v-for="y in years"  :value="y" > {{y}}</option>
										</select>
									</div>
									<div class="col-md-6"> 
										<select  class="browser-default custom-select"
										@change="getAbsenceWorkerByYearMonth($event.target.value,emp.id)" >
										<option  selected >{{currentMounth}}</option>
										<option  v-for="m in mounth" v-if="m!=currentMounth" :value="m" > {{m}}</option>
									</select>										
								</div>


								<div class="col-md-12 ml-auto mr-auto">
									<table class="table table-striped table-no-bordered table-hover">
										<thead class="text-primary">
											<th>date absence</th>
											<th>Du </th>
											<th>A</th>
											<th>Motif</th>
										</thead>
										<tbody>
											<tr v-for="a in absences">
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
				</div>
				<div class="modal-footer justify-content-right ">
					<button data-dismiss="modal"   class=" close btn btn-warning  mt-4 btn-lg">Cancel</button>
				</div>
			</div>
		</div>
	</div>
</div>



</div>
</div>



</template>
<script>
export default {
	props: ['villes','employes'],
	data()
	{
		return {
			Employes :this.employes,
			city: this.villes,
			emp :{},
			show: true,
			indice:false,
			centre:'',
			ville:'',
			annee:'',
			centres:[],
			absences : {},
			mounth:[],
			years:[],
			currentYear:'',
			currentMounth:'',
			form: {
				heure_debut : '',
				heure_fin : '',
				date : '',
				motif : '',
				type : '',
			}
		}
	},
	mounted() {

		for (var i = new Date().getFullYear() ; i >= new Date().getFullYear()-5; i--) {
			this.years.push(i)
		}
		for (var i = 1; i <= 12; i++) {
			this.mounth.push(i)
		}
		this.currentYear= new Date().getFullYear()
		this.currentMounth= new Date().getMonth()+1
		this.annee= this.currentYear
		//this.getListeAbsences()
	//	console.log(this.currentMounth)
	},
	methods:
	{
		getListeAbsencesByCentre() {
			/*if ($('#centre').val()) 
			//{
				axios.get('getListeByCentre')
				.then(({data})=>{
					this.employes =data
					//this.show=false
				})
				.catch(error => {


				})
			//}
		/*	else
			{
				$.notify({
					icon: "error",
					message: "Merci de choisir le centre "
				}, {
					type: 'danger',
					timer: 3000,
					placement: {
						from: 'top',
						align: 'center'
					}
				});
				console.log('Non')
			}*/ 



		},
		getCentre(id)
		{
			this.indice=false
			axios.get('/getCentresByVille/'+id)
			.then(({data})=>{
				this.centres =data
				//console.log(data.length)
				if (data.length>=1) 
				{
					this.indice=true	
				}
				

			})
		},
		getAbsencesEmploye(id) {
			axios.get('/Employe/getAbsencesEmploye/'+id)
			.then(({data})=>{
				//console.log('here'+data)
				$("#mois").val("currentMounth");
				this.emp =data.employe
				this.absences=data.absences
			})			


		},
		getAbsenceWorkerByYearMonth(month,id) {
			axios.get('/Employe/getAbsencesEmploye/'+id+'/'+this.annee+'/'+month)
			.then(({data})=>{
				this.emp =data.employe
				this.absences=data.absences
			})			


		},
		onChangeCentre(e)
		{
			this.centre=e
		},

		AddAbsence(id) 
		{
			//console.log('absence =' +id)
			axios.post('/Employe/makeAbsence/'+id,this.form)
			.then(({data})=>{
				$('.bd-AddAbsences-modal').modal('hide')
				this.viderForm()
				$.notify({
					icon: "done",
					message: "l'absence est bien ajouté pour l'employe "+this.emp.nom
				}, {
					type: 'success',
					timer: 3000,
					placement: {
						from: 'top',
						align: 'right'
					}
				});
			})


		},
		viderForm()
		{
			this.form.heure_debut=''
			this.form.heure_fin=''
			this.form.date=''
			this.form.motif=''
			this.form.type=''
		},
		getEmploye(emp) {
			this.emp=emp
		},

	}
}	
</script>