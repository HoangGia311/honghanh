<template>
	<div id="app">
		<transition name="fade" mode="out-in">
			<vue-extend-layouts />
		</transition>
	</div>
</template>

<script>
	import VueExtendLayouts from 'vue-extend-layout'
	import { mapActions, mapGetters } from 'vuex';
	export default {
		name: 'App',
		components: {
			VueExtendLayouts
		},
	}
</script>
<style lang="scss" scoped>
	.app-loading{
		height: 100vh;
		width: 100%;
		display: flex;
		justify-content: center;
		align-items: center;
		background: $purple;
	}
</style>
