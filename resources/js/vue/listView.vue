<template>
    <div>
        <div v-for="(item, index) in items" :key="index">
            <list-item
                :item="item"
                class="item"
                v-on:itemchanged="$emit('reloadlist')"      
                />
        </div>  
        <!-- ":item" recebe item de v-for item (sends item to child component) -->
        <!-- "itemchanged: custom child method  -->
        <!-- "$emit('reloadlist') : tells parent component to reload list with $emit (custom method) -->
    </div>
</template>

<script>
import ListItem from './listItem.vue';

export default {
    props: ['items'],   //receive items from app.vue
    components: {
        ListItem
    }
}
</script>

<style scoped>
.item{
    background: #e6e6e6;
    padding: 5px;
    margin-top: 5px;
}
</style>