<template>
    <div class="row">
        <div class="offset-2 col-lg-8">
            <div class="card mt-3">
                <div class="card-body">
                    <form autocomplete="off" @submit.prevent="upd">

                        <div v-if="hasError === true" class="alert alert-danger alert-dismissible">
<!--                            <button @click="hasError = false" type="button" class="close" data-dismiss="alert">&times;</button>-->
                            <ul>
                                <li v-for="error in errors">{{error[0]}}</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label for="family">Фамилия</label>
                            <input type="text" id="family" class="form-control" placeholder="Фамилия" v-model="family">
                        </div>
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" id="name" class="form-control" placeholder="Имя" v-model="name">
                        </div>
                        <div class="form-group">
                            <label for="second">Отчество</label>
                            <input type="text" id="second" class="form-control" placeholder="Отчество" v-model="second">
                        </div>
                        <div class="form-group">
                            <label for="birthday">Дата рождения</label>
                            <input type="date" id="birthday" class="form-control" placeholder="Дата рождения" v-model="birthday">
                        </div>
                        <div v-if="img !== null" class="form-group">
                            <label for="birthday">Текущее фото</label>
                            <div>
                                <img style="width: 240px; height: 320px;" :src="'/' + img" alt="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="img">Фото</label>
                            <input type="file"
                                   class="form-control-file"
                                   id="img"
                                   @change="onAttachmentChange"
                            >
                        </div>
                        <button type="submit" class="btn btn-default">Изменить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions} from 'vuex'
    export default {
        name: 'Profile',
        data () {
            return {
                name: '',
                family: '',
                second: '',
                birthday: null,
                img: '',

                hasError: false,
                error: '',
                errors: [],

                attachment: null,
            }
        },
        methods: {
            ...mapActions(['popUp']),
            onAttachmentChange(e) {
                this.attachment = e.target.files[0]
            },
            fetch() {
                this.$http.get('/api/users/' + this.$auth.user().id)
                    .then(response => {
                        this.name = response.data.user.name;
                        this.family = response.data.user.family;
                        this.second = response.data.user.second;
                        this.birthday = response.data.user.birthday;
                        this.img = response.data.user.img;
                        this.hasError = false;
                    })
                    .catch(error => {
                        this.hasError = true;
                        this.error = error.response.data.error;
                    })
            },
            upd() {
                const config = {'content-type': 'multipart/form-data'}
                const formData = new FormData()
                formData.append('name', this.name)
                formData.append('family', this.family)
                formData.append('second', this.second)
                formData.append('birthday', this.birthday)
                formData.append('_method', 'PUT')

                if(this.attachment !== null){
                    formData.append('attachment', this.attachment)
                }

                this.$http.post('/api/users/' + this.$auth.user().id, formData , config )
                    .then(response=>{
                        this.popUp({
                            msg: response.data.msg,
                            msgStatus: true,
                        });
                        this.fetch();
                    })
                    .catch(error=>{
                        this.hasError = true;
                        this.errors = error.response.data.errors;
                    });
            }

        },
        created() {
            this.fetch();
        }
    }
</script>

<style scoped>

</style>
