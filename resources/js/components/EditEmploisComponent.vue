<template>
	<div>

		<div>

			<div class="card card-login card-hidden col-md-12 ml-auto mr-auto
			"  >
			<div class="card-header card-header-rose text-center">
				<h4 class="card-title">l'emplois du temps  pour groupe : {{ groupe.nom_groupe}}</h4>
			</div>
			<div class="card-body">
				<div class="col-md-12 ">
					<div class="row">
						<button type="button" class="btn btn-success col-md-3 ml-auto" v-on:click="AddRow()"> Ajouter une ligne !</button>
					</div>
					<div class="row" style="margin-top:20px;">
						<div class="col-sm-4">
							<select class="browser-default custom-select"  @change="onChangeTrimestre($event.target.value)" name="trimestre" required>
								<option  v-for="t in trimestre" :value="t.trimestre.id">{{ t.trimestre.nom }}</option>
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
						<table id="" class="table table-striped">
							<thead>
								<tr>
									<th width="20%" >Jour</th>
									<th width="10%" >Du </th>
									<th width="10%" > A </th>
									<th width="20%" > Professeur </th>
									<th width="10%" > Module </th>
									<th width="20%" > Salle </th>
									<th width="10%" > Action </th>
								</tr>
							</thead>
							<tbody>
								<input type="hidden" name="groupe" :value="groupe.id"> 
							<tr v-for="e in emplois" >
								<td width="20%">
									<select style="display:block" name="jours[]" class="browser-default custom-select" data-style="select-with-transition" title="" data-size="100" required>
										 
										<option v-for="d in Jours" :value="d.id" :selected="d.id==e.jour.id"  >{{d.jour}}</option>                 
									</select>

								</td>

								<td width="10%"> <input type="time" class="form-control timepicker"  name="heureD[]" :value="e.heure_debut" required> </td>
								<td width="10%"> <input type="time" class="form-control timepicker"  name="heureF[]" :value="e.heure_fin" required> </td>
								<td width="20%"> 
									<select style="display:block" name="prof[]" class="browser-default custom-select" data-style="select-with-transition" title="" data-size="100" required>
										  
										<option v-for="p in Prof" :selected="p.id==e.prof.id" :value="p.id_prof">{{p.nom}}</option>                 
									</select>
								</td>
								<td width="10%"> 
									<select style="display:block" name="modules[]" class="browser-default custom-select" data-style="select-with-transition" title="" data-size="100" required> 

										<option v-for="m in modules" :selected="m.module_id==e.module.id" :value="m.module.id">
										{{m.module.nom_module}}</option>                 
									</select>
								</td>
								<input type="hidden" name="centre" :value="cent">
								<td width="20%"> 
									<select style="display:block" name="salles[]" class="browser-default custom-select" data-style="select-with-transition" title="" data-size="100" required>
										<option  selected hidden value>Salle !</option>  
										<option v-for="s in Salle" :selected="s.id==e.salle.id" :value="s.id">{{s.num}}-{{s.capacite}}</option>                 
									</select>
								</td>
								<td width="10%"> 						
									<button type="button" class="btn btn-danger btn-link" data-original-title="" title="" 
									v-on:click="RemoveItem(e)">
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
	props: ['Groupe'],
	data()
	{
		return {
			groupe : this.Groupe,
			emplois :[],
			trimestre:[],
			modules:[],
			date_debut:'',
			date_fin:'',
			cent:'',
			i:1,
			row:[
			{id: 0}
			],
			show:true,
			Jours:[],
			Prof:[],
			Salle:[],

		}
	},
	mounted() {
		//console.log('emplois : '+ this.emplois)
		axios.get('/getEmploisTempsByGroupe/'+this.groupe.id)
		.then(({data})=>{
			this.emplois = data.emplois		
			this.cent = this.emplois[0].centre_id	
			this.trimestre=data.trimestre
			this.date_debut=data.trimestre[0].trimestre.date_debut
			this.date_fin=data.trimestre[0].trimestre.date_fin

		})
		axios.get('/getGroupeByCentre/'+this.groupe.id)
		.then(({data})=>{
			groupes : {}
			this.groupes = data.groupe
			this.Jours=data.jours
			this.Prof=data.prof
			this.Salle=data.salles	

		})
		axios.get('/getModulesByGroupe/'+this.groupe.id)
		.then(({data})=>{
			groupes : {}
			this.modules = data


		})



	},
	methods:
	{

		onChangeTrimestre(t)
		{
			axios.get('/getEmploisByTrimestreByGroupe/'+t+'/'+this.groupe.id)
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
			$('#centre').val(this.cent)
			this.show=true
		},
		AddRow()
		{
			this.row.push({ id : (this.i)+1})
			this.i=this.i+1
		},
		RemoveRow(e)
		{
			var index = this.getElementByIndex(e,this.row)
			console.log(index)
			this.row.splice(index,1)
		},
		RemoveItem(e)
		{
			var index = this.getElementByIndex(e,this.emplois)
			this.emplois.splice(index,1)
		},
		getElementByIndex(element,model)
			{
				const index= model.findIndex( 
					(elementCh) => {
						if(element==elementCh)
							return true;
					});
				return index;
			}
	}
}
</script>

