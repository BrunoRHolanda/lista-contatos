<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container>
        <v-card>
            <v-card-title>
                <v-spacer></v-spacer>
                <v-text-field
                        v-model="search"
                        append-icon="search"
                        label="Pesquisar"
                        single-line
                        hide-details
                ></v-text-field>
                <v-dialog v-model="dialog" max-width="500px">
                    <template v-slot:activator="{ on }">
                        <v-btn
                            fab
                            dark
                            absolute
                            left
                            color="teal"
                            v-on="on"
                        >
                            <v-icon dark>add</v-icon>
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="headline">{{ formTitle }}</span>
                        </v-card-title>

                        <v-card-text>
                            <v-container grid-list-md>
                                <v-layout wrap>
                                    <v-flex xs12 sm6 md4>
                                        <v-text-field
                                                v-model="contato.name"
                                                label="Nome"
                                        ></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4>
                                        <v-text-field
                                                v-model="contato.email"
                                                label="Email"
                                        ></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4>
                                        <v-text-field
                                                v-model="contato.telephone"
                                                label="Telefone"
                                                mask="(##)# ####-####"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" flat @click="close">Cancel</v-btn>
                            <v-btn color="blue darken-1" flat @click="save">Save</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-card-title>
            <v-data-table
                    :headers="headers"
                    :items="contatos"
                    :search="search"
                    class="elevation-1"
            >
                <template v-slot:items="props">
                    <td>{{ props.item.id }}</td>
                    <td>{{ props.item.name }}</td>
                    <td>{{ props.item.email }}</td>
                    <td>{{ props.item.telephone }}</td>
                    <td class="justify-center layout px-0">
                        <v-icon
                                small
                                class="mr-2"
                                @click="editItem(props.item)"
                        >
                            editar
                        </v-icon>
                        <v-icon
                                small
                                @click="deleteItem(props.item)"
                        >
                            remover
                        </v-icon>
                    </td>
                </template>
                <template v-slot:no-results>
                    <v-alert :value="true" color="error" icon="warning">
                        Your search for "{{ search }}" found no results.
                    </v-alert>
                </template>
            </v-data-table>
        </v-card>
    </v-container>
</template>

<script>

    import ContactsService from "@vue/services/ContactsService";
    import Contact from "@vue/models/Contact";
    import Toolbar from "@vue/components/App/Toolbar";

    export default {
        name: "Contatos",
        components: {Toolbar},
        data() {
            return {
                contatos: [],
                headers: [
                    {
                        text: 'Id',
                        align: 'left',
                        sortable: false,
                        value: 'id'
                    },
                    {
                        text: 'Nome',
                        align: 'left',
                        value: 'name'
                    },
                    {
                        text: 'Email',
                        align: 'left',
                        value: 'email'
                    },
                    {
                        text: 'Telefone',
                        align: 'left',
                        value: 'telephone'
                    },
                    {
                        text: 'Actions',
                        value: 'name',
                        sortable: false
                    }
                ],
                search: '',
                editedIndex: -1,
                contato: Contact,
                dialog: false,
            };
        },
        created() {
            ContactsService.index(this.fetchAllContacts);
        },
        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'Novo Contato' : 'Editar Contato'
            }
        },
        watch: {
            dialog (val) {
                val || this.close()
            }
        },
        methods: {
            fetchAllContacts(response, error) {
                if (error) return;
                this.contatos = response.body;
            },

            editItem (item) {
                this.editedIndex = this.contatos.indexOf(item);
                this.contato = Object.assign({}, item);
                this.dialog = true
            },

            deleteItem (item) {
                const index = this.contatos.indexOf(item);
                confirm('Deseja remover esse contato ?') && ContactsService.delete(
                    this.contatos[index], (response, error) => {
                        if (error) return;
                        this.contatos.splice(index, 1);
                    }
                );
            },

            close () {
                this.dialog = false;
            },

            save () {
                if (this.editedIndex > -1) {
                    ContactsService.update(this.contato, (response, error) => {
                        if (error) return;
                        Object.assign(this.contatos[this.editedIndex], response.body);
                        this.contato = Object.assign({}, Contact);
                        this.editedIndex = -1
                    });
                } else {
                    ContactsService.store(this.contato, (response, error) => {
                        if (error) return;
                        this.contatos.push(response.body);
                    });
                }
                this.close();
            }
        },
    }
</script>

<style scoped>

</style>
