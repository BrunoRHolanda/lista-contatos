<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container class="text-xs-center">
        <v-tooltip bottom>
            <template v-slot:activator="{ on }">
                <v-btn fab dark large color="teal" v-on="on" @click="$router.push({ name: 'contatos'})">
                    <v-icon dark>person</v-icon>
                </v-btn>
            </template>
            <span>Meus Contatos</span>
        </v-tooltip>
    </v-container>
</template>

<script>
    export default {
        name: "Menu"
    }
</script>

<style scoped>

</style>