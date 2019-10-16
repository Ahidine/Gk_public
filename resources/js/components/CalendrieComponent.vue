<template>
      <div class="col-md-10 ml-auto mr-auto">
        <div class="card card-calendar">
          <div class="card-body ">
            {{calendarie}} test
          </div>
        </div>
      </div>	
</template>
<script >
export default {
	props: ['calendar'],
	data()
	{
		return {
			calendrie: this.calendar,

		}
	},
	mounted() {
		//console.log('here'+this.calendar)
	},
	methods:
	{
		
	}
}	
</script>