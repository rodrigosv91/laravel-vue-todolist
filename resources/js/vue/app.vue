<template>
    <div class="todoListContainer">
        <div class="heading">
            <h2 id="title">Todo List</h2>
            <add-item-form 
                v-on:reloadlist="getList()"
                />          
        </div>
        <list-view 
            :items="items" 
            v-on:reloadlist="getList()"
            /> 
            <!-- could use vue State Management -->
    </div>
</template>

<script>    

import addItemForm from "./addItemForm.vue";
import listView from './listView.vue';


export default {
    components:{
        addItemForm,
        listView
    },
    data: function () {
        return{
            items: []
        }
    },
    methods:{
        getList () {                        //metodo que retorna items
            axios.get('api/items')          //acessa metodo index via api com axios
            .then( response =>{             //lida com resposta
                this.items = response.data;  //atribui a this.item -> response.data (axios server response (metodo index() em api)) 
            })
            .catch(error => {
                console.log( error );       // lida com erro
            })
        }
    },
    created(){                              //em life cycle "created"
        this.getList();                     //aciona metodo getList()
    }
}
</script>

<style scoped>
.todoListContainer {
    width: 350px;
    margin: auto;
}

.heading {
    background: #e6e6e6;
    padding: 10px;

}

#title {
    text-align: center;
}

</style>