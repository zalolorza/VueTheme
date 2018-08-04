<template>
		
	 <transition name="slide-fade">

        <div class="page-content sinle-news page-content--no-padding" v-if="loaded">
            
            <div class="pt-110 mb-115 mb-sm-100 mb-xs-60">

					<div class="container-fluid">

							<div class="row mb-sm-50 mb-sm-40">
								<div class="col col-md-6 offset-md-6">
									<div class="text-news title-news-wrapper">
										<div class="date mb-5 ">{{post.date | formatDate }}</div>
										<h1 class="title-news ">{{post.title.rendered}}</h1>
									</div>
								</div>
							</div>
					</div>
		    </div>

			<!--<div class="paginator mb-90 text-center font-13-22 text-uppercase">
				Paginator
			</div>-->
        </div>

	</transition>
</template>

<script>


export default {

	props: ["wproute"],

	created: function() {
		this.getPost();
	},

	data() {
		return {
			post: {},
			loaded: false
		};
	},


	methods: {

		getPost: function() {
			 
            this.$http.get( 'wp/v2/news' ,{
				params: { slug: this.$route.params.slug }
			}).then( ( res ) => {
				this.post = res.data[ 0 ];
				this.loaded = true;
				this.$store.commit( 'changeTitle', this.post.title.rendered );
            } );

		}

	}
};
</script>
