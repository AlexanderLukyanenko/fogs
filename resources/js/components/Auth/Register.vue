<template>
    <div class="row">
        <div class="col-8 offset-2">
            <div class="card card-default">
                <div class="card-header">Регистрация</div>
                <div class="card-body">
                    <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">
                        <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.email }">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email">
                            <span v-if="has_error && errors.email">{{ errors.email }}</span>
                        </div>
                        <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
                            <label for="password">Пароль</label>
                            <input type="password" id="password" class="form-control" v-model="password">
                            <span v-if="has_error && errors.password">{{ errors.password }}</span>
                        </div>
                        <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
                            <label for="password_confirmation">Повторите пароль</label>
                            <input type="password" id="password_confirmation" class="form-control" v-model="password_confirmation">
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
    </div>
</template>
<script>
    import VueRecaptcha from 'vue-recaptcha';

    export default {
        name: 'Register',
        components: {
            VueRecaptcha
        },
        data() {
            return {
                email: '',
                password: '',
                password_confirmation: '',
                has_error: false,
                error: '',
                errors: {},
                success: false,
                recaptchaToken: '',
            }
        },
        methods: {
            register() {
                var app = this
                this.$auth.register({
                    data: {
                        email: app.email,
                        password: app.password,
                        password_confirmation: app.password_confirmation,
                        recaptcha_token: this.recaptchaToken
                    },
                    success: function () {
                        app.success = true
                        app.$router.push({name: 'login', params: {successRegistrationRedirect: true}})
                    },
                    error: function (res) {
                        app.has_error = true
                        app.error = res.response.data.error
                        app.errors = res.response.data.errors || {}
                    }
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
