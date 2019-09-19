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
                        <h2>Aside Heading</h2>
                        <p>content</p>
                    </div>
                </div>
                <div class="col col-8">
                    <div class="card">
                        <div class="card-section">
                            <h5>Section Heading</h5>
                            <p>content</p>
							<button @click="show">show</button>
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
	methods:{
		show(){
			this.$gallery.show(function(image){
				console.log(image)
			})
		}
	}
}
</script>