<template>
	<div>
		<div v-if="show" >
			<div class="card card-login card-hidden col-md-12 ml-auto mr-auto
			"   >
			<div class="card-header card-header-rose text-center">
				<h4 class="card-title">Consultation d'emplois du temps </h4>
			</div>
			<div class="card-body ">
				<div class="input-group">
					<div class="col-md-12" v-show="menu">
						<select  class="browser-default custom-select"  style="display:inline-block" @change="onChangeChoix($event.target.value)" v-model="choix"  data-style="select-with-transition" title="" data-size="100"   required>
							<option value selected hidden>Selectionnez !</option>
							<option value="1"> Groupe </option>
							<option value="2"> Professeur </option>
							<option value="3"> Centre </option>
							<option value="4"> Module </option>
						</select>						
					</div>					

					<div class="col-md-12" v-if="choix==1" style="margin-top:20px;">
						<select  class="browser-default custom-select"  style="display:inline-block" @change="onChangeCentre($event.target.value)" v-model="c"  data-style="select-with-transition" title="" data-size="100"   required>
							<option value="" selected hidden>Selectionnez le centre</option>
							<option    v-for="c in centres"    :value="c.id" >{{c.nom}}</option>
						</select>						
					</div>



					<div  v-if="choix==1" class="col-md-12" style="margin-top:20px;">
						<select id="centres"  class="browser-default custom-select" v-model="cible" style="display:inline-block" data-style="select-with-transition" title="Groupe" data-size="100" required >
							<option  selected  hidden value>Selectionnez le groupe</option>
							<option    v-for="g in groupes"    :value="g.id" >{{g.nom_groupe}}</option>
						</select>
					</div>

					<div  v-if="choix==2" class="col-md-12" style="margin-top:20px;">
						<select  class="browser-default custom-select"  style="display:inline-block"  v-model="cible"  data-style="select-with-transition" title="" data-size="100"   required>
							<option value selected hidden>Selectionnez le professeur</option>
							<option    v-for="p in professeurs"    :value="p.id" >{{p.employe.nom}}</option>
						</select>
					</div>

					<div  v-if="choix==3" class="col-md-12" style="margin-top:20px;">
						<select  class="browser-default custom-select"  style="display:inline-block"  v-model="cible"  data-style="select-with-transition" title="" data-size="100"   required>
							<option value="" selected hidden>Selectionnez le centre</option>
							<option    v-for="c in centres"    :value="c.id" >{{c.nom}}</option>
						</select>	
					</div>
					<div  v-if="choix==4" class="col-md-12" style="margin-top:20px;">
						<select  class="browser-default custom-select"  style="display:inline-block" v-model="cible"  data-style="select-with-transition" title="" data-size="100"   required>
							<option value="" selected hidden>Selectionnez le module</option>
							<option    v-for="m in modules"    :value="m.id" >{{m.nom_module}}</option>
						</select>	
					</div>



				</div>


			</div>
			<div class="card-footer justify-content-center">
				<button v-on:click="getEmplois(cible)" class="btn btn-rose btn-link btn-lg">Ok</button>
			</div>
		</div>
	</div>
	<div v-if="!show && choix==1">
		
		<div class="card card-login card-hidden col-md-12 ml-auto mr-auto
		"  >
		<div class="card-header card-header-rose text-center">
			<h4 class="card-title">l'emplois du temps  du groupe : {{ emplois[0].groupe.nom_groupe}}</h4>
			<h5 class="card-title">Module : {{ emplois[0].module.nom_module}}</h5>
		</div>
		<div class="card-body">
			<button class="btn btn-primary float-right" v-on:click="changerStatut()"> autre groupe !</button>
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
			<table  id="datatables" class="table table-striped table-no-bordered table-hover">
				<thead class="text-primary">

					<th > Jours-Marge horraire</th>
					<th class="text-center" >8-10</th>
					<th class="text-center">10-12</th>
					<th class="text-center">2-4 </th>
					<th class="text-center">4-6 </th>

				</thead>
				<tbody>
					<tr v-for="index in emplois.length" :key="index">
						<th class="text-primary">
							
							{{ jours[index-1].jour }}

							
						</th>

						
						<td class="text-center" >
							<h5 v-if="emplois[index-1].heure_debut>='08:00:00' &&   emplois[index-1].heure_debut<'10:00:00'">Prof : {{ emplois[index-1].prof.employe.nom }} <br> Salle: {{ emplois[index-1].salle.num }}
								<br> {{ emplois[index-1].heure_debut }} -> {{ emplois[index-1].heure_fin }}   </h5>
								<h5 v-else class="text-center"> --- </h5>

							</td>
							


							<td class="text-center" >
								<h5 v-if="emplois[index-1].heure_debut>='10:00:00' && emplois[index-1].heure_debut<'12:00:00' ">Prof : {{ emplois[index-1].prof.employe.nom }} <br> Salle: {{ emplois[index-1].salle.num }} 
									<br> {{ emplois[index-1].heure_debut }} -> {{ emplois[index-1].heure_fin }}</h5>
									<h5 v-else class="text-center"> --- </h5>
								</td>



								<td class="text-center" >
									<h5 v-if="emplois[index-1].heure_debut>='02:00:00' && emplois[index-1].heure_debut<'04:00:00' ">Prof : {{ emplois[index-1].prof.employe.nom }} <br> Salle: {{ emplois[index-1].salle.num }}
										<br> {{ emplois[index-1].heure_debut }} -> {{ emplois[index-1].heure_fin }} </h5>
										<h5 v-else class="text-center"> --- </h5>
									</td >
									


									<td class="text-center" >
										<h5 v-if="emplois[index-1].heure_debut>='04:00:00' && emplois[index-1].heure_debut<'06:00:00' ">Prof : {{ emplois[index-1].prof.employe.nom  }} <br> Salle: {{ emplois[index-1].salle.num }} 
											<br> {{ emplois[index-1].heure_debut }} -> {{ emplois[index-1].heure_fin }}</h5>
											<h5 v-else class="text-center"> --- </h5>
										</td>





									</tr>
								</tbody>
							</table>
						</div>

					</div>
				</div>
				<div class="card card-login card-hidden col-md-12 ml-auto mr-auto
				"  v-if="!show && choix==2">
				<div class="card-header card-header-rose text-center">
					<h4 class="card-title">l'emplois du temps  du Professeur {{ emplois[0].prof.employe.nom}}</h4>
				</div>
				<div class="card-body" >
					<button class="btn btn-primary float-right" v-on:click="changerStatut()"> autre Prof !</button>
					<br>
					<div class="col-md-12">
						<div class="row" >
							<div class="col-sm-4">
								<select class="browser-default custom-select"  @change="onChangeTrimestreProf($event.target.value)" name="trimestre">
									<option  :value="t.trimestre_id" v-for="t in trimestre">{{ t.trimestre.nom }}</option>
								</select>
							</div>
							<div class="col-sm-4 text-center">
								<input width="100%" readonly class="form-control text-center" v-model="date_debut"> 
							</div>
							<div class="col-sm-4 text-center">
								<input width="100%" readonly class="form-control text-center" v-model="date_fin"> 
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
			<div class="card card-login card-hidden col-md-12 ml-auto mr-auto
			"  v-if="!show && choix==4">
			<div class="card-header card-header-rose text-center">
				<h4 class="card-title">l'emplois du temps  du Module {{ emplois[0].module.nom_module}}</h4>
			</div>
			<div class="card-body" >
				<button class="btn btn-primary float-right" v-on:click="changerStatut()"> autre Module !</button>
				<br>
				<div class="col-md-12">
					<div class="row" >
						<div class="col-sm-4">
							<select class="browser-default custom-select"  @change="onChangeTrimestreModule($event.target.value)" name="trimestre">
								<option  :value="t.trimestre_id" v-for="t in trimestre">{{ t.trimestre.nom }}</option>
							</select>
						</div>
						<div class="col-sm-4 text-center">
							<input width="100%" readonly class="form-control text-center" v-model="date_debut"> 
						</div>
						<div class="col-sm-4 text-center">
							<input width="100%" readonly class="form-control text-center" v-model="date_fin"> 
						</div>

					</div> 
					<table class="table table-striped table-no-bordered table-hover">
						<thead class="text-primary">
							<th>Groupe </th>
							<th>Professeur</th>
							<th>Jour</th>
							<th>Du </th>
							<th> A </th>
							<th> Salle </th>
							<th> Centre </th>
						</thead>
						<tbody>
							<tr v-for="e in emplois">
								<td>{{e.groupe.nom_groupe}}</td>
								<td>{{ e.prof.employe.nom }} </td>
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
		<div class="card card-login card-hidden col-md-12 ml-auto mr-auto
		"  v-if="!show && choix==3">
		<div class="card-header card-header-rose text-center">
			<h4 class="card-title">l'emplois du temps  du Centre {{ emplois[0].centre.nom}}</h4>
		</div>
		<div class="card-body" >
			<button class="btn btn-primary float-right" v-on:click="changerStatut()"> autre Centre !</button>
			<br>
			<div class="col-md-12">
				<div class="row" >
					<div class="col-sm-4">
						<select class="browser-default custom-select"  @change="onChangeTrimestreCentre($event.target.value)" name="trimestre">
							<option  :value="t.trimestre_id" v-for="t in trimestre">{{ t.trimestre.nom }}</option>
						</select>
					</div>
					<div class="col-sm-4 text-center">
						<input width="100%" readonly class="form-control text-center" v-model="date_debut"> 
					</div>
					<div class="col-sm-4 text-center">
						<input width="100%" readonly class="form-control text-center" v-model="date_fin"> 
					</div>

				</div> 
				<table class="table table-striped table-no-bordered table-hover">
					<thead class="text-primary">
						<th>Module</th>
						<th>Groupe </th>
						<th>Professeur</th>
						<th>Jour</th>
						<th>Du </th>
						<th> A </th>
						<th> Salle </th>
					</thead>
					<tbody>
						<tr v-for="e in emplois">
							<td>{{ e.module.nom_module }} </td>
							<td>{{e.groupe.nom_groupe}}</td>
							<td>{{ e.prof.employe.nom }} </td>
							<td>{{e.jour.jour}}</td>
							<td>{{e.heure_debut}}</td>
							<td>{{e.heure_fin}}</td>
							<td>{{e.salle.num}}</td>
						</tr>


					</tbody>
				</table>

			</div>
		</div>
	</div>

</div>	
</template>
<script>
export default {
	data()
	{
		return {
			centres : {},
			groupes : {},
			groupe : {},
			trimestre:{},
			c:'',
			date_debut:'',
			date_fin:'',
			emplois :[],
			show:true,
			jours:[],
			choix:'',
			menu:true,
			modles:[],
			professeurs:[],
			cible:'',
			date_debut:'',
			date_fin:'',

		}
	},
	mounted() {
		//console.log('emplois : '+ this.emplois)
		axios.get('/getAllCentres')
		.then(({data})=>{
			this.centres = data

		})
		axios.get('/getAllProf')
		.then(({data})=>{
			this.professeurs = data

		})
		axios.get('/getAllModules')
		.then(({data})=>{
			this.modules = data

		})

	},
	methods:
	{
		onChangeChoix(e) {
			this.choix=e
		},
		onChangeCentre(e) {
			axios.get('/getGroupeByCentre/'+e)
			.then(({data})=>{
				groupes : {}
				$("#centres").val("none");
				this.groupes = data



			})
		},
		getEmplois(cible)
		{
			if(this.choix==1)
			{
				this.groupe=cible
				axios.get('/getEmploisTempsByGroupe/'+this.groupe)
				.then(({data})=>{
					this.emplois = data.emplois
				if(this.emplois.length<1) {
					$.notify({
						icon: "error",
						message: "ce groupe ne posséde pas un emplois du temps"
					}, {
						type: 'danger',
						timer: 3000,
						placement: {
							from: 'top',
							align: 'center'
						}
					});
				}
				else
                {
                	this.trimestre=data.trimestre
					this.date_debut=data.trimestre[0].trimestre.date_debut
					this.date_fin=data.trimestre[0].trimestre.date_fin
					this.jours=data.jours
                    this.show=false
                }
                
					



			})



			}
			else if (this.choix==2) 
			{
				axios.get('/getEmploisByProf/'+this.cible)
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
				if(this.emplois.length<1) {
					$.notify({
						icon: "error",
						message: "ce Prof ne posséde pas un emplois du temps"
					}, {
						type: 'danger',
						timer: 3000,
						placement: {
							from: 'top',
							align: 'center'
						}
					});
				}

				this.show=false
			})


			}
			else if (this.choix==4) 
			{
				axios.get('/getEmploisByModule/'+this.cible)
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
				if(this.emplois.length<1) {
					$.notify({
						icon: "error",
						message: "Il n y a pas de planning pour ce module"
					}, {
						type: 'danger',
						timer: 3000,
						placement: {
							from: 'top',
							align: 'center'
						}
					});
				}
				else
					this.show=false
			})

			}
			else if (this.choix==3) 
			{
				axios.get('/getEmploisByCentre/'+this.cible)
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
				if(this.emplois.length<1) {
					$.notify({
						icon: "error",
						message: "ce Centre ne posséde pas de planning"
					}, {
						type: 'danger',
						timer: 3000,
						placement: {
							from: 'top',
							align: 'center'
						}
					});
				}
				else
					this.show=false
			})


			}


		},
		onChangeGroupe(e)
		{
			this.groupe=e
			this.menu=false
			//console.log(e)
		},
		onChangeTrimestre(t)
		{
			axios.get('/getEmploisByTrimestreByGroupe/'+t+'/'+this.groupe)
			.then(({data})=>{
				this.emplois = data.emplois
				this.date_debut=data.trimestre.date_debut
				this.date_fin=data.trimestre.date_fin
				//this.date_fin=data.date_fin
			//	this.show=false


		})	

		},
		onChangeTrimestreProf(t)
		{
			axios.get('/getEmploisByTrimestreByProf/'+t+'/'+this.cible)
			.then(({data})=>{
				this.emplois = data.emplois
				this.date_debut=data.trimestre.date_debut
				this.date_fin=data.trimestre.date_fin
				//this.date_fin=data.date_fin
			//	this.show=false


		})	
		},
		onChangeTrimestreModule(t)
		{
			axios.get('/getEmploisByTrimestreByModule/'+t+'/'+this.cible)
			.then(({data})=>{
				this.emplois = data.emplois
				this.date_debut=data.trimestre.date_debut
				this.date_fin=data.trimestre.date_fin
				//this.date_fin=data.date_fin
			//	this.show=false


		})	
		},
		onChangeTrimestreCentre(t)
		{
			axios.get('/getEmploisByTrimestreByCentre/'+t+'/'+this.cible)
			.then(({data})=>{
				this.emplois = data.emplois
				this.date_debut=data.trimestre.date_debut
				this.date_fin=data.trimestre.date_fin
				//this.date_fin=data.date_fin
			//	this.show=false


		})	
		},


		changerStatut()
		{
			this.emplois=[]
			$('#centre').val(this.c)
			this.show=true
		}
	}
}
</script>
