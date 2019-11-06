	<template>
		<div>

			<div  class="row" >
				<label class="col-sm-2 col-form-label">Combien de classe ? </label>
				<div class="col-sm-7">
					<div class="form-group text-center">
						<input type="number"  v-model="nombreClasse" class="form-control">

					</div>


				</div>
				<button  type="button" class="btn btn-success btn-link add col-sm-2"  v-on:click="AddRows()" data-toggle="modal" > 
					<i class="material-icons"> add</i>
					Ajouter 
				</button>

			</div>

			<div class="row col-md-8 ml-auto mr-auto" v-if="rows.length" >
				<table id="datatables" class="table table-striped">
					<thead  class="text-primary">
						<tr>

							<th>Nom </th>
							<th>Capcité</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="r in  rows" >

							<td class="text-center" >
								<div class="form-group">
									<input  v-if="r.num" type="text" class="form-control" :value="r.num" name="classes[]">
									<input v-else type="text" class="form-control" name="classes[]">
								</div>

							</td>
							<td class="text-center">
								<input  v-if="r.capacite" type="number" class="form-control" :value="r.capacite" name="Capacite[]">
						
								<input v-else type="number" class="form-control" name="Capacite[]">


							</td>
							<td class="text-center">				
								<button type="button" v-on:click="RemoveRow(r)" class="btn btn-danger btn-link"  title="Supprime" >
									<i class="material-icons">close</i>
									<div class="ripple-container"></div>
								</button></td>
							</tr>

						</tbody>
					</table>

				</div>
			</div>

		</template>

		<script >
		export default {
			props: ['centre'],
			data()
			{
				return {
					nombreClasse: '',
					rows : [],
					errors: {},
					Centre : this.centre


				}
			},
			mounted() {
				axios.get('/getClassOfCentre/'+this.Centre.id)
				.then(({data})=>{
					this.rows = data

				})
			},
			methods:
			{

				AddRows() {
					console.log("hello word")
					for (var i = 0; i < this.nombreClasse; i++) {
						this.rows.push({ 
							id : i})
					}

				},
				RemoveRow(row)
				{
					if (confirm('Vous êtes sûr de supprimer cette classe ?'+row.id))
					{

					//window.location.reload()

					this.rows.splice(this.getElementByIndex(row),1);

					//console.log(resp)

				}
				else
				{
				//console.log('non'+id)
			}

		},
		getElementByIndex(element)
		{
			const index= this.rows.findIndex( 
				(elementCh) => {
					if(element.id==elementCh.id)
						return true;
				});
			return index;
		}

	}
}
</script>