import AppModal from './modal.vue'

const Modal = {
	install(Vue, options) {
		this.EventBus = new Vue()

		Vue.component('vue-gallery', AppModal)

		Vue.prototype.$gallery = {
			show(params) {
				Modal.EventBus.$emit('show', params)
			}
		}
	}
}

export default Modal