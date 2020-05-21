<template>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="navbar-nav">
                <router-link class="nav-item nav-link" :to="{name: 'home'}">Главная</router-link>
                <router-link class="nav-item nav-link" :to="{name: 'news'}">Новости</router-link>


                <router-link v-if="!this.$auth.user()" class="nav-item nav-link" :to="{name: 'login'}">Войти</router-link>
                <router-link v-if="!this.$auth.user()"class="nav-item nav-link" :to="{name: 'register'}">Регистрация</router-link>
                <router-link v-if="this.$auth.user()" class="nav-item nav-link" :to="{name: 'profile'}">Профиль</router-link>

                <a v-if="this.$auth.user()" class="nav-item nav-link" @click.prevent="$auth.logout()" href="#">Выйти</a>
            </div>
        </nav>
    </header>
</template>

<script>
    export default {
        name: "Head"
    }
</script>

<style scoped>

</style>
