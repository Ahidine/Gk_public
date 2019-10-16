<template>
	<div class="table-responsive">
		<div class="text-right">
			<a type="button"  class="btn btn-sm btn-rose text-black" v-on:click="AddRow()">Add row
				<i class="material-icons">add</i>
			</a>

		</div>
		<table class="table table-striped table-no-bordered table-hover">
			<thead class="text-primary">
				<th>Diplome</th>
				<th>Ecole</th>
				<th>Spécialité</th>
				<th>Date d'obtention</th>
				<th>Action</th>
			</thead>
			<tbody>

				<tr v-for="row in rows">
					<td><input type="text" :value="row.intitule" class="form-control" name="diplome[]"></td>
					<td><input type="text" :value="row.ecole" class="form-control" name="ecole[]"></td>
					<td><input type="text" :value="row.specialite" class="form-control" name="specialite[]"></td>
					<td><input  type="date"  :value="row.date_obtention"   class="form-control" name="date_obtention[]"></td>
						<td>                                         
						 <button type="button" v-on:click="RemoveRow(row)" class="btn btn-danger btn-link"  title="Supprime" >
							<i class="material-icons">close</i>
							<div class="ripple-container"></div>
						</button></td>

					</tr>
				</tbody>
			</table>
		</div>


	</template>
	<script >
	export default {
		props: ['professeur'],
		data()
		{
			return {
				rows : this.professeur.diplomes,

			}
		},
		mounted() {
			//console.log('here'+this.rows)
		},
		methods:
		{

			AddRow() {
				this.rows.push({})
				//console.log(this.rows)


			},
			RemoveRow(index) {
				this.rows.splice(this.rows.indexOf(index),1)
			},
		}
	}
	</script>