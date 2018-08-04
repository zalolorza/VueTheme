<template>


        <div class="page-content page-content--no-padding">
            <div class="mt-270 mt-lg-250 mt-md-220 mt-sm-200 mt-xs-140 mb-190 mb-md-100 mb-sm-60 mb-xs-30" v-if="loaded">
                <NewsList  :amount="9" />
            </div>
        </div>


</template>


<script>

import { mapGetters } from 'vuex';
import NewsList from './NewsList.vue';

export default {

    props: ["wproute"],

    created: function() {
        this.getPage();
    },
    
    components:{
        NewsList
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
	},
};
</script>