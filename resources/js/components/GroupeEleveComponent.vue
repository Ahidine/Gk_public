<template>
  <div>
     <div class="row">
    <label class="col-sm-2 col-form-label"> Centre </label>
    <div class="col-sm-10">
      <div class="form-group">
        <select  class="browser-default custom-select" name="centre"  v-on:click="onChangeCentre($event.target.value)">
          <option v-for="c in centres" :value="c.id" :selected="c.id==Centre.id" >{{c.nom}}</option>
        </select>

      </div>
    </div>
  </div>
    <h4 class="info-text">Quel niveau ? </h4>
    <div class="row">
      <div class="col-md-4 ml-auto mr-auto">
        <div class="choice" data-toggle="wizard-radio" v-on:click="onChange(1)" rel="tooltip" title="les eleves entre 5-7 ans">
          <input type="radio" name="niveau" value="1"  >
          <div class="icon"  >
            <i class="material-icons">
              child_care
            </i>
          </div>
          <h6>Junior</h6>
        </div>
      </div>
      <div class="col-md-4 ml-auto mr-auto">
        <div class="choice" data-toggle="wizard-radio" v-on:click="onChange(2)"  rel="tooltip" title="les eleves entre 8-15 ans">
          <input type="radio" name="niveau" value="2" >
          <div class="icon"  >
            <i class='fas fa-child'></i>


          </div>
          <h6>Medior</h6>
        </div>
      </div>
    
    </div>



    <div class="row" v-if="groupes.length"> 
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-rose card-header-icon">
            <div class="card-icon">
              <i class="fas fa-university"></i>
            </div>
            <h4 class="card-title" > Les groupes  </h4>

          </div>
          <div class="card-body">
           <div class="table-responsive" >

            <table id="datatables" class="table table-striped table-no-bordered table-hover">
              <thead class="text-primary">
                <th>
                  Nom
                </th>
                <th>
                  Capacité
                </th>
                <th>
                  Nombres Inscrits
                </th>
                <th>
                  Nombres Restans
                </th>
                <th> Action</th>

              </thead>
              <tbody id="body">


                <tr v-for="g in groupes"  class="text-center">
                  <td>
                    {{ g.nom_groupe }}
                  </td>
                  <td>
                    {{ g.capacite }}
                  </td>
                  <td>
                    {{ g.eleves_count }}
                  </td>
                  <td>
                    {{ g.capacite - g.eleves_count }}
                  </td>
                  <td class="td-actions text-right">
                    <div class="form-check form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" name="groupe_id"  type="radio" :value="g.id"> 
                        <span class="form-check-sign">
                          <span class="check"></span>
                        </span>
                      </label>
                    </div>

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
  props: ['centre'],
  data()
  {
    return {
      groupes : [],
      nbr_insc : {},
      niveau : '',
      centres: [],

      Centre:this.centre,
    }
  },
  mounted() {
   axios.get('/getAllCentres')
   .then(({data})=>{   
    this.centres =data
  })
  },
  methods:
  {
  onChangeCentre(e) {
    axios.get('/getCentres/'+e)
   .then(({data})=>{   
    this.Centre =data
  })
    },
    onChange(e) {
      //console.log(this.Centre.id)
      this.groupes = []
      axios.get('/getGroupeByThowIdWithCounting/'+this.Centre.id+'/'+e)
      .then(({data})=>{
        if (data.length>0)
        this.groupes =data
        else
        $.notify({
          icon: "info",
          message: "ce niveau ne contient pas des groupes  ",
        }, {
          type: 'warning',
          timer: 3000,
          placement: {
            from: 'top',
            align: 'right'
          }
        });
       // console.log(data)

      })
      .catch(error => {
        $.notify({
          icon: "error",
          message: "erreur quelques part ",
        }, {
          type: 'danger',
          timer: 3000,
          placement: {
            from: 'top',
            align: 'right'
          }
        });
      })

     axios.get('/putSessionNiveau/'+e+'/'+this.Centre.id)
      .then(({data})=>{
        //console.log(data)

      })
      .catch(error => {
        $.notify({
          icon: "error",
          message: "Ce niveau n'est pas disponible dans le centre "+this.Centre.nom,
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
  }
}
</script>
