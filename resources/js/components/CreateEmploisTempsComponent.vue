<template>
	<div>
		<div v-if="show" >
			<div class="card card-login card-hidden col-md-12 ml-auto mr-auto
			"   >
			<div class="card-header card-header-rose text-center">
				<h4 class="card-title">Creation d'emplois du temps </h4>
			</div>
			<div class="card-body ">
				<div class="input-group">

					<div class="col-md-12">
						<select  class="browser-default custom-select"  style="display:inline-block" @change="onChangeCentre($event.target.value)" v-model="cent" id="centre" data-style="select-with-transition" title="" data-size="100"   required>
							<option value="" selected hidden>Selectionnez le centre</option>
							<option    v-for="c in centres"    :value="c.id" >{{c.nom}}</option>
						</select>						
					</div>



					<div class="col-md-12" style="margin-top:20px;">
						<select  class="browser-default custom-select" @change="onChangeGroupe($event.target.value)" style="display:inline-block" data-style="select-with-transition" title="Groupe" data-size="100" required >
							<option  selected  hidden>Selectionnez le groupe</option>
							<option    v-for="g in groupes"    :value="g.id" >{{g.nom_groupe}}</option>
						</select>
					</div>


				</div>


			</div>
			<div class="card-footer justify-content-center">
				<button type="button" v-on:click="getGroupe()" class="btn btn-rose btn-link btn-lg">Ok</button>
			</div>
		</div>
	</div>
	<div v-if="!show">
		
		<div class="card card-login card-hidden col-md-12 ml-auto mr-auto
		"  >
		<div class="card-header card-header-rose text-center">
			<h4 class="card-title">l'emplois du temps  pour groupe : {{ groupe.nom_groupe}}</h4>
		</div>
		<div class="card-body">
			<div class="col-md-12 ">
				<div class="row">
					<button class="btn btn-primary col-md-3" v-on:click="changerStatut()"> Autre groupe !</button>
					<button class="btn btn-success col-md-3 ml-auto" v-on:click="AddRow()"> Add row !</button>
				</div>
				<div class="row" style="margin-top:20px;">
					<div class="col-sm-4">
						<select class="browser-default custom-select"  @change="onChangeTrimestre($event.target.value)" name="trimestre" required>
							<option value="" selected>Selectionner Trimestre</option>
							<option :value="t.id" v-for="t in trimestre">{{ t.nom }}</option>
						</select>
					</div>
					<div class="col-sm-4 text-center">
						<input width="100%" readonly class="form-control text-center" v-model="date_debut"> 
					</div>
					<div class="col-sm-4 text-center">
						<input width="100%" readonly class="form-control text-center" v-model="date_fin"> 
					</div>

				</div>
				<div class="table-responsive container" >
					<table id="datatables" class="table table-striped">
						<thead>
							<tr>
								<th width="10%" >Jour</th>
								<th width="20%" >Du </th>
								<th width="20%" > A </th>
								<th width="20%" > Professeur </th>
								<th width="10%" > Module </th>
								<th width="10%" > Salle </th>
								<th width="10%" > Action </th>
							</tr>
						</thead>
						<tbody>
							<input type="hidden" name="groupe" :value="groupe.id"> 
							<tr v-for="c in row" >
								<td width="10%">
									<select style="display:block" name="jours[]" class="browser-default custom-select" data-style="select-with-transition" title="" data-size="100" required>
										<option  selected hidden value>jours</option> 
										<option v-for="d in Jours" :value="d.id">{{d.jour}}</option>                 
									</select>

								</td>

								<td width="10%"> <input type="time" class="form-control timepicker"  name="heureD[]" required> </td>
								<td width="10%"> <input type="time" class="form-control timepicker"  name="heureF[]" required> </td>
								<td width="20%"> 
									<select style="display:block" name="prof[]" class="browser-default custom-select" data-style="select-with-transition" title="" data-size="100" required>
										<option  selected hidden value>Prof !</option>  
										<option v-for="p in Prof" :value="p.id">{{p.employe.nom}}</option>                 
									</select>
								</td>
								<td width="20%"> 
									<select style="display:block" name="modules[]" class="browser-default custom-select" data-style="select-with-transition" title="" data-size="100" required>
										<option  selected hidden value>Module !</option>  
										<option v-for="m in modules" :value="m.module.id">{{m.module.nom_module}}</option>                 
									</select>
								</td>
									<input type="hidden" name="centre" :value="cent">
								<td width="20%"> 
									<select style="display:block" name="salles[]" class="browser-default custom-select" data-style="select-with-transition" title="" data-size="100" required>
										<option  selected hidden value>Salle !</option>  
										<option v-for="s in Salle" :value="s.id">{{s.num}}-{{s.capacite}}</option>                 
									</select>
								</td>
								<td width="10%"> 						
									<button type="button" class="btn btn-danger btn-link" data-original-title="" title="" 
									v-on:click="RemoveRow(c)">
									<i class="material-icons">close</i>
									<div class="ripple-container"></div>
								</button>
								</td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>





		</div>
	</div>
</div>

</div>	
</template>
<script>
export default {
	props:['prof','salle','jours'],
	data()
	{
		return {
			centres : {},
			cent:'',
			groupes : {},
			groupe : {},
			emplois :[],
			trimestre:[],
			modules:[],
			date_debut:'',
			date_fin:'',
			i:0,
			row:[
			0
			],
			show:true,
			Jours:this.jours,
			Prof:this.prof,
			Salle:this.salle,

		}
	},
	mounted() {
		//console.log('emplois : '+ this.emplois)
		axios.get('/getAllCentres')
		.then(({data})=>{
			this.centres = data
			
			
		})
		axios.get('/getAllTrimestre')
		.then(({data})=>{
			this.trimestre = data
			
			
		})

	},
	methods:
	{

		onChangeCentre(e) {
			axios.get('/getGroupeByCentre/'+e)
			.then(({data})=>{
				groupes : {}
				this.groupes = data
				this.cent=e
				

			})

		},
		getGroupe()
		{
			//console.log(this.groupe)
			
			axios.get('/getGroupe/'+this.groupe)
			.then(({data})=>{
				this.groupe=data
				this.show=false



			})	
			axios.get('/getModulesByGroupe/'+this.groupe)
			.then(({data})=>{
				groupes : {}
				this.modules = data
				

			})
		},
		onChangeTrimestre(t)
		{
			axios.get('/getTrimestreById/'+t)
			.then(({data})=>{
				this.date_debut=data.date_debut
				this.date_fin=data.date_fin
				this.show=false



			})	

		},
		onChangeGroupe(e)
		{
			this.groupe=e
			//console.log(e)
		},
		changerStatut()
		{
			$('#centre').val(this.cent)
			this.show=true
		},
		AddRow()
		{
			this.row.push((this.i)+1)
			this.i=this.i+1
		},
		RemoveRow(e)
		{
			//console.log(this.row)
			var index = this.row.indexOf(e);
			///console.log(index)
			//console.log('/////')
			this.row.splice(this.row.indexOf(e),1)
		}
	}
}
</script>

