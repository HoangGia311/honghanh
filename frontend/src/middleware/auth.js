export default ({ next, router , store })=> {
	if ( !store.getters['auth/getToken'] ) {
		next({ name: 'Login' })
		return false
	}
	return true
}