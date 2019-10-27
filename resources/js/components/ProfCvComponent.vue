<template>
	<div class="table-responsive">
		<div class="text-right">
			<a type="button"  class="btn btn-sm btn-rose text-black" v-on:click="AddRow()">Ajoute une ligne
				<i class="material-icons">add</i>
			</a>

		</div>
		<table class="table table-striped table-no-bordered table-hover">
			<thead class="text-primary">
				<th>Diplome</th>
				<th>Ecole</th>
				<th>Spécialité</th>
				<th>Date_obtention</th>
				<th>Action</th>
			</thead>
			<tbody>
				<tr v-for="row in rows">
					<td><input type="text" class="form-control" name="diplome[]"></td>
					<td><input type="text" class="form-control" name="ecole[]"></td>
					<td><input type="text" class="form-control" name="specialite[]"></td>
					<td><input  type="date"     class="form-control" name="date_obtention[]"></td>
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
		data()
		{
			return {
				rows :[],

			}
		},
		mounted() {
			//console.log('here'+this.rows.length)
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
