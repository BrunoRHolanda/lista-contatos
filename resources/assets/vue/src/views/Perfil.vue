<template>
    <div>
        <v-container>
            <v-layout>
                <v-flex xs3 sm4 offset-sm4>
                    <v-card>
                        <v-container>
                            <v-form>
                                <v-text-field v-model="usuario.name" label="Nome"></v-text-field>
                                <v-text-field v-model="usuario.email" label="Email"></v-text-field>
                                <v-text-field v-model="usuario.password" label="Nova Senha"></v-text-field>
                                <v-spacer></v-spacer>
                                <v-btn dark color="primary" block large @click="save()">Salvar</v-btn>
                            </v-form>
                        </v-container>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
    import UserService from "@vue/services/UserService";

    export default {
        name: "Perfil",
        data() {
            return {
                usuario: {
                    id: this.$auth.user().id,
                    name: this.$auth.user().name,
                    email: this.$auth.user().email,
                    password: '',
                }
            }
        },
        methods: {
            save() {
                UserService.update(this.usuario, (response, error) => {
                    if (error) return;

                    this.$router.push({ name: 'app' });
                });
            }
        },
    }
</script>

<style scoped>

</style>