<template>


        <div class="page-content page-content--no-padding" >
           
            <div class="mb-160 mb-xs-150" v-if="loaded">
                <NewsList :amount="3" />
            </div>

        </div>


</template>

<script>
import Vue from 'vue';
import Page from './Page.vue';
import NewsList from './NewsList.vue';


export default {
    extends: Page,
    components:{
        NewsList
    },
    data:()=>({
       
    })
};
</script>

<style lang="scss">
  

</style>