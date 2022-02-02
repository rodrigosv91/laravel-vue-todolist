<template>
    <div class="addItem">
        <input type="text" v-model="item.name" />
        <font-awesome-icon
            icon="plus-square"
            v-on:click="addItem()"  
            v-bind:class="[ item.name ? 'active' : 'inactive', 'plus' ]" 
            
        /> <!-- v-on:click shorthand -> "@click" --> <!-- v-bind shorthand -> shorthand ":" -->
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            item: {
                name:""
            }
        }
    },
    methods: {
        addItem() {
            if(this.item.name == ''){               // test if item.name is empty, return if true
                return;
            }
            // continue if something was provided
            axios.post('api/item/store', {          // access api method "store"
                item: this.item                     // sends item as data in http request
            })
            .then( response =>{                     // then handle the response
                if(response.status == 201){         // if response status is successful (201)
                    this.item.name = "";            // resets input element
                    this.$emit('reloadlist');       // recarrega items da lista (em componente <add-item-form> em app)
                }
            })
            .catch(error => {
                console.log( error );               // handle error
            })
        }
    }
}
</script>

<style scoped>
.addItem {
    display: flex;
    justify-content: center;
    justify-items: center;
}

input {
    background: #f7f7f7;
    border: 0px;
    outline: none;
    padding: 5px;
    margin-right: 10px;
    width: 100%;
}

.plus{
    font-size: 20px;
    cursor: pointer;
}

.active{
    color: #00CE15;
}
.inactive{
    color:#999999;
}
</style>