<template>
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th>Trimestre</th>
					<th>date_début</th>
					<th>date_fin</th>
					<th>Module</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="t in trimestre">
					<td>
						<select class="" name="trimestre[]" @change="SetDates($event.target.value)">
							<option :value="{{ t.id }}" >{{ t.nom }}</option>
						</select>
					</td>
					<td>{{trim.date_debut}}</td>
					<td>{{trim.date_fin}}</td>
					<td>
						<div class="form-group" >

							<select  class="custom-select custom-select-sm"  name="modules[]" title="Choose Model"  required>
								<option value="" selected hidden>'Selectionner</option>

								<option v-for="m as modules"  value="{{ m.id }}" >{{ m.nom_module }}</option>

							</select>

						</div>      
					</td>
				</tr>


			</tbody>
		</table>
	</div>	
	<div class="modal fade bd-AddAbsences-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="card card-signup card-plain">
					<div class="modal-header">
						<div class="card-header card-header-primary text-center">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								<i class="material-icons">clear</i>
							</button>
							<div class="card-title">
								<h4 >Ajouter une trimestre </h4>
							</div>

						</div>
					</div>
					<div class="modal-body">
						<div class="card-body">

							<div class="row justify-content-center">
								<div class="col-md-12">

									<form method="post"  @submit.prevent="AddAbsencesStudent(eleve.id)">
										<div class="row">
											<div class="form-group col-md-10 ml-auto mr-auto" >
												<label for="libelle" class="bmd-label-floating">Nom</label>
												<input type="text" name="libelle" class="form-control" id="libelle" v-model="form.motif">
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-10 ml-auto mr-auto">
												<div class="card ">
													<div class="card-header card-header-rose card-header-text">
														<div class="card-icon">
															<i class="material-icons">today</i>
														</div>
														<h4 class="card-title">Date de debut</h4>
													</div>
													<div class="card-body ">
														<div class="form-group ">
															<input type="date" name="date" data-date-format='Y-MM-DD' v-model="form.date" class="form-control text-center" >
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-10 ml-auto mr-auto">
												<div class="card ">
													<div class="card-header card-header-rose card-header-text">
														<div class="card-icon">
															<i class="material-icons">today</i>
														</div>
														<h4 class="card-title">Date de début</h4>
													</div>
													<div class="card-body ">
														<div class="form-group ">
															<div class="form-check form-check-inline">
																<input type="radio" class="form-check-input" id="decalage">
																<label class="form-check-label" for="decalge">
																Avec décalage</label>
															</div>
															<div class="form-check form-check-inline">
																<input type="radio" class="form-check-input" id="sansDecalage">
																<label class="form-check-label" for="sansDecalage">
																Sans décalage</label>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>									
										<div class="row">
											<div class="col-md-10 ml-auto mr-auto">
												<div class="card ">
													<div class="card-header card-header-rose card-header-text">
														<div class="card-icon">
															<i class="material-icons">today</i>
														</div>
														<h4 class="card-title">Date de fin</h4>
													</div>
													<div class="card-body ">
														<div class="form-group ">
															<input type="date" name="date" data-date-format='Y-MM-DD' v-model="form.date" class="form-control text-center" >
														</div>
													</div>
												</div>
											</div>
										</div>





										<div class="col-md-4 float-right">
											<button style="width: 100%;" type="submit" class="btn btn-fill btn-rose">Add</button>
										</div>

									</form>

								</div>
							</div>

						</div>
					</div>
					<div class="modal-footer justify-content-start">
						<button data-dismiss="modal"   class=" close btn btn-primary mt-4 btn-lg">Annuler</button>
					</div>
				</div>
			</div>
		</div>


	</div>
</template>
<script >

</script>