<template>
	<div>
		<div class="card card-login card-hidden col-md-6 ml-auto mr-auto
		"  v-if="show" v-model="show">
		<div class="card-header card-header-rose text-center">
			<h4 class="card-title"> Espace Utilisateurs</h4>
		</div>
		<div class="card-body text-right ">
			<div class="input-group">

				<select  class=" col-md-6 ml-auto mr-auto
				browser-default custom-select text-right" v-model="role" tyle="display:inline-block" data-style="select-with-transition" title="" data-size="100" required   required>
				<option value="" selected hidden>Selectionnez</option>
				<option  value="Professeur" >Professeur</option>
				<option  value="Responsable_Commericale" >Responsable Commerciale</option>
				<option  value="Eleve" >Eleve</option>
				<option  value="Responsable_pedagogique" >Responsable Pedagogique</option>
			</select>

		</div>


	</div>
	<div class="card-footer justify-content-center">
		<button v-on:click="getData()" class="btn btn-rose btn-link btn-lg">Ok</button>
	</div>
</div>
<div v-if="!show">
	<button  class="btn btn-sm btn-rose float-right" v-on:click="AddAutreUser">
		Bloquer autre utilisateur
	</button> 
	<table id="datatable" class="table table-striped table-no-bordered table-hover"
	>

	<thead class="text-primary">

		<th >Centres</th>
		<th >Nom</th>
		<th >Prénom</th>
		<th >Sex</th>
		<th>Est Bloqué </th>
		<th> Actions</th>

	</thead>
	<tbody >

		<tr  v-for="em in employes"  v-if="typeof em.employe !='undefined'">
			<td v-if="em.employe.fonction=='Responsable_commerciale' || em.employe.fonction=='Professeur' || em.employe.fonction=='Responsable_pedagogique' ">
			<select   class="browser-default custom-select text-center" data-size="7" data-style="select-with-transition"    >
						<option  v-for="c in em.employe.centre"  > {{c.nom}}</option>
					</select>
			</td>
			<td v-else > 
						<select   class="browser-default custom-select text-center" data-size="7" data-style="select-with-transition"    >
						<option  v-for="c in em.centre"  > {{c.nom}}</option>
					</select> </td>
			<td >
				{{ em.employe.nom }}
			</td>
			<td >
				{{ em.employe.prenom }}
			</td >
			<td  v-if="em.employe.sex">
				Homme
			</td>
			<td v-else>
				Femme
			</td>      
			<td v-if="em.user.IsBlocked "> YES </td>
			<td v-else> NON  </td>
			<td class="td-actions " > 




				<a v-if="em.user.IsBlocked " rel="tooltip" class="btn btn-success btn-link add" data-original-title="add user" title="Debloquer user" v-on:click="DeBloqueUser(em.user.id)">
					<i class="material-icons">add</i>
					<div class="ripple-container"></div>
				</a>
				<a  v-else rel="tooltip" v-on:click="BloqueUser(em.user.id)" class="btn btn-danger btn-link" data-original-title="" title="Bloquer" >
					<i class="material-icons">close</i>
					<div class="ripple-container"></div>
				</a>

			</td>
		</tr>
		<tr v-if="student.length > 0" v-for="s in student" >
			<td >
				{{ s.centre.nom }}
			</td>
			<td >
				{{ s.nom }}
			</td>
			<td >
				{{ s.prenom }}
			</td >
			<td  v-if="s.sex">
				Garcon
			</td>
			<td v-else>
				Fille
			</td>      
			<td v-if="s.user.IsBlocked "> YES </td>
			<td v-else> NON </td>
			<td class="td-actions " > 
				<a v-if="s.user.IsBlocked " rel="tooltip" class="btn btn-success btn-link add" data-original-title="add user" title="Debloquer user" v-on:click="DeBloqueUser(s.user.id)">
					<i class="material-icons">add</i>
					<div class="ripple-container"></div>
				</a>
				<a  v-else rel="tooltip" v-on:click="BloqueUser(s.user.id)" class="btn btn-danger btn-link" data-original-title="" title="Bloquer" >
					<i class="material-icons">close</i>
					<div class="ripple-container"></div>
				</a>

			</td>
		</tr>
	</tbody>
</table>
</div>


<div class="modal fade bd-add-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="card card-signup card-plain">
				<div class="modal-header">
					<div class="card-header card-header-warning text-center">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<i class="material-icons">clear</i>
						</button>
						<div class="card-title">
							<h4 >ajout d'un utilisateur </h4>
							<h5>{{user.nom}} {{user.prenom}}</h5>
						</div>

					</div>
				</div>
				<div class="modal-body">
					<div class="card-body">

						<div class="row justify-content-center">
							<div class="col-md-12">
								<form class="form" method="post" @submit.prevent="AddUser">
									<div class="row">
										<label class="col-sm-4 col-form-label">email </label>
										<div class="col-sm-8">
											<div class="form-group">
												<input type="text" readonly  :value="user.email"class="form-control text-center">
											</div>
										</div>
									</div>
									<div class="row">
										<label class="col-sm-4 col-form-label">password</label>
										<div class="col-sm-8">
											<div class="form-group">
												<input type="password"readonly :value="user.password"  class="text-center form-control">
											</div>
										</div>
									</div>
									<div class="text-center">
										<input type="submit" value="Add"  class="btn btn-primary btn-link btn-wd btn-lg">
									</div>
								</form>
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





</div>	







</template>
<script>
export default {
	
	data()
	{
		return {
			employes :{},
			user :{
				nom:'',
				prenom:'',
				email:'',
				password : '',
				id:'',
				fonction: '',
			},
			role:'',
			pass:'',
			student: '',
			show:true,
		}
	},
	mounted() {
		//console.log('')
	},
	methods:
	{
		BloqueUser(id)
		{
			axios.get('/BloqueUser/'+id)
			.then(({data})=>{
			this.getData()
			$.notify({
					icon: "error",
					message: "l'operation est effectué  "
				}, {
					type: 'danger',
					timer: 3000,
					placement: {
						from: 'top',
						align: 'center'
					}
				});
			})	
		},
		DeBloqueUser(id)
		{
			//console.log(id)
			axios.get('/DeBloqueUser/'+id)
			.then(({data})=>{
				this.getData()
			$.notify({
					icon: "done",
					message: "l'operation est effectué  "
				}, {
					type: 'success',
					timer: 3000,
					placement: {
						from: 'top',
						align: 'center'
					}
				});
			})	
		},

		getData()
		{
			this.show=false
			this.employes=[]
			this.student=[]
			if (this.role=='Professeur') 
			{
				axios.get('/getProfUser')
				.then(({data})=>{
					//console.log(data)
					this.employes=data
				})
			}
			else if (this.role=='Responsable_Commericale') {
				axios.get('/getRCUser')
				.then(({data})=>{
					this.employes=data;
				})	
			}
			else if (this.role=='Responsable_pedagogique') 
			{
				axios.get('/getRPUser')
				.then(({data})=>{
					this.employes=data;
				})
			}
			else if (this.role=='Eleve') 
			{
				axios.get('/getEleveUser')
				.then(({data})=>{
					this.student=data;
				})
			}

			//console.log(this.role)

		},
		getEmailPassord(em) {
			this.user.email=em.employe.email
			this.user.nom=em.employe.nom
			this.user.prenom=em.employe.prenom
			this.user.id=em.id
			this.user.fonction=em.employe.fonction
			this.user.password= Math.random().toString(36).slice(2)
		},
		getEmailPassordStudent(s) {
			//console.log(s)
			this.user.email=s.parents[0].email
			this.user.nom=s.nom
			this.user.prenom=s.prenom
			this.user.id=s.id
			this.user.fonction='Eleve'
			this.user.password= Math.random().toString(36).slice(2)
		},
		AddAutreUser()
		{
			this.show=true
		},
		AddUser() {
			axios.post('/AddUser',this.user)
			.then(({data})=>{
				window.location.reload()
			})


		},

	}
}	
</script>