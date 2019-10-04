<template>
    <textarea class="form-control"></textarea>
</template>
<script>
    export default{
        name : 'editor',
        props : {
            value: {
                required: true
            },
            height: {
                type: Number,
                default: 150
            },
        },
        mounted() {
			let vm = this
            let config = {
				height: this.height,
                toolbar: [
                    ['style', ['style']],
                    ['font-style', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                    ['font', ['fontname']],
                    ['font-size', ['fontsize']],
                    ['font-color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
					['table', ['table']],
                    ['insert', ['gallery' ,'link', 'video']],
				],
				buttons: {
					gallery: function(context) {
						var ui = $.summernote.ui;
						var button = ui.button({
							contents: '<i class="note-icon-picture"></i>',
							tooltip: "Picute",
							class: "note-btn",
							click: function(){
								vm.$gallery.show((image)=>{
									$(vm.$el).summernote('insertImage',image.path);
								})
								
							}
						});
						return button.render();
					}
				},
			};
            config.callbacks = {
                onInit:  ()=>{
                    $(this.$el).summernote("code", vm.value);
                    $(this.$el).on('summernote.change', function() {
                        vm.$emit('input', $(vm.$el).summernote('code'));
                    })
                },
            };
            $(this.$el).summernote(config);
        },
        beforeDestroy(){
            $(this.$el).summernote('destroy');
        }
    }
</script>
<style lang="scss" >
    .note-editor.note-frame .note-editing-area .note-editable{
        min-height: 200px;
        height: auto !important;
    }
    .note-editor.note-frame .note-editing-area{
        overflow: auto;
        max-height: 500px;
    }
    .note-editor.note-frame .note-statusbar .note-resizebar{
        display: none;
	}
	.note-toolbar{
		.btn-group{
			display: inline-block;
		}
		// button{
		// 	background: #fff;
		// 	color:$text;
		// 	border: 1px solid #ddd;
		// }
	}
</style>    