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

			<div class="row col-md-6 ml-auto mr-auto" v-if="rows.length" >
				<table id="datatables" class="table table-striped">
					<thead>
						<tr>
							<th>Num</th>
							<th>Nom </th>
							<th>Capcité</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="r in  rows" >
							<td >
								{{r.id}}
							</td>
							<td >
								<div class="form-group">
									<input type="text" class="form-control" name="classes[]">
								</div>

							</td>
							<td >
								<div class="form-group">
									<input type="number" class="form-control" name="Capacite[]">
								</div>

							</td>
							<td>				
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
			data()
			{
				return {
					nombreClasse: '',
					rows : [],
					errors: {},


				}
			},
			mounted() {

			},
			methods:
			{

				AddRows() {
					console.log("hello word")
					this.rows= []
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