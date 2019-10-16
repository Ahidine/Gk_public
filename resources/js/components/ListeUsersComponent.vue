<template>
		<table class="table" id="datatables">
			<thead class="text-primary">
				<tr> 
					<th>Centre</th>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Sex</th>
					<th>Fonction </th>
					<td>Statut </td>
					<th class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="em in users">
					<td class="text-center">{{ em.employe.centre.nom }}</td>
					<td class="text-center">{{ em.employe.nom }}</td>
					<td class="text-center">{{ em.employe.prenom }}</td>
					<td v-if="em.employe.sex" class="text-center">
						Homme
					</td>
					<td v-else class="text-center">
						Homme
					</td>
					<td class="text-center">{{ em.employe.fonction }}</td>
					<td class="text-center">{{ em.employe.date_affectation }}</td>
					<td class="td-actions text-center">
						
						<a  rel="tooltip" v-on:click="Suppsubmit(em.id)" class="btn btn-danger btn-link" data-original-title="" title="supprimer" >
							<i class="material-icons">close</i>
							<div class="ripple-container"></div>
						</a>


				</td>
			</tr>

		</tbody>
	</table>	
</template>
<script >
	export default {
	props: ['users'],
	data()
	{
		return {
			Users:this.users
		}
	},
	mounted() {
		
	},
	methods:
	{
		Bloquer(id) {

			axios.get('/BloqueUser/'+id)
			.then(({data})=>{
					$.notify({
					icon: "error",
					message: "l'utilisateur  "
				}, {
					type: 'danger',
					timer: 3000,
					placement: {
						from: 'top',
						align: 'center'
					}
				});
				//console.log('Non')

			})
			.catch(error => {

			
				
			})
	

			



		},


	}
}	
</script>