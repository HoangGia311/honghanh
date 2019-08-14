import Vue from 'vue'
import Vuelidate from 'vuelidate'
import Toasted from 'vue-toasted'
import lineClamp from 'vue-line-clamp'
import pagination from '@/components/pagination'
import Modal from './modal'


import './helper'
import './axios'
import './filter'
import 'bootstrap'
import '@/styles/style.scss'
Vue.use(Modal)
Vue.use(Vuelidate)
Vue.use(Toasted, {
    position : 'top-right',
    duration: 5000 ,
    keepOnHover: true,
    iconPack: 'material',
    type: 'success',
    containerClass : 'vue-toast',
    action : {
        icon : 'close',
        onClick : (e, toastObject) => {
            toastObject.goAway(0);
        }
    },
})
Vue.use(lineClamp, {})
Vue.component('pagination', pagination)


