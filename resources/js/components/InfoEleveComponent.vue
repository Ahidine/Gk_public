<template>
	<div>
		<table class="table  table-striped table-no-bordered table-hover" id="datatables" style="width:100% !important">
			<thead class="text-primary">
				<tr> 
					<th>Nom</th>
					<th>Prénom</th>
					<th>Niveau</th>
					<th>Groupe</th>
					<th>Centre</th>
					<th>Commerciale interne</th>
					<th>Commerciale externe</th>
					<th class="text-right">Actions</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="e in stud">
					<td>{{e.nom}}</td>
					<td>{{e.prenom}}</td>
					<td>{{e.type}}</td>
					<td>{{e.nom_groupe}}</td>
					<td>{{e.centre_nom}}</td>
					<td v-if="e.resInt">{{e.resInt}}</td>
					<td v-else class="text-center">-</td>
					<td v-if="e.resExt">{{e.resExt}}</td>
					<td v-else class="text-center">-</td>
					<td class="td-actions text-right">


						<button type="button" v-on:click="getStudentInfo(e.id)" rel="tooltip" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-info btn-link">
							<i class="material-icons">person</i>
						</button>
						<button type="button"  class="btn btn-danger btn-link" data-original-title="" title="" 
						v-on:click="Suppsubmit(e)">
						<i class="material-icons">close</i>
						<div class="ripple-container"></div>
					</button>


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
									<li class="nav-item text-center" style="width:30%; " >
										<a class="nav-link active" href="#profile" data-toggle="tab">
											<i class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i> Elève
											<div class="ripple-container"></div>
										</a>
									</li>
									<li class="nav-item text-center" style="width:30%; ">
										<a class="nav-link"  href="#messages" data-toggle="tab">
											<i class="fas fa-restroom fa-2x"></i> ses parents
											<div class="ripple-container"></div>
										</a>
									</li>
									<li class="nav-item text-center" style="width:30%; " >
										<a class="nav-link text-center" href="#settings" data-toggle="tab">
											<i class="fas fa-dollar-sign fa-2x"></i> paiement
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
													<h4 class="card-title">Info Personnels</h4>
												</div>
											</div>
											<div class="card-body ">

												<div class="row">
													<label class="col-sm-4 col-form-label">Nom </label>
													<div class="col-sm-4">
														<div class="form-group">
															<input type="text"  :value="eleve.nom" readonly class="form-control">
														</div>
													</div>
												</div>
												<div class="row">
													<label class="col-sm-4 col-form-label">Prenom</label>
													<div class="col-sm-4">
														<div class="form-group">
															<input type="text" :value="eleve.prenom" readonly class="form-control">
														</div>
													</div>
												</div>
												<div class="row">
													<label class="col-sm-4 col-form-label">Age</label>
													<div class="col-sm-4">
														<div class="form-group">
															<input type="text"  :value="eleve.age+' Ans'" readonly class="form-control">
														</div>
													</div>
												</div>
												<div class="row">
													<label class="col-sm-4 col-form-label">Sex</label>
													<div class="col-sm-4">
														<div class="form-group">
															<input type="text" class="form-control" readonly  :value="eleve.sex==1? 'Garcon' : 'Fille'">
														</div>
													</div>
												</div>
												<div class="row">
													<label class="col-sm-4 col-form-label">Nationalite</label>
													<div class="col-sm-4">
														<div class="form-group">
															<input type="text" :value="eleve.nationalite" readonly class="form-control">
														</div>
													</div>
												</div>
												<div class="row">
													<label class="col-sm-4 col-form-label">Adresse</label>
													<div class="col-sm-4">
														<div class="form-group">
															<input type="text" :value="eleve.adresse" readonly class="form-control">
														</div>
													</div>
												</div>



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
													<h4 class="card-title">PARENTS</h4>
												</div>
											</div>
											<div class="card-body ">

												<div class="row">
													<label class="col-sm-4 col-form-label">Nom de mére</label>
													<div class="col-sm-4">
														<div class="form-group">
															<input type="text" readonly :value="mere.nom_complet"class="form-control">
														</div>
													</div>
												</div>
												<div class="row">
													<label class="col-sm-4 col-form-label">Nom du pére</label>
													<div class="col-sm-4">
														<div class="form-group">
															<input type="text"  readonly :value="pere.nom_complet"  class="form-control">
														</div>
													</div>
												</div>
												<div class="row">
													<label class="col-sm-4 col-form-label">Numéro de mére</label>
													<div class="col-sm-4">
														<div class="form-group">
															<input type="text" readonly :value="mere.tel_mobile"  class="form-control">
														</div>
													</div>
												</div>
												<div class="row">
													<label class="col-sm-4 col-form-label">Numéro du pére</label>
													<div class="col-sm-4">
														<div class="form-group">
															<input type="text" readonly :value="pere.tel_mobile" class="form-control">
														</div>
													</div>
												</div>
												<div class="row">
													<label class="col-sm-4 col-form-label">Numéro fixe</label>
													<div class="col-sm-4">
														<div class="form-group">
															<input type="text" readonly :value="mere.tel_fixe" class="form-control">
														</div>
													</div>
												</div>
												<div class="row">
													<label class="col-sm-4 col-form-label">Email de mére</label>
													<div class="col-sm-4">
														<div class="form-group">
															<input type="text" readonly :value="mere.email"class="form-control">
														</div>
													</div>
												</div>
												<div class="row">
													<label class="col-sm-4 col-form-label">Email de pére</label>
													<div class="col-sm-4">
														<div class="form-group">
															<input type="text" readonly :value="pere.email"class="form-control">
														</div>
													</div>
												</div>

											</div>
										</div>
									</div>

								</div> 
							</div>
							<div class="tab-pane" id="settings">

								<div class="row">
									<div class=" col-sm-4 text-right">
										<select  id="selectYear" class="browser-default custom-select"
										@change="getPaiementByYear(eleve.id,$event.target.value)">
										<option  v-for="y in years" :value="y" :selected="y==currentYear" > {{y}}</option>
									</select>
								</div>
							</div>

							<div  class="row">
								<table class="table table-striped table-no-bordered table-hover col-md-10 ml-auto mr-auto">
									<thead class="text-primary">
										<th>Modalite</th>
										<th>Date de paiement</th>
										<th>Montant </th>
										<th>Mode de paiement</th>
										<th>statut</th>
									</thead>
									<tbody>
										<tr v-for="paiements in paiements">
											<td>{{paiements.modalite}}</td>
											<td>{{paiements.date_reg}}</td>
											<td>{{paiements.montant}} {{paiements.devise}}</td>
											<td>{{paiements.mode_paiement}}</td>
											<td v-if="paiements.etat">Payé</td>
											<td v-else>Non</td>
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
</template>
<script>
export default {
	props: ['student'],
	data()
	{
		return {
			stud : this.student,
			eleve :{},
			parents : [],
			pere :{},
			mere : {},
			years: [],
			paiements : [],
            currentYear:'',


		}
	},
	mounted() {
        this.currentYear=new Date().getFullYear();
		for (var i = new Date().getFullYear()+2 ; i >= new Date().getFullYear()-5; i--) {
			this.years.push(i)
		}

	},
	methods:
	{
		Suppsubmit(id) {
			if (confirm('Are you sure you want to delete this student?'))
			{
				//console.log(this.stud.indexOf(id))

				axios.delete('/Eleve/'+id.id)
				.then(resp=>{
					this.stud.splice(this.stud.indexOf(id),1)

				$.notify({
					icon: "error",
					message: " l'élève est supprimé"
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
		getStudentInfo(id) {

			axios.get('/getInfo/'+id)
			.then(({data})=>{
				//console.log(data)
				this.parents = data.eleve_info.parents
				this.paiements = data.eleve_paiement
				this.eleve = data.eleve_info
               // $("#selectYear").val("this.currentYear");
				if (this.parents[0].type_parite) {
					this.pere=this.parents[0]
					this.mere=this.parents[1]
				}
				else
				{
					this.pere=this.parents[1]
					this.mere=this.parents[0]				
				}




			})

		},
		getPaiementByYear(id,year)
		{
			axios.get('/getPaiementByYear/'+id+'/'+year)
			.then(({data})=>{
				//console.log(data)
				this.paiements = data
			})

		}
	}
}	
</script>
