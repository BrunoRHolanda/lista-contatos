<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container>
        <v-card>
            <v-card-title>
                <v-toolbar-title>Contatos</v-toolbar-title>
                <v-divider
                        class="mx-2"
                        inset
                        vertical
                ></v-divider>
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
                        <v-btn color="primary" dark v-on="on">Novo Contato</v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="headline">{{ formTitle }}</span>
                        </v-card-title>

                        <v-card-text>
                            <v-container grid-list-md>
                                <v-layout wrap>
                                    <v-flex xs12 sm6 md4>
                                        <v-text-field v-model="editedItem.name" label="Nome"></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4>
                                        <v-text-field v-model="editedItem.email" label="Email"></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4>
                                        <v-text-field v-model="editedItem.telephone" label="Telefone"></v-text-field>
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

    export default {
        name: "Contatos",
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
                editedItem: {
                    id: null,
                    name: '',
                    email: '',
                    telephone: 0,
                },
                defaultItem: {
                    id: null,
                    name: '',
                    email: '',
                    telephone: 0,
                },
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
                this.contatos = response.body;
            },

            editItem (item) {
                this.editedIndex = this.contatos.indexOf(item);
                this.editedItem = Object.assign({}, item);
                this.dialog = true
            },

            deleteItem (item) {
                const index = this.contatos.indexOf(item);
                confirm('Deseja remover esse contato ?') && this.contatos.splice(index, 1)
            },

            close () {
                this.dialog = false;
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem);
                    this.editedIndex = -1
                }, 300)
            },

            save () {
                if (this.editedIndex > -1) {
                    Object.assign(this.contatos[this.editedIndex], this.editedItem);
                } else {
                    this.contatos.push(this.editedItem);
                }
                this.close();
            }
        },
    }
</script>

<style scoped>

</style>
