<template>
    <div>
        <Head></Head>

        <div class="container">
            <div v-if="msgStatus === true" class="alert alert-success alert-dismissible">
                <button @click="hidePopUp()" type="button" class="close" data-dismiss="alert">&times;</button>
                {{msg}}
            </div>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import Head from "./Layouts/Head";
    import {mapGetters, mapActions} from 'vuex'

    export default {
        name: "App",
        components: {Head},
        computed: mapGetters(['msg', 'msgStatus']),
        methods:{
            ...mapActions(['popUp']),
            hidePopUp(){
                this.popUp({
                    msg: '',
                    msgStatus: false,
                });
            }
        }
    }
</script>

<style scoped>

</style>
