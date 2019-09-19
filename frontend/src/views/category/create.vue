<template>
    <div class="page">
        <div class="page-header">
            <div class="page-title">
                <h1>Create Category</h1>
            </div>
            <div class="page-actions">
                <button >
                    Submit
                </button>
            </div>
        </div>
        <div class="page-body">
            <div class="row">
                <div class="col col-4">
                    <div class="card-aside">
                        <h2>Category</h2>
                    </div>
                </div>
                <div class="col col-8">
                    <div class="card">
                        <div class="card-section">
							<div class="m-b-15">
								<label class="m-b-5">Code</label>
								<input type="text" >
							</div>
							<div class="m-b-15">
								<label class="m-b-5">Name [Vi]</label>
								<input type="text" >
							</div>
							<div class="m-b-15">
								<label class="m-b-5">Name [En]</label>
								<input type="text" >
							</div>
							<div class="m-b-15">
								<div class="box-item-image" @click="gallery">
									<template v-if="form.primary_image">
										<img :src="form.primary_image.path" alt="">
									</template>
									<template v-else>
										<i class="icon-add-section"></i>
									</template>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
			<div class="row">
                <div class="col col-4">
                    <div class="card-aside">
                        <h2>SEO</h2>
                    </div>
                </div>
                <div class="col col-8">
                    <div class="card">
                        <div class="card-section">
							<div class="m-b-15">
								<label class="m-b-5">meta_title</label>
								<input type="text" >
							</div>
							<div class="m-b-15">
								<label class="m-b-5">meta_description</label>
								<input type="text" >
							</div>
							<div class="m-b-15">
								<label class="m-b-5">meta_keyword</label>
								<input type="text" >
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
	name : 'asdad',
	data(){
		return {
			form :{
				code : '',
				vi_name : '',
				primary_image : null
			}		
		}
	},
	methods:{
		gallery(){
			this.$gallery.show((image)=>{
				this.form.primary_image = image
			})
		}
	}
}
</script>
<style lang="scss" scoped>
	
</style>