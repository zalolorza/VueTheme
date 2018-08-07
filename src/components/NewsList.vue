<template>

        <div class="news news-list">
            
            <transition v-bind:css="false" v-on:enter="enterList"  name="transition-news-list">
                <div class="container" v-if="loaded">
                    <div :key="post.id" class="row justify-content-center news-item" v-for="post in news">
                            <router-link :to="post.link | urlToPath">
                                    <div class="row">
                                        <div class="col-3 text-uppercase">
                                        
                                                {{post.date | formatDate}}
                                        
                                        </div>
                                        <div class="col" style="">
                                        
                                                {{post.title.rendered}}
                                            
                                        </div>
                                    </div>
                            </router-link>
                    </div>
                </div>
            </transition>

        </div>

</template>


<script>

import { mapGetters } from 'vuex';
import { TweenMax } from "gsap/TweenMax"

export default {

    name: 'NewsList',

     props: {
        amount:Number
    },

    data() {
		return {
            offset: 0,
            per_page: 9,
			news: {},
            loaded:false
		};
    },

    created: function() {
        this.per_page = this.amount;
        this.isNewsPage = this.isArchive;
        this.getNews();
    },
	
    computed: {
      	...mapGetters({
          
        })
    },
	methods: {

        enterList(el, done){
            TweenMax.staggerFromTo('.transition-news-list',0.4,{opacity:0, y:30},{opacity:1,y:0},0.05);
        },
        getNews() {
            
            this.$http.get( 'wp/v2/news-vue/?per_page='+this.per_page+'&offset='+this.offset)
			.then( ( res ) => {
                this.news = {...this.news, ...res.data};
                this.offset = this.per_page;
                this.loaded = true;
            } );

        }
	},
};
</script>

<style lang="scss">

</style>