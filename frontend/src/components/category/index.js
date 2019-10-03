import AppModal from './modal.vue'

const Modal = {
	install(Vue, options) {
		this.EventBus = new Vue()

		Vue.component('vue-modal-category', AppModal)

		Vue.prototype.$category = {
			show(params) {
				Modal.EventBus.$emit('show', params)
			}
		}
	}
}

export default Modal