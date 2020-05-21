<template>
    <div>
        <div class="row">
            <div v-for="item in news.data" class="col-12" :key="item.id">
                <div class="card m-2">
                    <div class="card-body d-flex align-items-center">

                        <div class="card__left">
                            <img class="card-img" :src="item.img" alt="">
                        </div>

                        <div class="card__right ml-2">
                            <h5 class="card-title card__item">{{item.title}}</h5>
                            <p class="card-text card__item">{{item.date}}</p>
                            <p class="card-text card__item">{{item.short_description}}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="pagination-box">
            <pagination :data="news" @pagination-change-page="fetch"></pagination>
        </div>

    </div>
</template>

<script>
    export default {
        name: 'News',
        data () {
            return {
                news: {},
                hasError: false,
                error: '',
            }
        },
        methods: {
            fetch(page = 1) {
                this.$http.get('/api/news?page=' + page)
                    .then(response => {
                        this.news = response.data.news;
                    })
                    .catch(error => {
                        this.hasError = true;
                        this.error = error.response.data.error;
                    })
            }
        },
        created() {
            this.fetch();
        }
    }
</script>

<style scoped>
    .card__left{
        float: left;
        width: 300px;
        height: 225px;
    }
    .pagination-box{
        display: flex;
        justify-content: center;
    }
</style>
