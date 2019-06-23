<template>
    <div>
        <v-toolbar dark color="primary">
            <v-btn icon @click.stop="drawer = !drawer">
                <v-icon>menu</v-icon>
            </v-btn>

            <v-toolbar-title class="white--text">App Contatos</v-toolbar-title>

            <v-spacer></v-spacer>

            <v-btn icon @click="logout()">
                <v-icon>exit_to_app</v-icon>
            </v-btn>
        </v-toolbar>
        <v-navigation-drawer
                v-model="drawer"
                absolute
                temporary
        >
            <v-list class="pa-1">
                <v-list-tile avatar>
                    <v-list-tile-avatar>
                        <img src="https://randomuser.me/api/portraits/men/85.jpg">
                    </v-list-tile-avatar>

                    <v-list-tile-content>
                        <v-list-tile-title>{{ $auth.user().name }}</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>

            <v-list class="pt-0" dense>
                <v-divider></v-divider>

                <v-list-tile @click="$router.push({ name: 'app'})">
                    <v-list-tile-action>
                        <v-icon>dashboard</v-icon>
                    </v-list-tile-action>

                    <v-list-tile-content>
                        <v-list-tile-title>Dashboard</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>

                <v-list-tile @click="$router.push({ name: 'perfil'})">
                    <v-list-tile-action>
                        <v-icon>account_box</v-icon>
                    </v-list-tile-action>

                    <v-list-tile-content>
                        <v-list-tile-title>Perfil</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>

                <v-list-tile @click="$router.push({ name: 'contatos'})">
                    <v-list-tile-action>
                        <v-icon>person</v-icon>
                    </v-list-tile-action>

                    <v-list-tile-content>
                        <v-list-tile-title>Contatos</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
        </v-navigation-drawer>
    </div>

</template>

<script>
    export default {
        name: "Toolbar",
        data() {
            return {
                drawer: null,
                items: [
                    {title: 'Home', icon: 'dashboard'},
                    {title: 'About', icon: 'question_answer'}
                ]
            }
        },
        methods: {
            logout() {
                this.$auth.logout({
                    makeRequest: true,
                    params: {},
                    success: function () {
                    },
                    error: function () {
                    },
                    redirect: '/login',
                });
            }
        }
    }
</script>

<style scoped>

</style>