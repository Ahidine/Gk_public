<template>
	<div>
		<div class="card card-login card-hidden col-md-6 ml-auto mr-auto
		"  v-if="show" v-model="show">
		<div class="card-header card-header-rose text-center">
			<h4 class="card-title">Consultation d'absences des élèves </h4>
		</div>
		<div class="card-body ">
			<div class="input-group">

				<div class="col-md-12">
					<select  class="browser-default custom-select"  tyle="display:inline-block" @change="getCentre($event.target.value)" v-model="ville" data-style="select-with-transition" title="" data-size="100" required   required>
						<option value="" selected hidden>Selectionner la Ville</option>
						<option    v-for="v in city"    :value="v.id" >{{v.nom}}</option>
					</select>						
				</div>

				
				<div class="col-md-12" style="margin-top:20px;">
					<select  class="browser-default custom-select" id="centre" @change="changeCentre($event.target.value)" style="display:inline-block" data-style="select-with-transition" title="" data-size="100"  required>
						<option  value selected hidden>Selectionner le centre</option>
						<option    v-for="c in centres"    :value="c.id" >{{c.nom}}</option>
					</select>
				</div>





			</div>


		</div>
		<div class="card-footer justify-content-center" v-show="indice">
			<button v-on:click="getListeAbsences()" class="btn btn-rose btn-link btn-lg">Lets Go</button>
		</div>
	</div>
	<div>
		<button  v-if="!show" v-on:click="changeStatut()" class="btn btn-sm btn-rose float-right">Autre centre !</button>
		<table id="datatables" class="table table-striped table-no-bordered table-hover"  v-if="!show">

			<thead class="text-primary">
				<tr> 
					<th>Nom</th>
					<th>Prénom</th>
					<th>Groupe</th>
					<th>Centre</th>
					<th class="text-right">Actions</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="e in students">
					<td>{{e.nom}}</td>
					<td>{{e.prenom}}</td>
					<td>{{e.groupe.nom_groupe}}</td>
					<td>{{e.centre.nom}}</td>
					<td class="td-actions text-right">


						<button type="button" v-on:click="getAbsenceStudent(e.id)" rel="tooltip" data-toggle="modal" data-target=".bd-Absences-modal" class="btn btn-info btn-link" title="voir l'absences">
							<i class="material-icons">
								calendar_today
							</i>
						</button>
						<button type="button" class="btn btn-danger btn-link" data-original-title="" title="Ajouter absences" rel="tooltip" data-toggle="modal" data-target=".bd-AddAbsences-modal" 
						v-on:click="MakeAbsencesStudent(e)">
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
							<h5>{{eleve.nom}} {{eleve.prenom}}</h5>
						</div>

					</div>
				</div>
				<div class="modal-body">
					<div class="card-body">

						<div class="row justify-content-center">
							<div class="col-md-12">

								<form method="post"  @submit.prevent="AddAbsencesStudent(eleve.id)">
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
							<h5>{{eleve.nom}} {{eleve.prenom}}</h5>
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
								@change="getAbsenceStudentByYearMonth($event.target.value,eleve.id)">
								<option   selected hidden>Mois !</option>
								<option  v-for="m in mounth" :selected="m==currentMounth" :value="m" > {{m}}</option>
							</select>										
						</div>


						<div class="col-md-12 ml-auto mr-auto">
							<table class="table table-striped table-no-bordered table-hover">
								<thead class="text-primary">
									<th>date absence</th>
									<th>De </th>
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

</template>
<script>
export default {
	props: ['villes'],
	data()
	{
		return {
			students : [],
			city: this.villes,
			show: true,
			centre:'',
			ville:'',
			annee:'',
			centres:[],
			eleve :{},
			absences : {},
			mounth:[],
			indice: false,
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
		//console.log(this.currentMounth)

	},
	methods:
	{
		getListeAbsences() {
			if ($('#centre').val()) 
			{
			axios.get('/getListeByCentre/'+this.centre)
			.then(({data})=>{
				this.students =data
				this.show=false
			})
			.catch(error => {

				
			})
			}
			else
			{
				$.notify({
					icon: "error",
					message: "Merci de choisir le groupe "
				}, {
					type: 'danger',
					timer: 3000,
					placement: {
						from: 'top',
						align: 'center'
					}
				});
				//console.log('Non')
			}
			

		},
		getAbsenceStudent(id) {
			axios.get('/getAbsenceStudent/'+id)
			.then(({data})=>{
				this.eleve =data.eleve
				this.absences=data.absences
			})			


		},
		getAbsenceStudentByYearMonth(month,id) {
			axios.get('/getAbsenceStudent/'+id+'/'+this.annee+'/'+month)
			.then(({data})=>{
				this.eleve =data.eleve
				this.absences=data.absences
			})			


		},
		AddAbsencesStudent(id)
		{
			axios.post('/AddAbsenceStudent/'+id,this.form)
			.then(({data})=>{
				//console.log(data)
				$('.bd-AddAbsences-modal').modal('hide')
				this.viderForm()
				$.notify({
					icon: "done",
					message: "l'absence est bien ajouté pour l'élève "+this.eleve.nom
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
		MakeAbsencesStudent(eleve)
		{
			this.eleve=eleve

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
				
				this.students=[]
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
		changeStatut()
		{
			this.show=true
			this.centre=''
			this.students=[]
		},
		changeCentre(e)
		{
			this.centre=e
		}
	}
}	
</script>