<template>
    <div class="app-auth">
        <div class="app-auth-container">
            <transition name="fade" mode="out-in">
                <router-view />
            </transition>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'auth'
    }
</script>
<style lang="scss" scoped>
    .app-auth{
        background: $primary-background;
        height: 100vh;
        width: 100vw;
        overflow: auto;
        max-width: 100vw;
        max-height: 100vh;
        .app-auth-container{
            background: $primary-background;
            overflow: auto;
            position: relative;
            padding: 50px 30px;
            text-align: center;
        }
    }
</style>

