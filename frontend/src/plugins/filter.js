import Vue from 'vue'
import moment from  'moment'

Vue.filter('avatar', function(value){
    if( value ){
        var nameSplit = String(value).toUpperCase().split(' ')
        var initials = null
        if (nameSplit.length == 1) {
            initials = nameSplit[0] ? nameSplit[0].charAt(0):'?';
        } else {
            initials = nameSplit[0].charAt(0) + nameSplit[1].charAt(0);
        }
        return initials
    }
    return value
})