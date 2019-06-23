<template>
    <div>
        <toolbar></toolbar>
        <router-view></router-view>
    </div>
</template>

<script>
    import Toolbar from "@vue/components/App/Toolbar";
    export default {
        name: "Home",
        components: {Toolbar}
    }
</script>

<style scoped>

</style>