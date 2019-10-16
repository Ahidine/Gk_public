<template>
        <div class="row">
         <div class="col-md-12 ">
          <div class="table-responsive container" >
            <table id="datatables" class="table table-striped">
              <thead>
                <tr>
                  <th width="10%" ></th>
                  <th width="30%" >Centre</th>
                  <th width="30%" >Prix</th>
                  <th width="30%" >Devise</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="c in c_niveau" >
                  <td width="10%">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input"  :value="c.id" name="centresold[]" type="checkbox"  checked @change="submitPays($event.target,c.id)">
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                      </td>

                  
                
                  <td width="30%">{{c.nom}} </td>
                  <td width="30%"> <input  :class="'form-control cl'+c.id" type="numeric" name="prixold[]" :value="c.pivot.prix"> </td>
                  <td width="30%">
                   
                      <select style="display:inline-block" name="deviseold[]" :class="'selectpicker cl'+c.id" data-style="select-with-transition" title="" data-size="100" required>
                        <option :value="c.pivot.devise" selected >{{c.pivot.devise }}</option>                   
                        <option  v-if="c.pivot.devise != '€'"  value="€" >€</option>
                        <option  v-if="c.pivot.devise != '$'"  value="$" >$</option>
                        <option  v-if="c.pivot.devise != 'DH'" value="DH" >DH</option>
                      </select>
                    
                  </td>
                </tr>


   
                <tr v-for="cn in centr"   v-if="!ids_c.includes(cn.id)" >
                  <td width="10%">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" :value="cn.id"  name="centresnew[]"  type="checkbox" 
                             @change="submitPays($event.target,cn.id)">
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                      </td>

                  
                  <td width="30%"> {{cn.nom}} </td>
                  <td width="30%"><input :class="'notdisplay form-control cl'+cn.id" type="numeric"   name="prixnew[]"  > </td>
                  <td width="30%">
                   
                      <select  :class="'selectpicker cl'+cn.id" style="display:inline-block"   name="devisenew[]" data-style="select-with-transition" title="" data-size="100" required>
                        <option  selected hidden>Devise</option>
                        <option value="€" >€</option>
                        <option value="$" >$</option>
                        <option value="DH" >DH</option>
                      </select>
                    
                  </td>
                </tr>



              </tbody>
            </table>
          </div>
        </div>	
    </div>
</template>
<script >
export default {
	 props: ['centres_niveau','centres','niveau'],
	data()
	{
		return {
			c_niveau : this.centres_niveau,
			centr : this.centres,
			nv : this.niveau,
			ids_c : [],


		}
	},
	mounted() {
		axios.get('/getCentresId/'+this.nv)
		.then(({data})=>{
			this.ids_c = data
		  //	console.log(data)


			
		})
	},
	methods:
	{
		onChange(e,id) {
			// console.log($event.target.value)

		},
		submitPays(e,id) {
			//console.log(e.checked+' '+id)
			if(!e.checked)
			{
				$(".cl"+id).css("display", "none");
				//console.log('here')
			}
			else
			{
				$(".cl"+id).css("display", "block");
			}

			
		},
		submitVille() {


		},
	}
}	
</script>