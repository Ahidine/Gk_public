<template>
              <table id="" class="table table-striped table-no-bordered table-hover">
                <thead class="text-primary text-center">
                  <th>

                  </th>
                  <th>
                    8-10
                  </th>
                  <th>
                    10-12
                  </th>
                  <th>
                    2-4
                  </th>
                  <th>
                    4-6
                  </th>


                </thead>
                <tbody>

                 
                  <tr v-for="j in Jours">
                    <th>
                      {{ j.jour }}
                    </th>
                    
                    <td v-for="i in rows">
                      
                      <div :class="'text-center indice'+index" v-if="show">
                        <button class="btn btn-primary" type="button" > Add </button>
                      </div>
                      <div v-if="!show" :class="index">
                      <select class="browser-default custom-select " name="prof[]" > 
                        <option selected hidden  > Professeur  ! </option> 
                        
                        <option v-for="p in Professeur" :value="p.id"> {{ p.employe.nom }}</option>
                  
                      </select>
                      <select class="'browser-default custom-select" name="salle[]">
                      <option selected hidden   > Salle ! </option> 
                        
                        <option v-for="s in Salle" :value="s.id "> {{ s.num }}</option>
 
                      </select>
                      <input type="hidden" name="jour[]" :value="j.id">
                    </div>
                    </td>


                  </tr>
                </tbody>
              </table>  
</template>
<script >
export default {
  props:['prof','jours','salle'],
  data()
  {
    return {
      rows :[1,2,3,4],
      Professeur: this.prof,
      Jours:this.jours,
      Salle:this.salle,
      index:0,
      show:true,

    }
  },
  mounted() {
    //console.log('here'+this.rows.length)
  },
  methods:
  {

    AddRow() {
      
    },
    RemoveRow(index) {
      this.rows.splice(this.rows.indexOf(index),1)
    },
  }
} 
</script>