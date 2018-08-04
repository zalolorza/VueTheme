<style>

</style>

<template>

	<div class="page-content page-default" v-if="loaded">
		<div class="container">
			<div class="row" >

				<div class=" col" >

					<h2 class=""> {{ page.title.rendered }}</h2>
					<div class="" v-html="page.content.rendered"></div>

				</div>

			</div>
		</div>
	</div>


</template>

<script>


export default {

    props: ["wproute"],

	created: function() {
		this.getPage();
	},

	data() {
		return {
			page: {},
			loaded:false
		};
	},
	methods: {
		getPage: function() {
			
			this.$http.get( 'wp/v2/pages/'+this.wproute.id)
			.then( ( res ) => {
				this.page = res.data;
				this.$store.commit( 'changeTitle', this.page.title.rendered );
				this.loaded = true;
			} );
		}
	}

};
</script>
