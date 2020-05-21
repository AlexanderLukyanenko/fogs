<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">Вход</div>
            <div class="card-body">
                <div class="alert alert-danger" v-if="has_error">
                    <p>Неверно указаны данные</p>
                </div>
                <form autocomplete="off" @submit.prevent="login" method="post">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="password" id="password" class="form-control" v-model="password" required>
                    </div>
                    <div class="form-group">
                        <vue-recaptcha ref="recaptcha" sitekey="6LcQMfoUAAAAAN0vXXFg6aQG8xkbDP3OZE5cg0ot" @verify="onVerify" :loadRecaptchaScript="true" @expired="onCaptchaExpired"/>
                        <span class="help-block" v-if="has_error && errors.password">{{ errors.password }}</span>
                        <button type="submit" class="btn btn-default">Войти</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    import VueRecaptcha from 'vue-recaptcha'

    export default {
        data() {
            return {
                email: null,
                password: null,
                has_error: false,
                errors: [],
                recaptchaToken: '',
            }
        },
        components: {
            VueRecaptcha
        },
        methods: {
            login() {
                var app = this
                this.$auth.login({
                    params: {
                        email: app.email,
                        password: app.password,
                        recaptcha_token: this.recaptchaToken
                    },
                    success: function() {
                    },
                    error: function(res) {
                        app.has_error = true
                        app.error = res.response.data.error
                        app.errors = res.response.data.errors || {}
                    },
                    rememberMe: true,
                    fetchUser: true
                })
            },
            onVerify(response){
                this.recaptchaToken = response;
            },

            onCaptchaExpired () {
                this.$refs.recaptcha.reset()
            }
        }
    }
</script>
