<template>
    <v-container>
        <v-layout>
            <v-flex xs3 sm4 offset-sm4>
                <v-card>
                    <v-container>
                        <v-card-title primary-title>
                            <h3>Entrar</h3>
                        </v-card-title>
                        <v-form v-if="!loading">
                            <v-text-field
                                    prepend-icon="person"
                                    name="Username"
                                    label="Email"
                                    v-model="email"
                            ></v-text-field>
                            <v-text-field
                                    prepend-icon="lock"
                                    name="Password"
                                    label="Senha"
                                    type="password"
                                    v-model="password"
                            ></v-text-field>
                            <v-card-actions>
                                <v-btn primary large block @click="enviar()">Login</v-btn>
                            </v-card-actions>
                        </v-form>
                        <div class="text-xs-center" v-if="loading">
                            <v-progress-circular
                                    :size="70"
                                    :width="7"
                                    color="purple"
                                    indeterminate
                            ></v-progress-circular>
                        </div>
                    </v-container>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        name: "Login",
        data() {
            return {
                email: '',
                password: '',
                remember: true,
                loading: false,
            };
        },
        methods: {
            enviar() {
                this.loading = true;
                this.$auth.login({
                    body: { email: this.email, password: this.password },
                    error: () => alert('Usuário e/ou senha inválidos.'),
                    rememberMe: this.remember,
                    redirect: '/contatos'
                });
            }
        },
    }
</script>

<style scoped>

</style>