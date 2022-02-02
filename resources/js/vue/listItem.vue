<template>
    <div class="item">
        <input 
            type="checkbox" 
            v-on:change="updateCheck()"
            v-model="item.completed"
            />  <!-- @:change -->
        <span v-bind:class="[item.completed ? 'completed' : '', 'itemText']"> {{ item.name }} </span>
        <button v-on:click="removeItem()" class="trashcan"> <!-- @:click -->
            <font-awesome-icon icon="trash" />
        </button>
    </div>  
</template>

<script>
export default {
    props: ['item'],   //item received  from listView.vue
    methods:{
        updateCheck(){                                  // atualiza item
            axios.put('api/item/' + this.item.id,{      // acessa api update / enviando id do item na url
                item: this.item                         // envia item como data na request
            })
            .then( response => {                        // lida com resposta
                if( response.status == 200 ){           // se sucesso (200)
                    this.$emit('itemchanged');          // informa elemento pai (listView) que item mudou com "$emit" (evento personalizado)
                }
            }) 
            .catch( error =>{                           // trata erro
                console.log( error );
            })
        },
        removeItem(){                                   // deleta item
            axios.delete('api/item/'+ this.item.id)     // acessa api destroy / enviando id do item na url
            .then( response =>{                         
                if (response.status == 200) {           // se sucesso (200)
                    this.$emit('itemchanged');          // informa elemento pai (listView) que item mudou ($emit)
                }
            })
            .catch (error => {
                console.log( error );                   // trata erro
            })
        }
    }
}
</script>

<style scoped>
.completed{
    text-decoration: line-through;
    color: #999999;
}
.itemText{
    width: 100%;
    margin-left: 20px;
}
.item{
    display: flex;
    justify-content: center;
    align-items: center;
}
.trashcan{
    background: #e6e6e6;
    border: none;
    color: #ff0000;
    outline: none;
    cursor: pointer;

}
</style>